<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeddingGuest extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_id',
        'nama',
        'no_telp',
        'gender',
        'link',
        'status',
        'respon',
        'alasan',
        'jumlah',
        'pesan',
    ];
}
