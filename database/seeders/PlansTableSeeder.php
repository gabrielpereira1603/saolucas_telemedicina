<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlansTableSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'slug'  => 'plano-anual',
                'name'  => 'Plano Anual',
                // R$14,90 por mês -> totaliza R$178,80/ano, mas aqui usamos o preço mensal
                'value' => 178.80,
            ],
            [
                'slug'  => 'promocao-dia-dos-namorados',
                'name'  => 'Promoção Dia dos Namorados',
                // R$12,06 por mês, sem fidelidade
                'value' => 154.8,
            ],
            [
                'slug'  => 'plano-semestral',
                'name'  => 'Plano Semestral',
                // R$16,90 por mês
                'value' => 202.8,
            ],
        ];

        foreach ($plans as $data) {
            Plan::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
