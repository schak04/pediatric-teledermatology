@php
    $href = auth()->user()->role === 'doctor'
        ? route('cases.review', $case)
        : route('cases.show', $case);

    $showPatient = $showPatient ?? true;
    $firstImage = $case->images->first() ?? null;
@endphp

<a href="{{ $href }}" class="case-card" style="text-decoration:none;color:inherit">
    <div class="case-card__photo">
        @if($firstImage)
            <img src="{{ asset('storage/' . $firstImage->path) }}" alt="Case photo">
        @elseif($case->image_path)
            <img src="{{ asset('storage/' . $case->image_path) }}" alt="Case photo">
        @else
            <div class="case-card__photo-placeholder">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8a2 2 0 0 1 2-2h2l2-2h6l2 2h2a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><circle cx="12" cy="13" r="4"/></svg>
            </div>
        @endif
        <div class="case-card__status">
            <span class="badge {{ $case->status_class }}">{{ $case->status_label }}</span>
        </div>
        @php $photoCount = $case->images->count() ?: ($case->image_path ? 1 : 0); @endphp
        @if($photoCount)
        <div class="case-card__count">{{ $photoCount }} photo{{ $photoCount > 1 ? 's' : '' }}</div>
        @endif
    </div>
    <div class="case-card__body">
        <div class="case-card__patient">
            @if($showPatient)
                <span class="case-card__name">{{ $case->child_name ?? $case->user->name }}</span>
                <span class="case-card__meta">{{ $case->child_age ? $case->child_age . ' ' . $case->child_age_unit : '' }}</span>
            @else
                <span class="case-card__name">#{{ $case->id }}</span>
                <span class="case-card__meta">{{ $case->created_at->diffForHumans() }}</span>
            @endif
        </div>
        <p class="case-card__title">{{ $case->title ?? $case->description }}</p>
        <div class="case-card__foot">
            <span class="muted">{{ $case->body_location ?? '' }}</span>
            @if($case->diagnosis_condition)
                <span class="fw-600" style="color:var(--brand-ink);font-size:12px">{{ $case->diagnosis_condition }}</span>
            @elseif($case->status === 'needs_info')
                <span class="fw-600" style="color:var(--status-danger);font-size:12px">Reply needed</span>
            @endif
        </div>
    </div>
</a>
