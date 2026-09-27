<?php $__env->startSection('title'); ?> <?php echo e(__('admin.dashboard')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
    <div class="page-content">
        <div class="transition-all duration-150 container-fluid" id="page_layout">

            <div class="card p-6">
                <div class="grid xl:grid-cols-4 lg:grid-cols-2 md:grid-cols-2 grid-cols-1 gap-5 place-content-center">

                    <!--Welcome-->
                    <div class="flex space-x-4 h-full items-center rtl:space-x-reverse">
                        <div class="flex-none">
                            <div class="h-20 w-20 rounded-full">
                                <img src="<?php echo e(Asset('assets/user.png')); ?>" alt="" class="w-full h-full">
                            </div>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-xl font-medium mb-2">
                                <span class="block font-light"><?php echo e(__('admin.welcome')); ?></span>
                                <span class="block"><?php echo e(Auth::guard('admin')->user()->name); ?></span>
                            </h4>
                            <p class="text-sm dark:text-slate-300"><?php echo app('translator')->get('admin.title'); ?></p>
                        </div>
                    </div>

                    <div class="bg-warning-100 dark:bg-slate-900 rounded-md p-4  dark:bg-opacity-50 text-center">
                        <div class="text-primary-500 mx-auto h-10 w-10 flex flex-col items-center justify-center rounded-full bg-white text-2xl mb-4">
                            <iconify-icon icon=material-symbols:person-check-outline></iconify-icon>
                        </div>
                        <span class="block text-sm text-slate-600 font-medium dark:text-white mb-1"><?php echo e(__('admin.total_earning')); ?></span>
                        <span class="block mb- text-2xl text-slate-900 dark:text-white font-medium"><?php echo e(getSetting()->currency.number_format($total_earning,2)); ?></span>
                        <span class="block mb- text-sm text-slate-900 dark:text-white font-medium mt-2"><?php echo e(__('admin.today')); ?> <?php echo e(getSetting()->currency.number_format($today_earning,2)); ?></span>
                    </div>

                    <div class="bg-primary-100 dark:bg-slate-900 rounded-md p-4  dark:bg-opacity-50 text-center">
                        <div class="text-primary-500 mx-auto h-10 w-10 flex flex-col items-center justify-center rounded-full bg-white text-2xl mb-4">
                            <iconify-icon icon="material-symbols:person-heart"></iconify-icon>
                        </div>
                        <span class="block text-sm text-slate-600 font-medium dark:text-white mb-1"><?php echo e(__('admin.total_astrologer')); ?></span>
                        <span class="block mb- text-2xl text-slate-900 dark:text-white font-medium"><?php echo e($overview['astro']); ?></span>
                    </div>

                    <div class="bg-success-100 dark:bg-slate-900 rounded-md p-4  dark:bg-opacity-50 text-center">
                        <div class="text-primary-500 mx-auto h-10 w-10 flex flex-col items-center justify-center rounded-full bg-white text-2xl mb-4">
                            <iconify-icon icon="material-symbols:chat-outline-rounded"></iconify-icon>
                        </div>
                        <span class="block text-sm text-slate-600 font-medium dark:text-white mb-1">
                            <?php echo e(__('admin.total_chats')); ?>

                        </span>
                        <span class="block mb- text-2xl text-slate-900 dark:text-white font-medium">
                            <a href="tel:<?php echo e(Auth::user()->t_phone); ?>"><?php echo e($overview['chat']); ?></a>
                        </span>
                    </div>

                </div>
            </div>

            <?php echo $__env->make('admin.dashboard.chart', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<script>
    const ctxs = document.getElementById('dealChart').getContext('2d');

    new Chart(ctxs, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($months, 15, 512) ?>,
            datasets: [{
                data: <?php echo json_encode($userChart, 15, 512) ?>,
                borderColor: '#4F6EF7',
                backgroundColor: 'rgba(79, 110, 247, 0.15)',
                borderWidth: 3,
                fill: true,
                tension: 0.45, // smooth curve
                pointRadius: 0,
                pointHoverRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    ticks: {
                        stepSize: 8
                    },
                    grid: {
                        borderDash: [6, 6],
                        color: '#e5e7eb'
                    }
                }
            }
        }
    });
</script>

<script>
    const ctxs2 = document.getElementById('earningChart').getContext('2d');

    new Chart(ctxs2, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($months, 15, 512) ?>,
            datasets: [{
                data: <?php echo json_encode($earningChart, 15, 512) ?>,
                borderColor: '#4F6EF7',
                backgroundColor: 'rgba(79, 110, 247, 0.15)',
                borderWidth: 3,
                fill: true,
                tension: 0.45,
                pointRadius: 0,
                pointHoverRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: function(context) {
                            return '<?php echo e(getSetting()->currency); ?> ' + context.parsed.y;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    ticks: {
                        stepSize: 8,
                        callback: function(value) {
                            return '<?php echo e(getSetting()->currency); ?> ' + value;
                        }
                    },
                    grid: {
                        borderDash: [6, 6],
                        color: '#e5e7eb'
                    }
                }
            }
        }
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/samarthsharma/Downloads/61539797-ready-to-use-ai-powered-astrology-app-android-ios-website-admin-panel/Backend + Website/resources/views/admin/dashboard/home.blade.php ENDPATH**/ ?>