@extends('app')

@section('content')
<h3 class="mb-3">Dashboard</h3>
@if (session('success'))
                    <div class="alert alert-success py-2">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger py-2">{{ session('error') }}</div>
                @endif
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-hover align-middle bg-white">
            <thead class="table-light">
                <tr>
                    <th class="text-start">Peminjam</th>
                    <th class="text-start">Alat</th>
                    <th class="text-center">Status</th>
                    <th class="text-end">qty</th>
                    <th class="text-end">Tanggal pinjam</th>
                    <th class="text-end">Deadline</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($loans as $l)
                <tr>
                    <td class="text-start fw-semibold">
                        <a href="{{ route('profile.show', $l->borrower->id) }}" class="text-decoration-none">
                        <i class="fas fa-user-circle"></i> {{ $l->borrower->username }}
                    </a>
                    </td>

                    <td class="text-start">
                        {{ $l->tool->name_tools ?? 'Alat Dihapus' }}
                    </td>

                    <td class="text-center">
                        <span class="badge 
                            {{ $l->status == 'pending' ? 'bg-warning text-dark' : 
                               ($l->status == 'borrow' ? 'bg-info text-dark' : 'bg-success') }}">
                            {{ ucfirst($l->status) }}
                        </span>
                    </td>

                    <td class="text-end">
                        {{ $l->qty}}
                    </td>

                    <td class="text-end">
                        {{ $l->loan_date }}
                    </td>

                    <td class="text-end">
                        {{ $l->due_date}}
                    </td>


                    <td class="text-end">
                        @if ($l->status == 'pending')
                            <form action="{{ route('loans.approve', $l->id) }}" method="POST" class="d-inline">
                                @csrf @method('PUT')
                                <button class="btn btn-sm btn-primary">
                                    Approve
                                </button>
                            </form>

                        @elseif($l->status == 'borrow')
                            <form action="{{ route('loans.return', $l->id) }}" method="POST" class="d-inline">
                                @csrf @method('PUT')
                                <button class="btn btn-sm btn-success">
                                    Terima Kembali
                                </button>
                            </form>

                        @else
                            <span class="text-muted small">
                                Return <br>
                                Rp {{ number_format($l->penalty, 0, ',', '.') }}
                            </span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">
<a href="{{ route('users.create') }}" class="btn btn-primary">
                <i class='fa-solid fa-plus'></i> Regis user
            </a>
<a href="{{ route('officer.report') }}" class="btn btn-primary">
   Print Report
</a>
</div>
@endsection
