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
        'street','neighborhood','city','zip_code','number','complement','role','cpf_cnpj'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function client(): HasOne
    {
        return $this->hasOne(Client::class);
    }

    public function whiteLabel(): HasOne
    {
        return $this->hasOne(WhiteLabel::class);
    }

    public function subAcquirer(): HasOne
    {
        return $this->hasOne(SubAcquirer::class);
    }


    // Um usuário pode ter várias vendas (sales)
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
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

    public function getRoleBinding(): ?string
    {
        if ($this->subAcquirer()->exists()) return 'sub_acquirer';
        if ($this->client()->exists()) return 'client';
        if ($this->whiteLabel()->exists()) return 'white_label';

        return null;
    }

}
