<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class WCWedding extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'w_couple_id',
        'p_lengkap',
        'p_sapaan',
        'p_ayah',
        'p_ibu',
        'w_lengkap',
        'w_sapaan',
        'w_ayah',
        'w_ibu',
    ];

    public function w_couple(): BelongsTo {
        return $this->belongsTo(WCouple::class, 'w_couple_id');
    }

    public function w_detail(): HasMany {
        return $this->hasMany(WCWeddingDetail::class, 'w_c_wedding_id', 'id');
    }

    public function w_v_booking(): HasMany {
        return $this->hasMany(WVBooking::class, 'w_c_wedding_id');
    }

    public function invitation(): HasOne {
        return $this->hasOne(WCInvitation::class, 'w_c_wedding_id');
    }

    public function guests(): HasMany {
        return $this->hasMany(WCGuest::class, 'w_c_wedding_id');
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function ($wedding) {
            $wedding->w_detail()->delete();
            WVBooking::where('w_c_wedding_id', $wedding->id)
                ->where('status', 'diproses')
                ->update(['status' => 'ditolak']);
            $wedding->invitation()->delete();
            $wedding->guests()->delete();
        });
    }
}
