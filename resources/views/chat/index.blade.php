<!DOCTYPE html>
<html lang="en" class="light">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>@lang('front.live_astro_chat')</title>

<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@400;600;700&display=swap" rel="stylesheet">

<script>
tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary: "#ff7024",
            }
        }
    }
}
</script>

<style>
body { font-family: 'Epilogue', sans-serif; }
.no-scrollbar::-webkit-scrollbar { display: none; }
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
</head>

<body class="bg-slate-100 h-screen flex flex-col">




<!-- ================= ASTROLOGER HEADER ================= -->
<div class="bg-white border-b shadow-sm h-16 flex items-center">
    <div class="max-w-5xl mx-auto w-full px-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <a href="#" onclick="history.back()" class="text-gray-900 flex items-center gap-2 hover:text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <img src="{{ Asset('upload/astrologer/'.$astro->img) }}" class="w-10 h-10 rounded-full object-cover">
            <div>
                <h2 class="font-bold text-slate-800">{{ $astro->name }}</h2>
                <span class="text-xs font-semibold text-green-500">Active now</span>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <div class="bg-green-50 px-3 py-1 rounded-md text-center">
                <span class="text-[10px] font-bold text-slate-400 uppercase">@lang('front.wallet')</span>
                <div class="text-green-600 font-bold text-sm" id="userWalletBalance">{{ $setting->currency }}{{ number_format(auth()->user()->wallet, 2) }}</div>
            </div>
            <div class="bg-orange-50 px-3 py-1 rounded-md text-center">
                <span class="text-[10px] font-bold text-slate-400 uppercase">@lang('front.session')</span>
                <div class="text-primary font-bold text-sm" id="sessionTimer">00:00</div>
            </div>
            <a id="endChatBtn" href="#" class="text-red-500 hover:text-red-600 hidden text-xl" title="End chat">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M6 18L18 6" />
                </svg>
            </a>
        </div>
    </div>
</div>

<!-- ================= CHAT SCROLL AREA ================= -->
<main id="messageContainer" class="flex-1 overflow-y-auto px-4 py-6">
    <div id="chatHistory" class="max-w-5xl mx-auto flex flex-col gap-4">
        <!-- EMPTY -->
    </div>
</main>

<!-- ================= FIXED FOOTER ================= -->
<footer class="bg-white border-t p-4">

    <!-- TOPIC SELECT -->
    <div id="topicSection" class="max-w-5xl mx-auto mb-4">
        <p class="text-sm font-semibold text-slate-600 mb-3">
            @lang('front.choose_topic')
        </p>

        <div class="overflow-x-auto ">
            <div class="flex flex-nowrap gap-3 pb-2">
                @foreach (['General Life','Career','Love','Marriage','Health','Finance','Education','Business','Travel'] as $topic)
                    <button
                        class="topicBtn bg-primary/10 text-primary py-2.5 px-6 rounded-full font-semibold hover:bg-primary hover:text-white transition flex-shrink-0 border border-primary/20 shadow-sm whitespace-nowrap"
                        data-topic="{{ $topic }}" style="font-size: 13px;">
                        @lang('front.want_ask_about') {{ $topic }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- CHAT INPUT -->
    <div id="chatInputBox" class="max-w-5xl mx-auto flex items-center gap-3 hidden">
        <input
            id="chatInput"
            type="text"
            class="flex-1 border rounded-full px-5 py-3 focus:outline-none"
            placeholder="Type your message..."
        >
        <button id="sendBtn" class="bg-primary text-white px-5 py-3 rounded-full">
             @lang('front.send')
        </button>
    </div>

</footer>

@include('chat.js')

</body>
</html>
