<div class="grid xl:grid-cols-2 grid-cols-1 gap-6">
    <div class="card">
        <div class="card-body flex flex-col p-6">
            <div class="card-text h-full space-y-4">

                <input type="hidden" name="role_id" value="2">

                <div class="grid xl:grid-cols-1 grid-cols-1 gap-6">
                    <div class="input-area">
                        <label for="price" class="form-label">{{ __('admin.category_name') }} <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ $data->name }}" required>
                    </div>
                </div>

                <div class="grid xl:grid-cols-2 grid-cols-1 gap-6">
                    <div class="input-area">
                        <label for="price" class="form-label">{{ __('admin.image') }} <span class="text-danger">*</span></label>
                        <input id="price" class="form-control" @if(!$data->id) required @endif name="img" type="file" accept=".jpg,.jpeg,.png,.webp">
                    </div>
                    <div class="input-area">
                        <label for="username" class="form-label">{{ __('admin.sort_no') }} <span class="text-danger">*</span></label>
                        <input id="username" class="form-control form-control-solid" required name="sort_no" type="number" value="{{ $data->sort_no ?? 1 }}">
                    </div>
                </div>


                <br>
                <button type="submit" class="btn btn-primary btn-sm">{{ __('admin.submit') }}</button>

            </div>
        </div>
    </div>
</div>