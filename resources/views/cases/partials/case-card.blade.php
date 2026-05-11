<div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden transition-all hover:shadow-md">
    <div class="aspect-video w-full bg-slate-100 dark:bg-slate-800 overflow-hidden relative">
        <img src="{{ asset('storage/' . $case->image_path) }}" alt="Case Image" class="w-full h-full object-cover">
        <div class="absolute top-2 right-2">
            <span class="px-2 py-1 text-[10px] font-bold rounded shadow-sm {{ $case->status === 'pending' ? 'bg-amber-500 text-white' : 'bg-green-600 text-white' }} uppercase">
                {{ $case->status }}
            </span>
        </div>
    </div>
    <div class="p-6">
        <div class="flex justify-between items-center mb-3">
            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ $case->created_at->format('M d, Y') }}</span>
            @if(auth()->user()->role === 'doctor')
                <span class="text-[10px] font-medium text-slate-400">Patient: {{ $case->user->name }}</span>
            @endif
        </div>
        <p class="text-slate-700 dark:text-slate-300 text-sm line-clamp-2 mb-6 h-10">
            {{ $case->description }}
        </p>
        <a href="{{ route('cases.show', $case) }}" class="inline-flex items-center text-blue-600 dark:text-blue-400 text-sm font-bold hover:gap-2 transition-all">
            View Details 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        </a>
    </div>
</div>
