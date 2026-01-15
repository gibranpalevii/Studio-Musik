<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gayza Studio - Sewa Studio & Alat Musik</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212;
            color: #ffffff;
        }

        /* Navbar Transparan dengan efek blur */
        .navbar {
            background: rgba(0, 0, 0, 0.8) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Hero Section */
        .hero { 
            background: linear-gradient(to bottom, rgba(0,0,0,0.6), #121212), url("{{ asset('images/background.jpg') }}"); 
            background-size: cover; 
            background-position: center; 
            height: 100vh;
            display: flex; 
            align-items: center; 
            justify-content: center;
            position: relative;
        }

        .hero-content {
            z-index: 2;
            text-align: center;
        }

        .btn-custom {
            padding: 12px 35px;
            font-weight: 600;
            border-radius: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        /* Styling Kartu */
        .card {
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(255, 193, 7, 0.2);
            border-color: #ffc107;
        }

        .card-img-top {
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
        }

        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 3rem;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background-color: #ffc107;
        }

        .price-tag {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
            padding: 5px 15px;
            border-radius: 20px;
            display: inline-block;
            font-weight: bold;
        }
        
        /* Saya menghapus class .btn-wa karena kita sekarang pakai style outline bawaan bootstrap */
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-warning" href="#">
                <i class="fas fa-music me-2"></i> GAYZA STUDIO
            </a>
            <div class="ms-auto">
                <a href="{{ url('/login') }}" class="btn btn-outline-warning btn-sm px-4 rounded-pill">
                    <i class="fas fa-user-lock me-1"></i> Admin Area
                </a>
            </div>
        </div>
    </nav>

    <div class="hero">
        <div class="hero-content container">
            <h1 class="display-3 fw-bold mb-3">Musik Adalah Hidup</h1>
            <p class="fs-5 text-light opacity-75 mb-5 w-75 mx-auto">
                Temukan studio rekaman terbaik dan sewa alat musik berkualitas tinggi untuk menunjang kreativitas Anda.
            </p>
            <a href="#katalog" class="btn btn-warning btn-custom shadow">Lihat Katalog</a>
        </div>
    </div>

    <div class="container py-5" id="katalog">
        
        <div class="text-center mt-5">
            <h2 class="fw-bold section-title">Pilihan Studio</h2>
        </div>

        <div class="row g-4 mb-5">
            @foreach($studios as $s)
            <div class="col-md-4">
                <div class="card h-100 text-white">
                    <div style="overflow: hidden; height: 220px;">
                        @if($s->foto)
                            <img src="{{ asset('storage/'.$s->foto) }}" class="card-img-top h-100 w-100" alt="{{ $s->nama_studio }}">
                        @else
                            <div class="bg-secondary h-100 d-flex align-items-center justify-content-center">
                                <i class="fas fa-microphone-alt fa-3x text-white-50"></i>
                            </div>
                        @endif
                    </div>
                    <div class="card-body text-center p-4 d-flex flex-column">
                        <h4 class="card-title fw-bold mb-2">{{ $s->nama_studio }}</h4>
                        <div class="mb-3">
                            <span class="price-tag">Rp {{ number_format($s->harga_per_jam) }} / jam</span>
                        </div>
                        <p class="small text-secondary mb-4 flex-grow-1">
                            Siap digunakan untuk latihan band & rekaman profesional.
                        </p>
                        
                        <div class="d-grid">
                            <a href="https://wa.me/6285178433310?text=Halo%20Admin%2C%20saya%20tertarik%20booking%20{{ urlencode($s->nama_studio) }}%20untuk%20latihan." 
                               target="_blank" 
                               class="btn btn-outline-success rounded-pill fw-bold">
                                <i class="fab fa-whatsapp me-2"></i> Booking
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5 pt-4">
            <h2 class="fw-bold section-title">Sewa Alat Musik</h2>
        </div>

        <div class="row g-4 pb-5">
            @foreach($alats as $a)
            <div class="col-md-3 col-6"> 
                <div class="card h-100 text-white">
                    <div style="overflow: hidden; height: 180px;">
                        @if($a->foto)
                            <img src="{{ asset('storage/'.$a->foto) }}" class="card-img-top h-100 w-100" alt="{{ $a->nama_alat }}">
                        @else
                            <div class="bg-secondary h-100 d-flex align-items-center justify-content-center">
                                <i class="fas fa-guitar fa-3x text-white-50"></i>
                            </div>
                        @endif
                    </div>
                    <div class="card-body text-center p-3 d-flex flex-column">
                        <h5 class="card-title fw-bold" style="font-size: 1rem;">{{ $a->nama_alat }}</h5>
                        <div class="mb-3 flex-grow-1">
                            <span class="price-tag" style="font-size: 0.8rem;">
                                Rp {{ number_format($a->harga_sewa) }}
                            </span>
                        </div>

                        <div class="d-grid">
                            <a href="https://wa.me/6285178433310?text=Halo%20Admin%2C%20saya%20ingin%20sewa%20alat%20{{ urlencode($a->nama_alat) }}." 
                               target="_blank" 
                               class="btn btn-outline-success btn-sm rounded-pill fw-bold">
                                <i class="fab fa-whatsapp me-1"></i> Booking
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>

    <footer class="bg-black text-white text-center py-4 border-top border-secondary">
        <div class="container">
            <h5 class="fw-bold text-warning mb-3">GAYZA STUDIO MUSIK</h5>
            <p class="small text-secondary mb-0">&copy; {{ date('Y') }} All Rights Reserved. Created with Laravel.</p>
        </div>
    </footer>

</body>
</html>