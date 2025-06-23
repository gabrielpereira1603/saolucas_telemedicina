<?php

namespace App\Http\Controllers\Webhook;

use App\Events\MercadoPago\Payments\PaymentUpdated;
use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;

class MercadoPagoWebhookController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('🔔 Webhook MercadoPago recebido');
        Log::info("📦 Headers:\n" . json_encode($request->headers->all(), JSON_PRETTY_PRINT));
        Log::info("📨 Body:\n" . json_encode($request->all(), JSON_PRETTY_PRINT));

        $type = $request->input('type');
        $resourceId = $request->input('data.id');

        if ($type === 'payment') {
            MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));

            $client = new PaymentClient();
            $payment = $client->get($resourceId);

            $externalRef = (int) $payment->external_reference; // user_id
            $mpPaymentId = $payment->id;
            $status = $payment->status; // approved, pending, rejected...
            $value = $payment->transaction_amount;

            // Pega client via usuário (relacionamento reverso)
            $user = \App\Models\User::find($externalRef);
            $clientModel = $user?->client;

            if (!$clientModel) {
                Log::warning("⚠️ Nenhum client vinculado ao user_id {$externalRef}");
                return response()->json(['error' => 'Client não encontrado'], 404);
            }

            // Tenta localizar venda existente
            $sale = Sale::where('client_id', $clientModel->id)
                ->where('value', $value)
                ->latest()
                ->first();

            if ($sale) {
                $sale->update([
                    'status' => $this->mapStatus($status),
                ]);
            } else {
                Sale::create([
                    'client_id'  => $clientModel->id,
                    'plan_id'    => null, // opcional, se não tiver como relacionar
                    'value'      => $value,
                    'status'     => $this->mapStatus($status),
                ]);
            }

            // Emitir evento broadcast (Livewire escuta e atualiza)
            broadcast(new PaymentUpdated($clientModel->user_id));
        }

        return response()->json(['received' => true], 200);
    }

    private function mapStatus($status)
    {
        return match ($status) {
            'approved'     => 'paid',
            'pending',
            'in_process'   => 'pending',
            'rejected',
            'cancelled'    => 'cancelled',
            default        => 'pending',
        };
    }}
