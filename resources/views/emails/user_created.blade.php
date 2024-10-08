<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Account Has Been Created</title>
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
        <h1>Welcome to Our Complaint Portal</h1>
    </div>
    <div class="content">
        <p>Dear {{ $details['name'] }},</p>
        <p>Your account has been successfully created. Below are your login details:</p>
        <p><strong>Email:</strong> {{ $details['email'] }}</p>
        <p><strong>Password:</strong> {{ $details['password'] }}</p>
        <p>Please keep this information safe.</p>
        <p>Best regards,</p>
        <p>The NIU Complaint Portal Team</p>
    </div>
    <div class="footer">
        <p>&copy; {{ date('Y') }} NIU Complaint Portal. All rights reserved.</p>
    </div>
</div>
</body>
</html>
