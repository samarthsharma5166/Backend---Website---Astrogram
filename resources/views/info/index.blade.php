@extends('layout.main')

@section('title') @lang('front.user_info') @endsection

@section('header')
<style>
select {
background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
background-position: right 0.75rem center;
background-repeat: no-repeat;
background-size: 1.5em 1.5em;
padding-right: 2.5rem;
-webkit-print-color-adjust: exact;
print-color-adjust: exact;
}
</style>
@endsection

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-[#0a0a0c] md:py-12">
<div class="max-w-4xl mx-auto md:bg-white md:dark:bg-gray-900 md:shadow-2xl md:rounded-[3rem] overflow-hidden flex flex-col md:flex-row min-h-[600px]">

<!-- Left Side: Aesthetic Info -->
<div class="w-full md:w-2/5 bg-primary p-8 md:p-12 text-white flex flex-col justify-between relative overflow-hidden">
<div class="relative z-10">
<div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center mb-8">
<span class="material-symbols-outlined text-2xl">star</span>
</div>
<h2 class="text-3xl md:text-4xl font-black leading-tight mb-4">@lang('front.birth_chart_details')</h2>
<p class="text-white/70 text-sm md:text-base font-medium leading-relaxed">
@lang('front.birth_chart_desc')
</p>
</div>

<div class="relative z-10 mt-8">
<div class="flex items-center gap-3 text-sm font-bold opacity-80 decoration-white/30 underline-offset-4">
<span class="material-symbols-outlined text-lg">verified_user</span>
@lang('front.private_secure')
</div>
</div>

<!-- Decorative Circles -->
<div class="absolute -top-12 -right-12 w-48 h-48 bg-white/10 rounded-full blur-3xl"></div>
<div class="absolute -bottom-12 -left-12 w-48 h-48 bg-black/10 rounded-full blur-3xl"></div>
</div>

<!-- Right Side: Form -->
<div class="w-full md:w-3/5 p-6 md:p-12 bg-white dark:bg-gray-900">
<form action="{{ Asset('info') }}" method="POST" class="space-y-7" id="profileForm">
@csrf
<input type="hidden" name="dob" id="dob_combined">
<input type="hidden" name="tob" id="tob_combined">

<div class="space-y-6">
<!-- Name -->
<div class="space-y-1.5">
<label class="text-[11px] font-black text-gray-400 uppercase tracking-[0.15em] ml-1">@lang('front.full_name')</label>
<input type="text" name="name" required placeholder="John Doe" 
class="w-full px-5 py-4 bg-gray-50 dark:bg-gray-800 border-2 border-transparent focus:border-primary/20 focus:bg-white dark:focus:bg-gray-800 rounded-2xl text-sm font-bold transition-all outline-none dark:text-white">
</div>

<div class="grid grid-cols-1 gap-6">
<!-- Birth Date Dropdowns -->
<div class="space-y-1.5">
<label class="text-[11px] font-black text-gray-400 uppercase tracking-[0.15em] ml-1">@lang('front.birth_date')</label>
<div class="flex gap-3">
<select id="day" required class="flex-1 px-4 py-4 bg-gray-50 dark:bg-gray-800 border-2 border-transparent focus:border-primary/20 rounded-2xl text-sm font-bold outline-none dark:text-white appearance-none cursor-pointer">
<option value="">@lang('front.day')</option>
@for ($i = 1; $i <= 31; $i++)
<option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
@endfor
</select>
<select id="month" required class="flex-1 px-4 py-4 bg-gray-50 dark:bg-gray-800 border-2 border-transparent focus:border-primary/20 rounded-2xl text-sm font-bold outline-none dark:text-white appearance-none cursor-pointer">
<option value="">@lang('front.month')</option>
@foreach(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] as $index => $m)
<option value="{{ sprintf('%02d', $index + 1) }}">{{ $m }}</option>
@endforeach
</select>
<select id="year" required class="flex-1 px-4 py-4 bg-gray-50 dark:bg-gray-800 border-2 border-transparent focus:border-primary/20 rounded-2xl text-sm font-bold outline-none dark:text-white appearance-none cursor-pointer">
<option value="">@lang('front.year')</option>
@php $currentYear = date('Y'); @endphp
@for ($i = $currentYear; $i >= $currentYear - 100; $i--)
<option value="{{ $i }}">{{ $i }}</option>
@endfor
</select>
</div>
</div>

<!-- Birth Time Dropdowns -->
<div class="space-y-1.5">
<label class="text-[11px] font-black text-gray-400 uppercase tracking-[0.15em] ml-1">@lang('front.birth_time')</label>
<div class="flex gap-3">
<select id="hour" required class="flex-1 px-4 py-4 bg-gray-50 dark:bg-gray-800 border-2 border-transparent focus:border-primary/20 rounded-2xl text-sm font-bold outline-none dark:text-white appearance-none cursor-pointer">
<option value="">@lang('front.hour')</option>
@for ($i = 1; $i <= 12; $i++)
<option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
@endfor
</select>
<select id="minute" required class="flex-1 px-4 py-4 bg-gray-50 dark:bg-gray-800 border-2 border-transparent focus:border-primary/20 rounded-2xl text-sm font-bold outline-none dark:text-white appearance-none cursor-pointer">
<option value="">@lang('front.min')</option>
@for ($i = 0; $i <= 59; $i++)
<option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
@endfor
</select>
<select id="period" required class="flex-1 px-4 py-4 bg-gray-50 dark:bg-gray-800 border-2 border-transparent focus:border-primary/20 rounded-2xl text-sm font-bold outline-none dark:text-white appearance-none cursor-pointer">
<option value="AM">AM</option>
<option value="PM">PM</option>
</select>
</div>
</div>
</div>

<!-- Birth Place -->
<div class="space-y-2">
<label class="text-[11px] font-black text-gray-400 uppercase tracking-[0.15em] ml-1">@lang('front.place_of_birth')</label>
<div class="relative">
<input type="text" name="pob" required placeholder="@lang('front.enter_birth_place')" 
class="w-full pl-5 pr-12 py-4 bg-gray-50 dark:bg-gray-800 border-2 border-transparent focus:border-primary/20 focus:bg-white dark:focus:bg-gray-800 rounded-2xl text-sm font-bold transition-all outline-none dark:text-white">
</div>
</div>

<!-- Gender -->
<div class="space-y-3">
<label class="text-[11px] font-black text-gray-400 uppercase tracking-[0.15em] ml-1">@lang('front.identify_as')</label>
<div class="flex gap-3">
<label class="flex-1 cursor-pointer">
<input type="radio" name="gender" value="male" class="hidden peer" required>
<div class="py-3.5 text-center bg-gray-50 dark:bg-gray-800 rounded-2xl text-xs font-black uppercase tracking-widest text-gray-500 border-2 border-transparent peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:text-primary transition-all">
@lang('front.male')
</div>
</label>
<label class="flex-1 cursor-pointer">
<input type="radio" name="gender" value="female" class="hidden peer">
<div class="py-3.5 text-center bg-gray-50 dark:bg-gray-800 rounded-2xl text-xs font-black uppercase tracking-widest text-gray-500 border-2 border-transparent peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:text-primary transition-all">
@lang('front.female')
</div>
</label>
<label class="flex-1 cursor-pointer">
<input type="radio" name="gender" value="other" class="hidden peer">
<div class="py-3.5 text-center bg-gray-50 dark:bg-gray-800 rounded-2xl text-xs font-black uppercase tracking-widest text-gray-500 border-2 border-transparent peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:text-primary transition-all">
@lang('front.other')
</div>
</label>
</div>
</div>
</div>

<div class="pt-4">
<button type="submit" class="w-full bg-nebula-indigo dark:bg-primary text-white py-5 rounded-2xl font-black uppercase tracking-[0.3em] text-xs shadow-2xl hover:brightness-110 transition-all active:scale-[0.98]">
@lang('front.save_continue')
</button>
</div>
</form>
</div>
</div>
</div>

@endsection

@section('js')

@include('info.js')

@endsection


