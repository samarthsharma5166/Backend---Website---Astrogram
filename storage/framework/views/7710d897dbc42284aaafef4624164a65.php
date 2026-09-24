<?php $__env->startSection('title'); ?> Account Setting <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
<div class="page-content">
<div class="transition-all duration-150 container-fluid" id="page_layout">
<div id="content_layout">


<!-- BEGIN: BreadCrumb -->
<div class="mb-5">
<ul class="m-0 p-0 list-none">
<li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
<a href="<?php echo e(Asset(env('admin').'/home')); ?>">
<iconify-icon icon="heroicons-outline:home"></iconify-icon>
<iconify-icon icon="heroicons-outline:chevron-right" class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
</a>
</li>
<li class="inline-block relative text-sm text-slate-500 font-Inter ">Account Setting</li>
</ul>
</div>

<form action="<?php echo e($form_url); ?>" method="POST" onsubmit="return chkForm()" enctype="multipart/form-data">

<?php echo csrf_field(); ?>


<div class="grid grid-cols-1 gap-6">
<div class="card">
<div class="card-body flex flex-col p-6">
<header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
<div class="flex-1">
<div class="card-title text-slate-900 dark:text-white">Account Setting</div>
</div>
</header>
<div class="card-text h-full ">
<div>

<?php echo $__env->make('admin.setting.setting_tab', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</div>
</div>
</div>
</div>
</div>
<br>
<div class="grid xl:grid-cols-2 grid-cols-1">


<div class="tab-content" id="tabs-tabContent">

<?php echo $__env->make('admin.setting.general', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->make('admin.setting.logo', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->make('admin.setting.cost', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->make('admin.setting.push', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->make('admin.setting.email', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->make('admin.setting.password', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</div>
</div>



</form>
</div>
</div>
</div>
</div>

<script>

    function chkForm()
    {
        var pass    = document.getElementById("pass");
        var c_pass  = document.getElementById("c_pass");
    
        if(pass.value && pass.value.length < 6)
        {
            alert("Password length should be 6 characters atleast.");
    
            return false;
        }
    
        if(pass.value && pass.value != c_pass.value)
        {
            alert("Confirm Password not match.");
    
            return false;
        }
    
        return true;
    }
    
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(Asset('assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')); ?>"></script>
<script src="<?php echo e(Asset('assets/js/pages/form-editor.init.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/samarthsharma/Downloads/61539797-ready-to-use-ai-powered-astrology-app-android-ios-website-admin-panel/Backend + Website/resources/views/admin/setting/index.blade.php ENDPATH**/ ?>