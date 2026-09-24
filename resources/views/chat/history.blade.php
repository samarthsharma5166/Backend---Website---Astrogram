@extends('layout.main')

@section('title') @lang('front.chat_history') @endsection

@section('content')

<div class="bg-slate-50 min-h-screen py-8">
<div class="max-w-5xl mx-auto px-4">

<div class="flex items-center gap-4 mb-8">
<button onclick="history.back()" class="bg-white p-2 rounded-lg shadow-sm text-slate-400 hover:text-primary transition border">
<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
</svg>
</button>
<h1 class="text-2xl font-bold text-slate-800">@lang('front.chat_history')</h1>
</div>

@if(Session::has('message'))
<div class="mb-8 flex items-center p-4 bg-green-50 border-l-4 border-green-500 rounded-r-2xl shadow-sm animate-pulse">
	<svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
		<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
	</svg>
	<p class="text-green-800 font-bold">{{ Session::get('message') }}</p>
</div>
@endif

<div class="space-y-4">
@if(isset($data) && count($data))
@foreach($data as $row)
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 hover:shadow-md transition group">
<div class="flex flex-col md:flex-row md:items-center gap-5">

<!-- Astro Identity -->
<div class="flex items-center gap-4 min-w-[220px]">
<div class="relative">
<img src="{{ Asset('upload/astrologer/'.$row->img) }}" class="w-14 h-14 rounded-full object-cover border-2 border-primary/20">
<span class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-green-500 border-2 border-white rounded-full"></span>
</div>
<div>
<h3 class="font-bold text-slate-800 group-hover:text-primary transition line-clamp-1">{{ $row->astro_name }}</h3>
<span class="text-xs font-semibold text-slate-400">@lang('front.session') {{ $row->secToMin($row->total_seconds) }} min</span>
</div>
</div>

<!-- Session Info Info -->
<div class="flex-1 grid grid-cols-2 lg:grid-cols-3 gap-6">
<div>
<p class="text-[10px] uppercase font-bold text-slate-400 mb-1 tracking-wider">@lang('front.date_time')</p>
<p class="text-sm font-semibold text-slate-700">{{ $row->created_at->format("d M, Y h:i:A") }}</p>
</div>
<div>
<p class="text-[10px] uppercase font-bold text-slate-400 mb-1 tracking-wider">@lang('front.status')</p>
@if($row->status == "active")
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-green-50 text-green-700 border border-green-100 uppercase">
@lang('front.active')
</span>
@else
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-red-50 text-red-700 border border-green-100 uppercase">
@lang('front.ended')
</span>
@endif
</div>
<div class="col-span-2 lg:col-span-1">
<p class="text-[10px] uppercase font-bold text-slate-400 mb-1 tracking-wider">@lang('front.topic_summary')</p>
<p class="text-sm text-slate-600 line-clamp-1 italic">{{ $row->summary }}</p>
</div>
</div>

<!-- Action Button -->
<div class="flex items-center justify-end">
<a href="{{ Asset('chat/'.$row->astrologer_id.'?session_id='.$row->id) }}" class="inline-flex items-center gap-2 bg-primary/10 text-primary px-6 py-3 rounded-xl font-bold hover:bg-primary hover:text-white transition whitespace-nowrap shadow-sm">
@lang('front.view_history')
<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
</svg>
</a>
</div>

 </div>
 </div>
@endforeach
@else
<div class="text-center py-20">
	<div class="bg-white w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm border border-slate-100 text-slate-200">
		<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.827-1.233L3 20l1.341-3.99A4.644 4.644 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
		</svg>
	</div>
	<h3 class="text-xl font-bold text-slate-800">@lang('front.no_data')</h3>
	<p class="text-slate-500 mt-2">@lang('front.start_chat_history')</p>
	<a href="{{ Asset('index') }}" class="mt-8 inline-block bg-primary text-white px-10 py-4 rounded-2xl font-bold shadow-lg shadow-primary/30 hover:-translate-y-1 transition duration-200">Start Chat</a>
 </div>
@endif

</div>

</div>
</div>

@endsection