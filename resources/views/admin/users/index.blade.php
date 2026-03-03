@extends('app')

@section('title', 'Admin | User Management')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">Menejemen User</h2>
            <p class="text-muted small mb-0">Kontrol User</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span class="text-muted small d-none d-md-block">{{ auth()->user()->username }}</span>
            <div class="bg-purple text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" 
                 style="width: 40px; height: 40px;">
                {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-10">
            <form method="GET" action="{{ route('users.index') }}" class="row g-2">
                <div class="col-md-4">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           class="form-control shadow-sm border-0" 
                           placeholder="Search user name or email...">
                </div>
                <div class="col-md-3">
                    <select name="role" class="form-select shadow-sm border-0">
                        <option value="">Role</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="staff" {{ request('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="borrower" {{ request('role') == 'borrower' ? 'selected' : '' }}>Borrower</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-purple shadow-sm w-100">
                        <i class="fas fa-search me-1"></i> cari
                    </button>
                </div>
            </form>
        </div>
        <div class="col-md-2 text-md-end mt-3 mt-md-0">
            <a href="{{ route('users.create') }}" class="btn btn-purple btn-sm shadow-sm w-100">
                <i class="fas fa-user-plus me-1"></i> Tambah
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th class="ps-4 py-3">Nama, email</th>
                            <th class="py-3 text-center">Role</th>
                            <th class="py-3 text-center" style="width: 200px;">aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $u)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark">{{ $u->username }}</div>
                                    <small class="text-muted">{{ $u->email }}</small>
                                </td>
                                <td class="text-center">
                                    @php
                                        $role = strtolower($u->role);
                                        $badgeClass = match ($role) {
                                            'admin'    => 'bg-soft-primary text-primary',
                                            'staff'    => 'bg-soft-warning text-warning',
                                            'borrower' => 'bg-soft-success text-success',
                                            default    => 'bg-soft-secondary text-secondary',
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }} px-3 py-2 rounded-pill text-uppercase" style="font-size: 0.7rem;">
                                        {{ $u->role }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if ($u->id != auth()->id())
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('users.edit', [$u->id, 'role' => $u->role]) }}" 
                                               class="btn btn-warning btn-sm text-white shadow-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                            <form action="{{ route('users.destroy', $u->id) }}?role={{ $u->role }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Delete this user? Action cannot be undone.')"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm shadow-sm">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="badge bg-light text-dark border border-secondary shadow-sm">
                                            <i class="fas fa-user-check me-1"></i> You
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5 text-muted">
                                    <i class="fas fa-users-slash fa-3x mb-3 opacity-25 d-block mx-auto"></i>
                                    No users found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    /* Soft Color Badges */
    .bg-soft-primary { background-color: #e0e7ff; color: #4338ca; }
    .bg-soft-warning { background-color: #fef3c7; color: #b45309; }
    .bg-soft-success { background-color: #d1fae5; color: #047857; }
    .bg-soft-secondary { background-color: #f1f5f9; color: #475569; }

    .btn-purple { background-color: #6f42c1; color: white; }
    .btn-purple:hover { background-color: #59359a; color: white; }
    
    .table thead th {
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>
@endsection
