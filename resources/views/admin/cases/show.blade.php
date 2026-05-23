@extends('layouts.app')

@section('content')
<!-- Read-only banner -->
<div class="readonly-banner">
    <div class="readonly-banner__inner">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 8h.01M12 12v4"/></svg>
        <span class="fw-600">Read-only view</span>
        <span>— Admins can view any case for compliance, but cannot modify cases or diagnoses.</span>
    </div>
</div>

{{-- Reuse patient case detail layout --}}
<div class="page">
    <div class="row" style="margin-bottom:20px">
        <a href="{{ route('admin.cases.index') }}" class="btn btn--ghost btn--sm">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 6-6 6 6 6"/></svg>
            Back to all cases
        </a>
        <span class="muted text-sm">Case #{{ $case->id }}</span>
    </div>

    <div class="page__head">
        <div>
            <div class="row" style="gap:10px;margin-bottom:8px">
                <span class="badge {{ $case->status_class }}">{{ $case->status_label }}</span>
                <span class="muted text-sm">Submitted {{ $case->created_at->format('M d, Y') }}</span>
            </div>
            <h1 class="page__title">{{ $case->title ?? $case->description }}</h1>
            @if($case->child_name)
            <p class="page__sub">For {{ $case->child_name }}, age {{ $case->child_age }} {{ $case->child_age_unit }} · {{ $case->body_location }}</p>
            @endif
        </div>
    </div>

    <div class="case-detail">
        <div class="case-detail__main">
            @php
                $images = $case->images->count() ? $case->images : ($case->image_path ? collect([(object)['id'=>0,'path'=>$case->image_path]]) : collect());
            @endphp
            @if($images->count())
            <div class="photo-viewer">
                <div class="photo-viewer__main">
                    <img src="{{ asset('storage/' . $images->first()->path) }}" id="admin-photo-main" alt="Case photo">
                </div>
                @if($images->count() > 1)
                <div class="photo-viewer__thumbs">
                    @foreach($images as $i => $img)
                    <button class="photo-viewer__thumb {{ $i === 0 ? 'is-on' : '' }}" id="athumb-{{ $i }}" onclick="setPhoto('{{ asset('storage/' . $img->path) }}', {{ $i }}, {{ $images->count() }})">
                        <img src="{{ asset('storage/' . $img->path) }}" alt="">
                    </button>
                    @endforeach
                </div>
                @endif
            </div>
            @endif

            @if($case->diagnosis_condition || $case->diagnosis)
            <div class="diagnosis-box">
                <div class="diagnosis-box__head">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 3v6a4 4 0 0 0 8 0V3M5 3h2M11 3h2M9 13v3a4 4 0 0 0 8 0v-2"/><circle cx="17" cy="14" r="2"/></svg>
                    <h2 class="diagnosis-box__title">{{ $case->diagnosis_condition ?? $case->diagnosis }}</h2>
                    @if($case->icd_code)<span class="diagnosis-box__icd">{{ $case->icd_code }}</span>@endif
                </div>
                @if($case->diagnosis_summary)<p style="color:var(--ink-2);margin:0 0 16px;line-height:1.55">{{ $case->diagnosis_summary }}</p>@endif
                @if($case->treatment_steps && count($case->treatment_steps))
                <div class="card card--soft" style="padding:16px">
                    <div class="fw-600 text-sm" style="margin-bottom:10px">Treatment plan</div>
                    <ol style="margin:0;padding-left:20px;color:var(--ink-2);display:flex;flex-direction:column;gap:8px">
                        @foreach($case->treatment_steps as $step)<li>{{ $step }}</li>@endforeach
                    </ol>
                </div>
                @elseif($case->treatment)
                <div class="card card--soft" style="padding:16px"><p style="margin:0;color:var(--ink-2)">{{ $case->treatment }}</p></div>
                @endif
                @if($case->doctor)
                <div class="row" style="margin-top:14px;font-size:13px">
                    <span class="fw-600">{{ $case->doctor->name }}</span>
                    <span class="spacer"></span>
                    @if($case->follow_up)<span class="muted">Follow-up: {{ $case->follow_up }}</span>@endif
                </div>
                @endif
            </div>
            @endif

            @if($case->symptoms || $case->severity)
            <div class="card" style="padding:20px">
                <h3 class="section-h">Patient-reported details</h3>
                <dl class="kv">
                    @if($case->symptoms)<dt>Symptoms</dt><dd>{{ implode(', ', $case->symptoms) }}</dd>@endif
                    @if($case->severity)<dt>Severity</dt><dd>@include('cases.partials.severity-scale', ['value' => $case->severity])</dd>@endif
                    @if($case->duration)<dt>Duration</dt><dd>{{ $case->duration }}</dd>@endif
                    @if($case->body_location)<dt>Location</dt><dd>{{ $case->body_location }}</dd>@endif
                    @if($case->additional_notes)<dt>Notes</dt><dd>{{ $case->additional_notes }}</dd>@endif
                </dl>
            </div>
            @endif
        </div>

        <div class="case-detail__side">
            <div class="card" style="padding:20px">
                <h3 class="section-h">Patient</h3>
                <dl class="kv">
                    @if($case->child_name)<dt>Name</dt><dd>{{ $case->child_name }}</dd>@endif
                    @if($case->child_age)<dt>Age</dt><dd>{{ $case->child_age }} {{ $case->child_age_unit }}</dd>@endif
                    @if($case->sex)<dt>Sex</dt><dd>{{ $case->sex === 'F' ? 'Female' : 'Male' }}</dd>@endif
                    <dt>Guardian</dt><dd>{{ $case->user->name }}</dd>
                    <dt>Email</dt><dd>{{ $case->user->email }}</dd>
                </dl>
            </div>
            @if($case->medications || $case->allergies || $case->prior_conditions)
            <div class="card" style="padding:20px">
                <h3 class="section-h">Medical context</h3>
                <dl class="kv">
                    @if($case->medications)<dt>Medications</dt><dd>{{ $case->medications }}</dd>@endif
                    @if($case->allergies)<dt>Allergies</dt><dd>{{ $case->allergies }}</dd>@endif
                    @if($case->prior_conditions)<dt>Conditions</dt><dd>{{ $case->prior_conditions }}</dd>@endif
                    @if($case->family_history)<dt>Family</dt><dd>{{ $case->family_history }}</dd>@endif
                </dl>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
function setPhoto(src, idx, total) {
    document.getElementById('admin-photo-main').src = src;
    for (let i = 0; i < total; i++) {
        const t = document.getElementById('athumb-' + i);
        if (t) t.classList.toggle('is-on', i === idx);
    }
}
</script>
@endsection
