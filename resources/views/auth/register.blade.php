<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create account — TeleDermPeds</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;500;600;700&family=Fraunces:opsz,wght,SOFT@9..144,300..600,30..100&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="auth">

    <div class="auth__side">
        <div class="auth__brand">
            <div class="brand__mark">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 21s-7-4.5-7-11a5 5 0 0 1 7-4.5A5 5 0 0 1 19 10c0 6.5-7 11-7 11z" fill="currentColor" stroke="none" opacity="0.25"/>
                    <path d="M8 11.5h2.5l1.5-3 1.5 5 1-2H16"/>
                </svg>
            </div>
            <span>teledermpeds</span>
        </div>
        <div class="auth__hero">
            <div class="auth__hero-eyebrow">Pediatric dermatology, online</div>
            <h1 class="auth__hero-title">Get started in<br><em>under 2 minutes.</em></h1>
            <p class="auth__hero-sub">Create your account, upload your child's case photos, and hear back from a pediatric dermatologist — usually within 24 hours.</p>
        </div>
        <div class="auth__features">
            <div class="auth__feature">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3 4 6v6c0 5 3.5 8.5 8 9 4.5-.5 8-4 8-9V6z"/></svg>
                <span>Your data is encrypted and never shared without your consent.</span>
            </div>
            <div class="auth__feature">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 3v6a4 4 0 0 0 8 0V3M5 3h2M11 3h2M9 13v3a4 4 0 0 0 8 0v-2"/><circle cx="17" cy="14" r="2"/></svg>
                <span>Board-certified pediatric dermatologists review every case.</span>
            </div>
        </div>
    </div>

    <div class="auth__form">
        <h2 class="auth__form-title">Create your account</h2>
        <p class="auth__form-sub">Tell us how you'll be using teledermpeds.</p>

        <form method="POST" action="{{ route('register.post') }}" style="display:flex;flex-direction:column;gap:16px">
            @csrf

            <div class="field">
                <label class="label">I am a&hellip;</label>
                <div class="auth__role-grid">
                    <div class="auth__role {{ old('role', 'patient') === 'patient' ? 'is-on' : '' }}" data-role="patient" onclick="selectRole(this)">
                        <div class="auth__role-ico">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="7" r="3.5"/><path d="M2.5 20c0-3.3 3-6 6.5-6s6.5 2.7 6.5 6"/><circle cx="17" cy="9" r="2.8"/><path d="M14 14.5c.9-.3 1.9-.5 3-.5 3 0 5.5 2.3 5.5 5"/></svg>
                        </div>
                        <div class="auth__role-name">Parent / Guardian</div>
                        <div class="auth__role-desc">I have a child who needs to be seen</div>
                    </div>
                    <div class="auth__role {{ old('role') === 'doctor' ? 'is-on' : '' }}" data-role="doctor" onclick="selectRole(this)">
                        <div class="auth__role-ico">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 3v6a4 4 0 0 0 8 0V3M5 3h2M11 3h2M9 13v3a4 4 0 0 0 8 0v-2"/><circle cx="17" cy="14" r="2"/></svg>
                        </div>
                        <div class="auth__role-name">Doctor</div>
                        <div class="auth__role-desc">I review and diagnose cases</div>
                    </div>
                </div>
                <input type="hidden" name="role" id="role-input" value="{{ old('role', 'patient') }}">
                @error('role')<span class="hint" style="color:var(--status-danger)">{{ $message }}</span>@enderror
            </div>

            <div class="field">
                <label class="label" for="name">Full name</label>
                <input class="input" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Your name" required>
                @error('name')<span class="hint" style="color:var(--status-danger)">{{ $message }}</span>@enderror
            </div>

            <div class="field">
                <label class="label" for="email">Email</label>
                <input class="input" type="email" name="email" id="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                @error('email')<span class="hint" style="color:var(--status-danger)">{{ $message }}</span>@enderror
            </div>

            <div class="field-row">
                <div class="field">
                    <label class="label" for="password">Password</label>
                    <input class="input" type="password" name="password" id="password" placeholder="Min. 8 characters" required>
                    @error('password')<span class="hint" style="color:var(--status-danger)">{{ $message }}</span>@enderror
                </div>
                <div class="field">
                    <label class="label" for="password_confirmation">Confirm password</label>
                    <input class="input" type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat password" required>
                </div>
            </div>

            <button class="btn btn--primary btn--lg btn--block" type="submit">Create account</button>

            <div class="auth__divider">Already have an account?</div>
            <a href="{{ route('login') }}" class="btn btn--ghost btn--block">Sign in instead</a>
        </form>
    </div>
</div>

<script>
function selectRole(el) {
    document.querySelectorAll('.auth__role').forEach(r => r.classList.remove('is-on'));
    el.classList.add('is-on');
    document.getElementById('role-input').value = el.dataset.role;
}
</script>
</body>
</html>
