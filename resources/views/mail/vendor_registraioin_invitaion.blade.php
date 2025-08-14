<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onboarding Invitation</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; line-height: 1.6; margin: 0; padding: 0; color: #333333;">
    <div style="width: 100%; max-width: 100%; background: #ffffff;">
        <div style="padding: 20px;">
            <h2 style="margin-top: 0; color: #333333;">Service Provider Onboarding Invitation</h2>
            <p style="margin-bottom: 15px;">Hello {{ $name }},</p>
            <p style="margin-bottom: 15px;">You have been invited to register as a service provider on our platform.
                We're excited
                to have you join our network of trusted vendors!</p>

            <p style="margin-bottom: 15px;">Please complete your registration by clicking the button below:</p>

            <a href="{{ $registrationUrl }}"
                style="display: inline-block; background-color: #38b76c; color: white; padding: 10px 20px; text-decoration: none; margin: 15px 0; border-radius: 5px;">
                Complete Vendor Registration
            </a>

            <p style="margin-bottom: 15px; color: #d9534f; font-weight: bold;">
                This invitation link will expire in 24 hours.
            </p>

            <p style="margin-bottom: 15px;">
                After registration, you'll be able to:
            </p>
            <ul style="margin-bottom: 15px; padding-left: 20px;">
                <li>List your products/services on our platform</li>
                <li>Manage your profile</li>
                <li>Receive orders from customers</li>
                <li>Access service provider support resources</li>
            </ul>

            <p style="margin-bottom: 15px;">If you didn't expect this invitation or have any questions, please contact
                our sales team.</p>

            <p style="margin-bottom: 15px;">
                Best regards,<br>
                The EireHome Team
            </p>
        </div>

        <div style="padding: 15px 20px; font-size: 12px; color: #666666; border-top: 1px solid #eeeeee;">
            <p style="margin-top: 0; margin-bottom: 10px;">© {{ date('Y') }} EireHome Ltd. All rights reserved.</p>
            <p style="margin-top: 0; margin-bottom: 0;">Sales: <a href="mailto:sales@eirehome.ie"
                    style="color: #38b76c; text-decoration: underline;">sales@eirehome.ie</a></p>
        </div>
    </div>
</body>

</html>
