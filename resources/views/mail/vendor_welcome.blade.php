<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to EireHome Vendor Network</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; line-height: 1.6; margin: 0; padding: 0; color: #333333;">
    <div style="width: 100%; max-width: 100%; background: #ffffff;">
        <div style="padding: 20px;">
            <h2 style="margin-top: 0; color: #333333;">Welcome, {{ $name }}!</h2>
            <p style="margin-bottom: 15px;">Thank you for joining the EireHome vendor network. Your account is now active
                and ready to use.</p>

            <div>
                <p style="margin-top: 0; font-weight: bold;">Your vendor dashboard:</p>
                <a href="{{ url('vendor/login') }}"
                    style="display: inline-block; background-color: #38b76c; color: white; padding: 10px 20px; text-decoration: none; margin: 10px 0; border-radius: 5px;">
                    Access Dashboard
                </a>
                <p style="margin-bottom: 0;">Login email: <strong>{{ $email }}</strong></p>
            </div>

            <p style="margin-bottom: 10px; font-weight: bold;">Getting started:</p>
            <ul style="margin-bottom: 15px; padding-left: 20px;">
                <li>Complete your vendor profile</li>
                <li>Add your products/services</li>
                <li>Set up payment information</li>
            </ul>

            <p style="margin-bottom: 15px;">
                Need help? Contact our support team at <a href="mailto:support@eirehome.ie"
                    style="color: #38b76c;">support@eirehome.ie</a>
            </p>

            <p style="margin-bottom: 15px;">
                Best regards,<br>
                <strong>The EireHome Team</strong>
            </p>
        </div>

        <div style="padding: 15px 20px; font-size: 12px; color: #666666; border-top: 1px solid #eeeeee;">
            <p style="margin-top: 0; margin-bottom: 10px;">© {{ date('Y') }} EireHome Ltd. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
