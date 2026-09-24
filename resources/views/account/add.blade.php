<!-- Add Balance Modal -->
    <div id="addBalanceModal" class="fixed inset-0 z-50 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background Overlay -->
            <div onclick="toggleModal('addBalanceModal')" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"></div>

            <!-- Modal Panel -->
            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full relative z-10">
                
                <form action="{{ url('addBalance') }}" method="POST">
                    @csrf
                    <div class="px-6 py-6 bg-white sm:p-8">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-900">@lang('front.add_balance')</h3>
                            <button type="button" onclick="toggleModal('addBalanceModal')" class="text-gray-400 hover:text-gray-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Amount Input -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">@lang('front.enter_amount')</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                    <span class="text-gray-500 font-bold text-lg">{{ $setting->currency }}</span>
                                </div>
                                <input type="number" name="amount" id="modalAmountInput" required
                                       class="block w-full pl-10 pr-4 py-4 text-2xl font-bold bg-gray-50 border-0 rounded-xl focus:ring-2 focus:ring-primary text-gray-900" 
                                       placeholder="0.00">
                            </div>
                        </div>

                        <!-- Quick Select -->
                        <div class="mb-8 text-center">
                            <label class="block text-xs font-semibold text-gray-400 uppercase mb-3">@lang('front.quick_select')</label>
                            <div class="flex flex-wrap justify-center gap-3">
                                <button type="button" onclick="setAmount(50)" class="quick-amount-btn px-4 py-2 text-sm font-bold border-2 border-gray-100 text-gray-500 rounded-lg hover:border-gray-300 transition-all">
                                    +50
                                </button>
                                <button type="button" onclick="setAmount(70)" class="quick-amount-btn px-4 py-2 text-sm font-bold border-2 border-gray-100 text-gray-500 rounded-lg hover:border-gray-300 transition-all">
                                    +70
                                </button>
                                <button type="button" onclick="setAmount(100)" class="quick-amount-btn px-4 py-2 text-sm font-bold border-2 border-gray-100 text-gray-500 rounded-lg hover:border-gray-300 transition-all">
                                    +100
                                </button>
                                <button type="button" onclick="setAmount(500)" class="quick-amount-btn px-4 py-2 text-sm font-bold border-2 border-gray-100 text-gray-500 rounded-lg hover:border-gray-300 transition-all">
                                    +500
                                </button>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="mb-8">
                            <label class="block text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">@lang('front.select_payment_mode')</label>
                            <div class="space-y-3">
                                <label class="flex items-center p-4 border border-gray-100 rounded-xl cursor-pointer hover:bg-gray-50 transition group">
                                    <input type="radio" name="payment_method" value="card" checked class="w-5 h-5 text-primary focus:ring-primary border-gray-300">
                                    <div class="ml-4 flex items-center flex-1">
                                        <div class="bg-blue-50 p-2 rounded-lg text-blue-600 mr-3 group-hover:bg-blue-100 transition">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <span class="font-bold text-gray-900">@lang('front.card_payment')</span>
                                    </div>
                                </label>

                                <label class="flex items-center p-4 border border-gray-100 rounded-xl cursor-pointer hover:bg-gray-50 transition group">
                                    <input type="radio" name="payment_method" value="upi" class="w-5 h-5 text-primary focus:ring-primary border-gray-300">
                                    <div class="ml-4 flex items-center flex-1">
                                        <div class="bg-purple-50 p-2 rounded-lg text-purple-600 mr-3 group-hover:bg-purple-100 transition">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09a10.116 10.116 0 001.283-3.562V7a7 7 0 10-14 0v3.308c0 1.284.346 2.534.996 3.618l.054.09m4.716 2.315a8.213 8.213 0 01-2.147 2.146m6.23-2.314l-.064.107a8.214 8.214 0 01-2.146 2.147m1.147-11.33a5 5 0 00-5 5v2m-.001 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2z"></path>
                                            </svg>
                                        </div>
                                        <span class="font-bold text-gray-900">@lang('front.upi_payment')</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-primary hover:opacity-90 text-white font-bold py-4 px-6 rounded-xl transition duration-200 shadow-lg flex items-center justify-center space-x-2">
                            <span>@lang('front.proceed_payment')</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        } else {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    }

    function setAmount(value) {
        document.getElementById('modalAmountInput').value = value;
        // Optional: Add active styling to buttons
        document.querySelectorAll('.quick-amount-btn').forEach(btn => {
            btn.classList.add('border-gray-100', 'text-gray-500');
            btn.classList.remove('border-primary', 'bg-primary/5', 'text-primary');
        });
        event.currentTarget.classList.remove('border-gray-100', 'text-gray-500');
        event.currentTarget.classList.add('border-primary', 'bg-primary/5', 'text-primary');
    }
</script>