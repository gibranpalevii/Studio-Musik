<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Studio - Gayza Studio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root { --primary-gold: #ffc107; --bg-dark: #121212; --bg-card: #1e1e1e; --text-gray: #b0b3b8; }
        body { background-color: var(--bg-dark); color: #ffffff; font-family: 'Poppins', sans-serif; }
        
        .sidebar { min-height: 100vh; background: linear-gradient(180deg, #1a1a1a 0%, #000000 100%); border-right: 1px solid #333; }
        .brand-title { color: var(--primary-gold); font-weight: 800; letter-spacing: 1px; text-transform: uppercase; }
        .sidebar a { color: var(--text-gray); text-decoration: none; display: block; padding: 12px 20px; margin-bottom: 5px; border-radius: 8px; transition: all 0.3s; }
        .sidebar a:hover { background: rgba(255, 193, 7, 0.1); color: var(--primary-gold); transform: translateX(5px); }
        .sidebar a.active { background: var(--primary-gold); color: #000; font-weight: bold; }

        .card { background-color: var(--bg-card); border: 1px solid #333; border-radius: 12px; }
        .form-control, .form-select { background-color: #2b2b2b; border: 1px solid #444; color: #fff; padding: 12px; }
        .form-control:focus, .form-select:focus { background-color: #2b2b2b; color: #fff; border-color: var(--primary-gold); box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25); }
        .form-label { color: var(--primary-gold); font-weight: 500; font-size: 0.9rem; }
        
        .btn-gold { background-color: var(--primary-gold); color: #000; font-weight: bold; border: none; padding: 10px 25px; }
        .btn-gold:hover { background-color: #e0a800; color: #000; }
        .btn-cancel { background-color: transparent; border: 1px solid #555; color: #ccc; padding: 10px 25px; }
        .btn-cancel:hover { border-color: #fff; color: #fff; }
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
        </div>
    </div>

    <div class="col-md-10 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Tambah Studio Baru</h3>
            <a href="{{ url('/studio') }}" class="text-light text-decoration-none"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg p-3">
                    <div class="card-body">
                        <form action="{{ url('/studio') }}" method="POST" enctype="multipart/form-data">
                            @csrf 
                            
                            <div class="mb-4">
                                <label class="form-label">Nama Studio</label>
                                <input type="text" name="nama_studio" class="form-control" placeholder="Contoh: Studio VVIP Room" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Harga Sewa / Jam</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-secondary border-secondary text-white">Rp</span>
                                        <input type="number" name="harga_per_jam" class="form-control" placeholder="100000" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Status Awal</label>
                                    <select name="status" class="form-select">
                                        <option value="Tersedia">🟢 Tersedia</option>
                                        <option value="Dipakai">🟠 Dipakai</option>
                                        <option value="Maintenance">🔴 Maintenance</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-5">
                                <label class="form-label">Foto Studio (Opsional)</label>
                                <input type="file" name="foto" class="form-control" accept="image/*">
                                <small class="text-muted mt-1 d-block"><i class="fas fa-info-circle me-1"></i> Format: JPG/PNG, Maks 2MB.</small>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ url('/studio') }}" class="btn btn-cancel rounded-pill">Batal</a>
                                <button type="submit" class="btn btn-gold rounded-pill px-4">
                                    <i class="fas fa-save me-2"></i> Simpan Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>