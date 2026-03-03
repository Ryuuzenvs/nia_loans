@extends('app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body p-4">
        <h3 class="text-center mb-4">Edit User</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error) 
                        <li>{{ $error }}</li> 
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">
                    Password <small class="text-muted">(Leave blank if not changing)</small>
                </label>
                <input type="password" name="password" class="form-control" placeholder="Enter new password">
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Re-enter password">
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-control" {{ $user->role === 'admin' ? 'disabled' : '' }}>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="officer" {{ $user->role === 'officer' ? 'selected' : '' }}>Officer</option>
                    <option value="borrower" {{ $user->role === 'borrower' ? 'selected' : '' }}>Borrower</option>
                </select>
                @if ($user->role === 'admin')
                    <input type="hidden" name="role" value="admin">
                @endif
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('users.index') }}" class="btn btn-warning ms-2">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection
