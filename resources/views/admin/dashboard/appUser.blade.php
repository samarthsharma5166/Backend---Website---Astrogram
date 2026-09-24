@extends('admin.layout.main')

@section('title') {{ __('admin.app_users') }} @endsection

@section('content')

<div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
    <div class="page-content">
        <div class="transition-all duration-150 container-fluid" id="page_layout">
            <div id="content_layout">


                <div class="flex justify-between flex-wrap items-center mb-6">
                    <h2 class="font-medium lg:text-2xl text-xl capitalize text-slate-900 inline-block ltr:pr-4 rtl:pl-4 mb-1 sm:mb-0">{{ __('admin.app_users') }}</h2>
                    <div class="flex sm:space-x-4 space-x-2 sm:justify-end items-center rtl:space-x-reverse">
                    </div>
                </div>

                <div class="grid xl:grid-cols-1 grid-cols-1 gap-6">
                    <div class="card">
                        <div class="card-body flex flex-col p-6">
                            <div class="card-text h-full space-y-4">

                                <form action="{{ Asset(env('admin').'/appUser') }}">

                                    <div class="grid grid-cols-12 gap-5">
                                        <div class="xl:col-span-3 lg:col-span-5 col-span-12">
                                            <div class="input-area">
                                                <input type="text" name="q" class="form-control" placeholder="{{ __('admin.search_filter_placeholder') }}" value="{{ $q }}">
                                            </div>
                                        </div>
                                        <div class="input-area"><button class="btn btn-dark btn-sm">{{ __('admin.filter') }}</button></div>
                                    </div>
                            </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <br>

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
                                                <th scope="col" class="table-th">{{ __('admin.name') }}</th>
                                                <th scope="col" class="table-th">{{ __('admin.phone') }}</th>
                                                <th scope="col" class="table-th">{{ __('admin.email') }}</th>
                                                <th scope="col" class="table-th">{{ __('admin.chats') }}</th>
                                                <th scope="col" class="table-th">{{ __('admin.wallet') }}</th>
                                                <th scope="col" class="table-th">{{ __('admin.status') }}</th>
                                                <th scope="col" class="table-th">{{ __('admin.option') }}</th>

                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                            @php($i = ($data->currentPage() - 1) * $data->perPage() + 1)
                                            @foreach($data as $row)
                                            <tr>
                                                <td width="5%" class="table-td">{{ $i++ }}</td>
                                                <td width="15%" class="table-td"><a href="{{ Asset(env('admin').'/viewUser?user_id='.$row->id) }}" class="text-primary-500">{{ $row->name }}</a></td>
                                                <td width="15%" class="table-td">{{ $row->phone }}</td>
                                                <td width="15%" class="table-td" style="text-transform: lowercase;">{{ $row->email }}</td>
                                                <td width="15%" class="table-td">{{ $row->countChat($row->id) }}</td>
                                                <td width="15%" class="table-td"><span class="text-primary-500">{{ $setting->currency.number_format($row->wallet,2) }}</span></td>
                                                <td width="10%" class="table-td">

                                                    @if($row->status == 1) <span class="badge bg-primary-500 text-white capitalize rounded-3xl">{{ __('admin.active') }}</span> @else <span class="badge bg-danger-500 text-white capitalize rounded-3xl">{{ __('admin.disabled') }}</span> @endif

                                                </td>
                                                <td width="5%" class="table-td">

                                                    <div class="dropstart relative">
                                                        <button class="inline-flex justify-center items-center" type="button" id="tableDropdownMenuButton_{{ $row->uid }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <iconify-icon class="text-xl ltr:ml-2 rtl:mr-2" icon="heroicons-outline:dots-vertical"></iconify-icon>
                                                        </button>
                                                        <ul class="dropdown-menu min-w-max absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700 shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                                            <li>
                                                                <a href="{{ Asset(env('admin').'/appUserEdit?id='.$row->id) }}" class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                                                                    <iconify-icon icon="clarity:note-edit-line"></iconify-icon>
                                                                    <span>{{ __('admin.edit_details') }}</span></a>
                                                            </li>

                                                            <li>
                                                                <a href="{{ Asset(env('admin').'/viewUser?user_id='.$row->id) }}" class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                                                                    <iconify-icon icon="material-symbols:undereye-rounded"></iconify-icon>
                                                                    <span>{{ __('admin.view_details') }}</span></a>
                                                            </li>

                                                            <li>
                                                                <a href="javascript::void()" data-bs-toggle="modal" data-bs-target="#wallet_{{ $row->id }}" class="hover:bg-slate-900 dark:hover:bg-slate-600 dark:hover:bg-opacity-70 hover:text-white w-full border-b border-b-gray-500 border-opacity-10 px-4 py-2 text-sm dark:text-slate-300 last:mb-0 cursor-pointer first:rounded-t last:rounded-b flex space-x-2 items-center capitalize rtl:space-x-reverse">
                                                                    <iconify-icon icon="material-symbols:account-balance-wallet"></iconify-icon>
                                                                    <span>{{ __('admin.update_wallet') }}</span></a>
                                                            </li>

                                                        </ul>
                                                    </div>

                                                </td>
                                            </tr>

                                            @include('admin.dashboard.wallet')

                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><br>
                        {!! $data->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
@endsection