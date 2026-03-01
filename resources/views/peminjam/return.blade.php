@extends('app')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-success text-white">
        History
    </div>

    <div class="card-body">
        <table class="table table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th class="text-start">Alat</th>
                    <th class="text-end">Tanggal pinjam</th>
                    <th class="text-end">Tanggal Kembali</th>
                    <th class="text-end">Denda</th>
                </tr>
            </thead>

            <tbody>
                @forelse($history as $h)
                <tr>
                    <td class="text-start fw-semibold">
                        {{ $h->tool->name_tools }}
                    </td>

                    <td class="text-end text-muted">
                        {{ $h->loan_date ? \Carbon\Carbon::parse($h->loan_date)->format('d M Y H:i') : '-' }}
                    </td>

                    <td class="text-end text-muted">
                        {{ $h->return_date ? \Carbon\Carbon::parse($h->return_date)->format('d M Y H:i') : '-' }}
                    </td>

                    <td class="text-end fw-semibold">
                        Rp {{ number_format($h->penalty, 0, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        Empty
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
