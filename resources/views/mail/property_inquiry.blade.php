<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Property Inquiry</title>s
</head>

<body style="font-family: Arial, Helvetica, sans-serif; line-height: 1.6; margin: 0; padding: 0; color: #333333;">
    <div style="width: 100%; max-width: 100%; background: #ffffff;">
        <div style="padding: 20px;">
            <h2 style="margin-top: 0; color: #333333;">New Property Inquiry</h2>
            <p style="margin-bottom: 15px;">Hi {{ $messageDetails['owner_name'] }},</p>

            <p style="margin-bottom: 15px;">You have received a new inquiry about your property. Here are the details:
            </p>

            <div>
                <h3 style="margin-top: 0; margin-bottom: 10px; color: #333333;">Sender Information</h3>
                <p style="margin: 5px 0;"><strong>Name:</strong> {{ $messageDetails['name'] }}</p>
                <p style="margin: 5px 0;"><strong>Email:</strong> <a href="mailto:{{ $messageDetails['email'] }}"
                        style="color: #38b76c; text-decoration: underline;">{{ $messageDetails['email'] }}</a></p>
                <p style="margin: 5px 0;"><strong>Phone:</strong> {{ $messageDetails['phone'] }}</p>
                <p style="margin: 5px 0;"><strong>Inquiry Date:</strong> {{ $messageDetails['date'] }}</p>
            </div>

            <div>
                <h3 style="margin-top: 0; margin-bottom: 10px; color: #333333;">Property Details</h3>
                <p style="margin: 5px 0;"><strong>Property Title:</strong> {{ $messageDetails['property_title'] }}</p>
                <p style="margin: 5px 0;"><strong>Property Type:</strong> {{ $messageDetails['property_type'] }}</p>
                <p style="margin: 5px 0;"><strong>User's Message:</strong> {{ $messageDetails['message'] }}</p>
            </div>

            <p style="margin-bottom: 15px;">Please respond to the <strong>{{ $messageDetails['name'] }}</strong> at your
                earliest
                convenience.</p>

            <p style="margin-top: 20px; margin-bottom: 15px;">
                Thank you,<br>
                EireHome Team
            </p>
        </div>

        <div style="padding: 15px 20px; font-size: 12px; color: #666666; border-top: 1px solid #eeeeee;">
            <p style="margin-top: 0; margin-bottom: 10px;">© {{ date('Y') }} EireHome Ltd. All rights reserved.</p>
            <p style="margin-top: 0; margin-bottom: 0;">
                <a href="#" style="color: #38b76c; text-decoration: underline;">Privacy Policy</a> |
                <a href="#" style="color: #38b76c; text-decoration: underline;">Terms of Service</a>
            </p>
        </div>
    </div>
</body>

</html>
