@extends('app')

@section('title', 'Admin | Tools Management')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">Menejemen Alat</h2>
            <p class="text-muted small mb-0">Pantau Alat</p>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span class="text-muted small d-none d-md-block">{{ auth()->user()->username }}</span>
            <div class="bg-purple text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" 
                 style="width: 40px; height: 40px;">
                {{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
            </div>
        </div>
    </div>

    <div class="row mb-4 align-items-center">
        <div class="col-md-7">
            <form method="GET" action="{{ route('tools.index') }}" class="d-flex gap-2">
                <div class="input-group shadow-sm" style="max-width: 350px;">
                    <span class="input-group-text bg-white border-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           class="form-control border-0 px-2" 
                           placeholder="Search tools name...">
                    <button type="submit" class="btn btn-purple px-4">Cari</button>
                </div>
            </form>
        </div>
        <div class="col-md-5 text-md-end mt-3 mt-md-0">
            <a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm me-2 shadow-sm">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
            <a href="{{ route('tools.create') }}" class="btn btn-purple btn-sm shadow-sm">
                <i class="fas fa-plus me-1"></i> Tambah
            </a>
        </div>
    </div>

    @if (session('success'))
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
                            <th class="ps-4 py-3">Alat</th>
                            <th class="py-3">Kategori</th>
                            <th class="py-3 text-center">Stock</th>
                            <th class="py-3 text-end">Harga</th>
                            <th class="py-3 text-center" style="width: 180px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tools as $t)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark">{{ $t->name_tools }}</div>
                                    <small class="text-muted">ID: #{{ $t->id }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-soft-purple text-purple px-3">
                                        {{ $t->category->nama_kategori ?? 'Uncategorized' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($t->stock <= 5)
                                        <span class="badge bg-danger rounded-pill">{{ $t->stock }} (Low)</span>
                                    @else
                                        <span class="badge bg-success rounded-pill">{{ $t->stock }}</span>
                                    @endif
                                </td>
                                <td class="text-end fw-semibold text-dark">
                                    Rp {{ number_format($t->price, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('tools.edit', $t->id) }}" 
                                           class="btn btn-warning btn-sm text-white shadow-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <form action="{{ route('tools.destroy', $t->id) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this tool?')"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm shadow-sm" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-tools fa-3x mb-3 opacity-25 d-block mx-auto"></i>
                                        No tools found in inventory.
                                    </div>
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
    /* Custom Theme Colors */
    .btn-purple {
        background-color: #6f42c1;
        color: white;
    }
    .btn-purple:hover {
        background-color: #59359a;
        color: white;
    }
    .text-purple { color: #6f42c1; }
    
    /* Soft Purple Badge */
    .bg-soft-purple {
        background-color: #f1e9ff;
        color: #6f42c1;
    }

    .table thead th {
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #6c757d;
        border-bottom: 1px solid #edf2f7;
    }
</style>
@endsection
