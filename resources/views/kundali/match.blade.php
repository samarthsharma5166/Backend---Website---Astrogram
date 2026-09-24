@extends('layout.main')

@section('title') {{ __('front.match_making') }} @endsection

@section('content')
<style>
    h3 {
        font-weight: bold !important;
        color: black !important;
        font-size: 20px;
        margin-bottom: 15px;
    }

    .step-active {
        color: #f97316;
        border-bottom: 2px solid #f97316;
    }
</style>

@php
$userInfo = auth()->user()->info ?? [];

// Parse DOB (Expected YYYY-MM-DD or similar) - My Info
$myDob = $userInfo['dob'] ?? '';
$myDay = $myDob ? (int)date('d', strtotime($myDob)) : '';
$myMonth = $myDob ? (int)date('m', strtotime($myDob)) : '';
$myYear = $myDob ? (int)date('Y', strtotime($myDob)) : '';

// Parse TOB (Expected HH:MM AM/PM) - My Info
$myTob = $userInfo['tob'] ?? '';
$myHour = ''; $myMin = ''; $myAmPm = 'AM';
if ($myTob && strpos($myTob, ':') !== false) {
$parts = explode(' ', $myTob);
$timeParts = explode(':', $parts[0]);
$myHour = (int)$timeParts[0];
$myMin = (int)$timeParts[1];
$myAmPm = isset($parts[1]) ? strtoupper($parts[1]) : 'AM';
}
@endphp

<div class="container mx-auto px-4 py-12">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">{{ __('front.match_making') }}</h1>
            <p class="text-gray-500">{{ __('front.compare_charts') }}</p>
        </div>

        <!-- Cost & Balance Alert -->
        <div class="mb-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">{{ __('front.matching_cost') }}</h3>
                    <div class="text-2xl font-bold text-primary">{{ $setting->currency }}{{ number_format($setting->match_cost, 2) }}</div>
                </div>
                <div class="text-right">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Your Balance</h3>
                    <div class="text-xl font-bold {{ $haveBalance ? 'text-green-600' : 'text-red-500' }}">
                        {{ $setting->currency }}{{ number_format(auth()->user()->wallet, 2) }}
                    </div>
                </div>
            </div>

            @if(!$haveBalance)
            <div class="mt-4 bg-red-50 border border-red-200 rounded-xl p-4 flex items-start space-x-3">
                <svg class="w-6 h-6 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <div class="flex-1">
                    <p class="text-red-800 font-semibold text-sm">Insufficient Balance</p>
                    <p class="text-red-600 text-sm mt-1">{{ __('front.need_more_balance_kundali', ['amount' => $setting->currency . number_format($setting->match_cost - auth()->user()->wallet, 2)]) }}</p>
                    <a href="{{ Asset('account') }}" class="mt-3 inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-bold hover:bg-red-700 transition">
                        Add Balance
                    </a>
                </div>
            </div>
            @endif
        </div>

        <!-- Step Indicator -->
        <div class="flex items-center justify-center mb-8 space-x-8">
            <div id="step1Indicator" class="pb-2 px-4 font-bold transition-all step-active cursor-pointer" onclick="goToStep(1)">
                1. Your Details
            </div>
            <div id="step2Indicator" class="pb-2 px-4 font-bold transition-all text-gray-400 cursor-pointer" onclick="goToStep(2)">
                2. Partner Details
            </div>
        </div>

        <!-- Form Card -->
        <div id="formContainer" class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            <form id="matchAjaxForm" action="{{ url('match') }}" method="POST" class="p-8">
                @csrf

                <!-- Step 1: Your Details -->
                <div id="step1" class="space-y-6">
                    <h2 class="text-xl font-bold text-gray-800 border-b pb-2">{{ __('front.enter_your_birth_details') }}</h2>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('front.your_full_name') }}</label>
                        <input type="text" name="m_name" required placeholder="Enter your name" value="{{ $userInfo['name'] ?? '' }}"
                            class="w-full px-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900 transition @if(!$haveBalance) opacity-50 cursor-not-allowed @endif"
                            @if(!$haveBalance) disabled @endif>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- DOB Dropdowns -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Date of Birth</label>
                            <div class="grid grid-cols-3 gap-2">
                                <select name="m_day" required class="px-2 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900 @if(!$haveBalance) opacity-50 @endif" @if(!$haveBalance) disabled @endif>
                                    <option value="">Day</option>
                                    @for($i=1; $i<=31; $i++) <option value="{{ $i }}" {{ $myDay == $i ? 'selected' : '' }}>{{ sprintf("%02d", $i) }}</option> @endfor
                                </select>
                                <select name="m_month" required class="px-2 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900 @if(!$haveBalance) opacity-50 @endif" @if(!$haveBalance) disabled @endif>
                                    <option value="">Month</option>
                                    @foreach(['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'] as $m => $month)
                                    <option value="{{ $m+1 }}" {{ $myMonth == ($m+1) ? 'selected' : '' }}>{{ $month }}</option>
                                    @endforeach
                                </select>
                                <select name="m_year" required class="px-2 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900 @if(!$haveBalance) opacity-50 @endif" @if(!$haveBalance) disabled @endif>
                                    <option value="">Year</option>
                                    @for($i=date('Y'); $i>=1940; $i--) <option value="{{ $i }}" {{ $myYear == $i ? 'selected' : '' }}>{{ $i }}</option> @endfor
                                </select>
                            </div>
                        </div>

                        <!-- TOB Dropdowns -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Time of Birth</label>
                            <div class="grid grid-cols-3 gap-2">
                                <select name="m_hour" required class="px-2 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900 @if(!$haveBalance) opacity-50 @endif" @if(!$haveBalance) disabled @endif>
                                    <option value="">Hr</option>
                                    @for($i=1; $i<=12; $i++) <option value="{{ $i }}" {{ $myHour == $i ? 'selected' : '' }}>{{ sprintf("%02d", $i) }}</option> @endfor
                                </select>
                                <select name="m_min" required class="px-2 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900 @if(!$haveBalance) opacity-50 @endif" @if(!$haveBalance) disabled @endif>
                                    <option value="">Min</option>
                                    @for($i=0; $i<=59; $i++) <option value="{{ $i }}" {{ $myMin === $i ? 'selected' : '' }}>{{ sprintf("%02d", $i) }}</option> @endfor
                                </select>
                                <select name="m_ampm" required class="px-2 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900 @if(!$haveBalance) opacity-50 @endif" @if(!$haveBalance) disabled @endif>
                                    <option value="AM" {{ $myAmPm == 'AM' ? 'selected' : '' }}>AM</option>
                                    <option value="PM" {{ $myAmPm == 'PM' ? 'selected' : '' }}>PM</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Place of Birth</label>
                            <input type="text" name="m_place" required placeholder="City, State" value="{{ $userInfo['pob'] ?? '' }}"
                                class="w-full px-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900 @if(!$haveBalance) opacity-50 @endif"
                                @if(!$haveBalance) disabled @endif>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Language</label>
                            <select name="language" required class="w-full px-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900 @if(!$haveBalance) opacity-50 @endif" @if(!$haveBalance) disabled @endif>
                                @foreach(explode(',', $setting->language) as $lang)
                                <option value="{{ trim($lang) }}" {{ (isset($userInfo['language']) && trim($userInfo['language']) == trim($lang)) ? 'selected' : '' }}>{{ trim($lang) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Gender</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="m_gender" value="Male" {{ (isset($userInfo['gender']) && $userInfo['gender'] == 'Male') ? 'checked' : 'checked' }} class="peer hidden" @if(!$haveBalance) disabled @endif>
                                <div class="flex items-center justify-center p-3 border rounded-xl transition-all peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:text-primary hover:bg-gray-50 text-xs font-semibold text-gray-700 @if(!$haveBalance) opacity-50 @endif">
                                    Male
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="m_gender" value="Female" {{ (isset($userInfo['gender']) && $userInfo['gender'] == 'Female') ? 'checked' : '' }} class="peer hidden" @if(!$haveBalance) disabled @endif>
                                <div class="flex items-center justify-center p-3 border rounded-xl transition-all peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:text-primary hover:bg-gray-50 text-xs font-semibold text-gray-700 @if(!$haveBalance) opacity-50 @endif">
                                    Female
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="button" onclick="goToStep(2)"
                            class="w-full py-4 bg-primary text-white font-bold rounded-2xl shadow-lg hover:opacity-90 transition transform active:scale-[0.98] @if(!$haveBalance) opacity-50 cursor-not-allowed @endif"
                            @if(!$haveBalance) disabled @endif>
                            {{ __('front.next_partner_details') }}
                        </button>
                    </div>
                </div>

                <!-- Step 2: Partner Details -->
                <div id="step2" class="hidden space-y-6">
                    <h2 class="text-xl font-bold text-gray-800 border-b pb-2">{{ __('front.enter_partner_birth_details') }}</h2>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('front.partner_full_name') }}</label>
                        <input type="text" name="p_name" required placeholder="Enter partner's name"
                            class="w-full px-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900 transition">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Date of Birth</label>
                            <div class="grid grid-cols-3 gap-2">
                                <select name="p_day" required class="px-2 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900">
                                    <option value="">Day</option>
                                    @for($i=1; $i<=31; $i++) <option value="{{ $i }}">{{ sprintf("%02d", $i) }}</option> @endfor
                                </select>
                                <select name="p_month" required class="px-2 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900">
                                    <option value="">Month</option>
                                    @foreach(['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'] as $m => $month)
                                    <option value="{{ $m+1 }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                                <select name="p_year" required class="px-2 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900">
                                    <option value="">Year</option>
                                    @for($i=date('Y'); $i>=1940; $i--) <option value="{{ $i }}">{{ $i }}</option> @endfor
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Time of Birth</label>
                            <div class="grid grid-cols-3 gap-2">
                                <select name="p_hour" required class="px-2 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900">
                                    <option value="">Hr</option>
                                    @for($i=1; $i<=12; $i++) <option value="{{ $i }}">{{ sprintf("%02d", $i) }}</option> @endfor
                                </select>
                                <select name="p_min" required class="px-2 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900">
                                    <option value="">Min</option>
                                    @for($i=0; $i<=59; $i++) <option value="{{ $i }}">{{ sprintf("%02d", $i) }}</option> @endfor
                                </select>
                                <select name="p_ampm" required class="px-2 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900">
                                    <option value="AM">AM</option>
                                    <option value="PM">PM</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Place of Birth</label>
                        <input type="text" name="p_place" required placeholder="City, State"
                            class="w-full px-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Gender</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="p_gender" value="Male" class="peer hidden">
                                <div class="flex items-center justify-center p-3 border rounded-xl transition-all peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:text-primary hover:bg-gray-50 text-xs font-semibold text-gray-700">
                                    Male
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="p_gender" value="Female" checked class="peer hidden">
                                <div class="flex items-center justify-center p-3 border rounded-xl transition-all peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:text-primary hover:bg-gray-50 text-xs font-semibold text-gray-700">
                                    Female
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="pt-4 flex gap-4">
                        <button type="button" onclick="goToStep(1)"
                            class="w-1/3 py-4 bg-gray-100 text-gray-600 font-bold rounded-2xl hover:bg-gray-200 transition">
                            Back
                        </button>
                        <button type="submit" id="submitBtn"
                            class="w-2/3 py-4 bg-primary text-white font-bold rounded-2xl shadow-lg hover:opacity-90 transition flex justify-center items-center gap-2">
                            <span id="btnText">{{ __('front.check_compatibility') }}</span>
                            <span id="btnLoader" class="hidden">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Result Container -->
        <div id="matchResult" class="hidden mt-12 bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 bg-primary/5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-900">{{ __('front.compatibility_analysis') }}</h3>
                <button onclick="window.print()" class="text-primary hover:text-orange-700 font-bold text-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Print Result
                </button>
            </div>
            <div id="resultContent" class="p-8 prose prose-orange max-w-none text-gray-700">
                <!-- AJAX Data here -->
            </div>
        </div>
    </div>
</div>

@include('kundali.match_js')

@endsection