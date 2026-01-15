<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Studio - Gayza Studio</title>
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
            <h3 class="fw-bold">Edit Data Studio</h3>
            <a href="{{ url('/studio') }}" class="text-light text-decoration-none"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg p-3">
                    <div class="card-body">
                        <form action="{{ url('/studio/update/' . $studio->id_studio) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="mb-4">
                                <label class="form-label">Nama Studio</label>
                                <input type="text" name="nama_studio" class="form-control" value="{{ $studio->nama_studio }}" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Harga per Jam</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-secondary border-secondary text-white">Rp</span>
                                        <input type="number" name="harga_per_jam" class="form-control" value="{{ $studio->harga_per_jam }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="Tersedia" {{ $studio->status == 'Tersedia' ? 'selected' : '' }}>🟢 Tersedia</option>
                                        <option value="Dipakai" {{ $studio->status == 'Dipakai' ? 'selected' : '' }}>🟠 Dipakai</option>
                                        <option value="Maintenance" {{ $studio->status == 'Maintenance' ? 'selected' : '' }}>🔴 Maintenance</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-5">
                                <label class="form-label">Foto Studio</label>
                                <div class="d-flex align-items-start gap-3 mt-2">
                                    <div class="border border-secondary p-1 rounded bg-dark">
                                        @if($studio->foto)
                                            <img src="{{ asset('storage/'.$studio->foto) }}" width="100" class="rounded">
                                        @else
                                            <span class="text-muted small p-3 d-block">No Img</span>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <input type="file" name="foto" class="form-control mb-1">
                                        <small class="text-white-50" style="font-size: 11px;">* Biarkan kosong jika tidak ingin mengubah foto.</small>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ url('/studio') }}" class="btn btn-cancel rounded-pill">Batal</a>
                                <button type="submit" class="btn btn-gold rounded-pill px-4">
                                    <i class="fas fa-check me-2"></i> Update Data
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