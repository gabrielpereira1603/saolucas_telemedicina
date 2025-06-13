<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'uuid','name','email','password',
        'street','neighborhood','city','zip_code','number','complement','role'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Um usuário tem 1 client (relacionamento direto)
    public function client(): HasOne
    {
        return $this->hasOne(Client::class);
    }

    // Um usuário pode ter vários clients (exemplo multi-empresa)
    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    // Um usuário pode ter várias vendas (sales)
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    // Um usuário pode ter vários white labels
    public function whiteLabels(): HasMany
    {
        return $this->hasMany(WhiteLabel::class);
    }

    // Um usuário pode ter vários plans via sales (caso queira saber planos adquiridos)
    public function plans(): HasManyThrough
    {
        return $this->hasManyThrough(Plan::class, Sale::class);
    }

    // UUID para route-model binding
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    protected static function booted(): void
    {
        static::creating(function (User $user) {
            $user->uuid = (string) Str::uuid();
        });
    }

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }
}
