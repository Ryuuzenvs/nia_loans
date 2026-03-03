@extends('app')

@section('title', 'User Profile')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-7">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-purple-gradient p-4 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-white text-purple rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" 
                                 style="width: 50px; height: 50px; font-size: 1.2rem;">
                                {{ strtoupper(substr($user->username, 0, 1)) }}
                            </div>
                            <div>
                                <h5 class="mb-0 text-white fw-bold">Akun</h5>
                                <small class="text-white-50">Kelola data</small>
                            </div>
                        </div>
                        <span class="badge bg-white text-purple rounded-pill px-3 py-2 text-uppercase fw-bold shadow-sm">
                            <i class="fas fa-shield-alt me-1"></i> {{ $user->role }}
                        </span>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="alert alert-danger border-0 shadow-sm mb-4">
                            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('profile.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <h6 class="text-purple fw-bold mb-3 mt-2"><i class="fas fa-info-circle me-2"></i>Info akun</h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="fas fa-at text-muted"></i></span>
                                    <input type="text" class="form-control bg-light border-0" value="{{ $user->username }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-muted">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="fas fa-envelope text-muted"></i></span>
                                    <input type="text" class="form-control bg-light border-0" value="{{ $user->email }}" readonly>
                                </div>
                            </div>
                        </div>

                        <hr class="border-dashed my-4">

                        <h6 class="text-purple fw-bold mb-3"><i class="fas fa-user-edit me-2"></i>Detail Peminjam</h6>
                        <div class="row g-3">
                            <div class="col-md-12 mb-2">
                                <label class="form-label small fw-bold text-muted">Nama lengkap</label>
                                <input type="text" name="name" class="form-control @if(!$isOwner) bg-light @endif shadow-sm border-0 px-3 py-2" 
                                    value="{{ $user->borrower->name ?? '' }}" 
                                    placeholder="Enter your full name" 
                                    {{ $isOwner ? 'required' : 'readonly' }}>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="form-label small fw-bold text-muted">password</label>
                                <input type="text" name="password" class="form-control @if(!$isOwner) bg-light @endif shadow-sm border-0 px-3 py-2" 
                                    placeholder="Enter your full password" 
                                    {{ $isOwner ? '' : 'readonly' }}>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-bold text-muted">(No. HP)</label>
                                <div class="input-group shadow-sm">
                                    <span class="input-group-text bg-white border-0"><i class="fas fa-phone text-muted"></i></span>
                                    <input type="number" name="no_hp" class="form-control @if(!$isOwner) bg-light @endif border-0 py-2" 
                                        value="{{ $user->borrower->no_hp ?? '' }}" 
                                        placeholder="0812xxxx" 
                                        {{ $isOwner ? 'required' : 'readonly' }}>
                                </div>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-bold text-muted">(Alamat)</label>
                                <div class="input-group shadow-sm">
                                    <span class="input-group-text bg-white border-0"><i class="fas fa-map-marker-alt text-muted"></i></span>
                                    <input type="text" name="alamat" class="form-control @if(!$isOwner) bg-light @endif border-0 py-2" 
                                        value="{{ $user->borrower->alamat ?? '' }}" 
                                        placeholder="Your address" 
                                        {{ $isOwner ? 'required' : 'readonly' }}>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <a href="javascript:history.back()" class="btn btn-link text-muted text-decoration-none px-0">
                                <i class="fas fa-chevron-left me-1"></i> Kembali
                            </a>

                            @if($isOwner)
                                <button type="submit" class="btn btn-purple px-5 py-2 rounded-pill shadow-sm">
                                    <i class="fas fa-save me-2"></i>Simpan
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Gradient Purple Header */
    .bg-purple-gradient {
        background: linear-gradient(135deg, #6f42c1 0%, #a259ff 100%);
    }

    .text-purple { color: #6f42c1; }
    
    .btn-purple {
        background-color: #6f42c1;
        color: white;
        transition: all 0.3s;
    }

    .btn-purple:hover {
        background-color: #59359a;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(111, 66, 193, 0.3);
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.15);
        border-color: #6f42c1;
    }

    .border-dashed {
        border-top: 2px dashed #e9ecef;
    }

    /* Remove Arrows from Number Input */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
@endsection
