<script>
    function goToStep(step) {
        const s1 = document.getElementById('step1');
        const s2 = document.getElementById('step2');
        const i1 = document.getElementById('step1Indicator');
        const i2 = document.getElementById('step2Indicator');

        if (step === 1) {
            s1.classList.remove('hidden');
            s2.classList.add('hidden');
            i1.classList.add('step-active');
            i1.classList.remove('text-gray-400');
            i2.classList.remove('step-active');
            i2.classList.add('text-gray-400');
        } else {
            // Validation for step 1 fields if needed
            const name = document.querySelector('input[name="m_name"]').value;
            if (!name) {
                alert('Please enter your name first');
                return;
            }

            s1.classList.add('hidden');
            s2.classList.remove('hidden');
            i2.classList.add('step-active');
            i2.classList.remove('text-gray-400');
            i1.classList.remove('step-active');
            i1.classList.add('text-gray-400');
        }
    }

    document.getElementById('matchAjaxForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnLoader = document.getElementById('btnLoader');
        const resultDiv = document.getElementById('matchResult');
        const resultContent = document.getElementById('resultContent');

        submitBtn.disabled = true;
        btnText.textContent = '{{ __('front.analyzing') }}';
        btnLoader.classList.remove('hidden');

        const formData = new FormData(form);

        const payload = {
            my_info: {
                name: formData.get('m_name'),
                dob: `${formData.get('m_year')}-${formData.get('m_month').padStart(2, '0')}-${formData.get('m_day').padStart(2, '0')}`,
                tob: `${formData.get('m_hour').padStart(2, '0')}:${formData.get('m_min').padStart(2, '0')} ${formData.get('m_ampm')}`,
                pob: formData.get('m_place'),
                gender: formData.get('m_gender'),
                language: formData.get('language')
            },
            partner_info: {
                name: formData.get('p_name'),
                dob: `${formData.get('p_year')}-${formData.get('p_month').padStart(2, '0')}-${formData.get('p_day').padStart(2, '0')}`,
                tob: `${formData.get('p_hour').padStart(2, '0')}:${formData.get('p_min').padStart(2, '0')} ${formData.get('p_ampm')}`,
                pob: formData.get('p_place'),
                gender: formData.get('p_gender')
            }
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
                    resultDiv.classList.remove('hidden');
                    resultContent.innerHTML = res.data;
                    resultDiv.scrollIntoView({
                        behavior: 'smooth'
                    });
                } else {
                    alert(res.message || 'Error occurred. Checks your balance.');
                }
            })
            .catch(error => {
                console.error(error);
                alert('Something went wrong.');
            })
            .finally(() => {
                submitBtn.disabled = false;
                btnText.textContent = '{{ __('front.check_compatibility') }}';
                btnLoader.classList.add('hidden');
            });
    });
</script>