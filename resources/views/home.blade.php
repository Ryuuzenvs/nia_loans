@extends('app')

@section('title', 'Welcome to PinjamAlat')

@section('content')
<div class="container">
    <div class="row align-items-center py-5">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <h1 class="display-4 fw-bold text-dark mb-3">
                Sistem Peminjaman Alat <br>
                <span class="text-purple">Mudah & Terorganisir</span>
            </h1>
            <p class="lead text-muted mb-4">
                Aplikasi peminjaman alat berbasis web untuk mempermudah 
                pencatatan, monitoring denda, dan laporan peminjaman secara real-time.
            </p>
            <div class="d-grid d-md-flex gap-3">
                @auth
                    <a href="{{ route(Auth::user()->role . '.dashboard') }}" class="btn btn-purple btn-lg px-5 shadow">
                        Buka Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-purple btn-lg px-5 shadow">
                        Mulai Sekarang
                    </a>
                @endauth
            </div>
        </div>
        <div class="col-lg-5 offset-lg-1">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-body p-5">
                    <h3 class="fw-bold text-purple mb-4">Ringkasan Sistem</h3>
                    <ul class="list-unstyled">
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-check-circle text-purple me-3"></i> Manajemen data alat & kategori
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-check-circle text-purple me-3"></i> Peminjaman & pengembalian otomatis
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-check-circle text-purple me-3"></i> Hitung denda 1% per hari
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-check-circle text-purple me-3"></i> Laporan rapi siap cetak
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 pt-5 text-center">
        <div class="col-12 mb-5">
            <h2 class="fw-bold text-purple">Fitur Unggulan</h2>
            <div class="mx-auto bg-purple" style="width: 60px; height: 4px; border-radius: 2px;"></div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm p-4 hover-shadow transition">
                <div class="text-purple mb-3">
                    <i class="fas fa-box-open fa-3x"></i>
                </div>
                <h4 class="fw-bold">Data Barang</h4>
                <p class="text-muted small">Kelola seluruh data alat dengan rapi, termasuk stok dan harga satuan.</p>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm p-4 hover-shadow transition">
                <div class="text-purple mb-3">
                    <i class="fas fa-hand-holding fa-3x"></i>
                </div>
                <h4 class="fw-bold">Peminjaman</h4>
                <p class="text-muted small">Proses peminjaman cepat dengan approval petugas dan status barang otomatis.</p>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm p-4 hover-shadow transition">
                <div class="text-purple mb-3">
                    <i class="fas fa-file-invoice fa-3x"></i>
                </div>
                <h4 class="fw-bold">Laporan</h4>
                <p class="text-muted small">Generate laporan aktivitas peminjaman dan denda dalam format yang siap cetak.</p>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        transition: all 0.3s ease;
    }
</style>
@endsection
