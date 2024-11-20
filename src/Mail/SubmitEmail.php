<?php

namespace AlRimi\Submit\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubmitEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $studentId;
    protected $studentName;

    /**
     * Create a new message instance.
     *
     * @param  string  $studentId
     * @param  string  $studentName
     * @return void
     */
    public function __construct($studentId, $studentName)
    {
        $this->studentId = $studentId;
        $this->studentName = $studentName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Submission')
                    ->markdown('emails.submission_email')
                    ->with([
                        'studentId' => $this->studentId,
                        'studentName' => $this->studentName,
                    ]);
    }
}
