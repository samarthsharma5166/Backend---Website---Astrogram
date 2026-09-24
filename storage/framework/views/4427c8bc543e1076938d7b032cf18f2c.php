<br>
<div class="card">
<div class="card-body flex flex-col p-6">
<div class="card-text h-full space-y-4">

<h4 style="font-size: 18px;">Login Verification</h4>

<div class="grid xl:grid-cols-1 grid-cols-1 gap-6">
<div class="input-area">
<label for="name" class="form-label">Login Verify Type</label>
<select name="verify_type" class="form-control" onchange="toggleVerifyFields(this.value)">
<option value="1" <?php if($setting->verify_type == 1): ?> selected <?php endif; ?>>None</option>
<option value="2" <?php if($setting->verify_type == 2): ?> selected <?php endif; ?>>With Twilio SMS</option>
<option value="3" <?php if($setting->verify_type == 3): ?> selected <?php endif; ?>>Other SMS Api</option>
</select>
</div>


<div id="twilio_fields" style="display: none;">
<div class="input-area">
<label class="form-label">Twilio SID</label>
<input type="text" class="form-control" name="t_sid" value="<?php echo e($setting->t_sid); ?>">
</div>
<br>
<div class="input-area">
<label class="form-label">Twilio Auth Token</label>
<input type="text" class="form-control" name="t_auth" value="<?php echo e($setting->t_auth); ?>">
</div>
<br>
<div class="input-area">
<label class="form-label">Twilio Number</label>
<input type="text" class="form-control" name="t_from" value="<?php echo e($setting->t_from); ?>">
</div>
</div>


<div id="other_sms_fields" style="display: none;">
<div class="input-area">
<label class="form-label">Other SMS Provider API</label>
<small>Replace Number field with {num} and message field with {msg} any other field if need {other}</small>
<input type="text" class="form-control mt-4" name="other_sms_api" value="<?php echo e($setting->other_sms_api); ?>">
</div>
</div>
</div>

</div>
</div>
</div>

<script>
    function toggleVerifyFields(val) {
        document.getElementById("twilio_fields").style.display = (val == 2) ? "block" : "none";
        document.getElementById("other_sms_fields").style.display = (val == 3) ? "block" : "none";
    }

    toggleVerifyFields("<?php echo e($setting->verify_type); ?>");
</script><?php /**PATH /Users/samarthsharma/Downloads/61539797-ready-to-use-ai-powered-astrology-app-android-ios-website-admin-panel/Backend + Website/resources/views/admin/setting/login_type.blade.php ENDPATH**/ ?>