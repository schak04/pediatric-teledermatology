@extends('layouts.app')

@section('content')
<div class="py-12 px-4">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('cases.index') }}" class="text-sm font-medium text-blue-600 hover:underline">&larr; Back to Cases</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Case Image -->
            <div>
                <div class="bg-white dark:bg-slate-900 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-800 shadow-sm">
                    <img src="{{ asset('storage/' . $case->image_path) }}" alt="Dermatology Case" class="w-full h-auto">
                </div>
            </div>

            <!-- Case Details -->
            <div class="space-y-6">
                <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white">Case Information</h2>
                        <span class="px-2 py-1 text-xs font-bold rounded {{ $case->status === 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-green-100 text-green-700' }} uppercase">
                            {{ $case->status }}
                        </span>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Patient</p>
                            <p class="text-slate-900 dark:text-white">{{ $case->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Submitted On</p>
                            <p class="text-slate-900 dark:text-white">{{ $case->created_at->format('F d, Y \a\t H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Description</p>
                            <p class="text-slate-700 dark:text-slate-300">{{ $case->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4">Doctor's Assessment</h2>
                    
                    @if($case->status === 'diagnosed')
                        <div class="space-y-4">
                            <div>
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Diagnosis</p>
                                <p class="text-slate-900 dark:text-white font-medium">{{ $case->diagnosis }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Treatment Plan</p>
                                <p class="text-slate-700 dark:text-slate-300">{{ $case->treatment }}</p>
                            </div>
                        </div>
                    @else
                        @if(auth()->user()->role === 'doctor')
                            <form method="POST" action="{{ route('cases.diagnose', $case) }}" class="space-y-4">
                                @csrf
                                <div class="flex justify-between items-center mb-2">
                                    <label for="diagnosis" class="text-xs font-bold text-slate-500 uppercase tracking-wider">Diagnosis</label>
                                </div>
                                <input type="text" name="diagnosis" id="diagnosis" required
                                    class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all">
                                
                                <div>
                                    <label for="treatment" class="text-xs font-bold text-slate-500 uppercase tracking-wider">Treatment Plan</label>
                                    <textarea name="treatment" id="treatment" rows="4" required
                                        class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all"></textarea>
                                </div>

                                <button type="submit" class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors">
                                    Submit Final Assessment
                                </button>
                            </form>
                        @else
                            <div class="flex items-center gap-3 p-4 bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400 rounded-lg border border-amber-200 dark:border-amber-800/50">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                <p class="text-sm">Pending doctor's review. You will be notified once a diagnosis is added.</p>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
