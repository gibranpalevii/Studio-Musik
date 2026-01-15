<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi - Gayza Studio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-gold: #ffc107;
            --bg-dark: #121212;
            --bg-card: #1e1e1e;
            --text-gray: #b0b3b8;
            --text-light: #e0e0e0;
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
        .table-dark-custom { --bs-table-bg: #1e1e1e; --bs-table-color: var(--text-light); --bs-table-border-color: #333; }
        .table-dark-custom th { color: var(--primary-gold); text-transform: uppercase; font-size: 0.85rem; }
        .table-dark-custom td { vertical-align: middle; }

        /* Status Badges */
        .badge-lunas { background-color: rgba(25, 135, 84, 0.2); color: #75b798; border: 1px solid #198754; }
        .badge-belum { background-color: rgba(220, 53, 69, 0.2); color: #ea868f; border: 1px solid #dc3545; }
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
            <a href="{{ url('/studio') }}"><i class="fas fa-microphone-alt me-2"></i> Studio</a>
            <a href="{{ url('/alat') }}"><i class="fas fa-guitar me-2"></i> Alat Musik</a>
            <a href="{{ url('/pelanggan') }}"><i class="fas fa-users me-2"></i> Pelanggan</a>
            <a href="{{ url('/transaksi') }}" class="active"><i class="fas fa-receipt me-2"></i> Transaksi</a>
            <a href="{{ url('/laporan') }}"><i class="fas fa-file-invoice-dollar me-2"></i> Laporan</a>

            <div class="mt-3 pt-2 border-top border-secondary">
                <a href="{{ url('/logout') }}" class="text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
            </div>
        </div>
    </div>

    <div class="col-md-10 p-4" style="height: 100vh; overflow-y: auto;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Riwayat Transaksi</h2>
                <p class="text-white-50 mb-0">Monitor penyewaan studio dan alat musik.</p>
            </div>
            <a href="{{ url('/transaksi/tambah') }}" class="btn btn-gold shadow-sm">
                <i class="fas fa-plus me-2"></i> Transaksi Baru
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
                    <table class="table table-dark-custom table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Kode TRX</th>
                                <th>Tanggal</th>
                                <th>Pelanggan</th>
                                <th>Item Sewa</th>
                                <th>Total</th>
                                <th>Status Bayar</th>
                                <th>Status Sewa</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $t)
                            <tr>
                                <td class="ps-4">
                                    <span class="badge bg-secondary font-monospace">{{ $t->kode_transaksi }}</span>
                                </td>
                                <td class="text-white-50">{{ date('d M Y', strtotime($t->tanggal)) }}</td>
                                
                                <td>
                                    <strong class="text-white">{{ $t->pelanggan->nama_pelanggan ?? 'Terhapus' }}</strong><br>
                                    <small class="text-white-50" style="font-size: 11px;">
                                        <i class="fab fa-whatsapp me-1"></i> {{ $t->pelanggan->no_hp ?? '-' }}
                                    </small>
                                </td>

                                <td>
                                    <span class="text-warning fw-bold" style="font-size: 12px">{{ strtoupper($t->jenis_transaksi) }}</span><br>
                                    <span class="text-white-50">{{ $t->nama_item }}</span>
                                </td>

                                <td class="fw-bold text-white">Rp {{ number_format($t->total_biaya) }}</td>

                                <td>
                                    @if($t->status_bayar == 'Lunas')
                                        <span class="badge badge-lunas rounded-pill px-3">LUNAS</span>
                                    @else
                                        <span class="badge badge-belum rounded-pill px-3">BELUM LUNAS</span>
                                    @endif
                                </td>

                                <td>
                                    @if($t->status == 'Proses')
                                        <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i> Proses</span>
                                    @elseif($t->status == 'Selesai')
                                        <span class="badge bg-primary"><i class="fas fa-check-double me-1"></i> Selesai</span>
                                    @else
                                        <span class="badge bg-secondary">Batal</span>
                                    @endif
                                </td>

                                <td class="text-end pe-4">
                                    <div class="btn-group btn-group-sm">
                                        
                                        {{-- 1. Tombol Bayar (Hanya jika belum lunas) --}}
                                        @if($t->status_bayar == 'Belum Lunas')
                                            <a href="{{ url('/transaksi/bayar/'.$t->id) }}" class="btn btn-outline-success" title="Lunasi Pembayaran">
                                                <i class="fas fa-money-bill-wave"></i>
                                            </a>
                                        @endif

                                        {{-- 2. Tombol Selesai (Hanya jika Status Proses) --}}
                                        @if($t->status == 'Proses')
                                            
                                            {{-- LOGIKA VALIDASI: Hanya boleh selesai jika LUNAS --}}
                                            @if($t->status_bayar == 'Lunas')
                                                <a href="{{ url('/transaksi/status/'.$t->id.'/Selesai') }}" class="btn btn-outline-primary" title="Selesaikan Sewa">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            @else
                                                {{-- Tombol mati jika belum lunas --}}
                                                <button type="button" class="btn btn-outline-secondary" disabled title="Harus Lunas Terlebih Dahulu" style="cursor: not-allowed; opacity: 0.3;">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            @endif

                                        @endif

                                        {{-- 3. Tombol Hapus --}}
                                        <a href="{{ url('/transaksi/hapus/'.$t->id) }}" class="btn btn-outline-danger" 
                                           onclick="return confirm('Hapus transaksi ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>