@extends('admin.layout.main')

@section('title') Add New @endsection

@section('content')

<div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
<div class="page-content">
<div class="transition-all duration-150 container-fluid" id="page_layout">
<div id="content_layout">


<div class="flex justify-between flex-wrap items-center mb-6">
<h2 class="font-medium lg:text-2xl text-xl capitalize text-slate-900 inline-block ltr:pr-4 rtl:pl-4 mb-1 sm:mb-0">Add New</h2>
<div class="flex sm:space-x-4 space-x-2 sm:justify-end items-center rtl:space-x-reverse">
<a class="btn inline-flex justify-center btn-light text-slate-700 dark:bg-slate-700 !font-normal dark:text-white" href="{{ Asset(env('admin').'/category') }}">
<span class="flex items-center">
<iconify-icon class="text-xl ltr:mr-2 rtl:ml-2 font-light" icon="lets-icons:back"></iconify-icon>

<span>Go Back</span>
</span>
</a>

</div>
</div>


<form action="{{ $form_url }}" method="POST" enctype="multipart/form-data" onsubmit="return chkForm()">

@csrf

@include('admin.category.form')


</form>
</div>
</div>
</div>
</div>
@endsection