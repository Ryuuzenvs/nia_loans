@extends('app')

@section('title', 'Admin | Category Management')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">Kategori</h2>
            <p class="text-muted small mb-0">Pantau kategori</p>
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
        <div class="col-md-8">
            <form method="GET" action="{{ route('category.index') }}" class="d-flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="form-control shadow-sm border-0 px-3" 
                       placeholder="Search category name..." style="max-width: 300px;">
                <button type="submit" class="btn btn-purple shadow-sm">
                    <i class="fas fa-search me-1"></i> Cari
                </button>
            </form>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm me-2 shadow-sm">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
            <a href="{{ route('category.create') }}" class="btn btn-purple btn-sm shadow-sm">
                <i class="fas fa-plus me-1"></i> Tambah Kategori
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
 @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-times me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white py-3 border-bottom-0">
            <h5 class="fw-bold text-purple mb-0">Kategori List</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th class="ps-4 py-3" style="width: 80px;">No</th>
                            <th class="py-3">Kategori</th>
                            <th class="py-3 text-center" style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $c)
                            <tr>
                                <td class="ps-4 fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td class="fw-semibold text-dark">{{ $c->nama_kategori }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('category.edit', $c->id) }}" 
                                           class="btn btn-warning btn-sm text-white shadow-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <form action="{{ route('category.destroy', $c->id) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Hapus kategori ini? Semua alat dengan kategori ini akan terpengaruh.')"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm shadow-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5 text-muted fst-italic">
                                    <i class="fas fa-folder-open fa-3x mb-3 opacity-25 d-block"></i>
                                    No categories found.
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
    .table thead th {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .btn-purple {
        background-color: #6f42c1;
        color: white;
    }
    .btn-purple:hover {
        background-color: #59359a;
        color: white;
    }
    .text-purple { color: #6f42c1; }
</style>
@endsection
