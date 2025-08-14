<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to EireHome</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; line-height: 1.6; margin: 0; padding: 0; color: #333333;">
    <div style="width: 100%; max-width: 100%; background: #ffffff;">
        <div style="padding: 20px;">
            <h2 style="margin-top: 0; color: #333333;">Welcome to EireHome Agent Platform</h2>

            <p style="margin-bottom: 15px;">Hello {{ $name }},</p>

            <p style="margin-bottom: 15px;">
                We’re excited to welcome you to <strong>EireHome</strong> — Ireland’s leading property listing portal
                for residential and commercial real estate.
            </p>

            <p style="margin-bottom: 15px;">
                Your agent account has been created. You can now log in using the credentials below:
            </p>

            <div style="background-color: #f8f9fa; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
                <p style="margin: 0;"><strong>Login Email:</strong> {{ $email }}</p>
                <p style="margin: 0;"><strong>Password:</strong> {{ $password }}</p>
            </div>

            <p style="margin-bottom: 15px;">Click the button below to access your agent dashboard and start managing
                your listings:</p>

            <a href="http://127.0.0.1:8000/vendor/login"
                style="display: inline-block; background-color: #38b76c; color: white; padding: 10px 20px; text-decoration: none; margin: 15px 0; border-radius: 5px;">
                Go to Agent Dashboard
            </a>

            <p style="margin-bottom: 15px;">
                Once logged in, you can:
            </p>
            <ul style="margin-bottom: 15px; padding-left: 20px;">
                <li>Post residential and commercial property listings</li>
                <li>Manage your agent profile and listings</li>
                <li>Track inquiries and responses from potential clients</li>
                <li>Invite and manage your sub-agents</li>
            </ul>

            <p style="margin-bottom: 15px; color: #d9534f; font-weight: bold;">
                For your security, please change your password after your first login.
            </p>

            <p style="margin-bottom: 15px;">If you have any questions, feel free to reach out to our support team.</p>

            <p style="margin-bottom: 15px;">
                Best regards,<br>
                The EireHome Team
            </p>
        </div>

        <div style="padding: 15px 20px; font-size: 12px; color: #666666; border-top: 1px solid #eeeeee;">
            <p style="margin-top: 0; margin-bottom: 10px;">© {{ date('Y') }} EireHome Ltd. All rights reserved.</p>
            <p style="margin-top: 0; margin-bottom: 0;">Support: <a href="mailto:support@eirehome.ie"
                    style="color: #38b76c; text-decoration: underline;">support@eirehome.ie</a></p>
        </div>
    </div>
</body>

</html>
