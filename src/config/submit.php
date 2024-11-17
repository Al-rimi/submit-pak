<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Notification Email
    |--------------------------------------------------------------------------
    |
    | This value is the email address that will be used to send notifications
    | regarding submissions. For example, when a submission is made, this 
    | email will receive updates or alerts if configured. You can set this 
    | value in your .env file using the key "NOTIFICATION_EMAIL".
    |
    |
    */

    'notification_email' => env('NOTIFICATION_EMAIL', 'abdullah@example.com'),

    /*
    |--------------------------------------------------------------------------
    | Submission Deadline
    |--------------------------------------------------------------------------
    |
    | This value defines the deadline for accepting submissions. Once the 
    | deadline has passed, the package's logic will prevent users from 
    | submitting new entries. You should specify this value in your .env 
    | file using the key "SUBMISSION_DEADLINE" in ISO 8601 format 
    | (e.g., "YYYY-MM-DDTHH:MM:SS").
    |
    | Default: '2024-12-25T23:59:59'
    |
    */

    'submission_deadline' => env('SUBMISSION_DEADLINE', '2024-12-25T23:59:59'),

];
