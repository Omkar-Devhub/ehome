<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Email</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; line-height: 1.6; margin: 0; padding: 0; color: #333333;">
    <div style="width: 100%; max-width: 100%; background: #ffffff;">
        <div style="padding: 20px;">
            <h2 style="margin-top: 0; color: #333333;">Reset Your Password</h2>
            <p style="margin-bottom: 15px;">Hello {{ $name }},</p>
            <p style="margin-bottom: 15px;">We received a request to reset your password. To proceed with resetting your
                password, please click the button below:</p>

            <a href="{{ $reset_url }}"
                style="display: inline-block; background-color: #38b76c; color: white; padding: 10px 20px; text-decoration: none; margin: 15px 0; border-radius: 5px;">Reset
                Password</a>

            <p style="font-size: 12px; color: #777777; margin-top: 15px;">This password reset link will expire in 24
                hours.</p>

            <p style="margin-top: 20px; margin-bottom: 15px;">If you did not request to reset your password, you can
                safely ignore this email. Your account security is important to us, <br> so if you're concerned about
                any
                unauthorized access, please contact our support team immediately.</p>

            <p style="margin-bottom: 15px;">
                Thank you,<br>
                The EireHome Team
            </p>
        </div>

        <div style="padding: 15px 20px; font-size: 12px; color: #666666; border-top: 1px solid #eeeeee;">
            <p style="margin-top: 0; margin-bottom: 10px;">© {{ date('Y') }} EireHome Ltd. All rights reserved.</p>
            <p style="margin-top: 0; margin-bottom: 0;">If you need assistance, please <a href="#"
                    style="color: #38b76c; text-decoration: underline;">contact support</a>.</p>
        </div>
    </div>
</body>

</html>
