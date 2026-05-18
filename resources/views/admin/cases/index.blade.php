@extends('layouts.app')

@section('content')
<div class="py-12 px-4">
    <div class="max-w-7xl mx-auto">
        @include('partials.breadcrumbs', ['items' => [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Case Monitoring'],
        ]])

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Global Case Monitoring</h1>
            <span class="text-xs uppercase tracking-widest text-slate-500 px-2 py-1 bg-slate-100 dark:bg-slate-800 rounded">Read-only</span>
        </div>

        <div class="flex flex-wrap gap-2 mb-6 text-sm">
            <a href="{{ route('admin.cases.index') }}"
               class="px-3 py-1.5 rounded-full border transition-colors {{ ! $status ? 'bg-blue-600 text-white border-blue-600' : 'bg-white dark:bg-slate-900 border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:border-blue-500' }}">
                All <span class="ml-1 opacity-75">({{ $counts['all'] }})</span>
            </a>
            <a href="{{ route('admin.cases.index', ['status' => 'pending']) }}"
               class="px-3 py-1.5 rounded-full border transition-colors {{ $status === 'pending' ? 'bg-amber-500 text-white border-amber-500' : 'bg-white dark:bg-slate-900 border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:border-amber-500' }}">
                Pending <span class="ml-1 opacity-75">({{ $counts['pending'] }})</span>
            </a>
            <a href="{{ route('admin.cases.index', ['status' => 'diagnosed']) }}"
               class="px-3 py-1.5 rounded-full border transition-colors {{ $status === 'diagnosed' ? 'bg-green-600 text-white border-green-600' : 'bg-white dark:bg-slate-900 border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:border-green-600' }}">
                Diagnosed <span class="ml-1 opacity-75">({{ $counts['diagnosed'] }})</span>
            </a>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
            @if($cases->isEmpty())
                <div class="p-12 text-center text-slate-500">No cases match this filter.</div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-600 dark:text-slate-400 uppercase tracking-wider text-xs">
                            <tr>
                                <th class="px-6 py-3 text-left font-semibold">Submitted</th>
                                <th class="px-6 py-3 text-left font-semibold">Patient</th>
                                <th class="px-6 py-3 text-left font-semibold">Doctor</th>
                                <th class="px-6 py-3 text-left font-semibold">Status</th>
                                <th class="px-6 py-3 text-left font-semibold">Description</th>
                                <th class="px-6 py-3 text-right font-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                            @foreach($cases as $case)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                                    <td class="px-6 py-4 text-slate-500 text-xs whitespace-nowrap">{{ $case->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 font-medium text-slate-900 dark:text-white whitespace-nowrap">
                                        {{ $case->user?->name ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-600 dark:text-slate-400 whitespace-nowrap">
                                        {{ $case->doctor?->name ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-[10px] font-bold rounded uppercase {{ $case->status === 'pending' ? 'bg-amber-100 dark:bg-amber-900/40 text-amber-800 dark:text-amber-200' : 'bg-green-100 dark:bg-green-900/40 text-green-800 dark:text-green-200' }}">
                                            {{ $case->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600 dark:text-slate-400 max-w-xs">
                                        <span class="line-clamp-1">{{ $case->description }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('admin.cases.show', $case) }}"
                                           class="px-3 py-1.5 text-xs font-semibold rounded-md text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors border border-transparent hover:border-blue-200 dark:hover:border-blue-800">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
