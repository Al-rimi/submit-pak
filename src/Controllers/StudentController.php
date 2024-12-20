<?php

namespace AlRimi\Submit\Controllers;

use AlRimi\Submit\Models\Student;
use AlRimi\Submit\Mail\SubmitEmail;
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

            $folderName = $student->student_id . '_' . $student->student_name;

            // Check if the request contains files for upload
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $fileName = $folderName . '-' . Str::random(4) . '-' . $file->getClientOriginalName();

                    $file->storeAs(
                        'student_submissions/' . $folderName,
                        $fileName,
                        'public'
                    );
                }
            }

            $student->increment('submit_count');

            try {
                $recipientEmail = config('submit.notification_email');
                Mail::to($recipientEmail)->send(new SubmitEmail(
                    $student->student_id,
                    $student->student_name
                ));
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Files submitted, but email notification failed.');
            }

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
        $students = Student::all();

        return view('submission', compact('students'));
    }
}
