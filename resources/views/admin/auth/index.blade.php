<!DOCTYPE html>
<html lang="en" dir="ltr" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>{{ __('admin.welcome_admin') }} | @lang('admin.title')</title>
    <link rel="icon" type="image/png" href="{{ getAsset('favicon') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ Asset('assets/css/app.css') }}">

</head>

<body class=" font-inter skin-default">

    <div class="loginwrapper">
        <div class="lg-inner-column">

            @include('admin.auth.left')

            <div class="right-column  relative">
                <div class="inner-content h-full flex flex-col bg-white dark:bg-slate-800">
                    <div class="auth-box h-full flex flex-col justify-center">
                        <div class="mobile-logo text-center mb-6 lg:hidden block">
                            &nbsp;
                        </div>
                        <div class="2xl:mb-6 mb-2">
                            <img src="{{ getAsset('logo') }}" style="width: 170px;"><br>
                            <h4 class="font-medium">{{ __('admin.welcome_admin') }}</h4>
                            <div class="text-slate-500 text-base">{{ __('admin.welcome_desc') }}</div>
                        </div>

                        @include('admin.auth.msg')

                        <form class="space-y-4" action='{{ $form_url }}' method="POST">

                            {!! csrf_field() !!}


                            <div class="fromGroup">
                                <label class="block capitalize form-label">{{ __('admin.email') }}</label>
                                <div class="relative ">
                                    <input type="email" name="email" class="  form-control py-2" placeholder="{{ __('admin.email_login_placeholder') }}" required>
                                </div>
                            </div>
                            <div class="fromGroup       ">
                                <label class="block capitalize form-label">{{ __('admin.password') }}</label>
                                <div class="relative "><input type="password" name="password" class="  form-control py-2   " placeholder="{{ __('admin.password_placeholder') }}" required>
                                </div>
                            </div>
                            <div class="flex justify-between">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" class="hiddens">
                                    <span class="text-slate-500 dark:text-slate-400 text-sm leading-6 capitalize">&nbsp;&nbsp;{{ __('admin.keep_signin') }}</span>
                                </label>
                                <a class="text-sm text-slate-800 dark:text-slate-400 leading-6 font-medium" href="{{ Asset(env('admin').'/forgot') }}">{{ __('admin.forgot_pass_link') }}</a>
                            </div>
                            <br>
                            <button class="btn btn-dark block w-full text-center">{{ __('admin.sign_in') }}</button>
                        </form>



                        <br><br>
                        <div class="auth-footer text-center">
                            {{ __('admin.copyright') }} &copy;{{ date('Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>


</body>

</html>