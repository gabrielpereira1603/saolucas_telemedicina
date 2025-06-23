<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubAcquirer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'commission_rate',
        'prefix_url',
        'name',
        'slug',
        'street',
        'neighborhood',
        'city',
        'zip_code',
        'number',
        'complement',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
