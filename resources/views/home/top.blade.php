<section class="relative mb-16">
<div class="relative overflow-hidden rounded-3xl min-h-[520px] flex items-center justify-center p-8 hero-gradient" data-alt="Mystical space background with subtle nebula clouds" style="background-image: url('{{ Asset('upload/home.png') }}'); background-size: cover; background-position: center;">
<div class="absolute inset-0 bg-nebula-indigo/40 mix-blend-multiply"></div>
<div class="relative z-10 max-w-2xl text-center space-y-8">
<div class="space-y-4">
<span class="inline-block px-4 py-1.5 bg-primary/20 text-primary rounded-full text-xs font-black uppercase tracking-widest border border-primary/30">@lang('front.hero_subtitle')</span>
<h2 class="text-5xl md:text-7xl font-black text-white leading-tight">@lang('front.hero_title') <br/>@lang('front.of_fate')</h2>
<p class="text-lg text-white/80 font-medium">@lang('front.hero_desc')</p>
</div>
<div class="flex flex-col sm:flex-row gap-2 bg-white/10 backdrop-blur-xl p-2 rounded-2xl border border-white/20">
<div class="flex-1 flex items-center px-4 gap-3 text-white">
<span class="material-symbols-outlined opacity-60">search_spark</span>
<input class="bg-transparent border-none focus:ring-0 text-white placeholder:text-white/50 w-full text-lg py-4" placeholder="Ask the universe a specific question..." type="text" readonly/>
</div>
<a class="bg-primary hover:bg-primary/90 text-white px-10 py-4 rounded-xl font-bold text-lg transition-all" href="#startChat">
                           @lang('front.start_chat')
</a>
</div>
<div class="flex justify-center gap-6 text-white/60 text-sm font-bold uppercase tracking-widest">
<div class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> @lang('front.readings_count')</div>
<div class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> @lang('front.experts_247')</div>
<div class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> @lang('front.ai_powered')</div>
</div>
</div>
</div>
</section>