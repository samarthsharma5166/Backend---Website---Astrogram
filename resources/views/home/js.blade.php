<script>
const loginModal = document.getElementById('loginModal');
const otpModal = document.getElementById('otpModal');
const isAuth = {{ $auth }};
let timerInterval;

function startTimer() {
    let timeLeft = 30;
    const timerDisplay = document.getElementById('timer');
    const timerContainer = document.getElementById('timerContainer');
    const resendBtn = document.getElementById('resendBtn');
    const resendMsg = document.getElementById('resendMsg');

    timerContainer.classList.remove('hidden');
    resendBtn.classList.add('hidden');
    resendMsg.classList.add('hidden');
    
    clearInterval(timerInterval);
    timerInterval = setInterval(() => {
        timeLeft--;
        timerDisplay.innerText = timeLeft;
        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            timerContainer.classList.add('hidden');
            resendBtn.classList.remove('hidden');
        }
    }, 1000);
}

async function resendOtp() {
    const userId = document.getElementById('otp_user_id').value;
    const resendBtn = document.getElementById('resendBtn');
    const resendMsg = document.getElementById('resendMsg');

    resendBtn.disabled = true;
    resendBtn.innerText = 'Sending...';

    try {
        const formData = new FormData();
        formData.append('user_id', userId);
        formData.append('_token', '{{ csrf_token() }}');

        const response = await fetch('{{ Asset("api/resendCode") }}', {
            method: 'POST',
            body: formData
        });
        
        if (response.ok) {
            resendMsg.classList.remove('hidden');
            startTimer();
        }
    } catch (error) {
        console.error('Resend error:', error);
    } finally {
        resendBtn.disabled = false;
        resendBtn.innerText = 'Resend Code';
    }
}

function openLoginModal() {
    loginModal.classList.remove('hidden');
    loginModal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLoginModal() {
    loginModal.classList.add('hidden');
    loginModal.classList.remove('flex');
    document.body.style.overflow = 'auto';
}

function openOtpModal(userId) {
    document.getElementById('otp_user_id').value = userId;
    closeLoginModal();
    otpModal.classList.remove('hidden');
    otpModal.classList.add('flex');
    startTimer();
}

function closeOtpModal() {
    otpModal.classList.add('hidden');
    otpModal.classList.remove('flex');
    document.body.style.overflow = 'auto';
    clearInterval(timerInterval);
}

// Close on click outside
[loginModal, otpModal].forEach(modal => {
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeLoginModal();
            closeOtpModal();
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const verifyOtpForm = document.getElementById('verifyOtpForm');
    const otpInputs = document.querySelectorAll('.otp-input');

    // OTP Inputs Auto Focus
    otpInputs.forEach((input, index) => {
        input.addEventListener('input', (e) => {
            if (e.target.value.length === 1 && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }
        });
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !e.target.value && index > 0) {
                otpInputs[index - 1].focus();
            }
        });
    });

    // Handle Login Form Submission
    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const btn = document.getElementById('loginBtn');
        btn.disabled = true;
        btn.innerText = 'Sending...';

        try {
            const formData = new FormData(loginForm);
            const response = await fetch('{{ Asset("api/login") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const data = await response.json();

            console.log('Response body:', data);

            if (data.msg === 'otp') {
                openOtpModal(data.user_id);
            } else if (data.msg === 'done') {
                localStorage.setItem('user_profile', JSON.stringify(data.user_data));
                localStorage.setItem('token', data.token);
                window.location = "{{ Asset('index?authToken=') }}"+data.token;
            } else {
                alert(data.error || 'Something went wrong');
            }
        } catch (error) {
            console.error('Login error:', error);
            alert('Failed to connect to server');
        } finally {
            btn.disabled = false;
            btn.innerText = 'Send OTP';
        }
    });

    // Handle OTP Verification
    verifyOtpForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const btn = document.getElementById('verifyBtn');
        const otp = Array.from(otpInputs).map(i => i.value).join('');
        
        if (otp.length < 4) return alert('Please enter 4-digit OTP');
        
        btn.disabled = true;
        btn.innerText = 'Verifying...';

        try {
            const userId = document.getElementById('otp_user_id').value;
            const formData = new FormData();
            formData.append('user_id', userId);
            formData.append('vcode', otp);
            formData.append('is_web', '1');
            formData.append('_token', '{{ csrf_token() }}');

            const response = await fetch('{{ Asset("api/verifyCode") }}', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();

            if (data.msg === 'done') {
                localStorage.setItem('user_profile', JSON.stringify(data.user_data));
                localStorage.setItem('token', data.token);
                window.location = "{{ Asset('index?authToken=') }}"+data.token;
            } else {
                alert(data.error || 'Invalid OTP');
            }
        } catch (error) {
            console.error('OTP error:', error);
            alert('Verification failed');
        } finally {
            btn.disabled = false;
            btn.innerText = 'Verify & Login';
        }
    });

    const chips = document.querySelectorAll('.category-chip');
    const cards = document.querySelectorAll('.astrologer-card');

    // Handle Astrologer Card Clicks
    cards.forEach(card => {
        card.addEventListener('click', () => {
            const astroId = card.getAttribute('data-astro-id');

            if (isAuth == 0) {
                openLoginModal();
            } else {
                window.location.href = `{{ Asset('chat') }}/${astroId}`;
            }
        });
    });

    chips.forEach(chip => {
        chip.addEventListener('click', () => {
            const cateId = chip.getAttribute('data-cate-id');

            // Update active state UI
            chips.forEach(c => {
                c.classList.remove('active');
                const container = c.querySelector('.chip-container');
                const text = c.querySelector('.chip-text');
                
                if (c.getAttribute('data-cate-id') === 'all') {
                    // Always stay primary
                    container.classList.add('bg-primary', 'text-white');
                    container.classList.remove('bg-gray-100', 'dark:bg-gray-800', 'text-gray-400');
                    text.classList.add('text-nebula-indigo', 'dark:text-white');
                    text.classList.remove('text-gray-500', 'dark:text-gray-400');
                    
                    // Add a ring only when actually active
                    if (cateId === 'all') {
                        container.classList.add('ring-4', 'ring-primary/40', 'scale-110');
                    } else {
                        container.classList.remove('ring-4', 'ring-primary/40', 'scale-110');
                    }
                } else {
                    container.classList.remove('border-primary', 'ring-4', 'ring-primary/20', 'scale-110');
                    container.classList.add('border-transparent');
                    text.classList.remove('text-primary');
                    text.classList.add('text-gray-500', 'dark:text-gray-400');
                }
            });

            chip.classList.add('active');
            const activeContainer = chip.querySelector('.chip-container');
            const activeText = chip.querySelector('.chip-text');

            if (cateId !== 'all') {
                activeContainer.classList.add('border-primary', 'ring-4', 'ring-primary/20', 'scale-110');
                activeContainer.classList.remove('border-transparent');
                activeText.classList.add('text-primary');
                activeText.classList.remove('text-gray-500', 'dark:text-gray-400');
            }

            // Filter cards
            cards.forEach(card => {
                if (cateId === 'all') {
                    card.style.display = 'flex';
                } else {
                    try {
                        const rawCategories = card.getAttribute('data-categories');
                        const categories = JSON.parse(rawCategories || '[]');
                        
                        // Handle both array of IDs and array of objects with cate_id
                        const hasCate = categories.some(c => {
                            if (typeof c === 'object' && c !== null) {
                                return String(c.cate_id) === String(cateId);
                            }
                            return String(c) === String(cateId);
                        });

                        if (hasCate) {
                            card.style.display = 'flex';
                        } else {
                            card.style.display = 'none';
                        }
                    } catch (e) {
                        console.error('Error parsing categories:', e);
                        card.style.display = 'flex'; // Show anyway on error
                    }
                }
            });
        });
    });
});
</script>