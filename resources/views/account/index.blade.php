@extends('layout.main')

@section('title') @lang('front.my_profile')  @endsection

@section('content')
<div class="container mx-auto px-4 py-8">

@if(Session::has('message'))
<div class="mb-8 flex items-center p-4 bg-green-50 border-l-4 border-green-500 rounded-r-2xl shadow-sm animate-pulse">
<svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
</svg>
<p class="text-green-800 font-bold">{{ Session::get('message') }}</p>
</div>
@endif
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">



<div class="md:col-span-1 space-y-6">
<!-- Wallet Balance Card -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
<div class="p-8 text-center">
<h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2"> @lang('front.wallet_balance')</h3>
<div class="text-4xl font-extrabold text-gray-900 mb-6">
<span class="text-gray-400 font-medium">{{ $setting->currency }}</span>{{ number_format($user->wallet,2) }}
</div>
<button type="button" onclick="toggleModal('addBalanceModal')" class="w-full bg-primary hover:opacity-90 text-white font-bold py-3 px-6 rounded-xl transition duration-200 shadow-lg flex items-center justify-center space-x-2">
<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
<path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
</svg>
<span>@lang('front.add_balance')</span>
</button>
</div>
</div>

<!-- Total Spent Card -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center space-x-4 border-l-4 border-l-orange-500">
<div class="bg-orange-50 p-3 rounded-lg text-orange-600">
<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>
</div>
<div>
<h4 class="text-sm font-medium text-gray-500">@lang('front.total_spent')</h4>
<p class="text-lg font-bold text-gray-900">{{ $setting->currency.number_format($spent,2) }}</p>
</div>
</div>
</div>

<!-- Right Column: Transactions -->
<div class="md:col-span-2">
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
<div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
<h5 class="text-lg font-bold text-gray-900">@lang('front.recent')</h5>
</div>

<div class="overflow-x-auto">
<table class="w-full">
<thead class="bg-gray-50 text-left">
<tr>
<th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">@lang('front.t_info')</th>
<th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">@lang('front.type')</th>
<th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">@lang('front.amount')</th>
</tr>
</thead>
<tbody class="divide-y divide-gray-100">
@foreach($trans as $row)

<tr class="hover:bg-gray-50 transition duration-150">
<td class="px-6 py-4 text-sm text-gray-900">
    <div class="font-semibold">{{ $row->notes }}</div>
    <div class="text-xs text-gray-400">{{ $row->created_at->format('d M,Y h:i:A') }}</div>
</td>
<td class="px-6 py-4">
    @if($row->type == 'Credit')
    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
        @lang('front.credit')
    </span>
    @else
    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
        @lang('front.debit')
    </span>
    @endif
</td>
<td class="px-6 py-4 text-right text-sm font-bold @if($row->type == 'Credit') text-green-600 @else text-red-600 @endif">{{ $setting->currency.number_format($row->amount) }}</td>
</tr>

@endforeach


</tbody>
</table>
</div>

<div class="px-6 py-4 bg-gray-50 border-t border-gray-100 text-center">
{!! $trans->links() !!}
</div>
</div>
</div>
</div>


@include('account.add')

@endsection