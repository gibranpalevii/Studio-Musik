<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Studio Musik</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            /* Menggunakan background yang sama dengan Home agar konsisten */
            background: linear-gradient(to bottom, rgba(0,0,0,0.6), #121212), url("{{ asset('images/background.jpg') }}");
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background-color: rgba(30, 30, 30, 0.9); /* Transparan gelap */
            border: 1px solid #444;
            border-radius: 15px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px); /* Efek blur di belakang kartu */
        }

        .form-control {
            background-color: #2c2c2c;
            border: 1px solid #444;
            color: #fff;
            padding: 12px;
            border-radius: 8px;
        }

        .form-control:focus {
            background-color: #333;
            color: #fff;
            border-color: #ffc107; /* Warna kuning warning */
            box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
        }

        .btn-login {
            background-color: #ffc107;
            color: #000;
            font-weight: bold;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background-color: #e0a800;
            transform: translateY(-2px);
        }

        .text-warning {
            color: #ffc107 !important;
        }
        
        /* Placeholder color fix */
        ::placeholder { 
            color: #888 !important;
            opacity: 1; 
        }
    </style>
</head>
<body>

    <div class="login-card text-center text-white">
        <div class="mb-4">
            <i class="fas fa-music fa-3x text-warning mb-3"></i>
            <h3 class="fw-bold">Admin Login</h3>
            <p class="text-secondary small">Masuk untuk mengelola studio</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger py-2 small">
                <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
            </div>
        @endif

        <form action="{{ url('/login-proses') }}" method="POST">
            @csrf
            
            <div class="mb-3 text-start">
                <label class="form-label small text-secondary">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-dark border-secondary text-secondary"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="admin@studio.com" required>
                </div>
            </div>

            <div class="mb-4 text-start">
                <label class="form-label small text-secondary">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-dark border-secondary text-secondary"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn btn-login mb-3">
                MASUK <i class="fas fa-sign-in-alt ms-1"></i>
            </button>
        </form>

        <a href="{{ url('/') }}" class="text-decoration-none text-secondary small">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
        </a>
    </div>

</body>
</html>