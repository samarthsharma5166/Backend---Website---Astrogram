@extends('layout.main')

@section('title') {{ __('front.contact_title') }} @endsection

@section('content')
<div class="bg-gray-50/50">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-white pt-20 pb-16 lg:pt-24 lg:pb-20">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-[600px] h-[600px] bg-primary/5 rounded-full blur-3xl opacity-50"></div>
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h1 class="text-4xl lg:text-6xl font-extrabold text-gray-900 tracking-tight mb-6">
                {!! __('front.connected_cosmos') !!}
            </h1>
            <p class="max-w-2xl mx-auto text-xl text-gray-500 leading-relaxed font-light">
                {{ __('front.have_questions') }}
            </p>
        </div>
    </div>

    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-12 items-start">

                <!-- Contact Info & Channels -->
                <div class="lg:col-span-1 space-y-8">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ __('front.direct_channels') }}</h2>
                        <div class="space-y-4">
                            <!-- WhatsApp -->
                            <a href="https://wa.me/{{ $setting->whatsapp }}" target="_blank" class="group flex items-center p-4 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300">
                                <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center mr-4 group-hover:bg-green-500 transition-colors">
                                    <svg class="w-6 h-6 text-green-600 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412 0 6.556-5.338 11.892-11.893 11.892-1.997-.001-3.951-.499-5.688-1.447l-6.309 1.656zm6.224-3.629l.363.216c1.551.921 3.321 1.408 5.129 1.408 5.61 0 10.176-4.566 10.176-10.176 0-2.719-1.059-5.275-2.982-7.199-1.924-1.923-4.48-2.983-7.199-2.983-5.611 0-10.177 4.567-10.177 10.177 0 1.796.474 3.549 1.371 5.074l.237.319-1.11 4.053 4.14-1.086zm10.704-5.285c-.259-.13-.1.173-1.532-.882-.259-.13-.449-.195-.634.082-.185.277-.714.898-.874 1.082-.161.185-.321.208-.58.077-.251-.122-1.06-.39-2.019-1.246-.745-.664-1.248-1.485-1.394-1.742-.146-.258-.016-.398.114-.527.116-.116.259-.302.388-.452.129-.15.172-.252.259-.42.086-.168.043-.314-.022-.444-.065-.13-.634-1.53-.874-2.106-.233-.561-.47-.485-.634-.493-.161-.008-.346-.01-.529-.01-.184 0-.485.069-.738.347-.254.277-.965.943-.965 2.301 0 1.357.99 2.668 1.13 2.852.138.184 1.948 2.974 4.72 4.169.66.284 1.173.454 1.574.582.663.211 1.267.181 1.745.109.533-.081 1.642-.671 1.872-1.32.23-.648.23-1.203.161-1.32-.069-.117-.254-.185-.514-.314z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">WhatsApp</div>
                                    <div class="text-lg font-bold text-gray-900">{{ $setting->whatsapp }}</div>
                                </div>
                            </a>

                            <!-- Email -->
                            <a href="mailto:{{ $setting->contact_email }}" class="group flex items-center p-4 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300">
                                <div class="w-12 h-12 bg-primary/5 rounded-xl flex items-center justify-center mr-4 group-hover:bg-primary transition-colors">
                                    <svg class="w-6 h-6 text-primary group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">{{ __('front.email_us') }}</div>
                                    <div class="text-lg font-bold text-gray-900">{{ $setting->contact_email }}</div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="p-8 bg-gray-900 rounded-[2rem] text-white overflow-hidden relative">
                        <div class="relative z-10">
                            <h3 class="text-xl font-bold mb-4">Our Commitment</h3>
                            <p class="text-gray-400 font-light leading-relaxed">
                                We aim to respond to all inquiries within 24 cosmic hours. Your privacy and spiritual journey are our top priority.
                            </p>
                        </div>
                        <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-primary/20 rounded-full blur-2xl"></div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-2 bg-white rounded-[2.5rem] shadow-xl shadow-gray-100 p-8 lg:p-12 border border-gray-50">

                    @if(Session::has('message'))
                    <div class="mb-8 flex items-center p-4 bg-green-50 border-l-4 border-green-500 rounded-r-2xl shadow-sm animate-pulse">
                        <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-green-800 font-bold">{{ Session::get('message') }}</p>
                    </div>
                    @endif



                    <h2 class="text-3xl font-bold text-gray-900 mb-8">{{ __('front.send_message') }}</h2>

                    <form action="{{ url('contact') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('front.full_name') }}</label>
                                <input type="text" name="name" required placeholder="John Doe"
                                    class="w-full px-5 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary text-gray-900 transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('front.mobile_number') }}</label>
                                <input type="tel" name="phone" required placeholder="+1 234 567 890"
                                    class="w-full px-5 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary text-gray-900 transition-all">
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('front.subject') }}</label>
                                <input type="text" name="subject" required placeholder="How can we help?"
                                    class="w-full px-5 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary text-gray-900 transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('front.category') }}</label>
                                <select name="category" required class="w-full px-5 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary text-gray-900 transition-all appearance-none cursor-pointer">
                                    <option value="General Inquiry">General Inquiry</option>
                                    <option value="Billing Support">Billing Support</option>
                                    <option value="Technical Issue">Technical Issue</option>
                                    <option value="Astrologer Partnership">Astrologer Partnership</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">{{ __('front.message') }}</label>
                            <textarea name="message" rows="5" required placeholder="Type your message here..."
                                class="w-full px-5 py-4 bg-gray-50 border-0 rounded-2xl focus:ring-2 focus:ring-primary text-gray-900 transition-all"></textarea>
                        </div>

                        <button type="submit" class="w-full lg:w-auto px-12 py-5 bg-primary text-white font-bold rounded-2xl shadow-lg shadow-primary/20 hover:scale-[1.02] transition active:scale-95 flex items-center justify-center gap-3">
                            <span>{{ __('front.relay_message') }}</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">{{ __('front.faq') }}</h2>
                <div class="w-20 h-1 bg-primary mx-auto rounded-full"></div>
            </div>

            <div class="space-y-4">
                @php
                $faqData = $setting->faq;
                if (is_string($faqData)) {
                $faqData = json_decode($faqData);
                }
                @endphp
                @foreach($faqData as $faq)
                <div class="faq-item group bg-gray-50 rounded-3xl border border-transparent hover:border-primary/10 transition-all duration-300 overflow-hidden">
                    <button class="faq-toggle w-full px-8 py-6 flex items-center justify-between text-left focus:outline-none">
                        <span class="text-lg font-bold text-gray-800">{{ $faq->question ?? $faq->title ?? $faq['question'] ?? $faq['title'] ?? '' }}</span>
                        <div class="faq-icon-wrapper w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm group-hover:bg-primary transition-colors">
                            <svg class="w-4 h-4 text-gray-500 group-hover:text-white transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>
                    <div class="faq-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                        <div class="px-8 pb-8 text-gray-600 leading-relaxed font-light">
                            {!! nl2br(e($faq->answer ?? $faq->description ?? $faq['answer'] ?? $faq['description'] ?? '')) !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

<script>
    document.querySelectorAll('.faq-toggle').forEach(button => {
        button.addEventListener('click', () => {
            const currentItem = button.parentElement;
            const content = button.nextElementSibling;
            const icon = button.querySelector('svg');

            // Toggle active state
            const isOpen = currentItem.classList.contains('faq-open');

            // Close all others
            document.querySelectorAll('.faq-item').forEach(item => {
                item.classList.remove('faq-open');
                item.querySelector('.faq-content').style.maxHeight = null;
                item.querySelector('svg').style.transform = 'rotate(0deg)';
                item.classList.add('bg-gray-50');
                item.classList.remove('bg-white', 'shadow-xl', 'shadow-gray-100');
            });

            if (!isOpen) {
                currentItem.classList.add('faq-open');
                currentItem.classList.remove('bg-gray-50');
                currentItem.classList.add('bg-white', 'shadow-xl', 'shadow-gray-100');
                content.style.maxHeight = content.scrollHeight + "px";
                icon.style.transform = 'rotate(180deg)';
            }
        });
    });
</script>
@endsection