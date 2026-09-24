@extends('layout.main')

@section('title') {{ getSetting()->welcome_title }} @endsection

@section('content')

@if(Auth::check() && Auth::user()->free_minute > 0)
<div class="max-w-7xl mx-auto px-6 mb-8 pt-4">
    <div class="relative overflow-hidden bg-gradient-to-r from-starlight-bronze/10 via-primary/5 to-transparent border border-starlight-bronze/20 rounded-[2rem] p-8 group celestial-glow">
        <div class="absolute -right-4 -top-4 opacity-10 group-hover:opacity-20 transition-all duration-700">
            <span class="material-symbols-outlined text-[120px] rotate-12">stars</span>
        </div>
        <div class="relative flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="flex items-center gap-6">
                <div class="w-20 h-20 bg-gradient-to-br from-primary to-nebula-indigo rounded-2xl flex items-center justify-center text-white shrink-0 shadow-2xl relative">
                    <span class="material-symbols-outlined text-4xl animate-pulse">redeem</span>
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 rounded-full border-4 border-white dark:border-gray-900"></div>
                </div>
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="bg-primary/10 text-primary text-[10px] font-black uppercase tracking-widest px-2 py-0.5 rounded-md">{{ __('front.exclusive_offer') }}</span>
                        <h3 class="text-2xl font-black text-nebula-indigo dark:text-white uppercase tracking-tight">{{ __('front.free_session') }}</h3>
                    </div>
                    <p class="text-gray-500 dark:text-gray-400 font-medium text-lg leading-relaxed">
                        {{ __('front.claim_your') }} <span class="text-primary font-black underline decoration-primary/30 decoration-4 underline-offset-4">{{ Auth::user()->free_minute }} {{ __('front.minutes') }}</span> {{ __('front.of_free_consultation') }}
                    </p>
                </div>
            </div>
            <a href="#startChat" class="bg-nebula-indigo dark:bg-primary text-white px-10 py-4 rounded-2xl font-black uppercase tracking-[0.2em] shadow-xl shadow-primary/20 hover:scale-105 active:scale-95 transition-all text-sm group/btn flex items-center gap-3">
                {{ __('front.claim_minutes') }}
                <span class="material-symbols-outlined text-lg group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </a>
        </div>
    </div>
</div>
@endif

@include('home.top')

@include('home.astro')

<!-- Mobile App Download Section -->
<section id="mobileApp" class="py-20 mt-16 bg-gradient-to-br from-nebula-indigo/5 via-primary/5 to-starlight-bronze/5 dark:from-gray-900/50 dark:via-gray-800/50 dark:to-gray-900/50" style="border-radius: 20px;">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-4xl md:text-5xl font-black text-nebula-indigo dark:text-white mb-4">
                {{ __('front.download_app') }}
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                {{ __('front.app_desc') }}
            </p>
        </div>

        <div class="flex flex-col md:flex-row items-center justify-center gap-6">
            <!-- Android Download -->
            <a href="{{ $setting->android_app }}" target="_blank" class="group relative overflow-hidden bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 rounded-2xl px-8 py-6 hover:border-primary dark:hover:border-primary transition-all duration-300 hover:shadow-2xl hover:scale-105 w-full md:w-auto">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                        <img src="{{ Asset('upload/android.png') }}" style="height: 45px;">
                    </div>
                    <div class="text-left">
                        <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">{{ __('front.get_it_on') }}</div>
                        <div class="text-xl font-black text-gray-900 dark:text-white">{{ __('front.google_play') }}</div>
                    </div>
                </div>
            </a>

            <!-- iOS Download -->
            <a href="{{ $setting->ios_app }}" target="_blank" class="group relative overflow-hidden bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 rounded-2xl px-8 py-6 hover:border-primary dark:hover:border-primary transition-all duration-300 hover:shadow-2xl hover:scale-105 w-full md:w-auto">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">{{ __('front.download_on') }}</div>
                        <div class="text-xl font-black text-gray-900 dark:text-white">{{ __('front.app_store') }}</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="mt-12 text-center">
            <div class="flex items-center justify-center gap-8 text-sm text-gray-500 dark:text-gray-400">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">star</span>
                    <span>4.8 {{ __('front.rating') }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">download</span>
                    <span>10K+ {{ __('front.downloads') }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">verified</span>
                    <span>{{ __('front.secure_safe') }}</span>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection