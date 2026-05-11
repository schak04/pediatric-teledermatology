@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-12 px-4">
    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 p-8">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">New Consultation</h1>
        <p class="text-slate-600 dark:text-slate-400 mb-8">Please provide a clear image of the skin condition and a brief description.</p>
        
        <form method="POST" action="{{ route('cases.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div>
                <label for="image" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Patient's Case Image</label>
                <input type="file" name="image" id="image" required
                    class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-700 dark:file:text-slate-300">
                <p class="mt-1 text-xs text-slate-500">Supported formats: JPG, PNG. Max size: 5MB.</p>
                @error('image') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Short Description</label>
                <textarea name="description" id="description" rows="4" required placeholder="Describe the symptoms, duration, etc."
                    class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all">{{ old('description') }}</textarea>
                @error('description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors shadow-sm focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 outline-none">
                    Submit Case
                </button>
                <a href="{{ route('dashboard') }}" class="text-sm font-medium text-slate-600 dark:text-slate-400 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
