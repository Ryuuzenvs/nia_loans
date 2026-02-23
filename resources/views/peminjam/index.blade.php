@extends('app')

@section('title', 'My Loans')

@section('content')
<div class="container mt-5">
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card bg-purple-dark text-white shadow-sm border-0 rounded-4 overflow-hidden position-relative">
                <div class="card-body p-4 z-1">
                    <h6 class="text-uppercase small fw-bold opacity-75">Total Denda (Returned)</h6>
                    <h2 class="mb-0 fw-bold">Rp {{ number_format($myloan->where('status', 'return')->sum('penalty'), 0, ',', '.') }}</h2>
                </div>
                <i class="fas fa-hand-holding-usd position-absolute end-0 bottom-0 mb-n2 me-n2 opacity-25 fa-4x"></i>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-purple-gradient text-white shadow-sm border-0 rounded-4 overflow-hidden position-relative">
                <div class="card-body p-4 z-1">
                    <h6 class="text-uppercase small fw-bold opacity-75">Transaksi Aktif</h6>
                    <h2 class="mb-0 fw-bold">{{ $myloan->where('status', 'borrow')->count() }} <span class="small" style="font-size: 0.5em">Baris</span></h2>
                </div>
                <i class="fas fa-exchange-alt position-absolute end-0 bottom-0 mb-n2 me-n2 opacity-25 fa-4x"></i>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-soft-purple text-purple shadow-sm border-0 rounded-4 overflow-hidden position-relative border-start border-purple border-5">
                <div class="card-body p-4 z-1">
                    <h6 class="text-uppercase small fw-bold opacity-75">Total Alat Dibawa</h6>
                    <h2 class="mb-0 fw-bold">{{ $myloan->where('status', 'borrow')->sum('qty') }} <span class="small" style="font-size: 0.5em">Pcs</span></h2>
                </div>
                <i class="fas fa-box-open position-absolute end-0 bottom-0 mb-n2 me-n2 text-purple opacity-10 fa-4x"></i>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-4 mb-5 overflow-hidden">
        <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-list-ul me-2 text-purple"></i>Daftar Pinjaman Aktif</h5>
            <span class="badge bg-soft-purple text-purple rounded-pill px-3">On Process</span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th class="ps-4 py-3">Informasi Alat</th>
                            <th class="text-center py-3">Qty</th>
                            <th class="text-center py-3">Status</th>
                            <th class="text-end py-3">Tanggal & Deadline</th>
                            <th class="text-center py-3 pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($myloan->where('status', '!=', 'return') as $loan)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark">{{ $loan->tool->name_tools }}</div>
                                    <div class="text-purple small fw-medium">ID: #{{ str_pad($loan->id, 5, '0', STR_PAD_LEFT) }}</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-purple-light text-purple rounded-3 px-3">{{ $loan->qty }}</span>
                                </td>
                                <td class="text-center">
                                    @if ($loan->status == 'pending')
                                        <span class="badge bg-soft-secondary text-secondary rounded-pill px-3"><i class="fas fa-spinner fa-spin me-1"></i> Waiting ACC</span>
                                    @elseif($loan->request_return_date)
                                        <span class="badge bg-soft-warning text-warning rounded-pill px-3"><i class="fas fa-history me-1"></i> Verifying...</span>
                                    @else
                                        <span class="badge bg-soft-success text-success rounded-pill px-3"><i class="fas fa-check me-1"></i> Borrowed</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="small text-muted">{{ $loan->created_at->format('d M Y') }}</div>
                                    <div class="text-danger small fw-bold mt-1">
                                        <i class="fas fa-calendar-times me-1"></i> {{ \Carbon\Carbon::parse($loan->due_date)->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="text-center pe-4">
                                    @if ($loan->status == 'borrow' && !$loan->request_return_date)
                                        <form action="{{ route('loans.requestReturn', $loan->id) }}" method="POST" onsubmit="return confirm('Ajukan pengembalian sekarang?')">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-purple btn-sm rounded-pill px-3 shadow-sm">
                                                Kembalikan
                                            </button>
                                        </form>
                                    @elseif($loan->request_return_date)
                                        <div class="bg-soft-warning p-2 rounded-circle d-inline-block">
                                            <i class="fas fa-clock text-warning"></i>
                                        </div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3 d-block opacity-25"></i>
                                    <p class="mb-0 fw-medium">Hening sekali... Kamu belum meminjam alat apapun.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-4 overflow-hidden border-top border-purple border-5">
        <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-briefcase me-2 text-purple"></i>Alat di Tangan (Inventaris Saya)</h5>
            <span class="badge bg-purple text-white rounded-pill">{{ $myloan->where('status', 'borrow')->sum('qty') }} Total Pcs</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless align-middle">
                    <thead class="bg-soft-purple text-purple">
                        <tr class="text-center">
                            <th class="rounded-start-3" width="60">No</th>
                            <th class="text-start">Nama Alat</th>
                            <th>Kategori</th>
                            <th>Jumlah (Qty)</th>
                            <th class="rounded-end-3">Status Kondisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $toolsInHand = $myloan->where('status', 'borrow')->groupBy('tool_id');
                            $no = 1;
                        @endphp

                        @forelse($toolsInHand as $toolId => $loans)
                        <tr class="border-bottom border-light">
                            <td class="text-center text-muted fw-bold">{{ $no++ }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $loans->first()->tool->name_tools }}</div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light text-purple border border-purple-light px-3">{{ $loans->first()->tool->category->nama_kategori ?? 'Umum' }}</span>
                            </td>
                            <td class="text-center">
                                <span class="h5 mb-0 fw-bold text-purple">{{ $loans->sum('qty') }}</span> <small class="text-muted">Pcs</small>
                            </td>
                            <td class="text-center">
                                <span class="text-success small fw-medium"><i class="fas fa-shield-alt me-1"></i>Siap Digunakan</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted fst-italic">
                                Tidak ada alat yang sedang dibawa.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="bg-light rounded-3 p-3 mt-3 border-start border-warning border-4">
                <p class="mb-0 small text-dark">
                    <i class="fas fa-info-circle text-warning me-2"></i>
                    <strong>Penting:</strong> Harap jaga kondisi alat. Kerusakan atau kehilangan akan dikenakan denda sesuai kebijakan sistem.
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    /* Purple Theme Palette */
    .bg-purple-gradient { background: linear-gradient(45deg, #6f42c1, #a259ff); }
    .bg-purple-dark { background-color: #5227a1; }
    .bg-soft-purple { background-color: #f3ebff; }
    .bg-purple-light { background-color: #efebff; }
    .text-purple { color: #6f42c1; }
    .bg-purple { background-color: #6f42c1; }
    .border-purple { border-color: #6f42c1 !important; }
    .border-purple-light { border-color: #d1c1ed !important; }
    
    .bg-soft-success { background-color: #d1fae5; color: #065f46; }
    .bg-soft-warning { background-color: #fef3c7; color: #92400e; }
    .bg-soft-secondary { background-color: #f1f5f9; color: #475569; }

    .btn-purple { 
        background-color: #6f42c1; 
        color: white; 
        border: none; 
        transition: all 0.3s;
    }
    .btn-purple:hover { 
        background-color: #5a32a3; 
        color: white; 
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(111, 66, 193, 0.3);
    }

    /* Table & Card Tweaks */
    .table thead th {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .z-1 { z-index: 1; }
    .rounded-4 { border-radius: 1rem !important; }
    .mb-n2 { margin-bottom: -0.5rem !important; }
    .me-n2 { margin-right: -0.5rem !important; }
</style>
@endsection
