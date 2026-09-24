<!-- Login Modal -->
<div id="loginModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4">
    <div class="bg-white dark:bg-gray-900 w-full max-w-md rounded-3xl shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
        <div class="p-8 space-y-6">
            <div class="flex justify-between items-center">
                <h3 class="text-2xl font-black text-nebula-indigo dark:text-white">@lang('front.login_continue')</h3>
                <button onclick="closeLoginModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-white transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            
            <p class="text-gray-500 dark:text-gray-400">@lang('front.login_desc')</p>
            
            <form id="loginForm" class="space-y-4">
                @csrf
                <input type="hidden" name="is_web" value="1">
                <div class="flex gap-3">
                    <div class="w-32">
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-wider">@lang('front.code')</label>
                        <select name="country" class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-xl px-4 py-3.5 text-sm font-bold focus:ring-2 focus:ring-primary appearance-none">
                            @foreach($country as $c)
                                <option value="{{ $c->code }}" {{ $c->code == '91' ? 'selected' : '' }}>+{{ $c->code }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-wider">@lang('front.mobile_number')</label>
                        <input type="tel" name="phone" placeholder="Enter number" required
                               class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-xl px-4 py-3.5 text-sm font-bold focus:ring-2 focus:ring-primary">
                    </div>
                </div>
                
                <button type="submit" id="loginBtn" class="w-full bg-primary text-white py-4 rounded-xl font-black uppercase tracking-widest shadow-lg shadow-primary/20 hover:brightness-110 transition-all active:scale-95 disabled:opacity-50">
                   @lang('front.send_otp')
                </button>
            </form>
        </div>
    </div>
</div>