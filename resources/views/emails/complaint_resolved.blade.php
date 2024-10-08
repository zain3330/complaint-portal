<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Resolved</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            margin: 20px auto;
            padding: 20px;
            max-width: 600px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #348C4B;
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .header img {
            height: 60px;
        }
        .content {
            padding: 20px;
            color: #333;
        }
        .content p {
            font-size: 16px;
            margin: 15px 0;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #999;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }
        .btn-complaint {
            background-color: #348C4B;
        }
        .btn-status {
            background-color: #007bff;
        }
        .btn-admin {
            background-color: #dc3545;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <img src="https://www.niu.edu.pk/wp-content/uploads/2024/09/NIU-Logo-h-w.png" alt="NIU Care Logo">
        <h1>Complaint Resolved</h1>
    </div>

    <div class="content">
        <p>Dear {{ $details['name'] }},</p>
        <p>Your complaint with ID <strong>{{ $details['complaint_id'] }}</strong> has been successfully resolved.</p>
        <p><strong>Department:</strong> {{ $details['department'] }}</p>

        @if($details['comments'])
            <p><strong>Comments:</strong> {{ $details['comments'] }}</p>
        @endif

        @if($details['attachment'])
            <p>An attachment related to your complaint has been provided. You can download it from the link below:</p>
            <a href="{{ $details['attachment'] }}" target="_blank">Download Attachment</a>
        @endif

        <p>If you have any further questions or concerns, feel free to contact us.</p>

        <p>Best regards,</p>
        <p>The Complaint Resolution Team</p>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} NIU Complaint Portal. All rights reserved.</p>
    </div>
</div>

</body>
</html>
