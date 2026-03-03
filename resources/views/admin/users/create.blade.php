@extends('app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body p-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">Create User</h3>
            <a href="javascript:history.back()" class="btn btn-warning btn-sm">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error) 
                        <li>{{ $error }}</li> 
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="username" class="form-control" placeholder="Enter full name" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email@example.com" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Minimum 8 characters" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Re-enter password" required>
            </div>


    <div class="mb-3">
        <label class="form-label">Role</label>
        <select name="role" class="form-control" required>
            <option value="" disabled selected>Select role</option>
            <option value="borrower">Borrower</option>
            <option value="officer">Officer</option>
            @if(auth()->user()->role === 'admin')
            <option value="admin">Admin</option>
@endif
        </select>
    </div>



            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class='fa-solid fa-plus'></i> Create
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
