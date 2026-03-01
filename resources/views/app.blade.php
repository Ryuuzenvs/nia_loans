<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="PinjamAlat - Sistem Peminjaman Alat">
    <meta property="og:description" content="Kelola alat, monitoring denda, dan laporan rapi siap cetak.">
    <meta property="og:image" content="https://placehold.co/600x400/6f42c1/ffffff?text=PinjamAlat+System">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="PinjamAlat - Sistem Peminjaman Alat">
    <meta property="twitter:description" content="Kelola alat, monitoring denda, dan laporan rapi siap cetak.">
    <meta property="twitter:image" content="https://placehold.co/600x400/6f42c1/ffffff?text=PinjamAlat+System">
    <title>@yield('title', 'PinjamAlat')</title>
    
    <link href="{{ asset('bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+..." crossorigin="anonymous">

    
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
                            <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-purple ms-lg-3 px-4" href="{{ route('login') }}">Login</a>
                        </li>
                    @endguest

                    @auth
                        @if ($user->role === 'admin')
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            <a class="nav-link" href="{{ route('category.index') }}">Kategori</a>
                            <a class="nav-link" href="{{ route('tools.index') }}">Alat</a>
                            <a class="nav-link" href="{{ route('users.index') }}">User</a>
                            <a class="nav-link" href="{{ route('admin.loans.index') }}">Pinjam</a>
                            <a class="nav-link" href="{{ route('admin.logs.index') }}">logs</a>
                        @elseif($user->role === 'officer')
                            <a class="nav-link" href="{{ route('officer.dashboard') }}">Menejemen</a>
                            <a class="nav-link" href="{{ route('users.create') }}">Regis</a>
                            <a class="nav-link" href="{{ route('officer.report') }}">Lapor</a>
                        @elseif($user->role === 'borrower')
                            <a class="nav-link" href="{{ route('borrower.dashboard') }}">Menejemen</a>
                            <a class="nav-link" href="{{ route('borrower.pinjam') }}">Pinjam</a>
                            <a class="nav-link" href="{{ route('borrower.history') }}">Riwayat </a>
                            <a class="nav-link" href="{{ route('profile.show', auth()->id()) }}">Profile</a>
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
