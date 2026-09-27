<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title><?php echo app('translator')->get('front.app_title'); ?> | <?php echo $__env->yieldContent('title'); ?></title>
<?php if(getAsset('favicon')): ?>

<link rel="icon" type="image/png" href="<?php echo e(getAsset('favicon')); ?>">

<?php else: ?>

<link rel="icon" type="image/png" href="<?php echo e(Asset('assets/images/logo/favicon.svg')); ?>">


<?php endif; ?>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@400;500;700;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#ff7024",
                        "background-light": "#f5f7fa",
                        "background-dark": "#0e1c2f",
                        "cosmic-charcoal": "#2f2e41",
                        "nebula-indigo": "#2c3e50",
                        "starlight-bronze": "#ddc698",
                    },
                    fontFamily: {
                        "display": ["Epilogue", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
<style>
        .celestial-glow {
            box-shadow: 0 0 15px rgba(255, 112, 36, 0.1);
            transition: box-shadow 0.3s ease;
        }
        .celestial-glow:hover {
            box-shadow: 0 0 25px rgba(255, 112, 36, 0.25);
        }
        .hero-gradient {
            background: linear-gradient(135deg, rgba(14, 28, 47, 0.85) 0%, rgba(44, 62, 80, 0.7) 100%);
        }
    </style>

    <?php echo $__env->yieldContent('css'); ?>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-cosmic-charcoal dark:text-white transition-colors duration-300">

<?php echo $__env->make('layout.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<main class="max-w-7xl mx-auto px-6 py-8">

<?php echo $__env->yieldContent('content'); ?>


</main>

<footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 mt-20">
<div class="max-w-7xl mx-auto px-6 py-12 flex flex-col md:flex-row justify-between items-center gap-8">
<div class="flex items-center gap-3">
<div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white">
<span class="material-symbols-outlined text-xl">auto_awesome</span>
</div>
<h5 class="text-xl font-black text-nebula-indigo dark:text-white uppercase"><?php echo app('translator')->get('front.app_title'); ?></h5>
</div>
<div class="flex gap-8 text-sm font-bold text-gray-500 uppercase tracking-widest">
<a class="hover:text-primary" href="<?php echo e(Asset('about')); ?>"><?php echo app('translator')->get('front.about'); ?></a>
<a class="hover:text-primary" href="<?php echo e(Asset('terms')); ?>"><?php echo app('translator')->get('front.terms'); ?></a>
<a class="hover:text-primary" href="<?php echo e(Asset('privacy')); ?>"><?php echo app('translator')->get('front.privacy'); ?></a>
<a class="hover:text-primary" href="<?php echo e(Asset('contact')); ?>"><?php echo app('translator')->get('front.contact_us'); ?></a>
</div>
<div class="text-xs text-gray-400 font-medium">
                © <?php echo e(date("Y")); ?> <?php echo app('translator')->get('front.footer'); ?>
            </div>
</div>
</footer>

<?php if(request()->has('loginRequired')): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            openLoginModal(); 
        });
    </script>
<?php endif; ?>

<?php echo $__env->yieldContent('js'); ?>

</body></html><?php /**PATH /Users/samarthsharma/Downloads/61539797-ready-to-use-ai-powered-astrology-app-android-ios-website-admin-panel/Backend + Website/resources/views/layout/main.blade.php ENDPATH**/ ?>