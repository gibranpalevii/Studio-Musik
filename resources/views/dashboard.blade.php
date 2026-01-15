<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Gayza Studio</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-gold: #ffc107;
            --bg-dark: #121212;
            --bg-card: #1e1e1e;
            --text-gray: #b0b3b8;
        }

        body {
            background-color: var(--bg-dark);
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
        }

        /* Sidebar Styling */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #1a1a1a 0%, #000000 100%);
            border-right: 1px solid #333;
        }
        .brand-title { color: var(--primary-gold); font-weight: 800; letter-spacing: 1px; text-transform: uppercase; }
        .sidebar a { color: var(--text-gray); text-decoration: none; display: block; padding: 12px 20px; margin-bottom: 5px; border-radius: 8px; transition: all 0.3s; font-weight: 500; }
        .sidebar a:hover { background: rgba(255, 193, 7, 0.1); color: var(--primary-gold); transform: translateX(5px); }
        .sidebar a.active { background: var(--primary-gold); color: #000; font-weight: bold; box-shadow: 0 0 15px rgba(255, 193, 7, 0.4); }

        /* Cards & Content */
        .card { background-color: var(--bg-card); border: 1px solid #333; border-radius: 12px; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.3); }
        .card-stat { transition: transform 0.3s; position: relative; overflow: hidden; }
        .card-stat:hover { transform: translateY(-5px); border-color: var(--primary-gold); }
        .stat-icon { font-size: 2.5rem; color: var(--primary-gold); opacity: 0.8; }

        /* Hero Banner */
        .hero-card {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset("images/background.jpg") }}');
            background-size: cover; background-position: center; border: none;
        }

        /* Table Styling */
        .table-dark-custom { --bs-table-bg: #1e1e1e; --bs-table-color: #fff; --bs-table-border-color: #333; }
        .table-dark-custom th { color: var(--primary-gold); font-weight: 600; text-transform: uppercase; font-size: 0.85rem; }

        /* Buttons & Badges */
        .btn-gold { background-color: var(--primary-gold); color: #000; font-weight: bold; border: none; }
        .btn-gold:hover { background-color: #e0a800; color: #000; }
        .badge-proses { background: rgba(255, 193, 7, 0.2); color: #ffc107; border: 1px solid #ffc107; }
        .badge-selesai { background: rgba(25, 135, 84, 0.2); color: #198754; border: 1px solid #198754; }
        .badge-batal { background: rgba(220, 53, 69, 0.2); color: #dc3545; border: 1px solid #dc3545; }

        /* Pagination Style */
        .pagination { margin-bottom: 0; }
        .page-item .page-link { background-color: #1a1a1a; border-color: #333; color: #b0b3b8; font-size: 0.85rem; }
        .page-item.disabled .page-link { background-color: #121212; border-color: #333; color: #555; }
        .page-item.active .page-link { background-color: var(--primary-gold); border-color: var(--primary-gold); color: #000; font-weight: bold; }
        .page-item .page-link:hover { background-color: #333; color: var(--primary-gold); }
    </style>
</head>
<body>

<div class="d-flex">
    <div class="sidebar col-md-2 d-none d-md-block p-4">
        <div class="text-center mb-5">
            <i class="fas fa-music fa-2x text-warning mb-2"></i>
            <h5 class="brand-title">Gayza Studio</h5>
        </div>
        
        <div class="nav flex-column">
            <small class="text-uppercase text-light mb-2 fw-bold" style="font-size: 10px; letter-spacing: 1px;">Menu Utama</small>
            <a href="{{ url('/dashboard') }}" class="active"><i class="fas fa-home me-2"></i> Dashboard</a>
            <a href="{{ url('/studio') }}"><i class="fas fa-microphone-alt me-2"></i> Studio</a>
            <a href="{{ url('/alat') }}"><i class="fas fa-guitar me-2"></i> Alat Musik</a>
            <a href="{{ url('/pelanggan') }}"><i class="fas fa-users me-2"></i> Pelanggan</a>
            <a href="{{ url('/transaksi') }}"><i class="fas fa-receipt me-2"></i> Transaksi</a>
            <a href="{{ url('/laporan') }}"><i class="fas fa-file-invoice-dollar me-2"></i> Laporan</a>
            
            <div class="mt-3 pt-2 border-top border-secondary">
                <a href="{{ url('/logout') }}" class="text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
            </div>
        </div>
    </div>

    <div class="col-md-10 p-4" style="height: 100vh; overflow-y: auto;">
        
        <div class="d-md-none mb-3">
            <h4 class="brand-title text-center">GAYZA STUDIO</h4>
        </div>

        <div class="card hero-card mb-4 p-4 shadow-lg">
            <div class="d-flex align-items-center"> <div>
                    <h2 class="fw-bold">Musik Adalah Hidup</h2>
                    <p class="text-white-50 mb-0">Selamat datang kembali, <strong>{{ Session::get('nama_admin') ?? 'Admin' }}</strong>. Kelola studio dengan mudah.</p>
                </div>
                </div>
        </div>

        <div class="row mb-4 g-3">
            <div class="col-md-3">
                <div class="card card-stat p-3 h-100 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <small class="text-light text-uppercase">Pendapatan</small>
                        <h4 class="mb-0 fw-bold">Rp {{ number_format($totalPendapatan) }}</h4>
                    </div>
                    <div class="stat-icon"><i class="fas fa-wallet"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stat p-3 h-100 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <small class="text-light text-uppercase">Total Studio</small>
                        <h4 class="mb-0 fw-bold">{{ $totalStudio }} Room</h4>
                    </div>
                    <div class="stat-icon"><i class="fas fa-door-closed"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stat p-3 h-100 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <small class="text-light text-uppercase">Alat Musik</small>
                        <h4 class="mb-0 fw-bold">{{ $totalAlat }} Unit</h4>
                    </div>
                    <div class="stat-icon"><i class="fas fa-guitar"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stat p-3 h-100 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <small class="text-light text-uppercase">Pelanggan</small>
                        <h4 class="mb-0 fw-bold">{{ $totalPelanggan }} Orang</h4>
                    </div>
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-transparent border-secondary d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0 fw-bold text-white"><i class="fas fa-history text-warning me-2"></i> Riwayat Transaksi</h5>
                <small class="text-light">
                    Hal {{ $transaksiTerbaru->currentPage() }} dari {{ $transaksiTerbaru->lastPage() }}
                </small>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark-custom table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Tanggal</th>
                                <th>Pelanggan</th>
                                <th>Item Sewa</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksiTerbaru as $t)
                            <tr>
                                <td class="ps-4 text-white-50">{{ date('d/m/y', strtotime($t->tanggal)) }}</td>
                                
                                <td>
                                    <div class="fw-bold text-white">{{ $t->pelanggan->nama_pelanggan ?? 'Terhapus' }}</div>
                                </td>

                                <td>
                                    <span class="text-warning">{{ $t->nama_item }}</span>
                                    <div class="text-white-50" style="font-size: 10px;">{{ $t->jenis_transaksi }}</div>
                                </td>

                                <td class="fw-bold">Rp {{ number_format($t->total_biaya) }}</td>
                                
                                <td>
                                    @if($t->status == 'Selesai')
                                        <span class="badge badge-selesai">Selesai</span>
                                    @elseif($t->status == 'Batal')
                                        <span class="badge badge-batal">Batal</span>
                                    @else
                                        <span class="badge badge-proses">Proses</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    Belum ada transaksi.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card-footer bg-transparent border-secondary py-3">
                <div class="d-flex justify-content-end">
                    {{ $transaksiTerbaru->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
        
        <footer class="mt-4 text-center text-muted" style="font-size: 12px;">
            &copy; {{ date('Y') }} Gayza Studio System.
        </footer>

    </div>
</div>

</body>
</html>