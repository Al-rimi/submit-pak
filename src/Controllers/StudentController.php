<?php

namespace AlRimi\Submit\Controllers;

use AlRimi\Submit\Models\Student;
use AlRimi\Submit\Mail\CustomEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentController
{
    /**
     * Handle the submission of files by students.
     * 
     * This method validates the request, processes file uploads,
     * updates the submission count, and notifies the admin via email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'id' => 'required|digits:12',          // Ensure the student ID is exactly 12 digits
            'name' => 'required|string',          // Ensure the student name is provided as a string
            'files.*' => 'required|file|max:102400' // Validate each file with a maximum size of 100 MB
        ]);

        // Retrieve the student record matching the provided ID and name
        $student = Student::where('student_id', $validated['id'])
                          ->where('student_name', $validated['name'])
                          ->first();

        if ($student) {
            // Create a unique folder name combining the student ID and name
            $folderName = $student->student_id . '_' . $student->student_name;

            // Check if the request contains files for upload
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    // Generate a unique file name to prevent conflicts
                    $fileName = $folderName . '-' . Str::random(4) . '-' . $file->getClientOriginalName();

                    // Store the file in the designated public directory
                    $file->storeAs(
                        'student_submissions/' . $folderName,
                        $fileName,
                        'public'
                    );
                }
            }

            // Increment the student's submission count
            $student->increment('submit_count');

            // Send a notification email to the configured admin email address
            $recipientEmail = config('submit.notification_email'); // Fetch email from config
            Mail::to($recipientEmail)->send(new CustomEmail(
                $student->student_id,
                $student->student_name
            ));

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Files submitted successfully.');
        } else {
            // Redirect back with an error message if the student is not found
            return redirect()->back()->withErrors([
                'message' => 'Student not found.'
            ]);
        }
    }

    /**
     * Display the list of students.
     * 
     * This method retrieves all students from the database
     * and passes the data to the submission view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all student records
        $students = Student::all();

        // Pass the students' data to the view named "submission"
        return view('submission', compact('students'));
    }
}
