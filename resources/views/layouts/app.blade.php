<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TeleDermPeds') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;500;600;700&family=Fraunces:opsz,wght,SOFT@9..144,300..600,30..100&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="app">

    <header class="app-header">
        <div class="app-header__inner">
            <a href="{{ auth()->check() ? route('dashboard') : url('/') }}" style="text-decoration:none">
                <div class="brand">
                    <div class="brand__mark">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 21s-7-4.5-7-11a5 5 0 0 1 7-4.5A5 5 0 0 1 19 10c0 6.5-7 11-7 11z" fill="currentColor" stroke="none" opacity="0.25"/>
                            <path d="M8 11.5h2.5l1.5-3 1.5 5 1-2H16"/>
                        </svg>
                    </div>
                    <span>TeleDermPeds</span>
                </div>
            </a>

            @auth
            <nav class="nav">
                @if(auth()->user()->role === 'patient')
                    <a href="{{ route('cases.index') }}" class="nav__item {{ request()->routeIs('cases.index') ? 'is-active' : '' }}">My cases</a>
                    <a href="{{ route('cases.create') }}" class="nav__item {{ request()->routeIs('cases.create') ? 'is-active' : '' }}">New consultation</a>
                @elseif(auth()->user()->role === 'doctor')
                    <a href="{{ route('cases.index') }}" class="nav__item {{ request()->routeIs('cases.index') ? 'is-active' : '' }}">Case queue</a>
                @elseif(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.users.index') }}" class="nav__item {{ request()->routeIs('admin.users.*') ? 'is-active' : '' }}">Users</a>
                    <a href="{{ route('admin.cases.index') }}" class="nav__item {{ request()->routeIs('admin.cases.*') ? 'is-active' : '' }}">All cases</a>
                @endif
            </nav>
            @endauth

            <div class="header__spacer"></div>

            <div class="header__right">
                @auth
                <div class="role-chip">
                    <span>{{ auth()->user()->name }}</span>
                    <span class="role-chip__role">{{ strtoupper(auth()->user()->role) }}</span>
                </div>
                <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}{{ strtoupper(substr(strstr(auth()->user()->name, ' '), 1, 1)) }}</div>
                <form method="POST" action="{{ route('logout') }}" style="margin:0">
                    @csrf
                    <button type="submit" class="btn btn--ghost btn--sm">Sign out</button>
                </form>
                @else
                <a href="{{ route('login') }}" class="btn btn--ghost btn--sm">Sign in</a>
                <a href="{{ route('register') }}" class="btn btn--primary btn--sm">Get started</a>
                @endauth
            </div>
        </div>
    </header>

    <main style="flex:1">
        @if(session('success'))
        <div style="padding: 0 28px; padding-top: 16px; max-width: 1280px; margin: 0 auto;">
            <div class="flash flash--success">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>
                {{ session('success') }}
            </div>
        </div>
        @endif
        @if(session('error') || $errors->any())
        <div style="padding: 0 28px; padding-top: 16px; max-width: 1280px; margin: 0 auto;">
            <div class="flash flash--error">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 8v4M12 16h.01"/></svg>
                {{ session('error') ?? $errors->first() }}
            </div>
        </div>
        @endif

        @yield('content')
    </main>

    <footer style="padding: 24px 28px; border-top: 1px solid var(--divider); text-align: center; font-size: 13px; color: var(--ink-4);">
        &copy; {{ date('Y') }} TeleDermPeds &mdash; Pediatric dermatology, delivered.
    </footer>
</div>
</body>
</html>
