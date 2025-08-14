<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Onboarding Invitation</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; line-height: 1.6; margin: 0; padding: 0; color: #333333;">
    <div style="width: 100%; max-width: 100%; background: #ffffff;">
        <div style="padding: 20px;">
            <h2 style="margin-top: 0; color: #333333;">Estate Agent Onboarding Invitation</h2>
            <p style="margin-bottom: 15px;">Hello {{ $name }},</p>
            <p style="margin-bottom: 15px;">You have been invited to register as an estate agent on EireHome. We’re
                thrilled to
                welcome you to our growing network of professional property agents!</p>

            <p style="margin-bottom: 15px;">Please complete your registration by clicking the button below:</p>

            <a href="{{ $registrationUrl }}"
                style="display: inline-block; background-color: #38b76c; color: white; padding: 10px 20px; text-decoration: none; margin: 15px 0; border-radius: 5px;">
                Complete Agent Registration
            </a>

            <p style="margin-bottom: 15px; color: #d9534f; font-weight: bold;">
                This invitation link will expire in 24 hours.
            </p>

            <p style="margin-bottom: 15px;">
                Once registered, you’ll be able to:
            </p>
            <ul style="margin-bottom: 15px; padding-left: 20px;">
                <li>Post residential and commercial property listings</li>
                <li>Manage your agent profile and listings</li>
                <li>Track inquiries and responses from potential clients</li>
            </ul>

            <p style="margin-bottom: 15px;">If you did not expect this invitation or have any questions, feel free to
                reach out to our support team.</p>

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
