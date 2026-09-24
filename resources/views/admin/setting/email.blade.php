<div class="tab-pane fade show" id="email_smtp" role="tabpanel" aria-labelledby="tabs-home-tab">
<div class="card">
<div class="card-body flex flex-col p-6">
<div class="card-text h-full space-y-4">

<div class="grid xl:grid-cols-2 grid-cols-1 gap-6">
<div class="input-area">
<label for="host" class="form-label">Email Host</label>
<input id="host" type="text" class="form-control" name="email_host" value="{{ $setting->email_host }}" placeholder="e.g mail.abc.com">
</div>

<div class="input-area">
<label for="email_port" class="form-label">Email Port</label>
<input id="email_port" type="text" class="form-control" name="email_port" value="{{ $setting->email_port }}" placeholder="587">
</div>
</div>
<br>
<div class="grid xl:grid-cols-2 grid-cols-1 gap-6">
<div class="input-area">
<label for="email_username" class="form-label">Email Username</label>
<input id="email_username" type="text" class="form-control" name="email_username" value="{{ $setting->email_username }}">
</div>

<div class="input-area">
<label for="email_password" class="form-label">Email Password</label>
<input id="email_password" type="password" class="form-control" name="email_password" value="{{ $setting->email_password }}">
</div>
</div>
<br>
<div class="grid xl:grid-cols-2 grid-cols-1 gap-6">
<div class="input-area">
<label for="email_enc" class="form-label">Email Encryption</label>
<input id="email_enc" type="text" class="form-control" name="email_enc" value="{{ $setting->email_enc }}" placeholder="ssl">
</div>

<div class="input-area">
<label for="email_address_from" class="form-label">Email From Address</label>
<input id="email_address_from" type="text" class="form-control" name="email_from" value="{{ $setting->email_from }}" placeholder="Your email">
</div>
</div>
<br>
<div class="grid xl:grid-cols-2 grid-cols-1 gap-6">
<div class="input-area">
<label for="from_name" class="form-label">From Name</label>
<input id="from_name" type="text" class="form-control" name="email_from_name" value="{{ $setting->email_from_name }}">
</div>
</div>

<br>
<button type="submit" class="btn btn-dark btn-sm">Save Setting</button>

</div>
</div>
</div>
</div>