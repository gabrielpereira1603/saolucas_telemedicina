<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    // Um plano pode ter vários white labels vinculados
    public function whiteLabels(): BelongsToMany
    {
        return $this->belongsToMany(
            WhiteLabel::class,
            'plans_white_labels',
            'plan_id',
            'white_label_id'
        );
    }

    // Um plano pode ter várias vendas
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
