@extends('layout.main')

@section('title') {{ __('front.privacy_title') }} @endsection

@section('content')
<div class="bg-gray-50/50 min-h-screen">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-white pt-20 pb-16 lg:pt-24 lg:pb-20">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-[600px] h-[600px] bg-primary/5 rounded-full blur-3xl opacity-50"></div>
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-1.5 mb-6 text-sm font-bold tracking-widest text-primary uppercase bg-primary/10 rounded-full">
                Data Protection
            </span>
            <h1 class="text-4xl lg:text-6xl font-extrabold text-gray-900 tracking-tight mb-6">
                {!! __('front.privacy_policy') !!}
            </h1>
            <p class="max-w-2xl mx-auto text-xl text-gray-500 leading-relaxed font-light">
                {{ __('front.privacy_paramount') }}
            </p>
        </div>
    </div>

    <section class="py-16 pb-24">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-gray-100/50 border border-gray-50 overflow-hidden">
                <div class="p-8 lg:p-12 space-y-12">

                    <!-- 1. Information We Collect -->
                    <div class="relative pl-16 group">
                        <div class="absolute left-0 top-0 w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-primary font-bold text-xl transition-colors group-hover:bg-primary group-hover:text-white">
                            01
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('front.info_collect') }}</h2>
                        <p class="text-lg text-gray-600 leading-relaxed font-light">
                            To provide personalized cosmic insights, we collect personal details such as your name, email address, phone number, and precise birth data (date, time, and location). Payment details are securely handled through encrypted gateways when you engage our services.
                        </p>
                    </div>

                    <!-- 2. How We Use Information -->
                    <div class="relative pl-16 group">
                        <div class="absolute left-0 top-0 w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-primary font-bold text-xl transition-colors group-hover:bg-primary group-hover:text-white">
                            02
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('front.how_use_info') }}</h2>
                        <div class="space-y-4">
                            <p class="text-lg text-gray-600 leading-relaxed font-light">Your data serves your growth by allowing us to:</p>
                            <ul class="space-y-3">
                                <li class="flex items-start gap-3 text-gray-600">
                                    <svg class="w-5 h-5 text-primary mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="font-light">Generate accurate birth charts and personalized consultations.</span>
                                </li>
                                <li class="flex items-start gap-3 text-gray-600">
                                    <svg class="w-5 h-5 text-primary mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="font-light">Process transactions effortlessly within your wallet ecosystem.</span>
                                </li>
                                <li class="flex items-start gap-3 text-gray-600">
                                    <svg class="w-5 h-5 text-primary mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="font-light">Communicate vital updates and provide celestial support.</span>
                                </li>
                                <li class="flex items-start gap-3 text-gray-600">
                                    <svg class="w-5 h-5 text-primary mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="font-light">Uphold the security and integrity of our digital sanctuary.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- 3. Data Security -->
                    <div class="group p-8 bg-primary/5 rounded-[2rem] border border-primary/10">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white font-bold">03</div>
                            <h2 class="text-2xl font-bold text-gray-900">{{ __('front.data_security') }}</h2>
                        </div>
                        <p class="text-lg text-gray-600 leading-relaxed font-light">
                            We implement industry-standard security protocols and encryption to safeguard your data. While we strive to maintain the highest levels of protection, please remember that no digital transmission is entirely immune to the complexities of the internet.
                        </p>
                    </div>

                    <!-- 4. Sharing of Information -->
                    <div class="relative pl-16 group">
                        <div class="absolute left-0 top-0 w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-primary font-bold text-xl transition-colors group-hover:bg-primary group-hover:text-white">
                            04
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('front.sharing_info') }}</h2>
                        <p class="text-lg text-gray-600 leading-relaxed font-light">
                            We treat your data with sanctity. We never sell or rent your personal information. Your details are shared only with trusted partners essential for the fulfillment of our services, under strict confidentiality agreements.
                        </p>
                    </div>

                    <!-- 5. Cookies -->
                    <div class="relative pl-16 group">
                        <div class="absolute left-0 top-0 w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-primary font-bold text-xl transition-colors group-hover:bg-primary group-hover:text-white">
                            05
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('front.cosmic_cookies') }}</h2>
                        <p class="text-lg text-gray-600 leading-relaxed font-light">
                            Our platform uses "cookies" to enhance your experience, remember your preferences, and analyze how our spiritual tools are utilized to continuously refine and improve our offerings.
                        </p>
                    </div>

                    <!-- 6. User Rights -->
                    <div class="relative pl-16 group">
                        <div class="absolute left-0 top-0 w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-primary font-bold text-xl transition-colors group-hover:bg-primary group-hover:text-white">
                            06
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('front.your_rights') }}</h2>
                        <p class="text-lg text-gray-600 leading-relaxed font-light">
                            You hold the sovereign right to access, correct, or request the deletion of your personal data. Simply reach out to our dedicated support team, and we will honor your request in alignment with relevant regulations.
                        </p>
                    </div>

                    <!-- 7. Changes to Policy -->
                    <div class="relative pl-16 group">
                        <div class="absolute left-0 top-0 w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-primary font-bold text-xl transition-colors group-hover:bg-primary group-hover:text-white">
                            07
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('front.changes_policy') }}</h2>
                        <p class="text-lg text-gray-600 leading-relaxed font-light">
                            As our platform evolves, so may our Privacy Policy. Any cosmic updates will be posted here, and we encourage you to check this page periodically to stay informed about how we protecting your aura.
                        </p>
                    </div>

                </div>

                <!-- Footer of Card -->
                <div class="p-8 bg-gray-50 border-t border-gray-100 text-center">
                    <p class="text-gray-500 text-sm">Last updated: January 15, 2026. For privacy concerns, contact <a href="mailto:{{ $setting->contact_email }}" class="text-primary font-bold hover:underline">Data Protection Officer</a>.</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection