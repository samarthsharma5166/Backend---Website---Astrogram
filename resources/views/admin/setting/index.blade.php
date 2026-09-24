@extends('admin.layout.main')

@section('title') Account Setting @endsection

@section('content')

<div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
<div class="page-content">
<div class="transition-all duration-150 container-fluid" id="page_layout">
<div id="content_layout">


<!-- BEGIN: BreadCrumb -->
<div class="mb-5">
<ul class="m-0 p-0 list-none">
<li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
<a href="{{ Asset(env('admin').'/home') }}">
<iconify-icon icon="heroicons-outline:home"></iconify-icon>
<iconify-icon icon="heroicons-outline:chevron-right" class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
</a>
</li>
<li class="inline-block relative text-sm text-slate-500 font-Inter ">Account Setting</li>
</ul>
</div>

<form action="{{ $form_url }}" method="POST" onsubmit="return chkForm()" enctype="multipart/form-data">

{!! csrf_field() !!}

<div class="grid grid-cols-1 gap-6">
<div class="card">
<div class="card-body flex flex-col p-6">
<header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
<div class="flex-1">
<div class="card-title text-slate-900 dark:text-white">Account Setting</div>
</div>
</header>
<div class="card-text h-full ">
<div>

@include('admin.setting.setting_tab')

</div>
</div>
</div>
</div>
</div>
<br>
<div class="grid xl:grid-cols-2 grid-cols-1">


<div class="tab-content" id="tabs-tabContent">

@include('admin.setting.general')

@include('admin.setting.logo')

@include('admin.setting.cost')

@include('admin.setting.push')

@include('admin.setting.email')

@include('admin.setting.password')

</div>
</div>



</form>
</div>
</div>
</div>
</div>

<script>

    function chkForm()
    {
        var pass    = document.getElementById("pass");
        var c_pass  = document.getElementById("c_pass");
    
        if(pass.value && pass.value.length < 6)
        {
            alert("Password length should be 6 characters atleast.");
    
            return false;
        }
    
        if(pass.value && pass.value != c_pass.value)
        {
            alert("Confirm Password not match.");
    
            return false;
        }
    
        return true;
    }
    
    </script>
@endsection

@section('js')
<script src="{{ Asset('assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
<script src="{{ Asset('assets/js/pages/form-editor.init.js') }}"></script>
@endsection