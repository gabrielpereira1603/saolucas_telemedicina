<?php

namespace App\Service\MercadoPago\CheckoutPro;

use Illuminate\Support\Facades\Log;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class CreatePreferenceService
{
    protected string $baseUri;
    protected array  $headers;

    public function __construct()
    {
        $this->baseUri = config('services.mercadopago.base_uri');
        $this->headers = [
            'Authorization' => 'Bearer ' . config('services.mercadopago.access_token'),
            'Content-Type'  => 'application/json',
        ];
    }

    /**
     * $payload deve conter:
     * - items: array de itens (title, quantity, currency_id, unit_price)
     * - back_urls: array com success, failure, pending
     * - auto_return: 'approved'
     */
    public function createPreference(array $payload)
    {
        try {
            MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));
            // 2) passa **todo** o payload para o SDK
            $client     = new PreferenceClient();
            $preference = $client->create($payload);

            // 3) retorna o Preference para quem chamou
            return $preference;

        } catch (MPApiException $e) {
            // pega o MPResponse e registra o erro
            $mpResponse = $e->getApiResponse();
            $errorPayload = property_exists($mpResponse, 'response')
                ? $mpResponse->response
                : (array) $mpResponse;

            Log::error('MP create preference failed', [
                'mp_error' => $errorPayload,
            ]);

            // rethrow se quiser tratar lá em cima, ou retorne null
            throw $e;
        }}
}
