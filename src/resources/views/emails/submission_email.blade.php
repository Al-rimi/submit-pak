<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* General Styling */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #be0000;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
        }
        .content {
            padding: 20px;
            color: #333;
        }
        .content h2 {
            font-size: 20px;
            margin: 0 0 10px;
            color: #be0000;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            margin: 10px 0;
        }
        .button {
            display: block;
            width: fit-content;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            text-align: center;
            border-radius: 4px;
            font-size: 16px;
        }
        .footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: #777;
        }
    </style>
    <title>New Submission Notification</title>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h1>New Submission Alert</h1>
        </div>

        <!-- Content Section -->
        <div class="content">
            <h2>Hello, Admin!</h2>
            <p>
                A new submission has been received on the platform. Here are the details:
            </p>
            <p><strong>Student ID:</strong> {{ $student_id }}</p>
            <p><strong>Student Name:</strong> {{ $student_name }}</p>
            <a href="{{ config('app.url') }}/submissions" class="button">View Submission</a>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            © {{ date('Y') }} SYAlux. All rights reserved.<br>
        </div>
    </div>
</body>
</html>
