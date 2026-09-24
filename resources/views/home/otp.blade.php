<!-- OTP Modal -->
<div id="otpModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4">
    <div class="bg-white dark:bg-gray-900 w-full max-w-md rounded-3xl shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
        <div class="p-8 space-y-6">
            <div class="flex justify-between items-center">
                <h3 class="text-2xl font-black text-nebula-indigo dark:text-white">@lang('front.verify_otp')</h3>
                <button onclick="closeOtpModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-white transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            
            <p class="text-gray-500 dark:text-gray-400">@lang('front.otp_desc')</p>
            
            <form id="verifyOtpForm" class="space-y-6">
                @csrf
                <input type="hidden" id="otp_user_id" name="user_id">
                <input type="hidden" name="is_web" value="1">
                <div class="flex justify-between gap-4">
                    <input type="text" maxlength="1" class="otp-input w-16 h-16 text-center text-2xl font-black bg-gray-50 dark:bg-gray-800 border-none rounded-2xl focus:ring-2 focus:ring-primary">
                    <input type="text" maxlength="1" class="otp-input w-16 h-16 text-center text-2xl font-black bg-gray-50 dark:bg-gray-800 border-none rounded-2xl focus:ring-2 focus:ring-primary">
                    <input type="text" maxlength="1" class="otp-input w-16 h-16 text-center text-2xl font-black bg-gray-50 dark:bg-gray-800 border-none rounded-2xl focus:ring-2 focus:ring-primary">
                    <input type="text" maxlength="1" class="otp-input w-16 h-16 text-center text-2xl font-black bg-gray-50 dark:bg-gray-800 border-none rounded-2xl focus:ring-2 focus:ring-primary">
                </div>
                
                <button type="submit" id="verifyBtn" class="w-full bg-primary text-white py-4 rounded-xl font-black uppercase tracking-widest shadow-lg shadow-primary/20 hover:brightness-110 transition-all active:scale-95 disabled:opacity-50">
                   @lang('front.verify_login')
                </button>

                <div class="text-center">
                    <p id="timerContainer" class="text-sm font-bold text-gray-400">
                       @lang('front.resend_in') <span id="timer" class="text-primary">30</span>s
                    </p>
                    <button type="button" id="resendBtn" onclick="resendOtp()" class="hidden text-sm font-black text-primary uppercase tracking-wider hover:underline">
                        @lang('front.resend_code')
                    </button>
                    <p id="resendMsg" class="hidden text-xs font-bold text-green-500 mt-2"> @lang('front.otp_sent')</p>
                </div>
            </form>
        </div>
    </div>
</div>