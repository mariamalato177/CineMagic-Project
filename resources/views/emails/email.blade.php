<!DOCTYPE html>
<html>
<head>
    <title>Purchase Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #4CAF50;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
        }
        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #eaeaea;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thank you for your purchase!</h1>
        <p>Dear {{ $data['customerName'] }},</p>
        <p>We appreciate your business and are excited to have you as a customer. Find attached your purchase receipt.</p>
        <p>If you have any questions or need further assistance, please don't hesitate to contact our support team.</p>
        <div class="footer">
            <p>Best regards,</p>
            <p>The CineMagic Team</p>
            <p><a href="https://www.cinemagic.com" style="color: #4CAF50;">www.cinemagic.com</a></p>
        </div>
    </div>
</body>
</html>
