@extends('layouts.app')

@section('content')
<div class="page">
    <div class="page__head">
        <div>
            <h1 class="page__title">All cases</h1>
            <p class="page__sub">Read-only view of every consultation submitted to the platform.</p>
        </div>
        <div class="search">
            <svg class="search__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
            <input class="input" placeholder="Search…" style="width:280px" oninput="filterCases(this.value)">
        </div>
    </div>

    <div class="stat-grid">
        <div class="stat"><div class="stat__label">Total cases</div><div class="stat__value">{{ $counts['all'] }}</div></div>
        <div class="stat"><div class="stat__label">Active</div><div class="stat__value">{{ $cases->where('status','!=','closed')->count() }}</div></div>
        <div class="stat"><div class="stat__label">Diagnosed</div><div class="stat__value">{{ $counts['diagnosed'] }}</div></div>
        <div class="stat"><div class="stat__label">Closed</div><div class="stat__value">{{ $counts['closed'] }}</div></div>
    </div>

    <div class="tabs" id="case-tabs">
        <button class="tab {{ !$status ? 'is-on' : '' }}" onclick="filterStatus(this,'all')">All<span class="tab__count">{{ $counts['all'] }}</span></button>
        @foreach(['submitted','needs_info','in_review','diagnosed','closed'] as $s)
        <button class="tab {{ $status === $s ? 'is-on' : '' }}" onclick="filterStatus(this,'{{ $s }}')">
            {{ ['submitted'=>'Submitted','needs_info'=>'Needs info','in_review'=>'In review','diagnosed'=>'Diagnosed','closed'=>'Closed'][$s] }}
            <span class="tab__count">{{ $counts[$s] }}</span>
        </button>
        @endforeach
    </div>

    <div class="table-wrap">
        @if($cases->isEmpty())
        <div class="empty" style="border:none;border-radius:0">
            <p class="empty__sub">No cases found.</p>
        </div>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th>Case</th>
                    <th>Patient</th>
                    <th>Guardian</th>
                    <th>Complaint</th>
                    <th>Status</th>
                    <th>Submitted</th>
                    <th>Diagnosis</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="cases-tbody">
                @foreach($cases as $case)
                <tr class="case-row" data-status="{{ $case->status }}" data-search="{{ strtolower($case->id . ' ' . $case->child_name . ' ' . $case->user->name . ' ' . $case->title) }}" style="cursor:pointer" onclick="window.location='{{ route('admin.cases.show', $case) }}'">
                    <td>
                        <div class="row" style="gap:10px">
                            <div style="width:36px;height:36px;border-radius:8px;overflow:hidden;flex-shrink:0;background:var(--brand-softer)">
                                @if($case->images->first())
                                <img src="{{ asset('storage/' . $case->images->first()->path) }}" style="width:100%;height:100%;object-fit:cover">
                                @elseif($case->image_path)
                                <img src="{{ asset('storage/' . $case->image_path) }}" style="width:100%;height:100%;object-fit:cover">
                                @endif
                            </div>
                            <span class="mono text-xs">#{{ $case->id }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="fw-600">{{ $case->child_name ?? '—' }}</div>
                        <div class="text-xs muted">{{ $case->child_age ? $case->child_age . ' ' . $case->child_age_unit : '' }}</div>
                    </td>
                    <td class="text-sm">{{ $case->user->name }}</td>
                    <td style="max-width:260px">
                        <div style="display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden">{{ $case->title ?? $case->description }}</div>
                    </td>
                    <td><span class="badge {{ $case->status_class }}">{{ $case->status_label }}</span></td>
                    <td class="text-sm muted">{{ $case->created_at->format('M d, Y') }}</td>
                    <td class="text-sm">
                        @if($case->diagnosis_condition)
                        <div>
                            <div class="fw-600">{{ $case->diagnosis_condition }}</div>
                            @if($case->icd_code)<div class="text-xs muted mono">{{ $case->icd_code }}</div>@endif
                        </div>
                        @elseif($case->diagnosis)
                        <div class="fw-600">{{ $case->diagnosis }}</div>
                        @else
                        <span class="muted">—</span>
                        @endif
                    </td>
                    <td><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 6 6 6-6 6"/></svg></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>

<script>
let currentStatusFilter = '{{ $status ?? "all" }}';
function filterStatus(btn, status) {
    currentStatusFilter = status;
    document.querySelectorAll('#case-tabs .tab').forEach(t => t.classList.remove('is-on'));
    btn.classList.add('is-on');
    applyFilters();
}
function filterCases(q) { applyFilters(q.toLowerCase()); }
function applyFilters(q) {
    q = q || document.querySelector('input[oninput]')?.value?.toLowerCase() || '';
    document.querySelectorAll('.case-row').forEach(row => {
        const statusOk = currentStatusFilter === 'all' || row.dataset.status === currentStatusFilter;
        const searchOk = !q || row.dataset.search.includes(q);
        row.style.display = (statusOk && searchOk) ? '' : 'none';
    });
}
</script>
@endsection
