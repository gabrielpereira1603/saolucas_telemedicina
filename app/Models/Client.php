<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    protected $fillable = [
        'id_mercado_pago',
        'preference_id',
        'slug',
        'name',
        'user_id',
    ];

    // Cliente pertence a um usuário
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Cliente pode ter várias vendas (sales)
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
