<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WhiteLabel extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'plans_white_label');
    }
}
