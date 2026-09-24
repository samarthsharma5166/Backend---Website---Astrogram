@extends('layout.main')

@section('title') {{ __('front.about_title') }} @endsection

@section('content')
<div class="bg-gray-50/50">
    <!-- Hero Section with Abstract Background -->
    <div class="relative overflow-hidden bg-white pt-20 pb-16 lg:pt-32 lg:pb-24">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-[600px] h-[600px] bg-primary/5 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-[400px] h-[400px] bg-orange-100 rounded-full blur-3xl opacity-30"></div>

        <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center">
                <span class="inline-block px-4 py-1.5 mb-6 text-sm font-bold tracking-widest text-primary uppercase bg-primary/10 rounded-full">
                    Est. 2024
                </span>
                <h1 class="text-5xl lg:text-7xl font-extrabold text-gray-900 tracking-tight mb-8">
                    {!! __('front.guided_stars') !!}
                </h1>
                <p class="max-w-2xl mx-auto text-xl text-gray-500 leading-relaxed font-light">
                    {{ __('front.bridge_gap') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Our Story Section -->
    <section class="py-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="relative">
                    <div class="absolute -top-4 -left-4 w-24 h-24 bg-primary/20 rounded-full blur-2xl"></div>
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl transition hover:scale-[1.01] duration-500">
                        <img src="{{ Asset('upload/about.jpeg') }}" alt="About Us" class="w-full h-auto object-cover">
                    </div>
                </div>

                <div class="space-y-8">
                    <h2 class="text-4xl font-bold text-gray-900 leading-tight">
                        A modern approach to <br>astrological insights
                    </h2>
                    <div class="space-y-6 text-lg text-gray-600 leading-relaxed">
                        <p>
                            At our core, we believe that astrology is more than just predictions—it's a tool for self-discovery and conscious decision-making. Our platform was born from a desire to make deep astrological insights accessible to everyone, everywhere.
                        </p>
                        <p>
                            By combining high-precision algorithms with verified astrological datasets, we ensure that every chart, every prediction, and every match is delivered with unparalleled accuracy and meaningful context.
                        </p>
                    </div>

                    <div class="flex items-center gap-6 pt-4">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary">50k+</div>
                            <div class="text-sm text-gray-500 font-medium uppercase tracking-wider">Reports</div>
                        </div>
                        <div class="h-12 w-px bg-gray-200"></div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary">99.9%</div>
                            <div class="text-sm text-gray-500 font-medium uppercase tracking-wider">Accuracy</div>
                        </div>
                        <div class="h-12 w-px bg-gray-200"></div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary">24/7</div>
                            <div class="text-sm text-gray-500 font-medium uppercase tracking-wider">Support</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision Cards -->
    <section class="py-24 bg-white/50 backdrop-blur-sm border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-10">
                <div class="group p-10 bg-white rounded-[2rem] shadow-xl shadow-gray-100/50 border border-gray-50 hover:border-primary/20 transition-all duration-300">
                    <div class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-primary transition-colors">
                        <svg class="w-7 h-7 text-primary group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('front.our_mission') }}</h3>
                    <p class="text-lg text-gray-600 leading-relaxed font-light">
                        To empower individuals with data-driven cosmic perspectives, enabling them to navigate their life's journey with confidence, clarity, and purpose.
                    </p>
                </div>

                <div class="group p-10 bg-white rounded-[2rem] shadow-xl shadow-gray-100/50 border border-gray-50 hover:border-primary/20 transition-all duration-300">
                    <div class="w-14 h-14 bg-orange-100 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-primary transition-colors">
                        <svg class="w-7 h-7 text-primary group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('front.our_vision') }}</h3>
                    <p class="text-lg text-gray-600 leading-relaxed font-light">
                        To build the world's most trusted digital ecosystem for astrological services, fostering a global community that lives in harmony with universal rhythms.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values with Floating Icons -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">{{ __('front.our_values_guide') }}</h2>
                <div class="w-20 h-1 bg-primary mx-auto rounded-full"></div>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                $values = [
                ['Trust', 'Building long-term cosmic relationships through radical transparency.', 'shield-check'],
                ['Innovation', 'Merging traditional systems with cutting-edge cloud computing.', 'light-bulb'],
                ['Quality', 'Excellence in every planetary calculation and user interaction.', 'sparkles'],
                ['User First', 'Designed for the curious seeker, prioritized for your growth.', 'user-group']
                ];
                @endphp

                @foreach($values as $value)
                <div class="relative bg-white p-8 rounded-3xl shadow-sm hover:shadow-xl hover:shadow-primary/5 transition-all duration-500 group border border-gray-100/50">
                    <h4 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors">{{ $value[0] }}</h4>
                    <p class="text-gray-500 leading-relaxed font-light">
                        {{ $value[1] }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="relative py-20 px-6 overflow-hidden">
        <div class="max-w-5xl mx-auto rounded-[3rem] bg-gray-900 p-12 lg:p-20 text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-primary/20 rounded-full blur-3xl -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary/10 rounded-full blur-3xl -ml-32 -mb-32"></div>

            <h2 class="text-3xl lg:text-5xl font-bold text-white mb-8 relative">{{ __('front.ready_discover') }}</h2>
            <div class="flex flex-wrap justify-center gap-4 relative">
                <a href="{{ url('kundali') }}" class="px-10 py-4 bg-primary text-white font-bold rounded-full hover:scale-105 transition active:scale-95 shadow-lg shadow-primary/20">
                    {{ __('front.generate_kundali') }}
                </a>
                <a href="{{ url('index#startChat') }}" class="px-10 py-4 bg-white/10 text-white font-bold rounded-full hover:bg-white/20 transition backdrop-blur-md">
                    {{ __('front.talk_expert') }}
                </a>
            </div>
        </div>
    </section>
</div>
@endsection