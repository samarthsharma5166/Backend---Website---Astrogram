<script>
    document.getElementById('kundaliAjaxForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnLoader = document.getElementById('btnLoader');
        const resultDiv = document.getElementById('kundaliResult');
        const resultContent = document.getElementById('resultContent');

        // UI Loading State
        submitBtn.disabled = true;
        btnText.textContent = '{{ __('front.generating') }}';
        btnLoader.classList.remove('hidden');

        const formData = new FormData(form);

        // Construct the expected user_info object format
        const payload = {
            user_info: {
                name: formData.get('name'),
                dob: `${formData.get('year')}-${formData.get('month').padStart(2, '0')}-${formData.get('day').padStart(2, '0')}`,
                tob: `${formData.get('hour').padStart(2, '0')}:${formData.get('minute').padStart(2, '0')} ${formData.get('ampm')}`,
                pob: formData.get('place'),
                gender: formData.get('gender'),
                language: formData.get('language')
            },
            timeline: formData.get('timeline')
        };

        fetch(form.action, {
                method: 'POST',
                body: JSON.stringify(payload),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(res => {
                if (res.status) {
                    // Show Result
                    resultDiv.classList.remove('hidden');
                    resultContent.innerHTML = res.data;

                    // Scroll to result
                    resultDiv.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });

                    // Optional: Hide form after success
                    // document.getElementById('kundaliFormContainer').classList.add('hidden');
                } else {
                    alert(res.message || 'Something went wrong. Please check your balance or try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again later.');
            })
            .finally(() => {
                submitBtn.disabled = false;
                btnText.textContent = '{{ __('front.generate_horoscope_now') }}';
                btnLoader.classList.add('hidden');
            });
    });
</script>