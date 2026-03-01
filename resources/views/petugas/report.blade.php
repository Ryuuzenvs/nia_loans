@extends('app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 no-print">
    <h3>Laporan</h3>
</div>

<div class="card mb-3 no-print">
    <div class="card-body">
        <form action="{{ route('officer.report') }}" method="GET" class="row g-3 mt-2">
            <div class="col-md-4">
                <label>Tanggal mulai</label>
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <label>Tanggal akhir</label>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-2">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="">Semua</option>
                    <option value="borrow" {{ request('status') == 'borrow' ? 'selected' : '' }}>Borrowed</option>
                    <option value="return" {{ request('status') == 'return' ? 'selected' : '' }}>Returned</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-success w-100">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="d-flex justify-content-end mb-3 no-print">
    <button onclick="window.print()" class="btn btn-primary">Print Report (PDF)</button>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th class="text-start">Peminjam</th>
                    <th class="text-start">Alat</th>
                    <th class="text-end">Tanggal Pinjam</th>
                    <th class="text-end">Tanggal kembali</th>
                    <th class="text-center">Status</th>
                    <th class="text-end">Qty</th>
                    <th class="text-end">Denda</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $r)
                <tr>
                    <td class="text-start fw-semibold">{{ $r->borrower->username }}</td>
                    <td class="text-start">{{ $r->tool->name_tools ?? 'Tool Removed' }}</td>
                    <td class="text-end text-muted">
                        {{ $r->created_at ? \Carbon\Carbon::parse($r->created_at)->format('d M Y H:i') : '-' }}
                    </td>
                    <td class="text-end text-muted">
                        {{ $r->return_date ? \Carbon\Carbon::parse($r->updated_at)->format('d M Y H:i') : '-' }}
                    </td>
                    <td class="text-center">
                        <span class="badge 
                            {{ 
                           $r->status == 'pending' ? 'bg-warning text-dark' : 
                               ($r->status == 'borrow' ? 'bg-info text-dark' : 'bg-success') 
                            }}">
                            {{ ucfirst($r->status) }}
                        </span>
                    </td>
 <td class="text-end fw-semibold">
                        Rp {{ number_format($r->qty, 0, ',', '.') }}
                    </td>
                    <td class="text-end fw-semibold">
                        Rp {{ number_format($r->penalty, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        No report data available
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <a href="{{ route('officer.dashboard') }}" class="btn btn-danger mt-3">Back</a>
    </div>
</div>

<style>
@media print {
    .no-print, .navbar, .btn, .footer {
        display: none !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
}
</style>
@endsection
