<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Important Update: Your Property Status on EireHome</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; line-height: 1.6; margin: 0; padding: 0; color: #333333;">
    <div style="width: 100%; max-width: 100%; background: #ffffff;">
        <div style="padding: 20px;">
            <h2 style="margin-top: 0; color: #333333;">Property Status Update</h2>
            <p style="margin-bottom: 15px;">Hello {{ $details['name'] }},</p>
            <p style="margin-bottom: 15px;">Your property: <strong>{{ $details['title'] }}</strong> has been
                @if ($details['status'] == 'Approved')
                    <span style="font-weight: bold; color: #38b76c;">{{ $details['status'] }}</span>.
                @elseif ($details['status'] == 'Rejected')
                    <span style="font-weight: bold; color: #dc3545;">{{ $details['status'] }}</span>.
                @endif
            </p>

            @if ($details['status'] == 'Rejected' && $details['reason'] != '')
                <p style="margin-bottom: 15px; color: #dc3545;">Reason for rejection: {{ $details['reason'] }}</p>
            @endif

            <p style="margin-top: 20px; margin-bottom: 15px;">Thank you for using EireHome. If you have any questions or
                concerns, please contact our support team immediately.</p>

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
