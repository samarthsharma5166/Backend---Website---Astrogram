@extends('layout.main')

@section('title') @lang('front.baby_name_creation') @endsection

@section('content')
<style>
h3
{
    font-weight: bold !important;
    color:black !important;
    font-size: 20px;
    margin-bottom: 15px;
}
</style>

<div class="container mx-auto px-4 py-12">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">@lang('front.baby_name_creation')</h1>
            <p class="text-gray-500">@lang('front.create_baby_name_vedic')</p>
        </div>

        <!-- Cost & Balance Alert -->
        <div class="mb-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">@lang('front.generation_cost')</h3>
                    <div class="text-2xl font-bold text-primary">{{ $setting->currency }}{{ number_format($setting->name_cost, 2) }}</div>
                </div>
                <div class="text-right">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">@lang('front.your_balance')</h3>
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
                    <p class="text-red-800 font-semibold text-sm">@lang('front.insufficient_balance')</p>
                    <p class="text-red-600 text-sm mt-1">You need {{ $setting->currency }}{{ number_format($setting->name_cost - auth()->user()->wallet, 2) }} more to generate this Kundali.</p>
                    <a href="{{ Asset('account') }}" class="mt-3 inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-bold hover:bg-red-700 transition">
                       @lang('front.add_balance')
                    </a>
                </div>
            </div>
            @endif
        </div>

        <!-- Form Card -->
        <div id="kundaliFormContainer" class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            <form id="kundaliAjaxForm" action="{{ url('baby') }}" method="POST" class="p-8 space-y-6">
                @csrf
                
                

                <div class="space-y-6">
                    <!-- Date of Birth Dropdowns -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">@lang('front.birth_date')</label>
                        <div class="grid grid-cols-3 gap-3">
                            <select name="day" required class="px-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900 transition @if(!$haveBalance) opacity-50 cursor-not-allowed @endif" @if(!$haveBalance) disabled @endif>
                            
                                <option value="">@lang('front.day')</option>
                                @for($i=1; $i<=31; $i++) <option value="{{ $i }}">{{ sprintf("%02d", $i) }}</option> @endfor
                            </select>
                            <select name="month" required class="px-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900 transition @if(!$haveBalance) opacity-50 cursor-not-allowed @endif" @if(!$haveBalance) disabled @endif>
                                <option value="">@lang('front.month')</option>
                                @foreach(['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'] as $m => $month)
                                    <option value="{{ $m+1 }}">{{ $month }}</option>
                                @endforeach
                            </select>
                            <select name="year" required class="px-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900 transition @if(!$haveBalance) opacity-50 cursor-not-allowed @endif" @if(!$haveBalance) disabled @endif>
                                <option value="">@lang('front.year')</option>
                                @for($i=date('Y'); $i>=1940; $i--) <option value="{{ $i }}">{{ $i }}</option> @endfor
                            </select>
                        </div>
                    </div>

                    <!-- Time of Birth Dropdowns -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">@lang('front.birth_time')</label>
                        <div class="grid grid-cols-3 gap-3">
                            <select name="hour" required class="px-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900 transition @if(!$haveBalance) opacity-50 cursor-not-allowed @endif" @if(!$haveBalance) disabled @endif>
                                <option value="">@lang('front.hour')</option>
                                @for($i=1; $i<=12; $i++) <option value="{{ $i }}">{{ sprintf("%02d", $i) }}</option> @endfor
                            </select>
                            <select name="minute" required class="px-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900 transition @if(!$haveBalance) opacity-50 cursor-not-allowed @endif" @if(!$haveBalance) disabled @endif>
                                <option value="">@lang('front.min')</option>
                                @for($i=0; $i<=59; $i++) <option value="{{ $i }}">{{ sprintf("%02d", $i) }}</option> @endfor
                            </select>
                            <select name="ampm" required class="px-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900 transition @if(!$haveBalance) opacity-50 cursor-not-allowed @endif" @if(!$haveBalance) disabled @endif>
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Place of Birth -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">@lang('front.place_of_birth')</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </span>
                        <input type="text" name="place" required placeholder="City, State, Country" value="{{ $userInfo['pob'] ?? '' }}"
                            class="w-full pl-11 pr-4 py-3 bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900 transition @if(!$haveBalance) opacity-50 cursor-not-allowed @endif"
                            @if(!$haveBalance) disabled @endif>
                    </div>
                </div>

                <!-- Gender Selection -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-3">@lang('front.gender')</label>
                    <div class="grid grid-cols-3 gap-3">
                        <label class="relative flex items-center p-3 border rounded-xl cursor-pointer hover:bg-gray-50 transition group peer-checked:border-primary">
                            <input type="radio" name="gender" value="Male" {{ (isset($userInfo['gender']) && $userInfo['gender'] == 'Male') ? 'checked' : (!isset($userInfo['gender']) ? 'checked' : '') }} class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                            <span class="ml-2 font-semibold text-gray-900 text-xs">@lang('front.male')</span>
                        </label>
                        <label class="relative flex items-center p-3 border rounded-xl cursor-pointer hover:bg-gray-50 transition group">
                            <input type="radio" name="gender" value="Female" {{ (isset($userInfo['gender']) && $userInfo['gender'] == 'Female') ? 'checked' : '' }} class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                            <span class="ml-2 font-semibold text-gray-900 text-xs">@lang('front.female')</span>
                        </label>
                        <label class="relative flex items-center p-3 border rounded-xl cursor-pointer hover:bg-gray-50 transition group">
                            <input type="radio" name="gender" value="Other" {{ (isset($userInfo['gender']) && $userInfo['gender'] == 'Other') ? 'checked' : '' }} class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                            <span class="ml-2 font-semibold text-gray-900 text-xs">@lang('front.other')</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="submitBtn"
                    class="w-full py-4 bg-primary text-white font-bold rounded-2xl shadow-lg shadow-orange-100 hover:opacity-90 transition transform active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed disabled:shadow-none mt-4 flex justify-center items-center space-x-2"
                    @if(!$haveBalance) disabled @endif>
                    <span id="btnText">@lang('front.generate_names_now')</span>
                    <span id="btnLoader" class="hidden">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                </button>

                <p class="text-center text-xs text-gray-400 mt-4">
                    By clicking generate, {{ $setting->currency }}{{ number_format($setting->name_cost, 2) }} will be deducted from your wallet.
                </p>
            </form>
        </div>

        <!-- Result Container -->
        <div id="kundaliResult" class="hidden mt-12 bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 bg-primary/5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-900">@lang('front.here_baby_names')</h3>
                <button onclick="window.print()" class="text-primary hover:text-orange-700 font-bold text-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                   @lang('front.download_print')
                </button>
            </div>
            <div id="resultContent" class="p-8 prose prose-orange max-w-none text-gray-700 leading-relaxed">
            </div>
        </div>
    </div>
</div>

@include('kundali.baby_js')

@endsection
