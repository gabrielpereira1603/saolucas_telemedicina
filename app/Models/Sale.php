<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'plan_id',
        'user_id',
        'client_id',
        'value',
        'status',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
