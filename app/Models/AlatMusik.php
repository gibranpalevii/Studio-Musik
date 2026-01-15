<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatMusik extends Model
{
    use HasFactory;

    protected $table = 'alat_musiks';
    protected $primaryKey = 'id_alat';
    public $timestamps = true;

    protected $fillable = [
        'nama_alat', 
        'stok', 
        'harga_sewa', 
        'kondisi',
        'foto'
    ];
}