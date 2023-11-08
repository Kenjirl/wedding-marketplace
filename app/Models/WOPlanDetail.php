<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WOPlanDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'w_o_plan_id',
        'isi',
    ];

    public function plan(): BelongsTo {
        return $this->belongsTo(WOPlan::class, 'w_o_plan_id');
    }
}
