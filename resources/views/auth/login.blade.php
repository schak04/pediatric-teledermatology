<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in — TeleDermPeds</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;500;600;700&family=Fraunces:opsz,wght,SOFT@9..144,300..600,30..100&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="auth">

    <!-- Left side — hero -->
    <div class="auth__side">
        <div class="auth__brand">
            <div class="brand__mark">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 21s-7-4.5-7-11a5 5 0 0 1 7-4.5A5 5 0 0 1 19 10c0 6.5-7 11-7 11z" fill="currentColor" stroke="none" opacity="0.25"/>
                    <path d="M8 11.5h2.5l1.5-3 1.5 5 1-2H16"/>
                </svg>
            </div>
            <span>TeleDermPeds</span>
        </div>

        <div class="auth__hero">
            <div class="auth__hero-eyebrow">Pediatric dermatology, online</div>
            <h1 class="auth__hero-title">
                Expert care for your child's skin,<br>
                <em>without the waiting room.</em>
            </h1>
            <p class="auth__hero-sub">
                Send photos and a few details. A board-certified pediatric dermatologist
                reviews your case and sends back a diagnosis and treatment plan, usually within 24 hours.
            </p>
        </div>

        <div class="auth__features">
            <div class="auth__feature">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3 4 6v6c0 5 3.5 8.5 8 9 4.5-.5 8-4 8-9V6z"/></svg>
                <span><strong>HIPAA-compliant</strong> — your child's photos and records are encrypted end-to-end.</span>
            </div>
            <div class="auth__feature">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                <span><strong>24-hour turnaround</strong> on routine cases. Faster for urgent symptoms.</span>
            </div>
            <div class="auth__feature">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 3v6a4 4 0 0 0 8 0V3M5 3h2M11 3h2M9 13v3a4 4 0 0 0 8 0v-2"/><circle cx="17" cy="14" r="2"/></svg>
                <span><strong>Board-certified pediatric dermatologists</strong> — all consultations reviewed by specialists.</span>
            </div>
        </div>
    </div>

    <!-- Right side — form -->
    <div class="auth__form">
        <h2 class="auth__form-title">Welcome back</h2>
        <p class="auth__form-sub">Sign in to view your consultations or review pending cases.</p>

        <form method="POST" action="{{ route('login.post') }}" style="display:flex;flex-direction:column;gap:16px">
            @csrf

            <div class="field">
                <label class="label" for="email">Email</label>
                <input class="input" type="email" name="email" id="email" value="{{ old('email') }}" placeholder="you@example.com" required autocomplete="email">
                @error('email')<span class="hint" style="color:var(--status-danger)">{{ $message }}</span>@enderror
            </div>

            <div class="field">
                <div class="row" style="justify-content:space-between">
                    <label class="label" for="password">Password</label>
                </div>
                <input class="input" type="password" name="password" id="password" placeholder="••••••••" required autocomplete="current-password">
                @error('password')<span class="hint" style="color:var(--status-danger)">{{ $message }}</span>@enderror
            </div>

            <div class="row" style="font-size:13px">
                <label class="row" style="gap:8px;cursor:pointer">
                    <input type="checkbox" name="remember" style="accent-color:var(--brand)">
                    <span>Keep me signed in</span>
                </label>
            </div>

            <button class="btn btn--primary btn--lg btn--block" type="submit">Sign in</button>

            <!-- Demo accounts -->
            <div class="card card--soft" style="padding:12px 14px;margin-top:4px">
                <div class="text-xs muted" style="margin-bottom:6px;font-weight:600;text-transform:uppercase;letter-spacing:0.06em">Demo — quick sign in as:</div>
                <div class="row" style="gap:8px;flex-wrap:wrap">
                    <form method="POST" action="{{ route('login.post') }}" style="margin:0">
                        @csrf
                        <input type="hidden" name="email" value="patient@telederm.com">
                        <input type="hidden" name="password" value="PatientPass123!">
                        <button type="submit" class="btn btn--subtle btn--sm">Parent</button>
                    </form>
                    <form method="POST" action="{{ route('login.post') }}" style="margin:0">
                        @csrf
                        <input type="hidden" name="email" value="doctor@telederm.com">
                        <input type="hidden" name="password" value="DoctorPass123!">
                        <button type="submit" class="btn btn--subtle btn--sm">Doctor</button>
                    </form>
                    <form method="POST" action="{{ route('login.post') }}" style="margin:0">
                        @csrf
                        <input type="hidden" name="email" value="admin@telederm.com">
                        <input type="hidden" name="password" value="AdminPass123!">
                        <button type="submit" class="btn btn--subtle btn--sm">Admin</button>
                    </form>
                </div>
            </div>

            <div class="auth__divider">New to teledermpeds?</div>

            <a href="{{ route('register') }}" class="btn btn--ghost btn--block">Create an account</a>
        </form>
    </div>

</div>
</body>
</html>
