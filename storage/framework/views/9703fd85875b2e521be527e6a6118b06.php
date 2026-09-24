<div class="tab-pane fade show" id="password" role="tabpanel" aria-labelledby="tabs-home-tab">

    <div class="card">
        <div class="card-body flex flex-col p-6">
            <div class="card-text h-full space-y-4">

                <div class="grid xl:grid-cols-2 grid-cols-1 gap-6">
                    <div class="input-area">
                        <label for="name" class="form-label"><?php echo e(__('admin.display_name')); ?> <span class="text-danger">*</span></label>
                        <input id="name" type="text" class="form-control" name="name" value="<?php echo e($data->name); ?>" required>
                    </div>

                    <div class="input-area">
                        <label for="username" class="form-label"><?php echo e(__('admin.email')); ?> <span class="text-danger">*</span></label>
                        <input id="username" type="email" class="form-control" name="email" value="<?php echo e($data->email); ?>" required>
                    </div>
                </div>

                <div class="grid xl:grid-cols-2 grid-cols-1 gap-6">
                    <div class="input-area">
                        <label for="pass" class="form-label"><?php echo e(__('admin.choose_new_password')); ?></label>
                        <input id="pass" type="password" class="form-control" name="new_pass">
                    </div>

                    <div class="input-area">
                        <label for="c_pass" class="form-label"><?php echo e(__('admin.confirm_password')); ?></label>
                        <input id="c_pass" type="password" class="form-control" name="c_pass">
                    </div>
                </div>
                <br>
                <button class="btn inline-flex justify-center btn-primary btn-sm" name="auth_setting" value="1"><?php echo e(__('admin.save_setting')); ?></button>

            </div>
        </div>
    </div>
</div><?php /**PATH /Users/samarthsharma/Downloads/61539797-ready-to-use-ai-powered-astrology-app-android-ios-website-admin-panel/Backend + Website/resources/views/admin/setting/password.blade.php ENDPATH**/ ?>