<script>
/* ================= GLOBALS ================= */
let sessionId = null;
const astroId = {{ $astro->id }};
const userInfo = @json($info);
let isStarting = false;
const DEBUG = true;
let sessionTimerInterval = null;
let sessionSeconds = 0;
const querySessionId = new URLSearchParams(window.location.search).get('session_id');
const preloadedSession = @json($session ?? []);

// Detect refresh and redirect to history if no session_id in GET
(function () {
    try {
        const navEntry = performance.getEntriesByType('navigation')[0];
        const navType = navEntry?.type || (performance.navigation && performance.navigation.type === 1 ? 'reload' : null);
        if (navType === 'reload' && !querySessionId) {
            window.location.href = "{{ Asset('history') }}";
        }
    } catch (e) {
        if (DEBUG) console.warn('Navigation type detection failed', e);
    }
})();

/* ================= HELPERS ================= */
function scrollBottom() {
    const el = document.getElementById('messageContainer');
    el.scrollTo({ top: el.scrollHeight, behavior: 'smooth' });
}

function appendUserMessage(text) {
    document.getElementById('chatHistory').insertAdjacentHTML('beforeend', `
        <div class="flex justify-end">
            <div class="bg-primary text-white px-5 py-3 rounded-2xl max-w-[80%]">
                <p class="text-sm">${text}</p>
            </div>
        </div>
    `);
    scrollBottom();
}

function appendAstroMessage(text) {
    document.getElementById('chatHistory').insertAdjacentHTML('beforeend', `
        <div class="flex gap-3 max-w-[80%]">
            <img src="{{ Asset('upload/astrologer/'.$astro->img) }}" class="w-8 h-8 rounded-full">
            <div class="bg-white px-5 py-3 rounded-2xl shadow">
                <p class="text-sm">${text}</p>
            </div>
        </div>
    `);
    scrollBottom();
}

function showTyping() {
    document.getElementById('chatHistory').insertAdjacentHTML('beforeend', `
        <div id="typing" class="italic text-slate-400 text-sm ml-10">
            {{ $astro->name }} is typing...
        </div>
    `);
    scrollBottom();
}

function removeTyping() {
    const t = document.getElementById('typing');
    if (t) t.remove();
}

// Display astro reply split by '|' — first part immediately, rest 1s stagger
function appendAstroMessagesPipe(text) {
    if (!text) return;
    const parts = String(text)
        .split('|')
        .map(s => s.trim())
        .filter(Boolean);
    if (parts.length === 0) return;
    appendAstroMessage(parts[0]);
    for (let i = 1; i < parts.length; i++) {
        setTimeout(() => appendAstroMessage(parts[i]), 800 * i);
    }
}

// Post user's $info once
let infoPosted = false;
function buildUserInfoText() {
    return `
            Name: ${userInfo?.name ?? ''}<br>
            DOB: ${userInfo?.dob ?? ''}<br>
            TOB: ${userInfo?.tob ?? ''}<br>
            POB: ${userInfo?.pob ?? ''}<br>
            Gender: ${userInfo?.gender ?? ''}
        `;
}
function appendUserInfoIfAny() {
    if (infoPosted) return;
    const hasAny = userInfo && (
        (userInfo.name && userInfo.name !== '') ||
        (userInfo.dob && userInfo.dob !== '') ||
        (userInfo.tob && userInfo.tob !== '') ||
        (userInfo.pob && userInfo.pob !== '') ||
        (userInfo.gender && userInfo.gender !== '')
    );
    if (!hasAny) return;
    appendUserMessage(buildUserInfoText());
    infoPosted = true;
}

// Append $info immediately on load if available and not resuming an old session
if (!querySessionId) {
    appendUserInfoIfAny();
}

function onSessionStarted() {
    const topicSec = document.getElementById('topicSection');
    if (topicSec) topicSec.classList.add('hidden');
    const inputBox = document.getElementById('chatInputBox');
    if (inputBox) inputBox.classList.remove('hidden');
    const endBtn = document.getElementById('endChatBtn');
    if (endBtn) endBtn.classList.remove('hidden');
}

function onSessionReadonly(totalText) {
    const topicSec = document.getElementById('topicSection');
    if (topicSec) topicSec.classList.add('hidden');
    const inputBox = document.getElementById('chatInputBox');
    if (inputBox) inputBox.classList.add('hidden');
    const endBtn = document.getElementById('endChatBtn');
    if (endBtn) endBtn.classList.add('hidden');
    stopSessionTimer();
    const timer = document.getElementById('sessionTimer');
    if (timer) timer.textContent = totalText || timer.textContent;
}

// JSON-aware fetch with better console debugging
function requestJson(url, options, label = 'request') {
    const merged = { ...options };
    merged.headers = {
        Accept: 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        ...(options && options.headers)
    };
    let payload = undefined;
    try { payload = options && options.body ? JSON.parse(options.body) : undefined; } catch {}
    console.log(`${label} sending:`, { url, headers: merged.headers, payload });

    return fetch(url, merged)
        .then(async (res) => {
            const contentType = res.headers.get('content-type') || '';
            const text = await res.text();
            if (!res.ok) {
                let jsonError = null;
                try { if (contentType.includes('application/json')) jsonError = JSON.parse(text); } catch {}
                console.error(`${label} failed`, {
                    status: res.status,
                    statusText: res.statusText,
                    contentType,
                    jsonError,
                    raw: text
                });
                const msg = jsonError?.error || jsonError?.message || `${label} error ${res.status}: ${res.statusText}`;
                const err = Object.assign(new Error(msg), { status: res.status, statusText: res.statusText, contentType, jsonError, raw: text });
                throw err;
            }
            try {
                return JSON.parse(text);
            } catch (e) {
                console.error(`${label} JSON parse error`, { contentType, raw: text });
                throw e;
            }
        });
}

// Session timer helpers
function formatHHMMSS(total) {
    const h = Math.floor(total / 3600);
    const m = Math.floor((total % 3600) / 60);
    const s = total % 60;
    const pad = (n) => String(n).padStart(2, '0');
    return h > 0 ? `${pad(h)}:${pad(m)}:${pad(s)}` : `${pad(m)}:${pad(s)}`;
}
function updateSessionTimerDisplay() {
    const el = document.getElementById('sessionTimer');
    if (el) el.textContent = formatHHMMSS(sessionSeconds);
}
function startSessionTimer(startFrom = 0) {
    if (sessionTimerInterval) clearInterval(sessionTimerInterval);
    sessionSeconds = typeof startFrom === 'number' && !isNaN(startFrom) ? Math.max(0, Math.floor(startFrom)) : 0;
    updateSessionTimerDisplay();
    sessionTimerInterval = setInterval(() => {
        sessionSeconds += 1;
        updateSessionTimerDisplay();
    }, 1000);
}
function stopSessionTimer() {
    if (sessionTimerInterval) clearInterval(sessionTimerInterval);
    sessionTimerInterval = null;
}
function startSessionTimerFrom(startedAt) {
    function parseDateTime(val) {
        if (!val) return NaN;
        const d = new Date(val);
        if (!isNaN(d)) return d.getTime();
        const m = String(val).match(/^(\d{4})-(\d{2})-(\d{2})[ T](\d{2}):(\d{2}):(\d{2})$/);
        if (m) {
            const [, y, mo, da, h, mi, s] = m;
            return new Date(Number(y), Number(mo) - 1, Number(da), Number(h), Number(mi), Number(s)).getTime();
        }
        return NaN;
    }
    const t = parseDateTime(startedAt);
    const now = Date.now();
    const diff = Math.max(0, Math.floor((now - t) / 1000));
    const startFrom = isNaN(diff) ? 0 : diff;
    startSessionTimer(startFrom);
}

// End Chat button logic
document.addEventListener('DOMContentLoaded', () => {
    const endBtn = document.getElementById('endChatBtn');
    if (endBtn) {
        endBtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (!sessionId) return;
            const ok = confirm('End the chat session?');
            if (!ok) return;
            const url = "{{ Asset('chatEnd') }}" + "?web=true&session_id=" + encodeURIComponent(sessionId);
            window.location.href = url;
        });
    }

    // If session_id present in URL, preload history and start timer from backend time
    if (querySessionId) {
        sessionId = querySessionId;
        try {
            const items = preloadedSession && preloadedSession.data ? preloadedSession.data : [];
            items.forEach(m => {
                if (m.sender === 'user') appendUserMessage(m.message);
                else appendAstroMessage(m.message);
            });
            if (preloadedSession && preloadedSession.status === 'active') {
                onSessionStarted();
                if (preloadedSession.session_started_at) {
                    startSessionTimerFrom(preloadedSession.session_started_at);
                } else {
                    startSessionTimer();
                }
            } else if (preloadedSession && preloadedSession.status === 'ended') {
                onSessionReadonly(preloadedSession.total);
            } else {
                // Fallback: treat as active if status not provided
                onSessionStarted();
                if (preloadedSession && preloadedSession.session_started_at) {
                    startSessionTimerFrom(preloadedSession.session_started_at);
                } else {
                    startSessionTimer();
                }
            }
            scrollBottom();
        } catch (e) {
            if (DEBUG) console.error('Failed to preload session history', e, preloadedSession);
        }
    }
});

/* ================= TOPIC CLICK ================= */
document.querySelectorAll('.topicBtn').forEach(btn => {
    btn.addEventListener('click', function () {

        // Ignore topic clicks once a session exists
        if (sessionId) {
            onSessionStarted();
            return;
        }

        const topic = this.dataset.topic;

        appendUserInfoIfAny();
        appendUserMessage(`I want to ask about ${topic}`);
        showTyping();

        const payload = {
            astro_id: astroId,
            topic: topic || 'general life guidance',
            user_info: {
                name: userInfo?.name ?? '',
                dob: userInfo?.dob ?? '',
                tob: userInfo?.tob ?? '',
                pob: userInfo?.pob ?? '',
                gender: userInfo?.gender ?? ''
            }
        };

        requestJson("{{ Asset('chatStart') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify(payload)
        }, 'chatStart')
        .then(res => {
            console.log('chatStart response:', res);
            sessionId = res.session_id;
            removeTyping();
            appendAstroMessagesPipe(res.astrologer_reply);
            onSessionStarted();
            startSessionTimer();
        })
        .catch(err => {
            console.error('chatStart failed:', err);
            removeTyping();
            appendAstroMessage('Sorry, we could not start the chat. Please try again.');
        });
    });
});

/* ================= SEND MESSAGE ================= */
document.getElementById('sendBtn').addEventListener('click', sendMessage);
document.getElementById('chatInput').addEventListener('keydown', function (e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        sendMessage();
    }
});

function sendMessage() {
    const input = document.getElementById('chatInput');
    const msg = input.value.trim();
    if (!msg) return;

    

    // With an active session, send the message normally
    appendUserMessage(msg);
    input.value = '';
    showTyping();

    requestJson("{{ Asset('sendMsg') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            session_id: sessionId,
            message: msg
        })
    }, 'sendMsg')
    .then(res => {
        removeTyping();
        appendAstroMessagesPipe(res.message);
        if (res.balance !== undefined) {
            document.getElementById('userWalletBalance').textContent = "{{ $setting->currency }}" + parseFloat(res.balance).toFixed(2);
        }
    })
    .catch(err => {
        removeTyping();
        alert(err.message || 'Insufficient wallet balance. Chat ended.');
        window.location.href = "{{ Asset('history') }}";
    });
}
</script>