<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Baru - Gayza Studio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
        .form-control:read-only { background-color: #1a1a1a; cursor: not-allowed; color: var(--primary-gold); font-size: 1.2rem; }
        .form-label { color: var(--primary-gold); font-weight: 500; font-size: 0.9rem; }
        
        .btn-gold { background-color: var(--primary-gold); color: #000; font-weight: bold; border: none; padding: 10px 25px; }
        .btn-gold:hover { background-color: #e0a800; color: #000; }
        .btn-cancel { background-color: transparent; border: 1px solid #555; color: #ccc; padding: 10px 25px; }
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
        </div>
    </div>

    <div class="col-md-10 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Buat Transaksi Baru</h3>
            <a href="{{ url('/transaksi') }}" class="text-light text-decoration-none"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card shadow-lg p-3">
                    <div class="card-body">
                        <form action="{{ url('/transaksi') }}" method="POST">
                            @csrf 
                            
                            <div class="mb-4">
                                <label class="form-label">Nama Pelanggan</label>
                                <select name="id_pelanggan" class="form-select" required>
                                    <option value="">-- Pilih Pelanggan --</option>
                                    @foreach($pelanggans as $p)
                                        <option value="{{ $p->id_pelanggan }}">{{ $p->nama_pelanggan }} - ({{ $p->no_hp }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <hr class="border-secondary my-4">

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Jenis Transaksi</label>
                                    <select name="jenis_transaksi" id="jenis_transaksi" class="form-select" required>
                                        <option value="">-- Pilih Jenis --</option>
                                        <option value="Sewa Studio">Sewa Studio</option>
                                        <option value="Sewa Alat">Sewa Alat</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Pilih Item Sewa</label>
                                    
                                    {{-- Dropdown Studio --}}
                                    <select id="pilih_studio" class="form-select item-select" style="display:none;">
                                        <option value="" data-harga="0">-- Pilih Studio --</option>
                                        @foreach($studios as $s)
                                            <option value="{{ $s->nama_studio }}" data-harga="{{ $s->harga_per_jam }}">
                                                {{ $s->nama_studio }} (Rp {{ number_format($s->harga_per_jam) }}/jam)
                                            </option>
                                        @endforeach
                                    </select>

                                    {{-- Dropdown Alat --}}
                                    <select id="pilih_alat" class="form-select item-select" style="display:none;">
                                        <option value="" data-harga="0">-- Pilih Alat --</option>
                                        @foreach($alats as $a)
                                            <option value="{{ $a->nama_alat }}" data-harga="{{ $a->harga_sewa }}">
                                                {{ $a->nama_alat }} (Rp {{ number_format($a->harga_sewa) }})
                                            </option>
                                        @endforeach
                                    </select>

                                    <input type="hidden" name="nama_item" id="nama_item_final">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Tanggal Sewa</label>
                                    <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Durasi (Jam) / Jumlah Unit</label>
                                    <input type="number" name="durasi" id="durasi" class="form-control" value="1" min="1" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Total Estimasi Biaya (Rp)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark border-secondary text-warning fw-bold">Rp</span>
                                    <input type="number" name="total_biaya" id="total_biaya" class="form-control fw-bold" readonly placeholder="0">
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 pt-3">
                                <a href="{{ url('/transaksi') }}" class="btn btn-cancel rounded-pill">Batal</a>
                                <button type="submit" class="btn btn-gold rounded-pill px-4">
                                    <i class="fas fa-save me-2"></i> Simpan Transaksi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        let hargaPerUnit = 0;

        // 1. Kalau Jenis Transaksi Berubah
        $('#jenis_transaksi').change(function(){
            let jenis = $(this).val();
            
            // Sembunyikan dan reset dropdown item
            $('#pilih_studio').hide().val('');
            $('#pilih_alat').hide().val('');
            
            // Reset harga
            hargaPerUnit = 0;
            $('#total_biaya').val(0);
            $('#nama_item_final').val('');

            // Munculkan sesuai pilihan
            if(jenis == 'Sewa Studio'){
                $('#pilih_studio').show().attr('required', true);
                $('#pilih_alat').removeAttr('required');
            } else if(jenis == 'Sewa Alat'){
                $('#pilih_alat').show().attr('required', true);
                $('#pilih_studio').removeAttr('required');
            }
        });

        // 2. Kalau Item Dipilih (Studio atau Alat)
        $('.item-select').change(function(){
            // Ambil harga dari atribut 'data-harga'
            hargaPerUnit = $(this).find(':selected').data('harga') || 0;
            
            // Masukkan nama item ke input hidden
            let namaItem = $(this).val();
            $('#nama_item_final').val(namaItem);

            hitungTotal();
        });

        // 3. Kalau Durasi Diubah
        $('#durasi').on('input', function(){
            hitungTotal();
        });

        // Rumus Hitung
        function hitungTotal(){
            let durasi = parseInt($('#durasi').val()) || 1;
            if(durasi < 1) durasi = 1;
            
            let total = hargaPerUnit * durasi;
            $('#total_biaya').val(total);
        }
    });
</script>

</body>
</html>