<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Property Submitted</title>
</head>

<body
    style="font-family: Arial, Helvetica, sans-serif; line-height: 1.6; margin: 0; padding: 0; color: #333333; background-color: #f4f4f4;">
    <div
        style="width: 100%; max-width: 600px; margin: 20px auto; background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <div style="padding: 20px;">
            <h2 style="margin-top: 0; color: #333333;">New Property Submitted</h2>
            <p style="margin-bottom: 15px;">Hello Reviewers,</p>
            <p style="margin-bottom: 15px;">A new property has been submitted for review on <strong>EireHome.ie</strong>.
                Please review the details and approve or reject the listing.</p>

            <p style="margin-bottom: 15px;"><strong>Location:</strong> {{ $property->address }},
                {{ Str::title($property->area->name) }},
                {{ Str::title($property->county->name) }}, {{ $property->eircode }}</p>

            <p style="margin-bottom: 15px;"><strong>Submitted By:</strong>
                @if ($property->propertyable_type === 'App\Models\User')
                    {{ $property->propertyable->name }}
                @elseif ($property->propertyable_type === 'App\Models\Agent')
                    {{ $property->propertyable->name }}
                @endif
            </p>

            <p style="margin-bottom: 15px;"><strong>Submission Date:</strong> {{ $property->created_at }}</p>

            <a href="{{ url('/admin/properties/' . $property->id . '/preview') }}"
                style="display: inline-block; background-color: #38b76c; color: white; padding: 10px 20px; text-decoration: none; margin: 15px 0; border-radius: 5px;">Review
                Property</a>
        </div>

        <div
            style="padding: 15px 20px; font-size: 12px; color: #666666; border-top: 1px solid #eeeeee; text-align: center;">
            <p style="margin-top: 0; margin-bottom: 10px;">© {{ date('Y') }} EireHome Ltd. All rights reserved.</p>
            <p style="margin-top: 0; margin-bottom: 0;">If you need assistance, please <a href="#"
                    style="color: #38b76c; text-decoration: underline;">contact support</a>.</p>
        </div>
    </div>
</body>

</html>
