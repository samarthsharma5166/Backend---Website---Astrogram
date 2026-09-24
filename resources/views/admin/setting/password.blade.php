<div class="tab-pane fade show" id="password" role="tabpanel" aria-labelledby="tabs-home-tab">

    <div class="card">
        <div class="card-body flex flex-col p-6">
            <div class="card-text h-full space-y-4">

                <div class="grid xl:grid-cols-2 grid-cols-1 gap-6">
                    <div class="input-area">
                        <label for="name" class="form-label">{{ __('admin.display_name') }} <span class="text-danger">*</span></label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ $data->name }}" required>
                    </div>

                    <div class="input-area">
                        <label for="username" class="form-label">{{ __('admin.email') }} <span class="text-danger">*</span></label>
                        <input id="username" type="email" class="form-control" name="email" value="{{ $data->email }}" required>
                    </div>
                </div>

                <div class="grid xl:grid-cols-2 grid-cols-1 gap-6">
                    <div class="input-area">
                        <label for="pass" class="form-label">{{ __('admin.choose_new_password') }}</label>
                        <input id="pass" type="password" class="form-control" name="new_pass">
                    </div>

                    <div class="input-area">
                        <label for="c_pass" class="form-label">{{ __('admin.confirm_password') }}</label>
                        <input id="c_pass" type="password" class="form-control" name="c_pass">
                    </div>
                </div>
                <br>
                <button class="btn inline-flex justify-center btn-primary btn-sm" name="auth_setting" value="1">{{ __('admin.save_setting') }}</button>

            </div>
        </div>
    </div>
</div>