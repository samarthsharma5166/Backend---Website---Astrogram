@extends('admin.layout.main')

@section('title') {{ $title }} @endsection

@section('content')

<div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
    <div class="page-content">
        <div class="transition-all duration-150 container-fluid" id="page_layout">
            <div id="content_layout">


                <div class="flex justify-between flex-wrap items-center mb-6">
                    <h2 class="font-medium lg:text-2xl text-xl capitalize text-slate-900 inline-block ltr:pr-4 rtl:pl-4 mb-1 sm:mb-0">{{ $title }}</h2>
                    <div class="flex sm:space-x-4 space-x-2 sm:justify-end items-center rtl:space-x-reverse">
                        <a class="btn inline-flex justify-center btn-primary text-slate-700 dark:bg-slate-700 !font-normal dark:text-white btn-sm" href="{{ $link.'/add' }}">
                            <span class="flex items-center">
                                <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2 font-light" icon="material-symbols:add"></iconify-icon>
                                <span>{{ __('admin.add_new') }}</span>
                            </span>
                        </a>

                    </div>
                </div>

                <div class="grid xl:grid-cols-1 grid-cols-1 gap-5">
                    <div class="card">
                        <div class="card-body px-6 pb-6">
                            <div class="overflow-x-auto -mx-6">
                                <div class="inline-block min-w-full align-middle">
                                    <div class="overflow-hidden ">
                                        <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700">
                                            <thead class=" border-t border-slate-100 dark:border-slate-800">
                                                <tr>
                                                    <th scope="col" class="table-th">{{ __('admin.s_no') }}</th>
                                                    <th scope="col" class="table-th">{{ __('admin.image') }}</th>
                                                    <th scope="col" class="table-th">{{ __('admin.name') }}</th>
                                                    <th scope="col" class="table-th">{{ __('admin.language') }}</th>
                                                    <th scope="col" class="table-th">{{ __('admin.type') }}</th>
                                                    <th scope="col" class="table-th">{{ __('admin.status') }}</th>
                                                    <th scope="col" class="table-th" style="text-align: right;">{{ __('admin.option') }}</th>

                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                                @php($i = 1)
                                                @foreach($data as $row)
                                                <tr>
                                                    <td width="5%" class="table-td">{{ $i++ }}</td>
                                                    <td width="10%" class="table-td">@if($row->img) <img src="{{ Asset('upload/astrologer/'.$row->img) }}" style="height: 40px;border-radius: 10px;"> @endif</td>
                                                    <td width="15%" class="table-td">{{ $row->name }}
                                                        @php($count = $row->countChat($row->id))

                                                        @if($count > 0)
                                                        <p class="mt-2 text-primary-500">{{ __('admin.total_chat') }} {{ $count }}</p>
                                                        @endif

                                                    </td>
                                                    <td width="10%" class="table-td">{{ $row->language }}</td>
                                                    <td width="15%" class="table-td">{{ $row->type }}</td>
                                                    <td width="15%" class="table-td">

                                                        <a href="javascript:void(0)" onclick="showSweetAlert('astrologer_status?id={{ $row->id }}','{{ __('admin.are_you_sure') }}','{{ __('admin.delete_confirm') }}')">

                                                            @if($row->status == 0) <span class="badge bg-primary-500 text-white capitalize rounded-3xl">{{ __('admin.active') }}</span> @else <span class="badge bg-secondary-500 text-white capitalize rounded-3xl">{{ __('admin.disabled') }}</span> @endif

                                                        </a>
                                                    </td>
                                                    <td width="15%" class="table-td" style="text-align: right;">

                                                        <a href="{{ $link.'/'.$row->id.'/edit' }}" class="btn inline-flex h-8 w-6 items-center justify-center btn-success rounded-full toolTip onTop" data-tippy-content="{{ __('admin.edit_details') }}">
                                                            <span class="flex items-center">
                                                                <iconify-icon class="text-xl" icon="mingcute:edit-line"></iconify-icon>
                                                            </span>
                                                        </a>

                                                        <a href="javascript:void(0);" onclick="showSweetAlert('astrologer_delete?id={{ $row->id }}')" class="btn inline-flex h-8 w-6 items-center justify-center btn-danger rounded-full toolTip onTop" data-tippy-content="{{ __('admin.delete') }}">
                                                            <span class="flex items-center">
                                                                <iconify-icon class="text-xl" icon="material-symbols:delete-outline"></iconify-icon>
                                                            </span>
                                                        </a>

                                                    </td>
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
        </div>
    </div>
</div>
@endsection