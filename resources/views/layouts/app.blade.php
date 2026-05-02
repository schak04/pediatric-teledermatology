<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TeleDermPeds') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 transition-colors duration-300">
    <div class="min-h-screen flex flex-col">
        
        <!-- nav -->
        <nav class="sticky top-0 z-50 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center gap-2">
                        <a href="{{ url('/') }}" class="flex items-center gap-2">
                            <span class="text-xl font-bold tracking-tight">TeleDerm <span class="text-blue-600">Peds</span></span>
                        </a>
                    </div>
                    
                    <div class="flex items-center gap-6">
                        <div class="hidden md:flex items-center gap-4 text-sm font-medium">
                            <a href="{{ url('/') }}" class="hover:text-blue-600 transition-colors">Home</a>
                            @auth
                                <a href="{{ url('/dashboard') }}" class="hover:text-blue-600 transition-colors">Dashboard</a>
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="hover:text-blue-600 transition-colors">Logout</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="hover:text-blue-600 transition-colors">Login</a>
                                <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Get Started</a>
                            @endauth
                        </div>

                        <button 
                            onclick="toggleTheme()"
                            class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
                            aria-label="Toggle Theme"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="block dark:hidden"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden dark:block"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- main content -->
        <main class="flex-grow max-w-7xl mx-auto w-full py-6 px-4 sm:px-6 lg:px-8">
            @yield('content')
        </main>

        <!-- footer -->
        <footer class="mt-auto py-8 border-t border-slate-200 dark:border-slate-800 text-center text-sm text-slate-500">
            &copy; {{ date('Y') }} TeleDermPeds. All rights reserved.
        </footer>
    </div>
</body>
</html>
