<section class="space-y-8" id="startChat">
<div class="space-y-6 border-b border-gray-200 dark:border-gray-800 pb-8">
<div class="space-y-2">
<h3 class="text-3xl font-black text-nebula-indigo dark:text-white"><?php echo app('translator')->get('front.expert'); ?></h3>
<p class="text-gray-500 dark:text-gray-400"><?php echo app('translator')->get('front.hand_picked'); ?></p>
</div>

    <!-- Chips/Filters -->
    <div class="flex overflow-x-auto gap-8 pb-4 -mx-4 px-4 md:mx-0 md:px-0 scrollbar-hide">
        <div class="category-chip flex flex-col items-center gap-3 shrink-0 cursor-pointer group active mt-4" data-cate-id="all" style="margin-left: 20px;">
            <div class="chip-container w-28 h-28 bg-primary text-white rounded-full flex items-center justify-center shadow-lg shadow-primary/20 transition-all group-hover:scale-110">
                <span class="material-symbols-outlined text-4xl">all_inclusive</span>
            </div>
            <span class="chip-text text-sm font-black text-nebula-indigo dark:text-white uppercase tracking-wider"><?php echo app('translator')->get('front.all'); ?></span>
        </div>
        <?php $__currentLoopData = $cates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="category-chip flex flex-col items-center gap-3 shrink-0 cursor-pointer group mt-4" data-cate-id="<?php echo e($cate['id']); ?>">
            <div class="chip-container w-28 h-28 rounded-full border-2 border-transparent transition-all p-1">
                <img src="<?php echo e($cate['img']); ?>" class="w-full h-full rounded-full object-cover border border-gray-100 dark:border-gray-700 shadow-sm transition-all group-hover:scale-105" alt="<?php echo e($cate['name']); ?>">
            </div>
            <span class="chip-text text-sm font-black text-gray-500 dark:text-gray-400 group-hover:text-primary transition-colors uppercase tracking-wider"><?php echo e($cate['name']); ?></span>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

<?php $__currentLoopData = $astrologer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $astro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
    $isLowBalance = Auth::check() && (Auth::user()->wallet < $astro['price'] && Auth::user()->free_minute == 0);
?>

<div class="astrologer-card group bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 p-5 rounded-3xl celestial-glow flex flex-col gap-5 cursor-pointer <?php echo e($isLowBalance ? 'opacity-50 grayscale-[0.5]' : ''); ?>" 
     data-categories="<?php echo e(json_encode($astro['cates'])); ?>" 
     data-astro-id="<?php echo e($astro['id']); ?>">
<div class="relative w-full aspect-square overflow-hidden rounded-2xl">
<img alt="<?php echo e($astro['name']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Portrait of a friendly male Vedic astrologer" src="<?php echo e($astro['img']); ?>"/>
<?php if($isLowBalance): ?>
<div class="absolute inset-0 bg-black/20 flex flex-col items-center justify-center backdrop-blur-[1px]">
    <div class="bg-red-600 text-white text-[10px] font-black uppercase tracking-tighter px-3 py-1.5 rounded-xl shadow-2xl animate-pulse">
        <?php echo app('translator')->get('front.insufficient_balance'); ?>
    </div>
</div>
<?php endif; ?>
<div class="absolute top-3 right-3 bg-green-500 w-3 h-3 rounded-full border-2 border-white ring-4 ring-green-500/20"></div>
<div class="absolute bottom-3 left-3 px-3 py-1 bg-white/90 backdrop-blur rounded-lg text-[10px] font-black uppercase tracking-tighter text-nebula-indigo">
<?php echo app('translator')->get('front.online'); ?>
</div>
</div>
<div class="space-y-3">
<div class="flex justify-between items-start">
<div>
<h4 class="text-lg font-black dark:text-white"><?php echo e($astro['name']); ?> </h4>
<p class="text-sm text-primary font-bold"><?php echo e($astro['type']); ?></p>
</div>
<div class="flex items-center gap-1 text-starlight-bronze">
<span class="text-sm font-black" style="font-size: 10px;"><?php echo e($astro['total_order']); ?> <?php echo app('translator')->get('front.orders'); ?></span>
</div>
</div>
<div class="flex items-center justify-between border-t border-gray-100 dark:border-gray-800 pt-4">
<div class="text-lg font-black text-nebula-indigo dark:text-white">
<?php echo e($setting->currency.$astro['price']); ?><span class="text-xs text-gray-400 font-normal">/<?php echo app('translator')->get('front.min'); ?></span>
</div>
<button class="bg-nebula-indigo dark:bg-primary text-white w-10 h-10 rounded-xl flex items-center justify-center hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-lg">chat_bubble</span>
</button>
</div>
</div>
</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
</section>

<?php echo $__env->make('home.login', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->make('home.otp', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->make('home.js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/samarthsharma/Downloads/61539797-ready-to-use-ai-powered-astrology-app-android-ios-website-admin-panel/Backend + Website/resources/views/home/astro.blade.php ENDPATH**/ ?>