<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WPPlanDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'w_p_plan_id',
        'isi',
    ];

    public function plan(): BelongsTo {
        return $this->belongsTo(WPPlan::class, 'w_p_plan_id');
    }
}
