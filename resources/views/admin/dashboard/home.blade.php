@extends('admin.layout.main')

@section('title') {{ __('admin.dashboard') }} @endsection

@section('content')

<div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
    <div class="page-content">
        <div class="transition-all duration-150 container-fluid" id="page_layout">

            <div class="card p-6">
                <div class="grid xl:grid-cols-4 lg:grid-cols-2 md:grid-cols-2 grid-cols-1 gap-5 place-content-center">

                    <!--Welcome-->
                    <div class="flex space-x-4 h-full items-center rtl:space-x-reverse">
                        <div class="flex-none">
                            <div class="h-20 w-20 rounded-full">
                                <img src="{{ Asset('assets/user.png') }}" alt="" class="w-full h-full">
                            </div>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-xl font-medium mb-2">
                                <span class="block font-light">{{ __('admin.welcome') }}</span>
                                <span class="block">{{ Auth::guard('admin')->user()->name }}</span>
                            </h4>
                            <p class="text-sm dark:text-slate-300">@lang('admin.title')</p>
                        </div>
                    </div>

                    <div class="bg-warning-100 dark:bg-slate-900 rounded-md p-4  dark:bg-opacity-50 text-center">
                        <div class="text-primary-500 mx-auto h-10 w-10 flex flex-col items-center justify-center rounded-full bg-white text-2xl mb-4">
                            <iconify-icon icon=material-symbols:person-check-outline></iconify-icon>
                        </div>
                        <span class="block text-sm text-slate-600 font-medium dark:text-white mb-1">{{ __('admin.total_earning') }}</span>
                        <span class="block mb- text-2xl text-slate-900 dark:text-white font-medium">{{ getSetting()->currency.number_format($total_earning,2) }}</span>
                        <span class="block mb- text-sm text-slate-900 dark:text-white font-medium mt-2">{{ __('admin.today') }} {{ getSetting()->currency.number_format($today_earning,2) }}</span>
                    </div>

                    <div class="bg-primary-100 dark:bg-slate-900 rounded-md p-4  dark:bg-opacity-50 text-center">
                        <div class="text-primary-500 mx-auto h-10 w-10 flex flex-col items-center justify-center rounded-full bg-white text-2xl mb-4">
                            <iconify-icon icon="material-symbols:person-heart"></iconify-icon>
                        </div>
                        <span class="block text-sm text-slate-600 font-medium dark:text-white mb-1">{{ __('admin.total_astrologer') }}</span>
                        <span class="block mb- text-2xl text-slate-900 dark:text-white font-medium">{{ $overview['astro'] }}</span>
                    </div>

                    <div class="bg-success-100 dark:bg-slate-900 rounded-md p-4  dark:bg-opacity-50 text-center">
                        <div class="text-primary-500 mx-auto h-10 w-10 flex flex-col items-center justify-center rounded-full bg-white text-2xl mb-4">
                            <iconify-icon icon="material-symbols:chat-outline-rounded"></iconify-icon>
                        </div>
                        <span class="block text-sm text-slate-600 font-medium dark:text-white mb-1">
                            {{ __('admin.total_chats') }}
                        </span>
                        <span class="block mb- text-2xl text-slate-900 dark:text-white font-medium">
                            <a href="tel:{{ Auth::user()->t_phone }}">{{ $overview['chat'] }}</a>
                        </span>
                    </div>

                </div>
            </div>

            @include('admin.dashboard.chart')

        </div>
    </div>
</div>

@endsection

@section('js')

<script>
    const ctxs = document.getElementById('dealChart').getContext('2d');

    new Chart(ctxs, {
        type: 'line',
        data: {
            labels: @json($months),
            datasets: [{
                data: @json($userChart),
                borderColor: '#4F6EF7',
                backgroundColor: 'rgba(79, 110, 247, 0.15)',
                borderWidth: 3,
                fill: true,
                tension: 0.45, // smooth curve
                pointRadius: 0,
                pointHoverRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    ticks: {
                        stepSize: 8
                    },
                    grid: {
                        borderDash: [6, 6],
                        color: '#e5e7eb'
                    }
                }
            }
        }
    });
</script>

<script>
    const ctxs2 = document.getElementById('earningChart').getContext('2d');

    new Chart(ctxs2, {
        type: 'line',
        data: {
            labels: @json($months),
            datasets: [{
                data: @json($earningChart),
                borderColor: '#4F6EF7',
                backgroundColor: 'rgba(79, 110, 247, 0.15)',
                borderWidth: 3,
                fill: true,
                tension: 0.45,
                pointRadius: 0,
                pointHoverRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: function(context) {
                            return '{{ getSetting()->currency }} ' + context.parsed.y;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    ticks: {
                        stepSize: 8,
                        callback: function(value) {
                            return '{{ getSetting()->currency }} ' + value;
                        }
                    },
                    grid: {
                        borderDash: [6, 6],
                        color: '#e5e7eb'
                    }
                }
            }
        }
    });
</script>

@endsection