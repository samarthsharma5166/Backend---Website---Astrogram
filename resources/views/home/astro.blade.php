<section class="space-y-8" id="startChat">
<div class="space-y-6 border-b border-gray-200 dark:border-gray-800 pb-8">
<div class="space-y-2">
<h3 class="text-3xl font-black text-nebula-indigo dark:text-white">@lang('front.expert')</h3>
<p class="text-gray-500 dark:text-gray-400">@lang('front.hand_picked')</p>
</div>

    <!-- Chips/Filters -->
    <div class="flex overflow-x-auto gap-8 pb-4 -mx-4 px-4 md:mx-0 md:px-0 scrollbar-hide">
        <div class="category-chip flex flex-col items-center gap-3 shrink-0 cursor-pointer group active mt-4" data-cate-id="all" style="margin-left: 20px;">
            <div class="chip-container w-28 h-28 bg-primary text-white rounded-full flex items-center justify-center shadow-lg shadow-primary/20 transition-all group-hover:scale-110">
                <span class="material-symbols-outlined text-4xl">all_inclusive</span>
            </div>
            <span class="chip-text text-sm font-black text-nebula-indigo dark:text-white uppercase tracking-wider">@lang('front.all')</span>
        </div>
        @foreach($cates as $cate)
        <div class="category-chip flex flex-col items-center gap-3 shrink-0 cursor-pointer group mt-4" data-cate-id="{{ $cate['id'] }}">
            <div class="chip-container w-28 h-28 rounded-full border-2 border-transparent transition-all p-1">
                <img src="{{ $cate['img'] }}" class="w-full h-full rounded-full object-cover border border-gray-100 dark:border-gray-700 shadow-sm transition-all group-hover:scale-105" alt="{{ $cate['name'] }}">
            </div>
            <span class="chip-text text-sm font-black text-gray-500 dark:text-gray-400 group-hover:text-primary transition-colors uppercase tracking-wider">{{ $cate['name'] }}</span>
        </div>
        @endforeach
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

@foreach($astrologer as $astro)
@php
    $isLowBalance = Auth::check() && (Auth::user()->wallet < $astro['price'] && Auth::user()->free_minute == 0);
@endphp

<div class="astrologer-card group bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 p-5 rounded-3xl celestial-glow flex flex-col gap-5 cursor-pointer {{ $isLowBalance ? 'opacity-50 grayscale-[0.5]' : '' }}" 
     data-categories="{{ json_encode($astro['cates']) }}" 
     data-astro-id="{{ $astro['id'] }}">
<div class="relative w-full aspect-square overflow-hidden rounded-2xl">
<img alt="{{ $astro['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Portrait of a friendly male Vedic astrologer" src="{{ $astro['img'] }}"/>
@if($isLowBalance)
<div class="absolute inset-0 bg-black/20 flex flex-col items-center justify-center backdrop-blur-[1px]">
    <div class="bg-red-600 text-white text-[10px] font-black uppercase tracking-tighter px-3 py-1.5 rounded-xl shadow-2xl animate-pulse">
        @lang('front.insufficient_balance')
    </div>
</div>
@endif
<div class="absolute top-3 right-3 bg-green-500 w-3 h-3 rounded-full border-2 border-white ring-4 ring-green-500/20"></div>
<div class="absolute bottom-3 left-3 px-3 py-1 bg-white/90 backdrop-blur rounded-lg text-[10px] font-black uppercase tracking-tighter text-nebula-indigo">
@lang('front.online')
</div>
</div>
<div class="space-y-3">
<div class="flex justify-between items-start">
<div>
<h4 class="text-lg font-black dark:text-white">{{ $astro['name'] }} </h4>
<p class="text-sm text-primary font-bold">{{ $astro['type'] }}</p>
</div>
<div class="flex items-center gap-1 text-starlight-bronze">
<span class="text-sm font-black" style="font-size: 10px;">{{ $astro['total_order'] }} @lang('front.orders')</span>
</div>
</div>
<div class="flex items-center justify-between border-t border-gray-100 dark:border-gray-800 pt-4">
<div class="text-lg font-black text-nebula-indigo dark:text-white">
{{ $setting->currency.$astro['price'] }}<span class="text-xs text-gray-400 font-normal">/@lang('front.min')</span>
</div>
<button class="bg-nebula-indigo dark:bg-primary text-white w-10 h-10 rounded-xl flex items-center justify-center hover:scale-110 transition-transform">
<span class="material-symbols-outlined text-lg">chat_bubble</span>
</button>
</div>
</div>
</div>

@endforeach

</div>
</section>

@include('home.login')

@include('home.otp')

@include('home.js')