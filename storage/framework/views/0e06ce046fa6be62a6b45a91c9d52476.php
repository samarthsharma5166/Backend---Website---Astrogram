<?php
if (Session::has('locale') && Session::get('locale') == "ar") {
  $dir = "rtl";
} else {
  $dir = "ltr";
}
?>

<!DOCTYPE html>
<html lang="zxx" dir="<?php echo e($dir); ?>" class="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <title><?php echo $__env->yieldContent('title'); ?> | <?php echo app('translator')->get('admin.title'); ?></title>

  <?php if(getAsset('favicon')): ?>

  <link rel="icon" type="image/png" href="<?php echo e(getAsset('favicon')); ?>">

  <?php else: ?>

  <link rel="icon" type="image/png" href="<?php echo e(Asset('assets/images/logo/favicon.svg')); ?>">


  <?php endif; ?>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo e(Asset('assets/css/rt-plugins.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(Asset('assets/css/app.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(Asset('assets/libs/sweetalert2/sweetalert2.min.css')); ?>" />
  <script src="<?php echo e(Asset('assets/js/settings.js')); ?>" sync></script>


  <?php echo $__env->yieldContent('css'); ?>


</head>

<body class="font-inter dashcode-app" id="body_class">
  <main class="app-wrapper">

    <?php echo $__env->make('admin.layout.menu', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->make('admin.layout.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php if(Session::has('error')): ?>
    <div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
      <div class="page-content">
        <div class="transition-all duration-150 container-fluid" id="page_layout">
          <div id="content_layout">
            <div class="py-[18px] px-6 font-normal text-sm rounded-md bg-danger-500 bg-opacity-[14%]  text-dark">
              <div class="flex items-center space-x-3 rtl:space-x-reverse">
                <iconify-icon class="text-2xl flex-0 text-danger-500" icon="system-uicons:target"></iconify-icon>
                <p class="flex-1 text-danger-500 font-Inter"><?php echo e(Session::get('error')); ?></p>
                <div class="flex-0 text-xl cursor-pointer text-danger-500">
                  <iconify-icon icon="line-md:close"></iconify-icon>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <?php if(Session::has('message')): ?>
    <div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
      <div class="page-content">
        <div class="transition-all duration-150 container-fluid" id="page_layout">
          <div id="content_layout">
            <div class="py-[18px] px-6 font-normal text-sm rounded-md bg-primary-600 bg-opacity-[14%]  text-dark">
              <div class="flex items-center space-x-3 rtl:space-x-reverse">
                <iconify-icon class="text-2xl flex-0 text-primary-500" icon="system-uicons:target"></iconify-icon>
                <p class="flex-1 text-primary-500 font-Inter"><?php echo e(Session::get('message')); ?></p>
                <div class="flex-0 text-xl cursor-pointer text-primary-500">
                  <iconify-icon icon="line-md:close"></iconify-icon>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>


    <?php echo $__env->yieldContent('content'); ?>

  </main>

  <script src="<?php echo e(Asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>
  <script src="<?php echo e(Asset('assets/js/rt-plugins.js')); ?>"></script>

  <script src="<?php echo e(Asset('assets/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>

  <script src="<?php echo e(Asset('assets/js/pages/sweetalerts.init.js')); ?>"></script>

  <script src="<?php echo e(Asset('assets/js/app.js')); ?>"></script>

  <?php echo $__env->yieldContent('js'); ?>

  <script>
    function showSweetAlert(url, title = '<?php echo e(__('admin.are_you_sure')); ?>', text = 'You won\'t be able to revert this!', confirmText = 'Yes, do it!') {
      Swal.fire({
        title: title,
        text: text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: confirmText
      }).then((result) => {
        if (result.isConfirmed) {

          window.location.href = "<?php echo e(Asset(env('admin'))); ?>/" + url;

        }
      });
    }
  </script>

</body>

</html><?php /**PATH /Users/samarthsharma/Downloads/61539797-ready-to-use-ai-powered-astrology-app-android-ios-website-admin-panel/Backend + Website/resources/views/admin/layout/main.blade.php ENDPATH**/ ?>