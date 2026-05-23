@extends('layouts.app')

@section('content')
<div class="page">
    <div class="row" style="margin-bottom:20px">
        <a href="{{ route('cases.index') }}" class="btn btn--ghost btn--sm">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 6-6 6 6 6"/></svg>
            Back to cases
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
        <!-- Main column -->
        <div class="case-detail__main">

            <!-- Photo viewer -->
            @php
                $images = $case->images->count() ? $case->images : ($case->image_path ? collect([['id'=>0,'path'=>$case->image_path]]) : collect());
            @endphp
            @if($images->count())
            <div class="photo-viewer">
                <div class="photo-viewer__main" id="photo-main">
                    <img src="{{ asset('storage/' . ($images->first()['path'] ?? $images->first()->path)) }}" id="photo-main-img" alt="Case photo">
                </div>
                @if($images->count() > 1)
                <div class="photo-viewer__thumbs">
                    @foreach($images as $i => $img)
                    @php $path = is_array($img) ? $img['path'] : $img->path; @endphp
                    <button class="photo-viewer__thumb {{ $i === 0 ? 'is-on' : '' }}" id="thumb-{{ $i }}" onclick="setPhoto('{{ asset('storage/' . $path) }}', {{ $i }}, {{ $images->count() }})">
                        <img src="{{ asset('storage/' . $path) }}" alt="Photo {{ $i+1 }}">
                    </button>
                    @endforeach
                </div>
                @endif
            </div>
            @endif

            <!-- Diagnosis box -->
            @if($case->diagnosis_condition || $case->diagnosis)
            <div class="diagnosis-box">
                <div class="diagnosis-box__head">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 3v6a4 4 0 0 0 8 0V3M5 3h2M11 3h2M9 13v3a4 4 0 0 0 8 0v-2"/><circle cx="17" cy="14" r="2"/></svg>
                    <h2 class="diagnosis-box__title">{{ $case->diagnosis_condition ?? $case->diagnosis }}</h2>
                    @if($case->icd_code)
                    <span class="diagnosis-box__icd">{{ $case->icd_code }}</span>
                    @endif
                </div>

                @if($case->diagnosis_summary)
                <p style="color:var(--ink-2);margin:0 0 16px;line-height:1.55">{{ $case->diagnosis_summary }}</p>
                @endif

                @if($case->treatment_steps && count($case->treatment_steps))
                <div class="card card--soft" style="padding:16px">
                    <div class="fw-600 text-sm" style="margin-bottom:10px;color:var(--ink)">Treatment plan</div>
                    <ol style="margin:0;padding-left:20px;color:var(--ink-2);display:flex;flex-direction:column;gap:8px">
                        @foreach($case->treatment_steps as $step)
                        <li>{{ $step }}</li>
                        @endforeach
                    </ol>
                </div>
                @elseif($case->treatment)
                <div class="card card--soft" style="padding:16px">
                    <div class="fw-600 text-sm" style="margin-bottom:10px;color:var(--ink)">Treatment plan</div>
                    <p style="color:var(--ink-2);margin:0;line-height:1.55">{{ $case->treatment }}</p>
                </div>
                @endif

                @if($case->doctor)
                <div class="row" style="margin-top:14px;font-size:13px">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-7 8-7s8 3 8 7"/></svg>
                    <span class="fw-600">{{ $case->doctor->name }}</span>
                    <span class="spacer"></span>
                    @if($case->follow_up)
                    <span class="muted">Follow-up: {{ $case->follow_up }}</span>
                    @endif
                </div>
                @endif
            </div>
            @endif

            <!-- Needs more info callout -->
            @if($case->status === 'needs_info' && $case->info_request && auth()->user()->role === 'patient')
            <div class="card" style="padding:20px;border-left:3px solid var(--status-danger)">
                <div class="row" style="margin-bottom:10px">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.4 8.4 0 0 1-1 4 8.5 8.5 0 0 1-7.6 4.5 8.4 8.4 0 0 1-4-1L3 21l1.9-5.4a8.4 8.4 0 0 1-1-4 8.5 8.5 0 0 1 4.5-7.6 8.4 8.4 0 0 1 4-1A8.5 8.5 0 0 1 21 11.5z"/></svg>
                    <span class="fw-600">A question from your doctor</span>
                </div>
                <p style="color:var(--ink-2);margin:0 0 14px;line-height:1.55">{{ $case->info_request }}</p>

                @if($case->info_reply)
                <div class="callout" style="margin-bottom:14px">
                    <div class="callout__icon" style="background:var(--status-diagnosed)">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>
                    </div>
                    <div><div class="fw-600" style="margin-bottom:2px">Your reply was sent</div><div>{{ $case->info_reply }}</div></div>
                </div>
                @else
                <form method="POST" action="{{ route('cases.reply', $case) }}" enctype="multipart/form-data" style="display:flex;flex-direction:column;gap:12px">
                    @csrf
                    <div class="field">
                        <textarea class="textarea" name="info_reply" placeholder="Type your reply…" required></textarea>
                    </div>
                    <div class="field">
                        <label class="label text-sm">Additional photos (optional)</label>
                        <input type="file" name="reply_images[]" multiple accept="image/jpeg,image/png" class="input" style="padding:8px">
                    </div>
                    <div class="row" style="justify-content:flex-end">
                        <button class="btn btn--primary" type="submit">Send reply</button>
                    </div>
                </form>
                @endif
            </div>
            @endif

            <!-- Status callouts -->
            @if($case->status === 'in_review')
            <div class="callout">
                <div class="callout__icon">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                </div>
                <div>
                    <div class="fw-600" style="color:var(--ink);margin-bottom:2px">Your case is being reviewed</div>
                    <div>A doctor is currently reviewing your case. You'll be notified when there's an update.</div>
                </div>
            </div>
            @elseif($case->status === 'submitted')
            <div class="callout">
                <div class="callout__icon">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>
                </div>
                <div>
                    <div class="fw-600" style="color:var(--ink);margin-bottom:2px">Case received</div>
                    <div>We've received your consultation. A doctor will review it shortly — usually within 24 hours.</div>
                </div>
            </div>
            @endif

            <!-- What you reported -->
            @if($case->symptoms || $case->severity || $case->body_location)
            <div class="card" style="padding:20px">
                <h3 class="section-h">What you reported</h3>
                <dl class="kv">
                    @if($case->symptoms)<dt>Symptoms</dt><dd>{{ implode(', ', $case->symptoms) }}</dd>@endif
                    @if($case->severity)<dt>Severity</dt><dd>@include('cases.partials.severity-scale', ['value' => $case->severity])</dd>@endif
                    @if($case->duration)<dt>Duration</dt><dd>{{ $case->duration }}</dd>@endif
                    @if($case->body_location)<dt>Body location</dt><dd>{{ $case->body_location }}</dd>@endif
                    @if($case->additional_notes)<dt>Notes</dt><dd>{{ $case->additional_notes }}</dd>@endif
                </dl>
            </div>
            @endif
        </div>

        <!-- Side column -->
        <div class="case-detail__side">
            <div class="card" style="padding:20px">
                <h3 class="section-h">Patient</h3>
                <dl class="kv">
                    @if($case->child_name)<dt>Name</dt><dd>{{ $case->child_name }}</dd>@endif
                    @if($case->child_age)<dt>Age</dt><dd>{{ $case->child_age }} {{ $case->child_age_unit }}</dd>@endif
                    @if($case->sex)<dt>Sex</dt><dd>{{ $case->sex === 'F' ? 'Female' : 'Male' }}</dd>@endif
                    <dt>Guardian</dt><dd>{{ $case->user->name }}</dd>
                </dl>
            </div>

            @if($case->medications || $case->allergies || $case->prior_conditions || $case->family_history)
            <div class="card" style="padding:20px">
                <h3 class="section-h">Medical context</h3>
                <dl class="kv">
                    @if($case->medications)<dt>Medications</dt><dd>{{ $case->medications }}</dd>@endif
                    @if($case->allergies)<dt>Allergies</dt><dd>{{ $case->allergies }}</dd>@endif
                    @if($case->prior_conditions)<dt>Prior conditions</dt><dd>{{ $case->prior_conditions }}</dd>@endif
                    @if($case->family_history)<dt>History</dt><dd>{{ $case->family_history }}</dd>@endif
                </dl>
            </div>
            @endif

            <div class="card card--soft" style="padding:16px;display:flex;flex-direction:column;gap:6px">
                <div class="row text-sm">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 8h.01M12 12v4"/></svg>
                    <span class="fw-600">Need help?</span>
                </div>
                <div class="muted text-sm">If your child has trouble breathing, severe pain, or rapidly worsening symptoms, please call 911 or go to the nearest emergency room.</div>
            </div>
        </div>
    </div>
</div>

<script>
function setPhoto(src, idx, total) {
    document.getElementById('photo-main-img').src = src;
    for (let i = 0; i < total; i++) {
        const t = document.getElementById('thumb-' + i);
        if (t) t.classList.toggle('is-on', i === idx);
    }
}
</script>
@endsection
