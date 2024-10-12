<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your OTP Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            color: #333333;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            border: 1px solid #e1e1e1;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #0065FA; /* Red */
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
            background-color: #ffffff;
        }
        .otp-code {
            font-size: 24px;
            font-weight: bold;
            color: #0065FA; /* Red */
            padding: 10px;
            border: 2px solid  #0065FA; /* Red */
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }
        .footer {
            text-align: center;
            padding: 15px;
            background-color: #f9f9f9;
            color: #777777;
            font-size: 12px;
        }
        a {
            color:  #0065FA; /* Red */
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Your OTP Code</h1>
    </div>
    <div class="content">
        <p>Hello <strong>{{ $firstname }}</strong>,</p>
        <p>Your OTP code is:</p>
        <div class="otp-code">{{ $otp }}</div>
        <p>This code is valid for 10 minutes.</p>
        <p>If you did not request this code, please ignore this email.</p>
    </div>
    <div class="footer">
        <p>&copy; {{ date('Y') }} AiRad Expert. All rights reserved.</p>
    </div>
</div>
</body>
</html>
