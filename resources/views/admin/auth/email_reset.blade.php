<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@lang('admin.password_reset')</title>
    <style>
        /* Inline CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        }
        
        .header {
            background-color: #175169;
            padding: 5px;
            color: #ffffff;
            text-align: center;
            font-size: 24px;
        }
        
        .content {
            padding: 20px;
        }
        
        .button {
            display: inline-block;
            background-color: #175169;
            color: #ffffff !important;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
        }
        
        .footer {
            background-color: #f3f3f3;
            padding: 10px;
            color: black;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>@lang('admin.password_reset')</h2>
        </div>
        <div class="content">
            <p>@lang('front.dear') {{ $res->name }},</p>
            <p>@lang('front.pass_desc')</p>
            <p>
                <a href="{{ Asset(env('admin').'/resetPassword?token='.$res->reset_key) }}" class="button" target="_blank">@lang('front.reset_pass')</a>
            </p>
            <p>@lang('front.pass_text')</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} |  @lang('front.all_right')</p>
        </div>
    </div>
</body>
</html>
