@extends('app')

@section('title', 'Admin | Dashboard')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">Dashboard</h2>
            <p class="text-muted mb-0">Admin overview & statistics</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span class="text-muted small d-none d-md-block">{{ auth()->user()->username }}</span>
            <div class="bg-purple text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" 
                 style="width: 45px; height: 45px; font-size: 1.2rem;">
                {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-purple text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase small fw-bold opacity-75">Total Tools</h6>
                            <h2 class="mb-0 fw-bold">{{ \App\Models\tool::count() }}</h2>
                        </div>
                        <i class="fas fa-tools fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-warning text-dark h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase small fw-bold opacity-75">Activated Loans</h6>
                            <h2 class="mb-0 fw-bold">{{ \App\Models\loan::where('status', 'borrow')->count() }}</h2>
                        </div>
                        <i class="fas fa-hand-holding fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-danger text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase small fw-bold opacity-75">Need Approval</h6>
                            <h2 class="mb-0 fw-bold">{{ \App\Models\loan::where('status', 'pending')->count() }}</h2>
                        </div>
                        <i class="fas fa-clock fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-2 mb-4">
                <div class="card-body">
                    <h4 class="fw-bold text-dark mb-3">Welcome 👋</h4>
                    <p class="text-muted">Hello, <span class="fw-bold text-purple">{{ Auth::user()->username }}</span></p>
                    <p class="small text-secondary">
                        Anda masuk sebagai administrator. Gunakan menu akses cepat di samping atau bilah navigasi 
                        untuk mengelola pengguna, alat, kategori, dan memantau log sistem secara real-time.
                    </p>
                    
                    <hr class="my-4 opacity-25">
                    
                    <h6 class="fw-bold text-dark mb-2">Project Author</h6>
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="mb-0 fw-semibold">Agniya khairani</p>
                            <p class="text-xs text-muted mb-0">Sistem Manajemen Inventaris & Peminjaman Alat</p>
                        </div>
                        <div class="text-end">
                            <p class="text-xs text-muted mb-0">&copy; {{ date('Y') }} — All rights reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-dark text-white fw-bold py-3">
                    <i class="fas fa-rocket me-2"></i>Quick Access
                </div>
                <div class="card-body d-grid gap-2 p-4">
                    <a href="{{ route('tools.index') }}" class="btn btn-outline-purple text-start p-3">
                        <i class="fas fa-box me-2"></i> Tools Management
                    </a>
                    <a href="{{ route('category.index') }}" class="btn btn-outline-secondary text-start p-3">
                        <i class="fas fa-tags me-2"></i> Categories
                    </a>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-warning text-dark text-start p-3">
                        <i class="fas fa-users me-2"></i> User Management
                    </a>
                    <a href="{{ route('admin.loans.index') }}" class="btn btn-outline-primary text-start p-3">
                        <i class="fas fa-exchange-alt me-2"></i> Loan Records
                    </a>
                    <a href="{{ route('admin.logs.index') }}" class="btn btn-outline-info text-start p-3">
                        <i class="fas fa-history me-2"></i> System Logs
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-outline-purple {
        color: #6f42c1;
        border-color: #6f42c1;
    }
    .btn-outline-purple:hover {
        background-color: #6f42c1;
        color: white;
    }
    .text-xs { font-size: 0.75rem; }
</style>
@endsection
