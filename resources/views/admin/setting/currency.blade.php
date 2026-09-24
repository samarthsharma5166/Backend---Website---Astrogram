<div class="card">
<div class="card-body flex flex-col p-6">
<div class="card-text h-full space-y-4">

<h4 class="text-lg">Currency Setting</h4>

<div class="grid xl:grid-cols-2 grid-cols-1 gap-6">
<div class="input-area">
<label for="name" class="form-label">Currency Sign</label>
<input id="name" type="text" class="form-control" name="currency" value="{{ $setting->currency }}">
</div>

<div class="input-area">
<label for="currency_code" class="form-label">Currency Code</label>
<input id="currency_code" type="text" class="form-control" name="currency_code" value="{{ $setting->currency_code }}">
</div>
</div>

<div class="grid xl:grid-cols-1 grid-cols-1 gap-6">
<div class="input-area">
<label for="email" class="form-label">Currency Display <span class="text-danger">*</span></label>
<select name="currency_display" class="form-control">
<option value="1" @if($setting->currency_display == 1) selected @endif>On Left Side</option>
<option value="2" @if($setting->currency_display == 2) selected @endif>On Right Side</option>
</select>
</div>
</div>
</div>
</div>
</div>