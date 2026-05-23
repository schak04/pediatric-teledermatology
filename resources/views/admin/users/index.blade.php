@extends('layouts.app')

@section('content')
<div class="page">
    <div class="page__head">
        <div>
            <h1 class="page__title">Users</h1>
            <p class="page__sub">Manage parents, doctors, and admins on the platform.</p>
        </div>
        <div class="row">
            <div class="search">
                <svg class="search__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
                <input class="input" id="user-search" placeholder="Search users…" style="width:280px" oninput="filterUsers(this.value)">
            </div>
        </div>
    </div>

    @php
        $total   = \App\Models\User::count();
        $patients = \App\Models\User::where('role','patient')->count();
        $doctors  = \App\Models\User::where('role','doctor')->count();
        $admins   = \App\Models\User::where('role','admin')->count();
    @endphp

    <div class="stat-grid">
        <div class="stat"><div class="stat__label">Total users</div><div class="stat__value">{{ $total }}</div></div>
        <div class="stat"><div class="stat__label">Parents</div><div class="stat__value">{{ $patients }}</div></div>
        <div class="stat"><div class="stat__label">Doctors</div><div class="stat__value">{{ $doctors }}</div></div>
        <div class="stat"><div class="stat__label">Admins</div><div class="stat__value">{{ $admins }}</div></div>
    </div>

    <div class="tabs" id="user-tabs">
        @foreach([
            ['id'=>'all',    'label'=>'All',     'count'=>$total],
            ['id'=>'patient','label'=>'Parents',  'count'=>$patients],
            ['id'=>'doctor', 'label'=>'Doctors',  'count'=>$doctors],
            ['id'=>'admin',  'label'=>'Admins',   'count'=>$admins],
        ] as $tab)
        <button class="tab {{ ($loop->first) ? 'is-on' : '' }}" onclick="filterRole(this, '{{ $tab['id'] }}')" data-role="{{ $tab['id'] }}">
            {{ $tab['label'] }}<span class="tab__count">{{ $tab['count'] }}</span>
        </button>
        @endforeach
    </div>

    <div class="table-wrap">
        @if($users->isEmpty())
        <div class="empty" style="border:none;border-radius:0">
            <p class="empty__sub">No users found.</p>
        </div>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Joined</th>
                    <th style="width:100px"></th>
                </tr>
            </thead>
            <tbody id="users-tbody">
                @foreach($users as $user)
                <tr class="user-row" data-role="{{ $user->role }}" data-search="{{ strtolower($user->name . ' ' . $user->email) }}">
                    <td>
                        <div class="row" style="gap:12px">
                            <div class="avatar">{{ strtoupper(substr($user->name, 0, 1)) }}{{ strtoupper(substr(strstr($user->name, ' '), 1, 1)) }}</div>
                            <div>
                                <div class="fw-600">{{ $user->name }}</div>
                                <div class="text-xs muted">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge {{ $user->role === 'doctor' ? 'badge--review' : ($user->role === 'admin' ? 'badge--info' : 'badge--diagnosed') }}">{{ $user->role }}</span>
                    </td>
                    <td><span class="badge badge--diagnosed">active</span></td>
                    <td class="text-sm muted">{{ $user->created_at->format('M d, Y') }}</td>
                    <td>
                        @if($user->id === auth()->id())
                        <span class="text-xs muted" style="font-style:italic">You</span>
                        @else
                        <div class="row" style="gap:6px;justify-content:flex-end">
                            <button
                                class="btn btn--danger btn--sm"
                                onclick="confirmDelete({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ $user->email }}', {{ $user->cases->count() ?? 0 }})"
                            >
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                            </button>
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>

<!-- Delete confirmation modal -->
<div id="delete-modal" class="modal-overlay" style="display:none" onclick="if(event.target===this)closeModal()">
    <div class="modal" onclick="event.stopPropagation()">
        <div class="row" style="margin-bottom:14px">
            <div style="width:36px;height:36px;border-radius:8px;background:var(--status-danger-bg);color:var(--status-danger);display:grid;place-items:center;flex-shrink:0">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.3 3.7 1.7 18a2 2 0 0 0 1.7 3h17.2a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0z"/><path d="M12 9v4M12 17h.01"/></svg>
            </div>
            <div class="fw-600">Delete user</div>
        </div>
        <p style="margin:0 0 6px;color:var(--ink-2)">Permanently delete <strong id="del-name"></strong>?</p>
        <p class="text-sm muted" style="margin:0 0 18px" id="del-desc"></p>
        <div class="row" style="justify-content:flex-end;gap:8px">
            <button class="btn btn--ghost" onclick="closeModal()">Cancel</button>
            <form id="delete-form" method="POST" style="margin:0">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn" style="background:var(--status-danger);color:white">Delete user</button>
            </form>
        </div>
    </div>
</div>

<script>
function filterRole(btn, role) {
    document.querySelectorAll('#user-tabs .tab').forEach(t => t.classList.remove('is-on'));
    btn.classList.add('is-on');
    document.querySelectorAll('.user-row').forEach(row => {
        row.style.display = (role === 'all' || row.dataset.role === role) ? '' : 'none';
    });
}
function filterUsers(q) {
    q = q.toLowerCase();
    document.querySelectorAll('.user-row').forEach(row => {
        row.style.display = row.dataset.search.includes(q) ? '' : 'none';
    });
}
function confirmDelete(id, name, email, caseCount) {
    document.getElementById('del-name').textContent = name;
    const desc = 'This will revoke their access and remove their account record.'
        + (caseCount > 0 ? ` Their ${caseCount} case${caseCount === 1 ? '' : 's'} will be preserved but anonymized.` : '');
    document.getElementById('del-desc').textContent = desc;
    document.getElementById('delete-form').action = '/admin/users/' + id;
    document.getElementById('delete-modal').style.display = 'grid';
}
function closeModal() { document.getElementById('delete-modal').style.display = 'none'; }
</script>
@endsection
