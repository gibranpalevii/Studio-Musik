<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';
    
    // Sesuai screenshot database Anda, primary key-nya 'id' (bukan id_transaksi)
    protected $primaryKey = 'id'; 
    
    protected $fillable = [
        'kode_transaksi',
        'id_pelanggan',
        'jenis_transaksi',
        'nama_item',
        'tanggal',
        'durasi',
        'total_biaya',
        'status_bayar',
        'status'
    ];

    // RELASI KE PELANGGAN
    // Parameter: (ModelTujuan, FK_di_Transaksi, PK_di_Pelanggan)
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }
}