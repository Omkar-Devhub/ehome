<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onboarding Request</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; line-height: 1.6; margin: 0; padding: 0; color: #333333;">
    <div style="width: 100%; max-width: 100%; background: #ffffff;">
        <div style="padding: 20px;">
            <h2 style="margin-top: 0; color: #333333;">New Onboarding Request</h2>
            <p style="margin-bottom: 15px;">Hello Team,</p>
            <p style="margin-bottom: 15px;">A new {{ $info['reg_type'] }} has submitted an onboarding request. Here are
                the
                details:</p>
            <div>
                <p style="margin-top: 0; margin-bottom: 10px;"><strong>Onboarding Type:</strong>
                    {{ $info['reg_type'] }}</p>
                <p style="margin-top: 0; margin-bottom: 10px;"><strong>Name:</strong> {{ $info['name'] }}</p>
                <p style="margin-top: 0; margin-bottom: 10px;"><strong>Email:</strong> {{ $info['email'] }}</p>
                <p style="margin-top: 0; margin-bottom: 10px;"><strong>Phone:</strong> {{ $info['phone'] }}</p>
                <p style="margin-top: 0; margin-bottom: 10px;"><strong>Address:</strong>
                    {{ $info['address'] }}</p>
                <p style="margin-top: 0; margin-bottom: 0;"><strong>Submitted On:</strong>
                    {{ $info['submission_date'] }}</p>
            </div>

            <p style="margin-bottom: 15px;">Please review this request and take appropriate action:</p>

            <div style="margin: 20px 0;">
                <a href="tel:{{ $info['phone'] }}"
                    style="display: inline-block; background-color: #38b76c; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Call
                    Vendor</a>
            </div>

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
