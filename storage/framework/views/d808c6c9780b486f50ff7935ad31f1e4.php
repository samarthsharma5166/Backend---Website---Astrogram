<?php ($page = Request::segment(2)); ?>

<div class="sidebar-wrapper group">
    <div id="bodyOverlay" class="w-screen h-screen fixed top-0 bg-slate-900 bg-opacity-50 backdrop-blur-sm z-10 hidden"></div>
    <div class="logo-segment">
        <a class="flex items-center" href="<?php echo e(Asset(env('admin'))); ?>">

            <img src="<?php echo e(getAsset('logo')); ?>" class="black_logo" alt="logo" style="max-width: 170px;">


        </a>
        <!-- Sidebar Type Button -->
        <div id="sidebar_type" class="cursor-pointer text-slate-900 dark:text-white text-lg">
            <span class="sidebarDotIcon extend-icon cursor-pointer text-slate-900 dark:text-white text-2xl">
                <div class="h-4 w-4 border-[1.5px] border-slate-900 dark:border-slate-700 rounded-full transition-all duration-150 ring-2 ring-inset ring-offset-4 ring-black-900 dark:ring-slate-400 bg-slate-900 dark:bg-slate-400 dark:ring-offset-slate-700"></div>
            </span>
            <span class="sidebarDotIcon collapsed-icon cursor-pointer text-slate-900 dark:text-white text-2xl">
                <div class="h-4 w-4 border-[1.5px] border-slate-900 dark:border-slate-700 rounded-full transition-all duration-150"></div>
            </span>
        </div>
        <button class="sidebarCloseIcon text-2xl">
            <iconify-icon class="text-slate-900 dark:text-slate-200" icon="clarity:window-close-line"></iconify-icon>
        </button>
    </div>

    <div id="nav_shadow" class="nav_shadow h-[60px] absolute top-[80px] nav-shadow z-[1] w-full transition-all duration-200 pointer-events-none
opacity-0"></div>
    <div class="sidebar-menus bg-white dark:bg-slate-800 py-2 px-4 h-[calc(100%-80px)] overflow-y-auto z-50" id="sidebar_menus">
        <ul class="sidebar-menu">
            <li class="sidebar-menu-title"><?php echo e(__('admin.menu')); ?></li>

            <li class="">
                <a href="<?php echo e(Asset(env('admin').'/home')); ?>" class="navItem <?php if($page == 'home'): ?> active <?php endif; ?>">
                    <span class="flex items-center">
                        <iconify-icon class=" nav-icon" icon="heroicons-outline:home"></iconify-icon>
                        <span><?php echo e(__('admin.dashboard')); ?></span>
                    </span>
                </a>
            </li>

            <li class="sidebar-menu-title"><?php echo e(__('admin.setting')); ?></li>


            <li class="">
                <a href="<?php echo e(Asset(env('admin').'/setting')); ?>" class="navItem <?php if($page == 'setting'): ?> active <?php endif; ?>">
                    <span class="flex items-center">
                        <iconify-icon class=" nav-icon" icon="heroicons-outline:cog-6-tooth"></iconify-icon>
                        <span><?php echo e(__('admin.system_setting')); ?></span>
                    </span>
                </a>
            </li>


            <li class="sidebar-menu-title"><?php echo e(__('admin.category_astrologers')); ?></li>

            <li class="">
                <a href="<?php echo e(Asset(env('admin').'/category')); ?>" class="navItem <?php if($page == 'category'): ?> active <?php endif; ?>">
                    <span class="flex items-center">
                        <iconify-icon class=" nav-icon" icon="material-symbols:tag"></iconify-icon>
                        <span><?php echo e(__('admin.manage_category')); ?></span>
                    </span>
                </a>
            </li>

            <li class="">
                <a href="<?php echo e(Asset(env('admin').'/astrologer')); ?>" class="navItem <?php if($page == 'astrologer'): ?> active <?php endif; ?>">
                    <span class="flex items-center">
                        <iconify-icon class=" nav-icon" icon="material-symbols:frame-person-mic-outline-sharp"></iconify-icon>
                        <span><?php echo e(__('admin.manage_astrologer')); ?></span>
                    </span>
                </a>
            </li>

            <li class="sidebar-menu-title"><?php echo e(__('admin.other')); ?></li>


            <li class="">
                <a href="<?php echo e(Asset(env('admin').'/appUser')); ?>" class="navItem <?php if($page == 'appUser'): ?> active <?php endif; ?>">
                    <span class="flex items-center">
                        <iconify-icon class=" nav-icon" icon="material-symbols:person-add-rounded"></iconify-icon>
                        <span><?php echo e(__('admin.app_users')); ?></span>
                    </span>
                </a>
            </li>

            <li class="">
                <a href="<?php echo e(Asset(env('admin').'/push')); ?>" class="navItem <?php if($page == 'push'): ?> active <?php endif; ?>">
                    <span class="flex items-center">
                        <iconify-icon class=" nav-icon" icon="material-symbols:circle-notifications-outline"></iconify-icon>
                        <span><?php echo e(__('admin.push_notifications')); ?></span>
                    </span>
                </a>
            </li>


            <li class="">
                <a href="javascript:void(0)" class="navItem" onclick="showSweetAlert('logout','<?php echo e(__('admin.are_you_sure')); ?>','<?php echo e(__('admin.logout_confirm')); ?>')">
                    <span class="flex items-center">
                        <iconify-icon class=" nav-icon" icon="material-symbols:logout-sharp"></iconify-icon>
                        <span><?php echo e(__('admin.logout')); ?></span>
                    </span>
                </a>
            </li>

        </ul>


    </div>
</div><?php /**PATH /Users/samarthsharma/Downloads/61539797-ready-to-use-ai-powered-astrology-app-android-ios-website-admin-panel/Backend + Website/resources/views/admin/layout/menu.blade.php ENDPATH**/ ?>