<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>@lang('front.app_title') | @yield('title')</title>
@if(getAsset('favicon'))

<link rel="icon" type="image/png" href="{{ getAsset('favicon') }}">

@else

<link rel="icon" type="image/png" href="{{ Asset('assets/images/logo/favicon.svg') }}">


@endif
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

    @yield('css')
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-cosmic-charcoal dark:text-white transition-colors duration-300">

@include('layout.header')

<main class="max-w-7xl mx-auto px-6 py-8">

@yield('content')


</main>

<footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 mt-20">
<div class="max-w-7xl mx-auto px-6 py-12 flex flex-col md:flex-row justify-between items-center gap-8">
<div class="flex items-center gap-3">
@if(getSetting() && getSetting()->logo)
    <img src="{{ Asset('upload/admin/'.getSetting()->logo) }}" alt="Logo" class="w-9 h-9 object-contain rounded-full border border-gray-200 dark:border-gray-700 shadow-sm">
@else
    <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white">
        <span class="material-symbols-outlined text-xl">auto_awesome</span>
    </div>
@endif
<h5 class="text-xl font-black text-nebula-indigo dark:text-white uppercase">@lang('front.app_title')</h5>
</div>
<div class="flex gap-8 text-sm font-bold text-gray-500 uppercase tracking-widest">
<a class="hover:text-primary" href="{{ Asset('about') }}">@lang('front.about')</a>
<a class="hover:text-primary" href="{{ Asset('terms') }}">@lang('front.terms')</a>
<a class="hover:text-primary" href="{{ Asset('privacy') }}">@lang('front.privacy')</a>
<a class="hover:text-primary" href="{{ Asset('contact') }}">@lang('front.contact_us')</a>
</div>
<div class="text-xs text-gray-400 font-medium">
                © {{ date("Y") }} @lang('front.footer')
            </div>
</div>
</footer>

@if(request()->has('loginRequired'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            openLoginModal(); 
        });
    </script>
@endif

@yield('js')

</body></html>