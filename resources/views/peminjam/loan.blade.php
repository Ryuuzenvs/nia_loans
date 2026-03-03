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
                <form action="{{ route('pinjam.store') }}" method="POST">
    @csrf
    <div class="row">
        @foreach ($tools as $t)
            <div class="col-md-4 mb-3">
                <div class="card border-primary">
                    <div class="card-body">
                        <h5>{{ $t->name_tools }}</h5>
                        <p>Stock: <strong>{{ $t->stock }}</strong></p>
                        
                        <div class="mt-3">
                            <label class="form-label">Jumlah Pinjam:</label>
                            <input type="number" 
                                   name="items[{{ $t->id }}][qty]" 
                                   class="form-control text-center" 
                                   value="0" min="0" max="{{ $t->stock }}">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="sticky-bottom bg-white p-3 shadow-lg text-center">
        <button type="submit" class="btn btn-success btn-lg w-50">
            Pinjam Semua Alat yang Dipilih
        </button>
    </div>
</form>
            </div>
        </div>
    </div>
@endsection
