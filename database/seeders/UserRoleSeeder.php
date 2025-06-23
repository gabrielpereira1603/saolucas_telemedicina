<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Client;
use App\Models\WhiteLabel;
use App\Models\SubAcquirer;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        // Usuário Client
        $clientUser = User::create([
            'uuid'        => Str::uuid(),
            'cpf_cnpj'       => '12345678910',
            'name'        => 'Cliente Teste',
            'email'       => 'cliente@example.com',
            'password'    => Hash::make('password'),
            'role'        => 'client',
        ]);

        Client::create([
            'user_id' => $clientUser->id,
            'slug'    => 'cliente-teste',
            'name'    => 'Cliente Teste',
            'id_mercado_pago' => 'mp_123456',
        ]);

        // Usuário White Label
        $wlUser = User::create([
            'uuid'        => Str::uuid(),
            'name'        => 'São Lucas Telemedicina',
            'cpf_cnpj'       => '10987654321',
            'email'       => 'wl@example.com',
            'password'    => Hash::make('password'),
            'role'        => 'white label',
        ]);

        WhiteLabel::create([
            'user_id' => $wlUser->id,
            'slug'    => 'white-label-teste',
            'name'    => 'White Label Teste',
        ]);

        // Subadquirente 1
        $sub1 = User::create([
            'uuid'        => Str::uuid(),
            'cpf_cnpj'       => '10978654321',
            'name'        => 'Sub 1',
            'email'       => 'sub1@example.com',
            'password'    => Hash::make('password'),
            'role'        => 'subadquirente',
        ]);

        SubAcquirer::create([
            'user_id'        => $sub1->id,
            'prefix_url'     => 'gabriel',
            'commission_rate'=> 5.00,
            'name'           => 'Sub Adquirente 1',
            'slug'           => 'sub-1',
            'street'         => 'Rua 1',
            'city'           => 'Cidade 1',
            'zip_code'       => '00000000',
        ]);

        // Subadquirente 2
        $sub2 = User::create([
            'uuid'        => Str::uuid(),
            'name'        => 'frederico',
            'cpf_cnpj'       => '10978654322',
            'email'       => 'sub2@example.com',
            'password'    => Hash::make('password'),
            'role'        => 'subadquirente',
        ]);

        SubAcquirer::create([
            'user_id'        => $sub2->id,
            'prefix_url'     => 'frederico',
            'commission_rate'=> 10.00,
            'name'           => 'Sub Adquirente 2',
            'slug'           => 'sub-2',
            'street'         => 'Rua 2',
            'city'           => 'Cidade 2',
            'zip_code'       => '11111111',
        ]);
    }
}
