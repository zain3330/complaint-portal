<!DOCTYPE html>
<html>
<head>
    <title>Your Account Has Been Created</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .header {
            background-color: #343a40;
            color: #fff;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            margin-top: 20px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            color: #999;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Welcome to Our Complain Portal</h1>
    </div>
    <div class="content">
        <p>Dear {{ $details['name'] }},</p>
        <p>Your account has been successfully created. Below are your login details:</p>
        <p><strong>Email:</strong> {{ $details['email'] }}</p>
        <p><strong>Password:</strong> {{ $details['password'] }}</p>
        <p>Please keep this information safe.</p>
        <p>Best regards,</p>
        <p>The Job Portal Team</p>
    </div>
    <div class="footer">
        <p>&copy; {{ date('Y') }} Job Portal. All rights reserved.</p>
    </div>
</div>
</body>
</html>
