<script>
document.addEventListener('DOMContentLoaded', function() {
const profileForm = document.getElementById('profileForm');
const daySelect = document.getElementById('day');
const monthSelect = document.getElementById('month');
const yearSelect = document.getElementById('year');
const hourSelect = document.getElementById('hour');
const minuteSelect = document.getElementById('minute');
const periodSelect = document.getElementById('period');
const dobHidden = document.getElementById('dob_combined');
const tobHidden = document.getElementById('tob_combined');

function updateDOB() {
if (daySelect.value && monthSelect.value && yearSelect.value) {
dobHidden.value = `${yearSelect.value}-${monthSelect.value}-${daySelect.value}`;
}
}

function updateTOB() {
if (hourSelect.value && minuteSelect.value && periodSelect.value) {
tobHidden.value = `${hourSelect.value}:${minuteSelect.value} ${periodSelect.value}`;
}
}

[daySelect, monthSelect, yearSelect].forEach(select => {
select.addEventListener('change', updateDOB);
});

[hourSelect, minuteSelect, periodSelect].forEach(select => {
select.addEventListener('change', updateTOB);
});

profileForm.addEventListener('submit', function(e) {
updateDOB();
updateTOB();
if (!dobHidden.value || !tobHidden.value) {
e.preventDefault();
alert('Please select a valid birth date and time');
}
});
});
</script>