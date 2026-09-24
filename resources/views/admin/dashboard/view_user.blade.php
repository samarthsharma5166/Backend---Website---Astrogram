@extends('admin.layout.main')

@section('title') View User Details - {{ $user->name }} @endsection

@section('content')

<style>
hr
{
padding: 5px 5px;
}
</style>

<div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
<div class="page-content">
<div class="transition-all duration-150 container-fluid" id="page_layout">
<div id="content_layout">


<div class="flex justify-between flex-wrap items-center mb-6">
<h2 class="font-medium lg:text-2xl text-xl capitalize text-slate-900 inline-block ltr:pr-4 rtl:pl-4 mb-1 sm:mb-0">View User Details - {{ $user->name }}</h2>
<div class="flex sm:space-x-4 space-x-2 sm:justify-end items-center rtl:space-x-reverse">
<a class="btn inline-flex justify-center btn-primary text-slate-700 dark:bg-slate-700 !font-normal dark:text-white btn-sm" href="{{ url()->previous() }}">
<span class="flex items-center">
<iconify-icon class="text-xl ltr:mr-2 rtl:ml-2 font-light" icon="material-symbols:arrow-back-ios-new"></iconify-icon>
<span>Go Back</span>
</span>
</a>

</div>
</div>

<div class="grid xl:grid-cols-2 grid-cols-1 gap-5">

{{-- User Info --}}
<div class="card">
<div class="card-body px-6 pb-6">
<h4 class="text-lg font-semibold mb-4 py-4">User Details</h4>

<div class="space-y-3 text-sm">

<div class="flex justify-between">
<span class="text-slate-500">User ID</span>
<span class="font-medium">#{{ $user->id }}</span>
</div>
<hr>

<div class="flex justify-between">
<span class="text-slate-500">Name</span>
<span class="font-medium">{{ $user->name }}</span>
</div>
<hr>

<div class="flex justify-between">
<span class="text-slate-500">Phone</span>
<span class="font-medium">{{ $user->country }} {{ $user->phone }}</span>
</div>
<hr>

<div class="flex justify-between">
<span class="text-slate-500">Email</span>
<span class="font-medium">{{ $user->email }}</span>
</div>
<hr>

<div class="flex justify-between">
<span class="text-slate-500">Wallet Balance</span>
<span class="font-medium text-primary-500">{{ $setting->currency.number_format($user->wallet,2) }}</span>
</div>
<hr>

<div class="flex justify-between">
<span class="text-slate-500">Status</span>
<span class="px-2 py-1 text-xs rounded 
{{ $user->status ? 'bg-success-500' : 'bg-danger-500' }} text-white">
{{ $user->status ? 'Active' : 'Inactive' }}
</span>
</div>
<hr>

<div class="flex justify-between">
<span class="text-slate-500">Joined On</span>
<span class="font-medium">
{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y, h:i A') }}
</span>
</div>

</div>
</div>
</div>


</div>



<br>
<div class="grid xl:grid-cols-1 grid-cols-2 gap-5">
<div class="card">
<div class="card-body px-6 pb-6">
<h4 class="text-lg font-semibold mb-4 py-4">Wallet Transections</h4>

<table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700">
<thead class=" border-t border-slate-100 dark:border-slate-800">
<tr>
<th scope="col" class="table-th">S.NO</th>
<th scope="col" class="table-th">Date</th>
<th scope="col" class="table-th">Amount</th>
<th scope="col" class="table-th">Type</th>
<th scope="col" class="table-th">Notes</th>
</tr>
</thead>

<tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
@php($i = 1)
@foreach($trans as $t)

<tr>
<td class="table-td" width="10%">{{ $i++ }}</td>
<td class="table-td" width="20%">{{ $t->created_at->format('d-M-Y') }}</td>
<td class="table-td" width="20%"><span class="text-primary-500">{{ $setting->currency.number_format($t->amount,2) }}</span></td>
<td class="table-td" width="20%">@if($t->type == 'Credit') <span class="badge bg-success-200 text-dark capitalize rounded-3xl">Credit</span>  @else <span class="badge bg-danger-200 text-dark capitalize rounded-3xl">Debit</span> @endif</td>
<td class="table-td" width="30%">{{ $t->notes }}</td>
</tr>

@endforeach

</tbody>
</table>

</div>
</div>
</div>

</div>
</div>
</div>
</div>
@endsection