<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;

    protected $table = 'studios';
    protected $primaryKey = 'id_studio';
    public $timestamps = true;

    protected $fillable = [
        'nama_studio', 
        'harga_per_jam', 
        'status',
        'foto'
    ];
}