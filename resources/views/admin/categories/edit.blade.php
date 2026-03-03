@extends('app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body p-4">

        <div class="d-flex justify-content-start mb-3">
            <a href="{{ route('category.index') }}" class="btn btn-warning">
                <i class='fas fa-arrow-left'></i> Back
            </a>
        </div>

        <h3 class="text-center mb-4">Edit Category</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('category.update', $categories->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input type="text" name="nama_kategori" class="form-control" value="{{ $categories->nama_kategori }}" required>
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
