<?php if(Session::has('error')): ?>
<div class="py-[18px] px-6 font-normal text-sm rounded-md bg-danger-500 bg-opacity-[14%]  text-dark">
<div class="flex items-center space-x-3 rtl:space-x-reverse">
<iconify-icon class="text-2xl flex-0 text-primary-500" icon="system-uicons:target"></iconify-icon>
<p class="flex-1 text-danger-500 font-Inter"><?php echo e(Session::get('error')); ?></p>
<div class="flex-0 text-xl cursor-pointer text-primary-500">
<iconify-icon icon="line-md:close"></iconify-icon>
</div>
</div>
</div>
<?php endif; ?>

<?php if(Session::has('message')): ?>
<div class="py-[18px] px-6 font-normal text-sm rounded-md bg-primary-600 bg-opacity-[14%]  text-dark">
<div class="flex items-center space-x-3 rtl:space-x-reverse">
<iconify-icon class="text-2xl flex-0 text-primary-500" icon="system-uicons:target"></iconify-icon>
<p class="flex-1 text-primary-500 font-Inter"><?php echo e(Session::get('message')); ?></p>
<div class="flex-0 text-xl cursor-pointer text-primary-500">
<iconify-icon icon="line-md:close"></iconify-icon>
</div>
</div>
</div>
<?php endif; ?><?php /**PATH /Users/samarthsharma/Downloads/61539797-ready-to-use-ai-powered-astrology-app-android-ios-website-admin-panel/Backend + Website/resources/views/admin/auth/msg.blade.php ENDPATH**/ ?>