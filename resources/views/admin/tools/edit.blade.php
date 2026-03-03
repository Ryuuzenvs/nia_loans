@extends('app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body p-4">

        <div class="d-flex justify-content-start mb-3">
            <a href="{{ route('tools.index') }}" class="btn btn-warning">
                <i class='fa-solid fa-arrow-left'></i> Back
            </a>
        </div>

        <h3 class="text-center mb-4">Edit Book</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('tools.update', $tools->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Book Name</label>
                <input type="text" name="name_tools" value="{{ $tools->name_tools }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" value="{{ $tools->stock }}" required>
            </div>
<div class="mb-3">
                <label class="form-label">price</label>
                <input type="number" name="price" class="form-control" value="{{ $tools->price }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" required>
                    <option value="" disabled>-- Select Category --</option>
                    @forelse($category as $c)
                        <option value="{{ $c->id }}" {{ $c->id == $tools->category_id ? 'selected' : '' }}>
                            {{ $c->nama_kategori }}
                        </option>
                    @empty
                        <option disabled>No categories available. Please create one first!</option>
                    @endforelse
                </select>
                @error('category_id')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class='fa-solid fa-pen-to-square'></i> Update
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
