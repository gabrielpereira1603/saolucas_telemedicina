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

    // Venda pertence a um plano
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    // Venda pertence a um cliente
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Venda pertence a um usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
