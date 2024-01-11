<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WPPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'w_photographer_id',
        'nama',
        'detail',
        'harga',
    ];

    public function w_photographer(): BelongsTo {
        return $this->belongsTo(WPhotographer::class, 'w_photographer_id');
    }

    public function bookings(): HasMany {
        return $this->hasMany(WPBooking::class, 'w_p_plan_id');
    }
}
