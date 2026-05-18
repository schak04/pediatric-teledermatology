@extends('layouts.app')

@section('content')
<div class="py-12 px-4">
    <div class="max-w-7xl mx-auto">
        @include('partials.breadcrumbs', ['items' => [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => auth()->user()->role === 'patient' ? 'My Cases' : 'All Cases'],
        ]])

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">
                @if(auth()->user()->role === 'patient') My Consultation History @else Clinical Dashboard @endif
            </h1>
            @if(auth()->user()->role === 'patient')
                <a href="{{ route('cases.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">New Case</a>
            @endif
        </div>

        @if(auth()->user()->role === 'patient')
            <!-- Patient View -->
            @if($cases->isEmpty())
                <div class="bg-white dark:bg-slate-900 p-12 text-center rounded-xl border border-slate-200 dark:border-slate-800">
                    <p class="text-slate-500">You haven't submitted any cases yet.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($cases as $case)
                        @include('cases.partials.case-card', ['case' => $case])
                    @endforeach
                </div>
            @endif
        @else
            <!-- Doctor View -->
            <div class="space-y-12">
                <!-- Pending Section -->
                <section>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                        <h2 class="text-lg font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider text-sm">Pending Reviews</h2>
                    </div>
                    @if($pendingCases->isEmpty())
                        <div class="bg-slate-100 dark:bg-slate-900/50 p-8 text-center rounded-xl border border-dashed border-slate-300 dark:border-slate-700">
                            <p class="text-slate-500 text-sm">No pending cases at the moment. Great job!</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($pendingCases as $case)
                                @include('cases.partials.case-card', ['case' => $case])
                            @endforeach
                        </div>
                    @endif
                </section>

                <!-- Diagnosed Section -->
                <section>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-2 h-2 rounded-full bg-green-500"></div>
                        <h2 class="text-lg font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider text-sm">Completed Consultations</h2>
                    </div>
                    @if($diagnosedCases->isEmpty())
                        <div class="bg-slate-100 dark:bg-slate-900/50 p-8 text-center rounded-xl border border-dashed border-slate-300 dark:border-slate-700">
                            <p class="text-slate-500 text-sm">No completed consultations yet.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 opacity-80">
                            @foreach($diagnosedCases as $case)
                                @include('cases.partials.case-card', ['case' => $case])
                            @endforeach
                        </div>
                    @endif
                </section>
            </div>
        @endif
    </div>
</div>
@endsection
