@extends('app')

@section('title', 'Admin | Loan Management')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark">Loan Management</h2>
            <p class="text-muted small mb-0">Monitor and manage all tool borrowing transactions</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
            <a href="{{ route('admin.loans.create') }}" class="btn btn-purple btn-sm rounded-pill px-3 shadow-sm">
                <i class="fas fa-plus me-1"></i> Create Loan
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th class="ps-4 py-3">Borrower & Tool</th>
                            <th class="py-3">Dates</th>
                            <th class="py-3 text-center">Status</th>
                            <th class="py-3 text-center">Penalty</th>
                            <th class="py-3 text-center">qty</th>
                            <th class="py-3">Approver</th>
                            <th class="py-3 text-center pe-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $l)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark">{{ $l->borrower->username }}</div>
                                    <small class="text-purple fw-medium">
                                        <i class="fas fa-tools me-1"></i>{{ $l->tool->name_tools ?? 'Deleted Tool' }}
                                    </small>
                                </td>
                                <td>
                                    <div class="small">
                                        <span class="text-muted">Loan:</span> {{ \Carbon\Carbon::parse($l->loan_date)->format('d M Y') }}
                                    </div>
                                    <div class="small">
                                        <span class="text-muted">Return:</span> 
                                        <span class="{{ !$l->return_date ? 'fst-italic text-warning' : '' }}">
                                            {{ $l->return_date ? \Carbon\Carbon::parse($l->return_date)->format('d M Y') : 'no data..' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @php
                                        $statusClass = match ($l->status) {
                                            'pending' => 'bg-soft-warning text-warning',
                                            'borrow'  => 'bg-soft-primary text-primary',
                                            'returned'=> 'bg-soft-success text-success',
                                            default   => 'bg-soft-secondary text-secondary',
                                        };
                                        $statusText = $l->status == 'borrow' ? 'BORROWED' : strtoupper($l->status);
                                    @endphp
                                    <span class="badge {{ $statusClass }} rounded-pill px-3 py-2" style="font-size: 0.7rem;">
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($l->penalty > 0)
                                        <span class="text-danger fw-bold small">Rp {{ number_format($l->penalty) }}</span>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                             <td class="text-center">
                                        <span class="fw-bold small"> {{ number_format($l->qty) }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 24px; height: 24px;">
                                            <i class="fas fa-user-shield text-muted" style="font-size: 0.6rem;"></i>
                                        </div>
                                        <small class="text-dark">{{ $l->approver->username ?? 'No Admin' }}</small>
                                    </div>
                                </td>
                                <td class="text-center pe-4">
                                    <div class="btn-group gap-1">
                                        <a href="{{ route('admin.loans.edit', $l->id) }}" class="btn btn-soft-warning btn-sm rounded-3">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('loans.destroy', $l->id) }}" method="POST"
                                              onsubmit="return confirm('Delete transaction? Stock will be adjusted.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-soft-danger btn-sm rounded-3">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-center">
                {{ $loans->links() }}
            </div>
        </div>
    </div>
</div>

<style>
    /* Modern Theme Customization */
    .bg-purple-gradient { background: linear-gradient(135deg, #6f42c1 0%, #a259ff 100%); }
    .text-purple { color: #6f42c1; }
    .btn-purple { background-color: #6f42c1; color: white; border: none; }
    .btn-purple:hover { background-color: #59359a; color: white; transform: translateY(-1px); }

    /* Soft Colors for Badges and Buttons */
    .bg-soft-primary { background-color: #e0e7ff; color: #4338ca; }
    .bg-soft-warning { background-color: #fef3c7; color: #b45309; }
    .bg-soft-success { background-color: #d1fae5; color: #047857; }
    .bg-soft-secondary { background-color: #f1f5f9; color: #475569; }

    .btn-soft-warning { background-color: #fffbeb; color: #d97706; border: none; }
    .btn-soft-warning:hover { background-color: #fef3c7; color: #b45309; }
    .btn-soft-danger { background-color: #fef2f2; color: #dc2626; border: none; }
    .btn-soft-danger:hover { background-color: #fee2e2; color: #991b1b; }

    /* Typography */
    .table thead th {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: none;
    }
    
    .table tbody tr {
        transition: all 0.2s;
    }
    
    .table tbody tr:hover {
        background-color: #f8f9fa;
    }
</style>
@endsection
