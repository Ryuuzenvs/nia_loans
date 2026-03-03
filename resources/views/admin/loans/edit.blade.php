@extends('app')

@section('content')
<form action="{{ route('admin.loans.update', $loan->id) }}" method="POST">
    @csrf @method('PUT')
    
    <label>Jumlah Denda</label>
    <input type="number" name="penalty" value="{{ $loan->penalty }}" class="form-control">

    <label>Status</label>
    <select name="status" class="form-control">
        <option value="pending" {{ $loan->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="borrow" {{ $loan->status == 'borrow' ? 'selected' : '' }}>Dipinjam</option>
        <option value="return" {{ $loan->status == 'return' ? 'selected' : '' }}>Kembali</option>
    </select>


    <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>

</form>
    <a href="{{route('admin.loans.index')}}" class="btn btn-danger">back</a>
@endsection
