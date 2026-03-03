@extends('app')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">Pinjam alat</div>
        <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success py-2">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger py-2">{{ session('error') }}</div>
                @endif
            <div class="row">
                @foreach ($tools as $t)
                    <div class="col-md-4 mb-3">
                        <div class="card border-primary">
                            <div class="card-body">
                                <h5>{{ $t->name_tools }}</h5>
                                <p>Stock: <strong>{{ $t->stock }}</strong></p>
                                <form action="{{ route('pinjam.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="tool_id" value="{{ $t->id }}">
                                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                        data-bs-target="#confirmModal{{ $t->id }}">
                                        Loan
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="confirmModal{{ $t->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title">Konfirmasi Pinjaman</h5>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body text-center">
                                                    <p>Yakin ingin meminjam alat:</p>
                                                    <h5 class="fw-bold">{{ $t->name_tools }}</h5>
                                                    <div class="mt-3 px-5">
                                                    <label class="form-label">Jumlah Pinjam (Qty):</label>
                                                        <input type="number" name="qty" class="form-control text-center" value="1"  min="1" max="{{ $t->stock }}" required>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Batal
                                                    </button>

                                                    <form action="{{ route('pinjam.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="tool_id" value="{{ $t->id }}">
                                                        <button type="submit" class="btn btn-primary">
                                                            Ya, Pinjam
                                                        </button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
