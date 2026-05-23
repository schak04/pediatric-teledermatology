@extends('layouts.app')

@section('content')
@if(auth()->user()->role === 'patient')
{{-- ===== PATIENT DASHBOARD ===== --}}
<div class="page">
    <div class="page__head">
        <div>
            <h1 class="page__title">Hello, {{ explode(' ', auth()->user()->name)[0] }} 👋</h1>
            <p class="page__sub">Track your child's consultations or start a new one. A pediatric dermatologist usually responds within 24 hours.</p>
        </div>
        <a href="{{ route('cases.create') }}" class="btn btn--primary btn--lg">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
            New consultation
        </a>
    </div>

    @if($activeCases->where('status', 'needs_info')->count())
    <div class="callout" style="margin-bottom:24px;border-color:var(--status-danger);background:var(--status-danger-bg)">
        <div class="callout__icon" style="background:var(--status-danger)">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.3 3.7 1.7 18a2 2 0 0 0 1.7 3h17.2a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0z"/><path d="M12 9v4M12 17h.01"/></svg>
        </div>
        <div>
            <div class="fw-600" style="color:var(--ink);margin-bottom:4px">One of your cases needs more information</div>
            <div>The doctor has a question about your recent submission. Tap the case to respond.</div>
        </div>
    </div>
    @endif

    <h2 class="section-h" style="margin-top:8px">
        Active cases
        <span class="muted text-sm fw-600" style="margin-left:8px">({{ $activeCases->count() }})</span>
    </h2>

    @if($activeCases->isEmpty())
    <div class="empty">
        <div class="empty__icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M8 3v4M16 3v4M3 11h18"/></svg>
        </div>
        <h3 class="empty__title">No active cases</h3>
        <p class="empty__sub">When you submit a consultation, you'll see it here while a doctor reviews it.</p>
        <a href="{{ route('cases.create') }}" class="btn btn--primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
            Start a consultation
        </a>
    </div>
    @else
    <div class="case-grid">
        @foreach($activeCases as $case)
            @include('cases.partials.case-card', ['case' => $case, 'showPatient' => false])
        @endforeach
    </div>
    @endif

    @if($pastCases->count())
    <h2 class="section-h" style="margin-top:36px">
        Past consultations
        <span class="muted text-sm fw-600" style="margin-left:8px">({{ $pastCases->count() }})</span>
    </h2>
    <div class="case-grid">
        @foreach($pastCases as $case)
            @include('cases.partials.case-card', ['case' => $case, 'showPatient' => false])
        @endforeach
    </div>
    @endif
</div>

@else
{{-- ===== DOCTOR QUEUE ===== --}}
<div class="page">
    <div class="page__head">
        <div>
            <h1 class="page__title">Case queue</h1>
            <p class="page__sub">
                Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 17 ? 'afternoon' : 'evening') }}, {{ explode(' ', auth()->user()->name)[0] }}.
                {{ $pendingCases->count() }} consultation{{ $pendingCases->count() === 1 ? '' : 's' }} waiting for review.
            </p>
        </div>
        <div class="row">
            <div class="search">
                <svg class="search__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
                <input class="input" id="doctor-search" placeholder="Search by patient, condition, ID…" style="width:300px" oninput="filterTable(this.value)">
            </div>
        </div>
    </div>

    <div class="stat-grid">
        <div class="stat">
            <div class="stat__label">Awaiting review</div>
            <div class="stat__value">{{ $pendingCases->count() }}</div>
            <div class="stat__delta" style="color:var(--status-submitted)">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                Open
            </div>
        </div>
        <div class="stat">
            <div class="stat__label">Awaiting parent</div>
            <div class="stat__value">{{ $needsInfoCases->count() }}</div>
            <div class="stat__delta" style="color:var(--ink-3)">Pending reply</div>
        </div>
        <div class="stat">
            <div class="stat__label">Diagnosed</div>
            <div class="stat__value">{{ $diagnosedCases->count() }}</div>
            <div class="stat__delta">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>
                Complete
            </div>
        </div>
        <div class="stat">
            <div class="stat__label">Closed</div>
            <div class="stat__value">{{ $closedCases->count() }}</div>
            <div class="stat__delta" style="color:var(--ink-3)">Total</div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="tabs" id="queue-tabs">
        <button class="tab is-on" onclick="switchTab(this,'pending')" data-tab="pending">
            Awaiting review<span class="tab__count">{{ $pendingCases->count() }}</span>
        </button>
        <button class="tab" onclick="switchTab(this,'needs_info')" data-tab="needs_info">
            Awaiting parent<span class="tab__count">{{ $needsInfoCases->count() }}</span>
        </button>
        <button class="tab" onclick="switchTab(this,'diagnosed')" data-tab="diagnosed">
            Diagnosed<span class="tab__count">{{ $diagnosedCases->count() }}</span>
        </button>
        <button class="tab" onclick="switchTab(this,'closed')" data-tab="closed">
            Closed<span class="tab__count">{{ $closedCases->count() }}</span>
        </button>
    </div>

    @foreach([
        ['id' => 'pending',    'cases' => $pendingCases,    'shown' => true],
        ['id' => 'needs_info', 'cases' => $needsInfoCases,  'shown' => false],
        ['id' => 'diagnosed',  'cases' => $diagnosedCases,  'shown' => false],
        ['id' => 'closed',     'cases' => $closedCases,     'shown' => false],
    ] as $tab)
    <div id="tab-{{ $tab['id'] }}" class="tab-panel" style="{{ $tab['shown'] ? '' : 'display:none' }}">
        @if($tab['cases']->isEmpty())
        <div class="empty">
            <div class="empty__icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>
            </div>
            <h3 class="empty__title">All caught up</h3>
            <p class="empty__sub">No cases in this tab.</p>
        </div>
        @else
        <div class="table-wrap" id="table-{{ $tab['id'] }}">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width:100px">Case</th>
                        <th>Patient</th>
                        <th>Complaint</th>
                        <th>Duration</th>
                        <th>Severity</th>
                        <th>Submitted</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tab['cases'] as $case)
                    <tr style="cursor:pointer" onclick="window.location='{{ route('cases.review', $case) }}'" class="case-row" data-search="{{ strtolower($case->child_name . ' ' . $case->title . ' ' . $case->id) }}">
                        <td>
                            <div class="row" style="gap:10px">
                                <div style="width:36px;height:36px;border-radius:8px;overflow:hidden;flex-shrink:0;background:var(--brand-softer)">
                                    @if($case->images->first())
                                    <img src="{{ asset('storage/' . $case->images->first()->path) }}" style="width:100%;height:100%;object-fit:cover">
                                    @elseif($case->image_path)
                                    <img src="{{ asset('storage/' . $case->image_path) }}" style="width:100%;height:100%;object-fit:cover">
                                    @endif
                                </div>
                                <span class="mono text-xs muted">#{{ $case->id }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="fw-600">{{ $case->child_name ?? $case->user->name }}</div>
                            <div class="text-xs muted">{{ $case->child_age ? $case->child_age . ' ' . $case->child_age_unit : '' }}{{ $case->sex ? ' · ' . ($case->sex === 'F' ? 'Female' : 'Male') : '' }}</div>
                        </td>
                        <td style="max-width:280px">
                            <div style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">{{ $case->title ?? $case->description }}</div>
                            @if($case->body_location)<div class="text-xs muted">{{ $case->body_location }}</div>@endif
                        </td>
                        <td class="text-sm">{{ $case->duration ?? '—' }}</td>
                        <td>@include('cases.partials.severity-scale', ['value' => $case->severity ?? 0])</td>
                        <td class="text-sm muted">{{ $case->created_at->diffForHumans() }}</td>
                        <td><span class="badge {{ $case->status_class }}">{{ $case->status_label }}</span></td>
                        <td>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 6 6 6-6 6"/></svg>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
    @endforeach
</div>

<script>
function switchTab(btn, tabId) {
    document.querySelectorAll('.tabs .tab').forEach(t => t.classList.remove('is-on'));
    document.querySelectorAll('.tab-panel').forEach(p => p.style.display = 'none');
    btn.classList.add('is-on');
    document.getElementById('tab-' + tabId).style.display = '';
}
function filterTable(q) {
    q = q.toLowerCase();
    document.querySelectorAll('.case-row').forEach(row => {
        row.style.display = row.dataset.search.includes(q) ? '' : 'none';
    });
}
</script>
@endif
@endsection
