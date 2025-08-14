<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Action Required - EireHome Agent Account</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; line-height: 1.6; margin: 0; padding: 0; color: #333333;">
    <div style="width: 100%; max-width: 100%; background: #ffffff;">
        <div style="padding: 20px;">
            <h2 style="margin-top: 0; color: #d9534f;">Action Required: EireHome Agent Account</h2>

            <p style="margin-bottom: 15px;">Hello {{ $name }},</p>

            <p style="margin-bottom: 15px;">
                We’ve reviewed your registration for the <strong>EireHome Agent Platform</strong> — Ireland’s trusted
                property listing portal.
            </p>

            <p style="margin-bottom: 15px; color: #d9534f;"><strong>Reason for Pending Action:</strong></p>
            <div
                style="background-color: #f8d7da; padding: 15px; border-radius: 6px; margin-bottom: 20px; color: #721c24;">
                {{ $reason }}
            </div>

            <p style="margin-bottom: 15px;">
                To proceed further with your account activation, please contact our support team with the required
                clarification or document.
            </p>

            <p style="margin-bottom: 20px;">
                📧 <strong>Email:</strong>
                <a href="mailto:support@eirehome.ie" style="color: #38b76c; text-decoration: underline;">
                    support@eirehome.ie
                </a>
            </p>

            <p style="margin-bottom: 15px;">
                We appreciate your cooperation and look forward to welcoming you fully onboard.
            </p>

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
