<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeddingOrganizer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_pemilik',
        'nama_perusahaan',
        'no_telp',
        'alamat',
        'basis_operasi',
        'kota_operasi',
        'foto_profil',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
}
