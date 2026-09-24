<br>
<div class="grid xl:grid-cols-2 grid-cols-2 gap-5">
    <div class="card">
        <div class="card-body px-6 pb-6">
            <div class="overflow-x-auto -mx-6">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden px-6 py-6">
                        <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                            <div class="flex-1">
                                <div class="card-title text-slate-900 dark:text-white">{{ __('admin.user_signup_data') }} <span style="float:right;font-size: 15px;">{{ __('admin.total_users') }} {{ $total_users }}</span></div>
                                <p class="mt-2 text-slate-500" style="font-size: 12px;">{{ __('admin.verified_users_desc') }}</p>
                            </div>
                        </header>
                        <div class="card">
                            <div class="grid xl:grid-cols-1 grid-cols-1 gap-5">

                                <div class="bg-info-100 rounded-md p-4 bg-opacity-[0.15] dark:bg-opacity-50 text-center">
                                    <canvas id="dealChart" height="400"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body px-6 pb-6">
            <div class="overflow-x-auto -mx-6">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden px-6 py-6">
                        <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                            <div class="flex-1">
                                <div class="card-title text-slate-900 dark:text-white">{{ __('admin.earning_data') }} </div>
                                <p class="mt-2 text-slate-500" style="font-size: 12px;">{{ __('admin.earning_desc') }}</p>
                            </div>
                        </header>
                        <div class="card">
                            <div class="grid xl:grid-cols-1 grid-cols-1 gap-5">

                                <div class="bg-info-100 rounded-md p-4 bg-opacity-[0.15] dark:bg-opacity-50 text-center">
                                    <canvas id="earningChart" height="400"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>