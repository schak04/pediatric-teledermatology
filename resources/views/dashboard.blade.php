@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-slate-900 overflow-hidden shadow-sm rounded-xl border border-slate-200 dark:border-slate-800">
            <div class="p-8 text-slate-900 dark:text-white">
                <h1 class="text-2xl font-bold mb-4">Welcome, {{ auth()->user()->name }}!</h1>
                <p class="text-slate-600 dark:text-slate-400">
                    You are logged in as a <span class="font-semibold text-blue-600 capitalize">{{ auth()->user()->role }}</span>.
                </p>

                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if(auth()->user()->role === 'patient')
                        <div class="p-6 bg-slate-50 dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700">
                            <h2 class="font-bold text-lg mb-2">My Cases</h2>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-4">View your consultation history and status.</p>
                            <a href="{{ route('cases.index') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 transition-colors">View Cases</a>
                        </div>
                        <div class="p-6 bg-slate-50 dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700">
                            <h2 class="font-bold text-lg mb-2">New Consultation</h2>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-4">Upload a new case for review.</p>
                            <a href="{{ route('cases.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 transition-colors">Submit Case</a>
                        </div>
                    @else
                        <div class="p-6 bg-slate-50 dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700">
                            <h2 class="font-bold text-lg mb-2">Pending Reviews</h2>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-4">Check cases waiting for your diagnosis.</p>
                            <a href="{{ route('cases.index') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 transition-colors">View Pending</a>
                        </div>
                        <div class="p-6 bg-slate-50 dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700">
                            <h2 class="font-bold text-lg mb-2">My History</h2>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-4">View cases you have already diagnosed.</p>
                            <a href="{{ route('cases.index') }}" class="inline-block px-4 py-2 bg-slate-200 dark:bg-slate-700 text-slate-900 dark:text-white rounded-md text-sm font-medium hover:bg-slate-300 dark:hover:bg-slate-600 transition-colors">View History</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
