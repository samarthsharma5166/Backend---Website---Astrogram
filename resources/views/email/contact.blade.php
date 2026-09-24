<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>@lang('front.new_contact_enquiry')</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f6f8; font-family:Arial, Helvetica, sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f8; padding:20px;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,0.05);">

                <!-- Header -->
                <tr>
                    <td style="background-color:#ff5722; padding:20px; text-align:center;">
                        <h1 style="color:#ffffff; margin:0; font-size:22px;">
                            @lang('front.new_contact_enquiry')
                        </h1>
                    </td>
                </tr>

                <!-- Body -->
                <tr>
                    <td style="padding:25px; color:#333333; font-size:14px; line-height:1.6;">

                        <p style="margin-top:0;">
                            @lang('front.hello_admin')
                        </p>

                        <p>
                            @lang('front.contact_enquiry_desc')
                        </p>

                        <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse; margin-top:15px;">

                            <tr>
                                <td style="font-weight:bold; width:30%; border-bottom:1px solid #eeeeee;">
                                     @lang('front.name')
                                </td>
                                <td style="border-bottom:1px solid #eeeeee;">
                                   {{ $user->name ?? $data['name'] }}
                                </td>
                            </tr>

                            <tr>
                                <td style="font-weight:bold; border-bottom:1px solid #eeeeee;">
                                     @lang('front.phone')
                                </td>
                                <td style="border-bottom:1px solid #eeeeee;">
                                    @if(isset($user->phone)) +{{ $user->country." - ".$user->phone }} @else {{ $data['phone'] }} @endif
                                </td>
                            </tr>

                            <tr>
                                <td style="font-weight:bold; border-bottom:1px solid #eeeeee;">
                                     @lang('front.subject')
                                </td>
                                <td style="border-bottom:1px solid #eeeeee;">
                                    {{ $data['subject'] }}
                                </td>
                            </tr>

                            <tr>
                                <td style="font-weight:bold; border-bottom:1px solid #eeeeee;">
                                     @lang('front.category')
                                </td>
                                <td style="border-bottom:1px solid #eeeeee;">
                                    {{ $data['category'] }}
                                </td>
                            </tr>

                            <tr>
                                <td style="font-weight:bold; vertical-align:top;">
                                     @lang('front.message')
                                </td>
                                <td>
                                    {{ $data['message'] }}
                                </td>
                            </tr>

                        </table>

                        

                        <p style="margin-bottom:0;">
                            @lang('front.regards'),<br>
                            <strong>@lang('front.system_name')</strong>
                        </p>

                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="background-color:#f0f0f0; padding:12px; text-align:center; font-size:12px; color:#777777;">
                        © {{ date('Y') }} @lang('front.all_rights')
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
```

</body>
</html>
