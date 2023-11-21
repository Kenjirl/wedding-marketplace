<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WPBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'w_c_wedding_id',
        'w_p_plan_id',
        'status',
        'bukti_bayar',
        'untuk_tanggal',
    ];

    public function wedding(): BelongsTo {
        return $this->belongsTo(WCWedding::class, 'w_c_wedding_id');
    }

    public function plan(): BelongsTo {
        return $this->belongsTo(WPPlan::class, 'w_p_plan_id');
    }
}
