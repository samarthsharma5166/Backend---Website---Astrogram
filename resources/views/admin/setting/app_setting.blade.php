<div class="card">
<div class="card-body flex flex-col p-6">
<div class="card-text h-full space-y-4">

<h4 class="text-lg">App Settings</h4>

<div class="input-area">
<label for="welcome_title" class="form-label">Language for Astrologer</label>
<input id="welcome_title" type="text" class="form-control" name="language" value="{{ $setting->language }}" placeholder="comma seprated for multiple e.g English,Hindi">
</div>

<div class="grid xl:grid-cols-1 grid-cols-1 gap-6">

<div class="input-area">
<label for="welcome_title" class="form-label">App Welcome Page Heading</label>
<input id="welcome_title" type="text" class="form-control" name="welcome_title" value="{{ $setting->welcome_title }}">
</div>

<div class="input-area">
<label for="welcome_desc" class="form-label">App Welcome Description</label>
<textarea id="welcome_desc" type="text" class="form-control" name="welcome_desc">{{ $setting->welcome_desc }}</textarea>
</div>
</div>

<div class="input-area">
<label for="welcome_title" class="form-label">Android App Link</label>
<input id="welcome_title" type="text" class="form-control" name="android_app" value="{{ $setting->android_app }}">
</div>

<div class="input-area">
<label for="welcome_title" class="form-label">IOS App Link</label>
<input id="welcome_title" type="text" class="form-control" name="ios_app" value="{{ $setting->ios_app }}">
</div>

</div>
</div>
</div>

@include('admin.setting.login_type')

<br>
<div class="card">
<div class="card-body flex flex-col p-6">
<div class="card-text h-full space-y-4">

<h4 class="text-lg">Contact us & FAQ</h4>
<div class="grid xl:grid-cols-2 grid-cols-2 gap-6">

<div class="input-area">
<label for="welcome_title" class="form-label">Contact us Email</label>
<input id="welcome_title" type="text" class="form-control" name="contact_email" value="{{ $setting->contact_email }}">
</div>

<div class="input-area">
<label for="welcome_desc" class="form-label">Whatsapp Number</label>
<input id="welcome_title" type="text" class="form-control" name="whatsapp_no" value="{{ $setting->whatsapp_no }}" placeholder="with country code 91">
</div>
</div>
<div class="input-area">
<label for="welcome_title" class="form-label">FAQ's</label>
<textarea name="faq" class="form-control">{{ $setting->faq }}</textarea>
</div>
<br>
<button class="btn inline-flex justify-center btn-primary btn-sm">Save Setting</button>
</div>
</div>
</div>