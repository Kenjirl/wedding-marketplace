<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WOPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'w_organizer_id',
        'nama',
        'harga',
    ];

    public function w_organizer(): BelongsTo {
        return $this->belongsTo(WOrganizer::class, 'w_organizer_id');
    }

    public function fitur(): HasMany {
        return $this->hasMany(WOPlanDetail::class, 'w_o_plan_id');
    }

    public function bookings(): HasMany {
        return $this->hasMany(WOBooking::class, 'w_o_plan_id');
    }
}
