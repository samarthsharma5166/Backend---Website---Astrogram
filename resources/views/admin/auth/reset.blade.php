<!DOCTYPE html>
<html lang="en" dir="ltr" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>{{ __('admin.reset_password') }} | @lang('admin.title')</title>
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
                            <h4 class="font-medium">{{ __('admin.reset_password') }} 🔒</h4>
                            <div class="text-slate-500 text-base">{{ __('admin.reset_desc') }}</div>
                        </div>

                        @include('admin.auth.msg')

                        <form class="space-y-4" action='{{ $form_url }}' method="POST" onsubmit="return chkForm()">

                            {!! csrf_field() !!}


                            <div class="fromGroup">
                                <label class="block capitalize form-label">{{ __('admin.new_password') }}</label>
                                <div class="relative ">
                                    <input type="password" name="password" class="  form-control py-2" placeholder="{{ __('admin.new_password_placeholder') }}" required id="pass">
                                </div>
                            </div>

                            <div class="fromGroup">
                                <label class="block capitalize form-label">{{ __('admin.confirm_password') }}</label>
                                <div class="relative ">
                                    <input type="password" name="c_password" class="  form-control py-2" placeholder="{{ __('admin.confirm_password_placeholder') }}" required id="c_pass">
                                </div>
                            </div>

                            <br>
                            <button class="btn btn-primary block w-full text-center">{{ __('admin.reset_btn') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function chkForm() {
                var pass = document.getElementById("pass");
                var c_pass = document.getElementById("c_pass");

                if (pass.value.length < 6) {
                    alert("{{ __('admin.pass_error') }}");

                    return false;
                }

                if (pass.value != c_pass.value) {
                    alert("{{ __('admin.confirm_error') }}");

                    return false;
                }

                return true;
            }
        </script>
</body>

</html>