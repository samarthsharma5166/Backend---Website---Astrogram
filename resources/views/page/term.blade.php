@extends('layout.main')

@section('title') {{ __('front.terms_title') }} @endsection

@section('content')
<div class="bg-gray-50/50 min-h-screen">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-white pt-20 pb-16 lg:pt-24 lg:pb-20">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-[600px] h-[600px] bg-primary/5 rounded-full blur-3xl opacity-50"></div>
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-1.5 mb-6 text-sm font-bold tracking-widest text-primary uppercase bg-primary/10 rounded-full">
                Legal Framework
            </span>
            <h1 class="text-4xl lg:text-6xl font-extrabold text-gray-900 tracking-tight mb-6">
                {!! __('front.terms_conditions') !!}
            </h1>
            <p class="max-w-2xl mx-auto text-xl text-gray-500 leading-relaxed font-light">
                Our commitment to transparency and mutual respect. Please read these guidelines carefully as they govern your cosmic journey with us.
            </p>
        </div>
    </div>

    <section class="py-16 pb-24">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-gray-100/50 border border-gray-50 overflow-hidden">
                <div class="p-8 lg:p-12 space-y-12">

                    <!-- 1. Acceptance -->
                    <div class="relative pl-16 group">
                        <div class="absolute left-0 top-0 w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-primary font-bold text-xl transition-colors group-hover:bg-primary group-hover:text-white">
                            01
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('front.acceptance_terms') }}</h2>
                        <p class="text-lg text-gray-600 leading-relaxed font-light">
                            By accessing or using our website, mobile application, or services, you implicitly agree to be bound by these Terms & Conditions. This constitutes a legally binding agreement. If you do not align with these terms, we respectfully ask that you refrain from using our platform.
                        </p>
                    </div>

                    <!-- 2. Services -->
                    <div class="relative pl-16 group">
                        <div class="absolute left-0 top-0 w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-primary font-bold text-xl transition-colors group-hover:bg-primary group-hover:text-white">
                            02
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('front.service_description') }}</h2>
                        <p class="text-lg text-gray-600 leading-relaxed font-light">
                            We provide digital astrological services, including but not limited to consultations, personalized reports, AI-driven insights, and educational content. Please note that all services are intended for entertainment and personal guidance purposes only.
                        </p>
                    </div>

                    <!-- 3. User Responsibilities -->
                    <div class="relative pl-16 group">
                        <div class="absolute left-0 top-0 w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-primary font-bold text-xl transition-colors group-hover:bg-primary group-hover:text-white">
                            03
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('front.portal_responsibilities') }}</h2>
                        <div class="space-y-4">
                            <p class="text-lg text-gray-600 leading-relaxed font-light">As a seeker on our platform, you agree to:</p>
                            <ul class="space-y-3">
                                <li class="flex items-start gap-3 text-gray-600">
                                    <svg class="w-5 h-5 text-primary mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="font-light">Provide accurate, current, and complete birth data.</span>
                                </li>
                                <li class="flex items-start gap-3 text-gray-600">
                                    <svg class="w-5 h-5 text-primary mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="font-light">Maintain the sacred confidentiality of your account credentials.</span>
                                </li>
                                <li class="flex items-start gap-3 text-gray-600">
                                    <svg class="w-5 h-5 text-primary mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="font-light">Refrain from any activities that could harm or misuse the digital ecosystem.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- 4. Payments -->
                    <div class="group p-8 bg-primary/5 rounded-[2rem] border border-primary/10">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white font-bold">04</div>
                            <h2 class="text-2xl font-bold text-gray-900">{{ __('front.payments_refunds') }}</h2>
                        </div>
                        <p class="text-lg text-gray-600 leading-relaxed font-light">
                            All energetic exchanges (payments) made on the platform are final. Our refund policy is strictly enforced. Any refund requests are subject to internal audit and are processed at the sole discretion of our administration team to maintain platform integrity.
                        </p>
                    </div>

                    <!-- 5. Disclaimer -->
                    <div class="relative pl-16 group">
                        <div class="absolute left-0 top-0 w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-primary font-bold text-xl transition-colors group-hover:bg-primary group-hover:text-white">
                            05
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('front.professional_disclaimer') }}</h2>
                        <p class="text-lg text-gray-600 leading-relaxed font-light italic">
                            "The stars impel, they do not compel."
                        </p>
                        <p class="text-lg text-gray-600 leading-relaxed font-light mt-4">
                            Our insights, whether delivered by AI or experts, are not a substitute for professional legal, medical, or financial advice. We do not guarantee specific life outcomes based on planetary alignments.
                        </p>
                    </div>

                    <!-- 6. Liability -->
                    <div class="relative pl-16 group">
                        <div class="absolute left-0 top-0 w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-primary font-bold text-xl transition-colors group-hover:bg-primary group-hover:text-white">
                            06
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('front.limitation_liability') }}</h2>
                        <p class="text-lg text-gray-600 leading-relaxed font-light">
                            Within the fullest extent permitted by law, we shall not be held liable for any direct, indirect, or consequential impacts arising from your interpretation or use of the cosmic data provided through our services.
                        </p>
                    </div>

                    <!-- 7. Termination -->
                    <div class="relative pl-16 group">
                        <div class="absolute left-0 top-0 w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-primary font-bold text-xl transition-colors group-hover:bg-primary group-hover:text-white">
                            07
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('front.account_termination') }}</h2>
                        <p class="text-lg text-gray-600 leading-relaxed font-light">
                            We reserve the right to gracefully sunset your access to our services, without prior notice, if these established terms are violated or if platform harmony is compromised.
                        </p>
                    </div>

                    <!-- 8. Changes -->
                    <div class="relative pl-16 group">
                        <div class="absolute left-0 top-0 w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-primary font-bold text-xl transition-colors group-hover:bg-primary group-hover:text-white">
                            08
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ __('front.evolution_terms') }}</h2>
                        <p class="text-lg text-gray-600 leading-relaxed font-light">
                            Just as the planets are in constant motion, these terms may be updated to reflect our platform's evolution. Your continued use of the platform following updates constitutes acceptance of the new celestial guidelines.
                        </p>
                    </div>

                </div>

                <!-- Footer of Card -->
                <div class="p-8 bg-gray-50 border-t border-gray-100 text-center">
                    <p class="text-gray-500 text-sm">Last updated: January 15, 2026. For inquiries, contact <a href="mailto:{{ getSetting()->contact_email }}" class="text-primary font-bold hover:underline">Legal Support</a>.</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection