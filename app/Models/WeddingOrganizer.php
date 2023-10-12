<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeddingOrganizer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_pemilik',
        'nama_perusahaan',
        'no_telp',
        'alamat',
        'lat',
        'long',
        'basis_operasi',
        'kota_operasi',
    ];
}
