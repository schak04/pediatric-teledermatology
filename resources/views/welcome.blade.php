@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center py-12 text-center">
    <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white sm:text-6xl">
        Welcome to TeleDerm <span class="text-blue-600">Peds</span>
    </h1>
    <p class="mt-6 text-lg leading-8 text-slate-600 dark:text-slate-400 max-w-2xl">
        Because every child deserves healthy skin. Our platform connects parents with professional dermatologists for remote consultations.
    </p>
    <div class="mt-10 flex items-center justify-center gap-x-6">
        @auth
            <a href="{{ url('/dashboard') }}" class="rounded-md bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                Go to Dashboard
            </a>
        @else
            <a href="{{ route('register') }}" class="rounded-md bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                Get Started
            </a>
            <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-slate-900 dark:text-white">
                Log in <span aria-hidden="true">→</span>
            </a>
        @endauth
    </div>
</div>
@endsection
