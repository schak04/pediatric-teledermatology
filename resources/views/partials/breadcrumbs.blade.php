@php
    /** @var array $items each ['label' => string, 'url' => ?string] */
    $items = $items ?? [];
@endphp

@if(! empty($items))
<nav aria-label="Breadcrumb" class="mb-6">
    <ol class="flex flex-wrap items-center gap-1.5 text-sm text-slate-500 dark:text-slate-400">
        @foreach($items as $i => $item)
            <li class="flex items-center gap-1.5">
                @if(! empty($item['url']) && ! $loop->last)
                    <a href="{{ $item['url'] }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                        {{ $item['label'] }}
                    </a>
                @else
                    <span class="text-slate-900 dark:text-slate-200 font-medium" @if($loop->last) aria-current="page" @endif>
                        {{ $item['label'] }}
                    </span>
                @endif
                @unless($loop->last)
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 dark:text-slate-600"><path d="m9 18 6-6-6-6"/></svg>
                @endunless
            </li>
        @endforeach
    </ol>
</nav>
@endif
