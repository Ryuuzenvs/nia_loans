@extends('app')

@section('title', 'System Activity Logs')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Activity Logs</h2>
            <p class="text-muted small">Monitoring system events and user actions</p>
        </div>
        <div>
            <button onclick="window.location.reload()" class="btn btn-soft-purple btn-sm rounded-pill px-3">
                <i class="fas fa-sync-alt me-1"></i> Refresh Logs
            </button>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white border-bottom py-3 px-4">
            <h5 class="mb-0 fw-bold text-slate-800">
                <i class="fas fa-history text-purple me-2"></i>History Log List
            </h5>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th class="ps-4 py-3" width="80">No</th>
                            <th class="py-3" width="220">Timestamp</th>
                            <th class="py-3">Activity Description</th>
                            <th class="py-3 text-end pe-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $key => $log)
                        <tr>
                            <td class="ps-4 fw-medium text-muted">
                                {{ $logs->firstItem() + $key }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-soft-purple rounded-3 p-2 me-3 d-none d-md-block">
                                        <i class="far fa-calendar-alt text-purple"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark small">
                                            {{ $log->created_at->format('d M Y') }}
                                        </div>
                                        <div class="text-muted" style="font-size: 0.75rem;">
                                            {{ $log->created_at->format('H:i:s') }} WIB
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="text-dark fw-medium">{{ $log->data }}</span>
                                    <small class="text-muted">ID Log: #{{ str_pad($log->id, 5, '0', STR_PAD_LEFT) }}</small>
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <span class="badge bg-soft-success text-success rounded-pill px-3 py-2">
                                    <i class="fas fa-check-circle me-1"></i> Recorded
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="60" class="opacity-25 mb-3" alt="Empty">
                                <p class="mb-0">Belum ada riwayat aktivitas sistem yang tercatat.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white border-top py-3">
            <div class="d-flex justify-content-center">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    /* Purple Theme Utilities */
    .text-purple { color: #6f42c1; }
    
    .bg-soft-purple { 
        background-color: #f3ebff; 
    }

    .btn-soft-purple {
        background-color: #f3ebff;
        color: #6f42c1;
        border: none;
        transition: all 0.3s;
    }

    .btn-soft-purple:hover {
        background-color: #6f42c1;
        color: white;
    }

    .bg-soft-success { 
        background-color: #d1fae5; 
        color: #047857; 
    }

    /* Table Styling */
    .table thead th {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: none;
    }

    .table tbody tr {
        transition: background-color 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: #faf8ff;
    }

    /* Pagination Customization (Bootstrap 5) */
    .pagination {
        margin-bottom: 0;
        gap: 5px;
    }

    .page-item.active .page-link {
        background-color: #6f42c1;
        border-color: #6f42c1;
        border-radius: 8px;
    }

    .page-link {
        color: #6f42c1;
        border-radius: 8px;
        border: none;
        padding: 8px 16px;
    }
</style>
@endsection
