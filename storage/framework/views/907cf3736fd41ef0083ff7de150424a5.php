<div class="card">
<div class="card-body flex flex-col p-6">
<div class="card-text h-full space-y-4">

<h4 class="text-lg">App Settings</h4>

<div class="input-area">
<label for="welcome_title" class="form-label">Language for Astrologer</label>
<input id="welcome_title" type="text" class="form-control" name="language" value="<?php echo e($setting->language); ?>" placeholder="comma seprated for multiple e.g English,Hindi">
</div>

<div class="grid xl:grid-cols-1 grid-cols-1 gap-6">

<div class="input-area">
<label for="welcome_title" class="form-label">App Welcome Page Heading</label>
<input id="welcome_title" type="text" class="form-control" name="welcome_title" value="<?php echo e($setting->welcome_title); ?>">
</div>

<div class="input-area">
<label for="welcome_desc" class="form-label">App Welcome Description</label>
<textarea id="welcome_desc" type="text" class="form-control" name="welcome_desc"><?php echo e($setting->welcome_desc); ?></textarea>
</div>
</div>

<div class="input-area">
<label for="welcome_title" class="form-label">Android App Link</label>
<input id="welcome_title" type="text" class="form-control" name="android_app" value="<?php echo e($setting->android_app); ?>">
</div>

<div class="input-area">
<label for="welcome_title" class="form-label">IOS App Link</label>
<input id="welcome_title" type="text" class="form-control" name="ios_app" value="<?php echo e($setting->ios_app); ?>">
</div>

</div>
</div>
</div>

<?php echo $__env->make('admin.setting.login_type', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<br>
<div class="card">
<div class="card-body flex flex-col p-6">
<div class="card-text h-full space-y-4">

<h4 class="text-lg">Contact us & FAQ</h4>
<div class="grid xl:grid-cols-2 grid-cols-2 gap-6">

<div class="input-area">
<label for="welcome_title" class="form-label">Contact us Email</label>
<input id="welcome_title" type="text" class="form-control" name="contact_email" value="<?php echo e($setting->contact_email); ?>">
</div>

<div class="input-area">
<label for="welcome_desc" class="form-label">Whatsapp Number</label>
<input id="welcome_title" type="text" class="form-control" name="whatsapp_no" value="<?php echo e($setting->whatsapp_no); ?>" placeholder="with country code 91">
</div>
</div>
<div class="input-area">
<label for="welcome_title" class="form-label">FAQ's</label>
<textarea name="faq" class="form-control"><?php echo e($setting->faq); ?></textarea>
</div>
<br>
<button class="btn inline-flex justify-center btn-primary btn-sm">Save Setting</button>
</div>
</div>
</div><?php /**PATH /Users/samarthsharma/Downloads/61539797-ready-to-use-ai-powered-astrology-app-android-ios-website-admin-panel/Backend + Website/resources/views/admin/setting/app_setting.blade.php ENDPATH**/ ?>