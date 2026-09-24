<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="wallet_{{ $row->id }}" tabindex="-1" aria-labelledby="send_email" aria-hidden="true">
    <div class="modal-dialog relative w-auto pointer-events-none">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
            <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                    <h3 class="text-xl font-medium text-white dark:text-white capitalize">{{ __('admin.update_wallet') }} - {{ $row->name }}</h3>

                    <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="#ffffff" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-4">

                    <form action="{{ Asset(env('admin').'/updateWallet') }}" method="POST">

                        @csrf

                        <input type="hidden" name="user_id" value="{{ $row->id }}">

                        <div class="grid xl:grid-cols-1 grid-cols-1 gap-6">
                            <div class="input-area">
                                <label for="price" class="form-label">{{ __('admin.transaction_type') }} <span class="text-danger">*</span></label>
                                <select name="type" class="form-control" required>
                                    <option value="">{{ __('admin.select') }}</option>
                                    <option value="Credit">{{ __('admin.add_plus') }}</option>
                                    <option value="Debit">{{ __('admin.minus') }}</option>
                                </select>
                            </div>

                            <div class="input-area">
                                <label for="price" class="form-label">{{ __('admin.amount') }} <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="amount" required>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-sm" type="submit">{{ __('admin.submit') }}</button>
                    </form>


                </div>
                <!-- Modal footer -->
                <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                </div>
            </div>
        </div>
    </div>
</div>