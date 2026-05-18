@extends('layouts.app')

@section('content')
<div class="py-12 px-4">
    <div class="max-w-7xl mx-auto">
        @include('partials.breadcrumbs', ['items' => [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'User Management'],
        ]])

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">User Management</h1>
            <span class="text-sm text-slate-500">Total: {{ $users->count() }}</span>
        </div>

        <div class="flex flex-wrap gap-2 mb-6 text-sm">
            <a href="{{ route('admin.users.index') }}"
               class="px-3 py-1.5 rounded-full border transition-colors {{ ! request('role') ? 'bg-blue-600 text-white border-blue-600' : 'bg-white dark:bg-slate-900 border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:border-blue-500' }}">
                All
            </a>
            @foreach(['admin','doctor','patient'] as $r)
                <a href="{{ route('admin.users.index', ['role' => $r]) }}"
                   class="px-3 py-1.5 rounded-full border capitalize transition-colors {{ request('role') === $r ? 'bg-blue-600 text-white border-blue-600' : 'bg-white dark:bg-slate-900 border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:border-blue-500' }}">
                    {{ $r }}s
                </a>
            @endforeach
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
            @if($users->isEmpty())
                <div class="p-12 text-center text-slate-500">No users found.</div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-600 dark:text-slate-400 uppercase tracking-wider text-xs">
                            <tr>
                                <th class="px-6 py-3 text-left font-semibold">Name</th>
                                <th class="px-6 py-3 text-left font-semibold">Email</th>
                                <th class="px-6 py-3 text-left font-semibold">Role</th>
                                <th class="px-6 py-3 text-left font-semibold">Joined</th>
                                <th class="px-6 py-3 text-right font-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                            @foreach($users as $user)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                                    <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">{{ $user->name }}</td>
                                    <td class="px-6 py-4 text-slate-600 dark:text-slate-400">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        @php
                                            $roleClass = match($user->role) {
                                                'admin' => 'bg-purple-100 dark:bg-purple-900/40 text-purple-800 dark:text-purple-200',
                                                'doctor' => 'bg-blue-100 dark:bg-blue-900/40 text-blue-800 dark:text-blue-200',
                                                default => 'bg-emerald-100 dark:bg-emerald-900/40 text-emerald-800 dark:text-emerald-200',
                                            };
                                        @endphp
                                        <span class="px-2 py-1 text-[10px] font-bold rounded uppercase {{ $roleClass }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500 text-xs">{{ $user->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 text-right">
                                        @if($user->id === auth()->id())
                                            <span class="text-xs text-slate-400 italic">You</span>
                                        @else
                                            <form method="POST"
                                                  action="{{ route('admin.users.destroy', $user) }}"
                                                  class="inline"
                                                  onsubmit="return confirm('Delete user {{ addslashes($user->name) }} ({{ $user->email }})? This cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-3 py-1.5 text-xs font-semibold rounded-md text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors border border-transparent hover:border-red-200 dark:hover:border-red-800">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
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
