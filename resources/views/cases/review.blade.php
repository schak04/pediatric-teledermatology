@extends('layouts.app')

@section('content')

@php
    $images = $case->images->count() ? $case->images : ($case->image_path ? collect([(object)['id'=>0,'path'=>$case->image_path]]) : collect());
    $icdCodes = [
        ['code'=>'L20.9','label'=>'Atopic dermatitis, unspecified'],
        ['code'=>'L20.84','label'=>'Intrinsic (allergic) eczema'],
        ['code'=>'L25.9','label'=>'Contact dermatitis, unspecified'],
        ['code'=>'L01.0','label'=>'Impetigo, non-bullous'],
        ['code'=>'L01.03','label'=>'Bullous impetigo'],
        ['code'=>'B08.1','label'=>'Molluscum contagiosum'],
        ['code'=>'B35.4','label'=>'Tinea corporis'],
        ['code'=>'B35.0','label'=>'Tinea barbae and tinea capitis'],
        ['code'=>'L50.9','label'=>'Urticaria, unspecified'],
        ['code'=>'L70.0','label'=>'Acne vulgaris'],
        ['code'=>'B07.9','label'=>'Viral wart, unspecified'],
        ['code'=>'D22.5','label'=>'Melanocytic nevi of trunk'],
        ['code'=>'L40.9','label'=>'Psoriasis, unspecified'],
        ['code'=>'L21.0','label'=>'Seborrhea capitis (cradle cap)'],
        ['code'=>'L22','label'=>'Diaper dermatitis'],
    ];
@endphp

<div style="padding:16px 20px 0;max-width:100%">
    <div class="row" style="margin-bottom:14px">
        <a href="{{ route('cases.index') }}" class="btn btn--ghost btn--sm">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 6-6 6 6 6"/></svg>
            Queue
        </a>
        <span class="muted text-sm">Reviewing case #{{ $case->id }}</span>
        <span class="spacer"></span>
        <span class="text-sm muted">{{ $case->child_name ?? $case->user->name }}</span>
    </div>
</div>

<div style="padding:0 20px 40px">
    <div class="review-shell" style="max-height:calc(100vh - 130px)">

        <!-- LEFT — case list -->
        <div class="review-list">
            <div class="review-list__head">
                <div class="review-list__title">Open ({{ $reviewCases->count() }})</div>
            </div>
            <div class="review-list__items">
                @foreach($reviewCases as $rc)
                @php $rcFirst = $rc->images->first(); @endphp
                <a href="{{ route('cases.review', $rc) }}" class="review-item {{ $rc->id === $case->id ? 'is-on' : '' }}" style="text-decoration:none;color:inherit;display:flex">
                    <div class="review-item__thumb">
                        @if($rcFirst)
                        <img src="{{ asset('storage/' . $rcFirst->path) }}" alt="">
                        @elseif($rc->image_path)
                        <img src="{{ asset('storage/' . $rc->image_path) }}" alt="">
                        @endif
                    </div>
                    <div class="review-item__body">
                        <div class="review-item__name">
                            <span>{{ $rc->child_name ?? $rc->user->name }}</span>
                            <span class="review-item__time">{{ $rc->created_at->diffForHumans(null, true) }}</span>
                        </div>
                        <div class="review-item__sub">{{ $rc->child_age ? $rc->child_age . ' ' . $rc->child_age_unit . ' · ' : '' }}{{ $rc->body_location }}</div>
                        <span class="badge {{ $rc->status_class }}">{{ $rc->status_label }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        <!-- CENTER — case content -->
        <div class="review-center">
            <div class="review-center__head">
                <div>
                    <div class="row" style="gap:10px;margin-bottom:4px">
                        <span class="mono text-xs muted">#{{ $case->id }}</span>
                        <span class="badge {{ $case->status_class }}">{{ $case->status_label }}</span>
                    </div>
                    <div class="fw-600 text-lg">{{ $case->child_name ?? $case->user->name }}@if($case->child_age), {{ $case->child_age }} {{ $case->child_age_unit }}@endif</div>
                    <div class="text-sm muted">{{ $case->title ?? $case->description }}</div>
                </div>
                <div class="row">
                    <!-- Request info modal trigger -->
                    <button class="btn btn--ghost btn--sm" onclick="document.getElementById('info-modal').style.display='grid'">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.4 8.4 0 0 1-1 4 8.5 8.5 0 0 1-7.6 4.5 8.4 8.4 0 0 1-4-1L3 21l1.9-5.4a8.4 8.4 0 0 1-1-4 8.5 8.5 0 0 1 4.5-7.6 8.4 8.4 0 0 1 4-1A8.5 8.5 0 0 1 21 11.5z"/></svg>
                        Request info
                    </button>
                </div>
            </div>

            <div class="review-center__body">
                <!-- Photo grid -->
                @if($images->count())
                <div class="photo-grid">
                    <div class="photo-grid__hero">
                        @if($images->first()->path ?? null)
                        <img src="{{ asset('storage/' . $images->first()->path) }}" alt="Primary photo">
                        @else
                        <div class="photo-grid__hero-placeholder">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M3 8a2 2 0 0 1 2-2h2l2-2h6l2 2h2a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><circle cx="12" cy="13" r="4"/></svg>
                        </div>
                        @endif
                    </div>
                    <div class="photo-grid__side">
                        @foreach($images->slice(1, 2) as $img)
                        <div class="photo-grid__small">
                            <img src="{{ asset('storage/' . $img->path) }}" alt="">
                        </div>
                        @endforeach
                        @if($images->count() < 3)
                        @for($i = $images->count() - 1; $i < 2; $i++)
                        <div class="photo-grid__small" style="background:#1a1c25"></div>
                        @endfor
                        @endif
                    </div>
                </div>
                @endif

                <!-- Presenting complaint -->
                <div class="card" style="padding:18px">
                    <h3 class="section-h">Presenting complaint</h3>
                    <p style="margin:0 0 14px;color:var(--ink-2);line-height:1.55">{{ $case->title ?? $case->description }}</p>
                    <dl class="kv">
                        @if($case->body_location)<dt>Body location</dt><dd>{{ $case->body_location }}</dd>@endif
                        @if($case->duration)<dt>Duration</dt><dd>{{ $case->duration }}</dd>@endif
                        @if($case->symptoms)<dt>Symptoms</dt><dd>{{ implode(', ', $case->symptoms) }}</dd>@endif
                        @if($case->severity)<dt>Severity (parent)</dt><dd>@include('cases.partials.severity-scale', ['value' => $case->severity])</dd>@endif
                        @if($case->additional_notes)<dt>Notes</dt><dd>{{ $case->additional_notes }}</dd>@endif
                    </dl>
                </div>

                <!-- Medical history -->
                @if($case->medications || $case->allergies || $case->prior_conditions || $case->family_history)
                <div class="card" style="padding:18px">
                    <h3 class="section-h">Medical history</h3>
                    <dl class="kv">
                        <dt>Medications</dt><dd>{{ $case->medications ?: '—' }}</dd>
                        <dt>Allergies</dt><dd>{{ $case->allergies ?: '—' }}</dd>
                        <dt>Prior conditions</dt><dd>{{ $case->prior_conditions ?: '—' }}</dd>
                        <dt>History</dt><dd>{{ $case->family_history ?: '—' }}</dd>
                    </dl>
                </div>
                @endif

                <!-- Parent info_reply if any -->
                @if($case->info_request)
                <div class="card" style="padding:18px;border-left:3px solid var(--status-danger)">
                    <div class="fw-600 text-sm" style="margin-bottom:6px;color:var(--status-danger)">Information requested</div>
                    <p style="color:var(--ink-2);margin:0 0 10px">{{ $case->info_request }}</p>
                    @if($case->info_reply)
                    <div class="callout" style="margin-top:10px">
                        <div class="callout__icon" style="background:var(--status-diagnosed)">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>
                        </div>
                        <div><div class="fw-600" style="margin-bottom:2px;color:var(--ink)">Parent replied</div><div>{{ $case->info_reply }}</div></div>
                    </div>
                    @else
                    <span class="badge badge--needs-info">Awaiting reply</span>
                    @endif
                </div>
                @endif
            </div>
        </div>

        <!-- RIGHT — diagnosis form -->
        <div class="review-side">
            <div class="review-side__head">
                <div>
                    <div class="review-side__title">Diagnosis &amp; plan</div>
                    <div class="text-xs muted" style="margin-top:2px">Dr. {{ auth()->user()->name }}</div>
                </div>
                @if($case->diagnosis_condition)
                <span class="badge badge--diagnosed">Saved</span>
                @else
                <span class="badge badge--info">Draft</span>
                @endif
            </div>

            <div class="review-side__body">
                <form method="POST" action="{{ route('cases.diagnose', $case) }}" id="diag-form" style="display:flex;flex-direction:column;gap:16px">
                    @csrf

                    <!-- ICD-10 picker -->
                    <div class="field" style="position:relative">
                        <label class="label">ICD-10 code</label>
                        @php $currentIcd = old('icd_code', $case->icd_code ?? ''); @endphp
                        <button type="button" class="input row" style="text-align:left;cursor:pointer;justify-content:space-between" onclick="toggleIcdPicker()">
                            <span id="icd-display">
                                @if($currentIcd)
                                <span class="mono fw-600">{{ $currentIcd }}</span>
                                <span class="muted"> — {{ collect($icdCodes)->firstWhere('code', $currentIcd)['label'] ?? '' }}</span>
                                @else
                                <span class="muted">Search by code or condition…</span>
                                @endif
                            </span>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </button>
                        <input type="hidden" name="icd_code" id="icd-val" value="{{ $currentIcd }}">

                        <div class="icd-picker" id="icd-picker" style="display:none">
                            <div style="padding:8px;border-bottom:1px solid var(--divider)">
                                <div class="search">
                                    <svg class="search__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
                                    <input class="input" id="icd-search" placeholder="Search…" oninput="filterIcd(this.value)" autocomplete="off">
                                </div>
                            </div>
                            @foreach($icdCodes as $icd)
                            <button type="button" class="icd-picker__item" data-code="{{ $icd['code'] }}" data-label="{{ $icd['label'] }}" onclick="selectIcd('{{ $icd['code'] }}', '{{ addslashes($icd['label']) }}')">
                                <span class="mono fw-600" style="min-width:56px;color:var(--brand-ink)">{{ $icd['code'] }}</span>
                                <span>{{ $icd['label'] }}</span>
                            </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="field">
                        <label class="label" for="diagnosis_condition">Condition (plain language)</label>
                        <input class="input" type="text" name="diagnosis_condition" id="diagnosis_condition" value="{{ old('diagnosis_condition', $case->diagnosis_condition ?? '') }}" placeholder="e.g. Atopic dermatitis" required>
                        <span class="hint">This is what the parent will see.</span>
                    </div>

                    <div class="field">
                        <label class="label">Severity</label>
                        @php $currentSev = (int) old('severity_doctor', $case->severity_doctor ?? 0); @endphp
                        <div class="severity" id="diag-severity">
                            @for($i = 1; $i <= 5; $i++)
                            <button type="button" class="severity__dot {{ $currentSev >= $i ? 'active-' . $currentSev : '' }}" id="dsev-{{ $i }}" onclick="setDiagSev({{ $i }})"></button>
                            @endfor
                            <span class="severity__label" id="dsev-label">{{ ['','Mild','Mild-Mod','Moderate','Mod-Severe','Severe'][$currentSev] ?? '' }}</span>
                        </div>
                        <input type="hidden" name="severity_doctor" id="dsev-val" value="{{ $currentSev ?: '' }}">
                    </div>

                    <div class="field">
                        <label class="label" for="diagnosis_summary">Summary for the parent</label>
                        <textarea class="textarea" name="diagnosis_summary" id="diagnosis_summary" style="min-height:100px" placeholder="Explain what this is, in language a parent can understand…" required>{{ old('diagnosis_summary', $case->diagnosis_summary ?? '') }}</textarea>
                    </div>

                    <div class="field">
                        <label class="label">Treatment plan</label>
                        <div style="display:flex;flex-direction:column;gap:8px" id="treatment-steps">
                            @php $steps = old('treatment_steps', $case->treatment_steps ?: ['']); @endphp
                            @foreach($steps as $i => $step)
                            <div class="row treatment-step-row" style="gap:6px">
                                <div class="treatment-step__num">{{ $i + 1 }}</div>
                                <input class="input" type="text" name="treatment_steps[]" value="{{ $step }}" placeholder="e.g. Apply mupirocin 2% TID for 5 days">
                                <button type="button" class="btn btn--ghost btn--sm" onclick="removeStep(this)" {{ count($steps) <= 1 ? 'style=visibility:hidden' : '' }}>
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
                                </button>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn--ghost btn--sm" style="align-self:flex-start;margin-top:6px" onclick="addStep()">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                            Add step
                        </button>
                    </div>

                    <div class="field">
                        <label class="label" for="follow_up">Follow-up</label>
                        <select class="select" name="follow_up" id="follow_up">
                            <option value="">No scheduled follow-up</option>
                            @foreach(['1 week','2 weeks','4 weeks','If not clearing in 7 days','As needed'] as $fu)
                            <option value="{{ $fu }}" {{ (old('follow_up', $case->follow_up ?? '') === $fu) ? 'selected' : '' }}>{{ $fu }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="divider"></div>

                    <div class="row" style="gap:8px">
                        <button type="submit" name="close_case" value="0" class="btn btn--primary" style="flex:1">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>
                            Send to parent
                        </button>
                    </div>
                    <button type="submit" name="close_case" value="1" class="btn btn--ghost btn--sm" style="width:100%">Mark as closed</button>
                </form>
            </div>
        </div>

    </div>
</div>

<!-- Request info modal -->
<div id="info-modal" class="modal-overlay" style="display:none" onclick="if(event.target===this)this.style.display='none'">
    <div class="modal" onclick="event.stopPropagation()">
        <div class="row" style="margin-bottom:14px">
            <div style="width:36px;height:36px;border-radius:8px;background:var(--brand-soft);color:var(--brand-ink);display:grid;place-items:center">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.4 8.4 0 0 1-1 4 8.5 8.5 0 0 1-7.6 4.5 8.4 8.4 0 0 1-4-1L3 21l1.9-5.4a8.4 8.4 0 0 1-1-4 8.5 8.5 0 0 1 4.5-7.6 8.4 8.4 0 0 1 4-1A8.5 8.5 0 0 1 21 11.5z"/></svg>
            </div>
            <span class="fw-600">Request more information</span>
        </div>
        <p style="margin:0 0 14px;color:var(--ink-2)">Ask the parent to provide additional details or photos.</p>
        <form method="POST" action="{{ route('cases.request-info', $case) }}" style="display:flex;flex-direction:column;gap:12px">
            @csrf
            <div class="field">
                <textarea class="textarea" name="info_request" placeholder="e.g. Could you upload a close-up showing whether the wheals blanch when pressed?" required>{{ $case->info_request ?? '' }}</textarea>
            </div>
            <div class="row" style="justify-content:flex-end;gap:8px">
                <button type="button" class="btn btn--ghost" onclick="document.getElementById('info-modal').style.display='none'">Cancel</button>
                <button type="submit" class="btn btn--primary">Send request</button>
            </div>
        </form>
    </div>
</div>

<script>
const sevLabels = ['','Mild','Mild-Mod','Moderate','Mod-Severe','Severe'];

function setDiagSev(v) {
    document.getElementById('dsev-val').value = v;
    document.getElementById('dsev-label').textContent = sevLabels[v] || '';
    for (let i = 1; i <= 5; i++) {
        const d = document.getElementById('dsev-' + i);
        d.className = 'severity__dot' + (i <= v ? ' active-' + v : '');
    }
}

let stepCount = {{ count($steps) }};
function addStep() {
    stepCount++;
    const c = document.getElementById('treatment-steps');
    const row = document.createElement('div');
    row.className = 'row treatment-step-row';
    row.style.gap = '6px';
    row.innerHTML = `<div class="treatment-step__num">${stepCount}</div>
        <input class="input" type="text" name="treatment_steps[]" placeholder="e.g. Continue monitoring">
        <button type="button" class="btn btn--ghost btn--sm" onclick="removeStep(this)">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
        </button>`;
    c.appendChild(row);
    renumberSteps();
}
function removeStep(btn) {
    btn.closest('.treatment-step-row').remove();
    renumberSteps();
}
function renumberSteps() {
    document.querySelectorAll('.treatment-step-row .treatment-step__num').forEach((el, i) => { el.textContent = i + 1; });
    stepCount = document.querySelectorAll('.treatment-step-row').length;
}

function toggleIcdPicker() {
    const p = document.getElementById('icd-picker');
    p.style.display = p.style.display === 'none' ? '' : 'none';
    if (p.style.display !== 'none') document.getElementById('icd-search').focus();
}
function selectIcd(code, label) {
    document.getElementById('icd-val').value = code;
    document.getElementById('diag-form').elements['diagnosis_condition'].value = label;
    document.getElementById('icd-display').innerHTML = `<span class="mono fw-600">${code}</span> <span class="muted">— ${label}</span>`;
    document.getElementById('icd-picker').style.display = 'none';
}
function filterIcd(q) {
    q = q.toLowerCase();
    document.querySelectorAll('.icd-picker__item').forEach(item => {
        const match = item.dataset.code.toLowerCase().includes(q) || item.dataset.label.toLowerCase().includes(q);
        item.style.display = match ? '' : 'none';
    });
}
document.addEventListener('click', e => {
    const picker = document.getElementById('icd-picker');
    if (picker && !picker.contains(e.target) && !e.target.closest('[onclick="toggleIcdPicker()"]')) {
        picker.style.display = 'none';
    }
});
</script>
@endsection
