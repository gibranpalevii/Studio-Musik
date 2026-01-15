<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan - Gayza Studio</title>
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

        /* Content Elements */
        .card { background-color: var(--bg-card); border: 1px solid #333; }
        .btn-gold { background-color: var(--primary-gold); color: #000; font-weight: bold; border: none; }
        .btn-gold:hover { background-color: #e0a800; color: #000; }
        
        /* Form Inputs Dark Mode */
        .form-control { background-color: #2c2c2c; border: 1px solid #444; color: #fff; }
        .form-control:focus { background-color: #2c2c2c; color: #fff; border-color: var(--primary-gold); box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25); }
        label { color: var(--text-gray); font-size: 0.9rem; margin-bottom: 5px; }

        /* Table Custom */
        .table-dark-custom { --bs-table-bg: #1e1e1e; --bs-table-color: var(--text-light); --bs-table-border-color: #333; }
        .table-dark-custom th { color: var(--primary-gold); text-transform: uppercase; font-size: 0.85rem; border-bottom: 2px solid #444; }
        .table-dark-custom td { vertical-align: middle; border-bottom: 1px solid #333; }
        
        /* Footer Total Row */
        .total-row { background-color: rgba(255, 193, 7, 0.1) !important; color: var(--primary-gold); font-weight: bold; font-size: 1.1rem; }
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
            <a href="{{ url('/transaksi') }}"><i class="fas fa-receipt me-2"></i> Transaksi</a>
            <a href="{{ url('/laporan') }}" class="active"><i class="fas fa-file-invoice-dollar me-2"></i> Laporan</a>

            <div class="mt-3 pt-2 border-top border-secondary">
                <a href="{{ url('/logout') }}" class="text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
            </div>
        </div>
    </div>

    <div class="col-md-10 p-4" style="height: 100vh; overflow-y: auto;">
        <div class="mb-4">
            <h2 class="fw-bold">Laporan Keuangan</h2>
            <p class="text-white-50">Rekapitulasi pendapatan bersih studio musik.</p>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ url('/laporan') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label><i class="far fa-calendar-alt me-1"></i> Tanggal Awal</label>
                        <input type="date" name="tgl_awal" class="form-control" value="{{ $tgl_awal }}">
                    </div>
                    <div class="col-md-3">
                        <label><i class="far fa-calendar-alt me-1"></i> Tanggal Akhir</label>
                        <input type="date" name="tgl_akhir" class="form-control" value="{{ $tgl_akhir }}">
                    </div>
                    <div class="col-md-6 d-flex gap-2">
                        <button type="submit" class="btn btn-gold flex-grow-1">
                            <i class="fas fa-filter me-2"></i> Tampilkan
                        </button>
                        
                        <a href="{{ url('/laporan/cetak?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir) }}" target="_blank" class="btn btn-outline-light flex-grow-1">
                            <i class="fas fa-print me-2"></i> Cetak PDF
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                
                @if($tgl_awal)
                    <div class="p-3 border-bottom border-secondary bg-dark">
                        <small class="text-warning">
                            <i class="fas fa-info-circle me-1"></i> Menampilkan data periode: 
                            <span class="text-white fw-bold">{{ date('d M Y', strtotime($tgl_awal)) }}</span> s/d 
                            <span class="text-white fw-bold">{{ date('d M Y', strtotime($tgl_akhir)) }}</span>
                        </small>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-dark-custom table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">No</th>
                                <th>Tanggal</th>
                                <th>Pelanggan</th>
                                <th>Item Sewa</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksi as $index => $t)
                            <tr class="{{ $t->status == 'Batal' ? 'opacity-50' : '' }}">
                                <td class="ps-4 text-white-50">{{ $index + 1 }}</td>
                                <td>{{ date('d M Y', strtotime($t->tanggal)) }}</td>
                                <td>{{ $t->pelanggan->nama_pelanggan ?? 'Terhapus' }}</td>
                                <td>
                                    <span class="text-warning">{{ strtoupper($t->jenis_transaksi) }}</span> - {{ $t->nama_item }}
                                </td>
                                
                                <td>
                                    @if($t->status == 'Batal')
                                        <span class="badge bg-danger">Batal</span>
                                    @elseif($t->status == 'Selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @else
                                        <span class="badge bg-warning text-dark">{{ $t->status }}</span>
                                    @endif
                                </td>

                                <td class="text-end pe-4">
                                    @if($t->status == 'Batal')
                                        <span class="text-decoration-line-through text-danger">Rp {{ number_format($t->total_biaya) }}</span>
                                    @else
                                        Rp {{ number_format($t->total_biaya) }}
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-white-50">
                                    <i class="fas fa-search fa-3x mb-3"></i><br>
                                    Tidak ada data transaksi pada periode ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr class="total-row">
                                <td colspan="5" class="text-center py-3">TOTAL PENDAPATAN BERSIH</td>
                                <td class="text-end pe-4 py-3">Rp {{ number_format($totalPendapatan) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>