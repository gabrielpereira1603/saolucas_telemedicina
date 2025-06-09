<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model,Factories\HasFactory,SoftDeletes};
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slug','name','user_id',
    ];

    // A client belongs to a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
