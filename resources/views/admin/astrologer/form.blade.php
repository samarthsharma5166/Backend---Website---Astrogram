<div class="grid xl:grid-cols-2 grid-cols-1 gap-6">
    <div class="card">
        <div class="card-body flex flex-col p-6">
            <div class="card-text h-full space-y-4">

                <input type="hidden" name="role_id" value="2">

                <div class="grid xl:grid-cols-1 grid-cols-1 gap-6">
                    <div class="input-area">
                        <label for="price" class="form-label">{{ __('admin.select_category') }} <span class="text-danger">*</span></label>
                        <select name="cate_id[]" class="form-control select2" required multiple>
                            <option value="">{{ __('admin.select') }}</option>
                            @foreach($cates as $cate)
                            <option value="{{ $cate->id }}" @if(in_array($cate->id,$array)) selected @endif>{{ $cate->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-area">
                        <label for="username" class="form-label">{{ __('admin.name') }} <span class="text-danger">*</span></label>
                        <input id="username" class="form-control form-control-solid" required name="name" type="text" value="{{ $data->name }}">
                    </div>
                </div>

                <div class="input-area">
                    <label for="username" class="form-label">{{ __('admin.short_description') }}</label>
                    <textarea class="form-control" name="description">{{ $data->description }}</textarea>
                </div>

                <div class="grid xl:grid-cols-2 grid-cols-1 gap-6">
                    <div class="input-area">
                        <label for="username" class="form-label">{{ __('admin.language') }}</label>
                        <select name="language" class="form-control">
                            @foreach(explode(",",getSetting()->language) as $language)
                            <option value="{{ trim($language) }}" @if($data->language == trim($language)) selected @endif>{{ trim($language) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-area">
                        <label for="username" class="form-label">{{ __('admin.type') }}</label>
                        <input id="username" class="form-control form-control-solid" name="type" type="text" value="{{ $data->type }}" placeholder="{{ __('admin.type_placeholder') }}">
                    </div>
                </div>

                <div class="grid xl:grid-cols-2 grid-cols-1 gap-6">

                    <div class="input-area">
                        <label for="username" class="form-label">{{ __('admin.gender') }}</label>
                        <select name="gender" class="form-control">
                            <option value="Male" @if($data->gender == 'Male') selected @endif>{{ __('admin.male') }}</option>
                            <option value="Female" @if($data->gender == 'Female') selected @endif>{{ __('admin.female') }}</option>
                        </select>
                    </div>

                    <div class="input-area">
                        <label for="price" class="form-label">{{ __('admin.image') }} <span class="text-danger">*</span></label>
                        <input id="price" class="form-control" @if(!$data->id) required @endif name="img" type="file" accept=".jpg,.jpeg,.png,.webp">
                    </div>
                </div>

                <div class="grid xl:grid-cols-2 grid-cols-1 gap-6">
                    <div class="input-area">
                        <label for="username" class="form-label">{{ __('admin.experience_year') }} <span class="text-danger">*</span></label>
                        <input id="username" class="form-control form-control-solid" name="exp" type="number" value="{{ $data->exp }}" required>
                    </div>

                    <div class="input-area">
                        <label for="username" class="form-label">{{ __('admin.cost_per_minute') }} <span class="text-danger">*</span></label>
                        <input id="username" class="form-control form-control-solid" name="cost_per_minute" type="number" value="{{ $data->cost_per_minute }}" required>
                    </div>
                </div>

                <br>
                <button type="submit" class="btn btn-primary btn-sm">{{ __('admin.submit') }}</button>

            </div>
        </div>
    </div>
</div>