<div class="tab-pane fade show" id="logo" role="tabpanel" aria-labelledby="tabs-home-tab">

    <div class="card">
        <div class="card-body flex flex-col p-6">
            <div class="card-text h-full space-y-4">

                <div class="input-area">
                    <label for="logo" class="form-label"><?php echo e(__('admin.app_logo')); ?></label>
                    <input id="logo" type="file" class="form-control" name="logo">

                    <?php if($setting->logo): ?>

                    <br>
                    <img src="<?php echo e(Asset('upload/admin/'.$setting->logo)); ?>" style="height: 30px;">

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="card">
        <div class="card-body flex flex-col p-6">
            <div class="card-text h-full space-y-4">

                <div class="input-area">
                    <label for="logo" class="form-label">Login Page Cover Photo</label>
                    <input id="logo" type="file" class="form-control" name="cover">

                    <?php if($setting->cover): ?>

                    <br>
                    <img src="<?php echo e(Asset('upload/admin/'.$setting->cover)); ?>" style="height: 30px;">

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="card">
        <div class="card-body flex flex-col p-6">
            <div class="card-text h-full space-y-4">
                <div class="input-area">
                    <label for="favicon" class="form-label"><?php echo e(__('admin.favicon')); ?></label>
                    <input id="favicon" type="file" class="form-control" name="favicon">

                    <?php if($setting->favicon): ?>

                    <br>
                    <img src="<?php echo e(Asset('upload/admin/'.$setting->favicon)); ?>" style="height: 30px;">

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-body flex flex-col p-6">
            <div class="card-text h-full space-y-4">
                <div class="input-area">
                    <label for="favicon" class="form-label"><?php echo e(__('admin.app_logo')); ?></label>
                    <input id="favicon" type="file" class="form-control" name="app_logo">

                    <?php if($setting->app_logo): ?>

                    <br>
                    <img src="<?php echo e(Asset('upload/admin/'.$setting->app_logo)); ?>" style="height: 30px;">

                    <?php endif; ?>


                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-body flex flex-col p-6">
            <div class="card-text h-full space-y-4">
                <div class="input-area">
                    <label for="favicon" class="form-label"><?php echo e(__('admin.app_welcome_image')); ?></label>
                    <input id="favicon" type="file" class="form-control" name="app_welcome_img">

                    <?php if($setting->app_welcome_img): ?>

                    <br>
                    <img src="<?php echo e(Asset('upload/admin/'.$setting->app_welcome_img)); ?>" style="height: 30px;">

                    <?php endif; ?>

                </div>

                <br>
                <button class="btn inline-flex justify-center btn-primary btn-sm"><?php echo e(__('admin.save_setting')); ?></button>

            </div>
        </div>
    </div>
</div><?php /**PATH /Users/samarthsharma/Downloads/61539797-ready-to-use-ai-powered-astrology-app-android-ios-website-admin-panel/Backend + Website/resources/views/admin/setting/logo.blade.php ENDPATH**/ ?>