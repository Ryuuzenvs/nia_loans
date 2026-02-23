<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PinjamAlat')</title>
    
    <link href="{{ asset('bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <style>
        /* Custom Purple Theme */
        .bg-purple { background-color: #6f42c1 !important; }
        .btn-purple { 
            background-color: #6f42c1; 
            color: white; 
            border: none;
        }
        .btn-purple:hover { 
            background-color: #59359a; 
            color: white; 
        }
        .text-purple { color: #6f42c1 !important; }
        .border-purple { border-color: #6f42c1 !important; }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">
            @php $user = Auth::user(); @endphp
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="fas fa-tools me-2 text-purple"></i>PinjamAlat
            </a>
            
            <button class="navbar-expand-lg navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-purple ms-lg-3 px-4" href="{{ route('login') }}">Login</a>
                        </li>
                    @endguest

                    @auth
                        @if ($user->role === 'admin')
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            <a class="nav-link" href="{{ route('category.index') }}">Category</a>
                            <a class="nav-link" href="{{ route('tools.index') }}">Tool</a>
                            <a class="nav-link" href="{{ route('users.index') }}">User</a>
                            <a class="nav-link" href="{{ route('admin.loans.index') }}">Loan</a>
                            <a class="nav-link" href="{{ route('admin.logs.index') }}">logs</a>
                        @elseif($user->role === 'officer')
                            <a class="nav-link" href="{{ route('officer.dashboard') }}">Management</a>
                            <a class="nav-link" href="{{ route('users.create') }}">Regis</a>
                            <a class="nav-link" href="{{ route('officer.report') }}">report</a>
                        @elseif($user->role === 'borrower')
                            <a class="nav-link" href="{{ route('borrower.dashboard') }}">My Loans</a>
                            <a class="nav-link" href="{{ route('borrower.pinjam') }}">Get Loans</a>
                            <a class="nav-link" href="{{ route('borrower.history') }}">Get history</a>
                            <a class="nav-link" href="{{ route('profile.show', auth()->id()) }}">Get profile</a>
                        @endif

                        <li class="nav-item ms-lg-3">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-light btn-sm">
                                    Logout ({{ $user->username }})
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        @yield('content')
    </div>

    <script src="{{ asset('bootstrap.bundle.min.js') }}"></script>
</body>
</html>
