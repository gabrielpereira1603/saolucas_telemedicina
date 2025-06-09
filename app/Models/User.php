<?php
// app/Models/User.php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'uuid','name','email','password',
        'street','neighborhood','city','zip_code','number','complement'
    ];
    /**
     * Campos ocultos nas serializações (JSON, etc).
     *
     * @var array<int,string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts para atributos específicos.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function client(): HasOne
    {
        return $this->hasOne(Client::class);
    }

    /**
     * Sobrescreve a chave usada no route-model binding para 'uuid'.
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    /**
     * Gera automaticamente o UUID antes de criar o registro.
     */
    protected static function booted(): void
    {
        static::creating(function (User $user) {
            $user->uuid = (string) Str::uuid();
        });
    }

    /**
     * Retorna as iniciais do nome do usuário.
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }
}
