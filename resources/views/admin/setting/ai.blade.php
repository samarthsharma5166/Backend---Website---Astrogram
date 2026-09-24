<div class="tab-pane fade show" id="ai" role="tabpanel" aria-labelledby="tabs-home-tab">

<div class="card">
<div class="card-body flex flex-col p-6">
<div class="card-text h-full space-y-4">

<div class="input-area">
<label for="open_ai_key" class="form-label">Open AI Key</label>
<input id="open_ai_key" type="password" class="form-control" name="open_ai_key" value="{{ $setting->open_ai_key }}">
</div>

<br>
<button class="btn inline-flex justify-center btn-primary btn-sm">Save Setting</button>

</div>
</div>
</div>
</div>