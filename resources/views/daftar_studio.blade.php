<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Studio - Gayza Studio</title>
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
        body { background-color: var(--bg-dark); color: #ffffff; font-family: 'Poppins', sans-serif; }
        
        /* Sidebar */
        .sidebar { min-height: 100vh; background: linear-gradient(180deg, #1a1a1a 0%, #000000 100%); border-right: 1px solid #333; }
        .brand-title { color: var(--primary-gold); font-weight: 800; letter-spacing: 1px; text-transform: uppercase; }
        .sidebar a { color: var(--text-gray); text-decoration: none; display: block; padding: 12px 20px; margin-bottom: 5px; border-radius: 8px; transition: all 0.3s; font-weight: 500; }
        .sidebar a:hover { background: rgba(255, 193, 7, 0.1); color: var(--primary-gold); transform: translateX(5px); }
        .sidebar a.active { background: var(--primary-gold); color: #000; font-weight: bold; box-shadow: 0 0 15px rgba(255, 193, 7, 0.4); }

        /* Content */
        .card { background-color: var(--bg-card); border: 1px solid #333; }
        .btn-gold { background-color: var(--primary-gold); color: #000; font-weight: bold; border: none; }
        .btn-gold:hover { background-color: #e0a800; color: #000; }

        /* Table Custom */
        .table-dark-custom { --bs-table-bg: #1e1e1e; --bs-table-color: #fff; --bs-table-border-color: #333; }
        .table-dark-custom th { color: var(--primary-gold); text-transform: uppercase; font-size: 0.85rem; }
        .img-studio { width: 80px; height: 50px; object-fit: cover; border-radius: 6px; border: 1px solid #444; }

        /* Badges */
        .badge-success { background: rgba(25, 135, 84, 0.2); color: #198754; border: 1px solid #198754; }
        .badge-warning { background: rgba(255, 193, 7, 0.2); color: #ffc107; border: 1px solid #ffc107; }
        .badge-danger { background: rgba(220, 53, 69, 0.2); color: #dc3545; border: 1px solid #dc3545; }
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
            <a href="{{ url('/dashboard') }}"><i class="fas fa-home me-2"></i> Dashboard</a>
            <a href="{{ url('/studio') }}" class="active"><i class="fas fa-microphone-alt me-2"></i> Studio</a>
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Data Studio</h2>
                <p class="text-white-50 mb-0">Kelola daftar ruangan studio musik Anda.</p>
            </div>
            <a href="{{ url('/studio/create') }}" class="btn btn-gold shadow-sm">
                <i class="fas fa-plus me-2"></i> Tambah Studio
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success bg-dark text-success border-success mb-4">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark-custom table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">No</th>
                                <th>Foto</th>
                                <th>Nama Studio</th>
                                <th>Harga / Jam</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($studios as $key => $s)
                            <tr>
                                <td class="ps-4">{{ $key + 1 }}</td>
                                <td>
                                    @if($s->foto)
                                        <img src="{{ asset('storage/'.$s->foto) }}" class="img-studio" alt="Foto">
                                    @else
                                        <div class="img-studio d-flex align-items-center justify-content-center bg-dark text-muted">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-bold">{{ $s->nama_studio }}</td>
                                <td>Rp {{ number_format($s->harga_per_jam) }}</td>
                                <td>
                                    @if($s->status == 'Tersedia')
                                        <span class="badge badge-success px-3 rounded-pill">Tersedia</span>
                                    @elseif($s->status == 'Dipakai')
                                        <span class="badge badge-warning px-3 rounded-pill">Sedang Dipakai</span>
                                    @else
                                        <span class="badge badge-danger px-3 rounded-pill">Maintenance</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ url('/studio/edit/' . $s->id_studio) }}" class="btn btn-sm btn-outline-warning me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ url('/studio/hapus/' . $s->id_studio) }}" 
                                       class="btn btn-sm btn-outline-danger"
                                       onclick="return confirm('Yakin ingin menghapus studio ini?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                            @if($studios->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-microphone-slash fa-3x mb-3 opacity-25"></i><br>
                                    Belum ada data studio.
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>