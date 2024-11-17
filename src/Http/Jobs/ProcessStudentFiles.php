<?php

namespace AlRimi\Submit\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProcessStudentFiles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePaths;
    protected $folderName;

    /**
     * Create a new job instance.
     *
     * @param  \AlRimi\Submit\Models\Student  $student
     * @param  array  $filePaths
     * @return void
     */
    public function __construct($student, array $filePaths)
    {
        $this->filePaths = $filePaths;
        $this->folderName = $student->student_id . '_' . $student->student_name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->filePaths as $path) {
            // Generate a unique file name with random string
            $fileName = $this->folderName . '-' . Str::random(4) . '.' . pathinfo($path, PATHINFO_EXTENSION);

            // Move the file to the target directory within the public disk
            Storage::disk('public')->move($path, 'student_submissions/' . $this->folderName . '/' . $fileName);
        }
    }
}
