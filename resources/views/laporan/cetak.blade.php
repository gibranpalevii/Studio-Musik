<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan - Gayza Studio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: white; color: black; }
        .header-title { font-weight: 800; letter-spacing: 2px; text-transform: uppercase; border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .table thead th { background-color: #f2f2f2 !important; border-bottom: 2px solid #000; text-transform: uppercase; font-size: 12px; }
        .table-total td { background-color: #eee !important; font-weight: bold; border-top: 2px solid #000; }
        
        @media print {
            @page { size: A4; margin: 20mm; }
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="header-title">GAYZA STUDIO MUSIK</h2>
            <h5 class="fw-bold">LAPORAN PENDAPATAN</h5>
            <p class="mb-0">Periode: 
                <strong>{{ $tgl_awal ? date('d M Y', strtotime($tgl_awal)) : 'Awal' }}</strong> 
                s/d 
                <strong>{{ $tgl_akhir ? date('d M Y', strtotime($tgl_akhir)) : 'Sekarang' }}</strong>
            </p>
            <small class="text-muted">Jl. Abimanyu No.10 - Telp: 0812-3456-7890</small>
        </div>
    </div>

    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th class="text-center" width="5%">No</th>
                <th width="15%">Tanggal</th>
                <th width="20%">Pelanggan</th>
                <th>Keterangan Item</th>
                <th width="15%" class="text-end">Biaya</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $index => $t)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ date('d/m/Y', strtotime($t->tanggal)) }}</td>
                <td>{{ $t->pelanggan->nama_pelanggan ?? '-' }}</td>
                <td>
                    <strong>{{ $t->nama_item }}</strong> <br>
                    <small class="text-muted">({{ $t->jenis_transaksi }})</small>
                </td>
                <td class="text-end">Rp {{ number_format($t->total_biaya) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center fst-italic py-3">Tidak ada data transaksi.</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="table-total">
                <td colspan="4" class="text-center text-uppercase">Total Pendapatan Bersih</td>
                <td class="text-end">Rp {{ number_format($totalPendapatan) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="row mt-5">
        <div class="col-8"></div>
        <div class="col-4 text-center">
            <p class="mb-5">Jakarta, {{ date('d F Y') }}<br>Admin Pengelola</p>
            <p class="fw-bold text-decoration-underline mt-4">( .................................... )</p>
        </div>
    </div>
</div>

</body>
</html>