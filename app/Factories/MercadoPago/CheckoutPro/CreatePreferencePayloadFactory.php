<?php

namespace App\Factories\MercadoPago\CheckoutPro;

use App\Models\Plan;
use Carbon\Carbon;

class CreatePreferencePayloadFactory
{
    public static function make(Plan $plan, array $payerData, string $clientName, int $userId): array
    {
        $now = Carbon::now();
        $expiresInOneHour = $now->copy()->addHour();

        return [
            'items' => [[
                'id'           => $plan->slug,
                'title'        => $plan->name,
                'description'  => $plan->simple_description ?: 'Plano de assinatura',
                'quantity'     => 1,
                'currency_id'  => 'BRL',
                'unit_price'   => (float) $plan->value,
                'picture_url'  => $plan->image_url ?? null,
                'category_id'  => 'health_services',
            ]],
            'back_urls' => [
                'success' => route('login', ['status' => 'success']),
                'failure' => route('login', ['status' => 'failure']),
                'pending' => route('login', ['status' => 'pending']),
            ],
            'expires'               => true,
            'expiration_date_from'  => $now->toIso8601String(),
            'expiration_date_to'    => $expiresInOneHour->toIso8601String(),
            'payer'                => $payerData,
            'payment_methods'      => [
                'excluded_payment_types' => [],
                'default_payment_method_id' => null,
            ],
            'additional_info'      => "Cliente: {$clientName}",
            'external_reference'   => (string) $userId,
            'notification_url'     => 'https://somosdevteam.com',
            'statement_descriptor' => 'SAO LUCAS TM',
        ];
    }
}
