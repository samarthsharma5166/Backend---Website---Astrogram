@extends('admin.layout.main')

@section('title') {{ __('admin.push_notification') }} @endsection

@section('content')

<div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
    <div class="page-content">
        <div class="transition-all duration-150 container-fluid" id="page_layout">
            <div id="content_layout">


                <div class="flex justify-between flex-wrap items-center mb-6">
                    <h2 class="font-medium lg:text-2xl text-xl capitalize text-slate-900 inline-block ltr:pr-4 rtl:pl-4 mb-1 sm:mb-0">{{ __('admin.push_notification') }}</h2>
                    <div class="flex sm:space-x-4 space-x-2 sm:justify-end items-center rtl:space-x-reverse">
                        <a class="btn inline-flex justify-center btn-light text-slate-700 dark:bg-slate-700 !font-normal dark:text-white" href="{{ Asset(env('admin').'/home') }}">
                            <span class="flex items-center">
                                <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2 font-light" icon="lets-icons:back"></iconify-icon>

                                <span>{{ __('admin.go_back') }}</span>
                            </span>
                        </a>

                    </div>
                </div>


                <form action="{{ Asset(env('admin').'/push') }}" method="POST" enctype="multipart/form-data" onsubmit="return chkForm()">

                    @csrf

                    <div class="grid xl:grid-cols-2 grid-cols-1 gap-6">
                        <div class="card">
                            <div class="card-body flex flex-col p-6">
                                <div class="card-text h-full space-y-4">

                                    <div class="grid xl:grid-cols-2 grid-cols-1 gap-6">
                                        <div class="input-area">
                                            <label for="price" class="form-label">{{ __('admin.notification_title') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="title" required>
                                        </div>

                                        <div class="input-area">
                                            <label for="price" class="form-label">{{ __('admin.image') }}</label>
                                            <input type="file" class="form-control" name="file">
                                        </div>
                                    </div>

                                    <div class="grid xl:grid-cols-1 grid-cols-1 gap-6">
                                        <div class="input-area">
                                            <label for="price" class="form-label">{{ __('admin.notification_desc') }} <span class="text-danger">*</span></label>
                                            <textarea name="desc" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-sm">{{ __('admin.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection