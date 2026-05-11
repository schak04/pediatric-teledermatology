@extends('layouts.app')

@section('content')
<div class="py-12 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">
                @if(auth()->user()->role === 'patient') My Consultation History @else All Patient Cases @endif
            </h1>
            @if(auth()->user()->role === 'patient')
                <a href="{{ route('cases.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">New Case</a>
            @endif
        </div>

        @if($cases->isEmpty())
            <div class="bg-white dark:bg-slate-900 p-12 text-center rounded-xl border border-slate-200 dark:border-slate-800">
                <p class="text-slate-500">No cases found.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($cases as $case)
                    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
                        <div class="aspect-video w-full bg-slate-100 dark:bg-slate-800 overflow-hidden">
                            <img src="{{ asset('storage/' . $case->image_path) }}" alt="Dermatology Case" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <span class="px-2 py-1 text-xs font-bold rounded {{ $case->status === 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-green-100 text-green-700' }} uppercase">
                                    {{ $case->status }}
                                </span>
                                <span class="text-xs text-slate-500">{{ $case->created_at->format('M d, Y') }}</span>
                            </div>
                            <p class="text-slate-700 dark:text-slate-300 text-sm line-clamp-2 mb-4">
                                {{ $case->description }}
                            </p>
                            <a href="{{ route('cases.show', $case) }}" class="text-blue-600 dark:text-blue-400 text-sm font-semibold hover:underline">
                                View Details &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
