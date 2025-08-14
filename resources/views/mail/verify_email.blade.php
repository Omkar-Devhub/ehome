<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email Address</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; line-height: 1.6; margin: 0; padding: 0; color: #333333;">
    <div style="width: 100%; max-width: 100%; background: #ffffff;">
        <div style="padding: 20px;">
            <h2 style="margin-top: 0; color: #333333;">Verify Your Email Address</h2>
            <p style="margin-bottom: 15px;">Hello {{ $info['name'] }},</p>
            <p style="margin-bottom: 15px;">Thank you for signing up! Please verify your email address by clicking the
                button below:</p>

            <a href="{{ $info['verification_url'] }}"
                style="display: inline-block; background-color: #38b76c; color: white; padding: 10px 20px; text-decoration: none; margin: 15px 0; border-radius: 5px;">Verify
                Email Address</a>

            <p style="margin-top: 20px; margin-bottom: 15px;">If you didn't create an account with us, you can safely
                ignore this email.</p>

            <p style="margin-bottom: 15px;">
                Best regards,<br>
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
