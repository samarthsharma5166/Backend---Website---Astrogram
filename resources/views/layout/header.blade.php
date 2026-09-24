<header class="sticky top-0 z-50 bg-white/80 dark:bg-background-dark/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-800">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center text-white">
                <span class="material-symbols-outlined text-2xl">auto_awesome</span>
            </div>
            <a href="{{ Asset('index') }}">
                <h1 class="text-2xl font-black tracking-tight text-nebula-indigo dark:text-white uppercase">{{ __('front.app_title') }}</h1>
            </a>

        </div>
        <nav class="hidden md:flex items-center gap-10">
            <a class="text-sm font-bold hover:text-primary transition-colors uppercase tracking-wider" href="{{ Asset('index') }}">{{ __('front.home') }}</a>
            <div class="relative group">
                <a class="text-sm font-bold hover:text-primary transition-colors uppercase tracking-wider flex items-center gap-1" href="#">
                    {{ __('front.services') }}
                    <span class="material-symbols-outlined text-lg">expand_more</span>
                </a>
                <div class="absolute top-full left-0 pt-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                    <div class="w-48 bg-white dark:bg-background-dark border border-gray-200 dark:border-gray-800 rounded-xl shadow-2xl py-2 overflow-hidden">
                        <a @if(Request::segment(1)=='index' ) href="#startChat" @else href="{{ Asset('index#startChat') }}" @endif class="block px-4 py-2.5 text-[12px] font-bold hover:text-primary hover:bg-gray-50 dark:hover:bg-white/5 transition-colors uppercase tracking-widest">{{ __('front.ask_astrologer') }}</a>
                        <a href="{{ Asset('kundali') }}" class="block px-4 py-2.5 text-[12px] font-bold hover:text-primary hover:bg-gray-50 dark:hover:bg-white/5 transition-colors uppercase tracking-widest">{{ __('front.make_kundali') }}</a>
                        <a href="{{ Asset('predication') }}" class="block px-4 py-2.5 text-[12px] font-bold hover:text-primary hover:bg-gray-50 dark:hover:bg-white/5 transition-colors uppercase tracking-widest">{{ __('front.predictions') }}</a>

                        <a href="{{ Asset('horoscope') }}" class="block px-4 py-2.5 text-[12px] font-bold hover:text-primary hover:bg-gray-50 dark:hover:bg-white/5 transition-colors uppercase tracking-widest">{{ __('front.horoscope') }}</a>
                        <a href="{{ Asset('match') }}" class="block px-4 py-2.5 text-[12px] font-bold hover:text-primary hover:bg-gray-50 dark:hover:bg-white/5 transition-colors uppercase tracking-widest">{{ __('front.match_making') }}</a>

                        <a href="{{ Asset('baby') }}" class="block px-4 py-2.5 text-[12px] font-bold hover:text-primary hover:bg-gray-50 dark:hover:bg-white/5 transition-colors uppercase tracking-widest">{{ __('front.baby_name') }}</a>
                    </div>
                </div>
            </div>
            <a class="text-sm font-bold hover:text-primary transition-colors uppercase tracking-wider" href="{{ Asset('about') }}">{{ __('front.about_us') }}</a>
            <a class="text-sm font-bold hover:text-primary transition-colors uppercase tracking-wider" href="{{ Asset('contact') }}">{{ __('front.contact_us') }}</a>
            <a class="text-sm font-bold hover:text-primary transition-colors uppercase tracking-wider" @if(Request::segment(1)=='index' ) href="#mobileApp" @else href="{{ Asset('index#mobileApp') }} @endif">{{ __('front.mobile_app') }}</a>
        </nav>
        <div class="flex items-center gap-4">
            <a href="#startChat" class="bg-primary text-white px-6 py-2.5 rounded-lg text-sm font-bold uppercase tracking-wider hover:brightness-110 transition-all celestial-glow">
                {{ __('front.start_chat') }}
            </a>

            @if(Auth::check())
            <div class="relative group flex items-center gap-2">
                <span class="hidden sm:inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-extrabold bg-primary/10 text-primary border border-primary/20">
                    <span class="opacity-80">{{ getSetting()->currency }}</span>
                    <span>{{ number_format(Auth::user()->wallet ?? 0, 2) }}</span>
                </span>
                <button class="w-10 h-10 rounded-full bg-gray-100 border-2 border-primary/20 flex items-center justify-center text-slate-600 hover:bg-gray-200" aria-haspopup="true" aria-expanded="false">
                    <span class="material-symbols-outlined text-xl">account_circle</span>
                </button>
                <div class="absolute right-0 top-full pt-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                    <div class="w-56 bg-white dark:bg-background-dark border border-gray-200 dark:border-gray-800 rounded-xl shadow-2xl overflow-hidden">
                        <div class="p-4 border-b border-gray-200 dark:border-gray-800">
                            <p class="text-[10px] uppercase font-bold text-slate-400 tracking-widest">{{ __('front.wallet') }}</p>
                            <p class="mt-1 text-sm font-extrabold text-slate-800 dark:text-white">{{ getSetting()->currency }} {{ number_format(Auth::user()->wallet ?? 0, 2) }}</p>
                        </div>
                        <div class="py-2">
                            <a href="{{ Asset('account') }}" class="block px-4 py-2.5 text-[12px] font-bold hover:text-primary hover:bg-gray-50 dark:hover:bg-white/5 transition-colors uppercase tracking-widest">{{ __('front.my_profile') }}</a>
                            <a href="{{ Asset('info') }}" class="block px-4 py-2.5 text-[12px] font-bold hover:text-primary hover:bg-gray-50 dark:hover:bg-white/5 transition-colors uppercase tracking-widest">{{ __('front.birth_chart') }}</a>
                            <a href="{{ Asset('history') }}" class="block px-4 py-2.5 text-[12px] font-bold hover:text-primary hover:bg-gray-50 dark:hover:bg-white/5 transition-colors uppercase tracking-widest">{{ __('front.chat_history') }}</a>

                            <a href="{{ Asset('logout') }}" class="block px-4 py-2.5 text-[12px] font-bold hover:text-primary hover:bg-gray-50 dark:hover:bg-white/5 transition-colors uppercase tracking-widest">{{ __('front.logout') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <a href="javascript::void()" onclick="openLoginModal()" class="bg-gray-900 text-white px-5 py-2.5 rounded-lg text-sm font-bold uppercase tracking-wider hover:brightness-110 transition-all">{{ __('front.login_button') }}</a>
            @endif
        </div>
    </div>
</header>`