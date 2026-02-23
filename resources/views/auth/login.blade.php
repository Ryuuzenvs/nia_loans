<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PinjamAlat</title>
    <link href="{{ asset('bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            overflow: hidden;
        }
        /* Custom Purple Accent */
        .btn-purple {
            background-color: #6f42c1;
            color: white;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .btn-purple:hover {
            background-color: #59359a;
            color: white;
            transform: translateY(-2px);
        }
        .text-purple { color: #6f42c1; }
        
        /* Floating Logo Style dari Proyek 1 */
        .login-card {
            margin-top: 80px;
            border-radius: 20px;
            position: relative;
        }
        .logo-wrapper {
            position: absolute;
            top: -75px;
            left: 50%;
            transform: translateX(-50%);
            width: 140px;
            height: 140px;
            background: linear-gradient(135deg, #6f42c1 0%, #a29bfe 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(111, 66, 193, 0.3);
            border: 5px solid white;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center">

    <div style="width: 100%; max-width: 400px;" class="px-4">
        
        <div class="card login-card shadow-lg border-0">
            <div class="logo-wrapper">
                <i class="fas fa-book-open fa-4x text-white"></i>
            </div>

            <div class="card-body p-5 pt-5 mt-5">
                <div class="text-center mb-4">
                    <h2 class="fw-bold mb-1">Book <span class="text-purple">Borrowing</span></h2>
                    <p class="text-muted small">Login to continue to system</p>
                </div>

                @if (session('success'))
                    <div class="alert alert-success py-2 small">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger py-2 small">{{ session('error') }}</div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" id="loginForm">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Username</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                            <input type="text" name="username" class="form-control bg-light border-start-0" 
                                   placeholder="Username anda" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                            <input type="password" name="password" id="password" 
                                   class="form-control bg-light border-start-0" 
                                   placeholder="••••••••" required>
                        </div>
                        <div id="passwordError" class="text-danger small mt-1" style="display: none;">
                            Password minimal 8 karakter.
                        </div>
                    </div>

                    <button type="submit" class="btn btn-purple w-100 py-2 fw-bold" id="loginBtn">
                        LOGIN
                    </button>
                </form>

                <div class="text-center mt-4">
                    <a href="{{ route('home') }}" class="text-decoration-none small text-muted">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>

        <p class="text-center text-muted mt-4 small">
            &copy; 2026 PinjamAlat System
        </p>
    </div>

    <script>
        document.getElementById('loginForm').onsubmit = function(e) {
            const passwordInput = document.getElementById('password');
            const passwordError = document.getElementById('passwordError');
            const btn = document.getElementById('loginBtn');

            if (passwordInput.value.length < 8) {
                e.preventDefault();
                passwordInput.classList.add('is-invalid');
                passwordError.style.display = 'block';
                return false;
            }

            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Memproses...';
        };

        document.getElementById('password').oninput = function() {
            this.classList.remove('is-invalid');
            document.getElementById('passwordError').style.display = 'none';
        };
    </script>

</body>
</html>
