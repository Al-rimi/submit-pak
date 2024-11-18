<?php

namespace AlRimi\Submit\Controllers;

use AlRimi\Submit\Models\Student;
use AlRimi\Submit\Mail\CustomEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
     * Handle the submission of files by students.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|digits:12',         // Validate student ID to be exactly 12 digits
            'name' => 'required|string',         // Validate student name as a string
            'files.*' => 'required|file|max:102400' // Validate files to be uploaded, with a max size of 100 MB
        ]);

        // Find the student by ID and name
        $student = Student::where('student_id', $validated['id'])
                          ->where('student_name', $validated['name'])
                          ->first();

        if ($student) {
            // Create a unique folder name based on student ID and name
            $folderName = $student->student_id . '_' . $student->student_name;

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    // Generate a unique file name
                    $fileName = $folderName . '-' . Str::random(4) . '-' . $file->getClientOriginalName();
                    $file->storeAs('student_submissions/' . $folderName, $fileName, 'public'); // Store file in the public directory
                }
            }

            // Increment the submission count for the student
            $student->increment('submit_count');

            // Send a notification email to the admin
            $recipientEmail = env('NOTIFICATION_EMAIL'); // Fetch email from environment variables
            Mail::to($recipientEmail)->send(new CustomEmail($student->student_id, $student->student_name));

            return redirect()->back()->with('success', 'Files submitted successfully.');
        } else {
            // Return error if the student is not found
            return redirect()->back()->withErrors(['message' => 'Student not found.']);
        }
    }

    /**
     * Display the list of students.
     */
    public function index()
    {
        // Retrieve all students
        $students = Student::all();
        return view('submission', compact('students')); // Pass students data to the view
    }
}
