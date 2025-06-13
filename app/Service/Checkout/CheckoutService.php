<?php

namespace App\Service\Checkout;

use App\Models\Client;
use App\Models\Plan;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CheckoutService
{
    public function createOrUpdateUser(array $data, string $clientName, string $token): User
    {
        return User::updateOrCreate(
            ['email' => $data['email']],
            [
                'name'         => $clientName,
                'password'     => Hash::make($token),
                'role'         => 'client',
                'street'       => $data['street'],
                'neighborhood' => $data['neighborhood'],
                'city'         => $data['city'],
                'zip_code'     => $data['zip_code'],
                'number'       => $data['number'] ?? null,
                'complement'   => $data['complement'] ?? null,
            ]
        );
    }

    public function createOrGetClient(User $user, string $clientName): Client
    {
        return Client::firstOrCreate(
            ['user_id' => $user->id],
            ['slug' => Str::slug($clientName), 'name' => $clientName]
        );
    }

    public function createSale(Plan $plan, User $user, Client $client): Sale
    {
        return Sale::create([
            'plan_id'   => $plan->id,
            'user_id'   => $user->id,
            'client_id' => $client->id,
            'value'     => $plan->value,
            'status'    => 'pending',
        ]);
    }
}
