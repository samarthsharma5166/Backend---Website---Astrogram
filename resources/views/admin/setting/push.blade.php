<div class="tab-pane fade show" id="push" role="tabpanel" aria-labelledby="tabs-home-tab">

    <b class="px-2 py-2">{{ __('admin.onesignal_api') }} <a href="https://dashboard.onesignal.com/" target="_blank" style="float:right;" class="acolor">{{ __('admin.get_keys_link') }}</a></b>

    <small class="px-2 py-2 block mb-4">{{ __('admin.onesignal_desc') }}</small>

    <div class="card">
        <div class="card-body flex flex-col p-6">
            <div class="card-text h-full space-y-4">

                <div class="input-area">
                    <label for="name" class="form-label">{{ __('admin.user_app_id') }}</label>
                    <input id="name" type="text" class="form-control" name="push_user_app_id" value="{{ $setting->push_user_app_id }}">
                </div>

                <div class="input-area">
                    <label for="username" class="form-label">{{ __('admin.user_api_key') }}</label>
                    <input id="username" type="text" class="form-control" name="push_user_reset_id" value="{{ $setting->push_user_reset_id }}">
                </div>

            </div>
        </div>
    </div>
    <br>
    <b class="px-2 py-2">{{ __('admin.ai_setting') }} <a href="http://openai.com" target="_blank" style="float:right;" class="acolor">{{ __('admin.get_keys_link') }}</a></b>
    <div class="card mt-4">
        <div class="card-body flex flex-col p-6">
            <div class="card-text h-full space-y-4">

                <div class="input-area">
                    <label for="open_ai_key" class="form-label">{{ __('admin.openai_key') }}</label>
                    <input id="open_ai_key" type="text" class="form-control" name="open_ai_key" value="{{ $setting->open_ai_key }}" placeholder="sk-..." autocomplete="off" spellcheck="false">
                </div>
                <div>
                    <button class="btn inline-flex justify-center btn-primary btn-sm">{{ __('admin.save_setting') }}</button>
                </div>
            </div>
        </div>
    </div>

    <br>
    <b class="px-2 py-2">{{ __('admin.stripe_gateway') }}</b>
    <small class="px-2 py-2 block mb-4">{{ __('admin.gateway_desc') }}</small>
    <div class="card">
        <div class="card-body flex flex-col p-6">
            <div class="card-text h-full space-y-4">

                <div class="input-area">
                    <label for="name" class="form-label">{{ __('admin.stripe_key') }}</label>
                    <input id="name" type="text" class="form-control" name="stripe_key" value="{{ $setting->stripe_key }}">
                </div>

                <div class="input-area">
                    <label for="username" class="form-label">{{ __('admin.stripe_sec') }}</label>
                    <input id="username" type="password" class="form-control" name="stripe_sec" value="{{ $setting->stripe_sec }}">
                </div>
            </div>
        </div>
    </div>

    <br>
    <b class="px-2 py-2">{{ __('admin.razorpay_gateway') }}</b>
    <small class="px-2 py-2 block mb-4">{{ __('admin.gateway_desc') }}</small>
    <div class="card">
        <div class="card-body flex flex-col p-6">
            <div class="card-text h-full space-y-4">

                <div class="input-area">
                    <label for="name" class="form-label">{{ __('admin.razorpay_key') }}</label>
                    <input id="name" type="text" class="form-control" name="razorpay_key" value="{{ $setting->razorpay_key }}">
                </div>

                <div class="input-area">
                    <label for="name" class="form-label">{{ __('admin.razorpay_sec') }}</label>
                    <input id="name" type="password" class="form-control" name="razorpay_sec" value="{{ $setting->razorpay_sec }}">
                </div>

                <br>
                <button class="btn inline-flex justify-center btn-primary btn-sm">{{ __('admin.save_setting') }}</button>
            </div>
        </div>
    </div>

</div>