<div class="tab-pane fade show" id="cost" role="tabpanel" aria-labelledby="tabs-home-tab">
<p class="mb-4 text-sm">Define cost for Chat and other stuff</p>

<div class="card">
<div class="card-body flex flex-col p-6">
<div class="card-text h-full space-y-4">

<div class="input-area">
<label for="name" class="form-label">Free chat minute for user</label>
<input id="name" type="number" class="form-control" name="free_chat_minute" value="<?php echo e($setting->free_chat_minute); ?>" placeholder="add 0 if no free chat">
</div>

<div class="input-area">
<label for="username" class="form-label">Cost for Kundali creation</label>
<input id="username" type="number" class="form-control" name="kundali_cost" value="<?php echo e($setting->kundali_cost); ?>">
</div>

<div class="input-area">
<label for="username" class="form-label">Cost for Predications</label>
<input id="username" type="number" class="form-control" name="predication_cost" value="<?php echo e($setting->predication_cost); ?>">
</div>

<div class="input-area">
<label for="username" class="form-label">Cost for Horoscope</label>
<input id="username" type="number" class="form-control" name="horoscope_cost" value="<?php echo e($setting->horoscope_cost); ?>">
</div>

<div class="input-area">
<label for="username" class="form-label">Cost for Match Making</label>
<input id="username" type="number" class="form-control" name="match_cost" value="<?php echo e($setting->match_cost); ?>">
</div>

<div class="input-area">
<label for="username" class="form-label">Cost for Baby name</label>
<input id="username" type="number" class="form-control" name="name_cost" value="<?php echo e($setting->name_cost); ?>">
</div>

<br>
<button class="btn inline-flex justify-center btn-primary btn-sm">Save Setting</button>

</div>
</div>
</div>
</div><?php /**PATH /Users/samarthsharma/Downloads/61539797-ready-to-use-ai-powered-astrology-app-android-ios-website-admin-panel/Backend + Website/resources/views/admin/setting/cost.blade.php ENDPATH**/ ?>