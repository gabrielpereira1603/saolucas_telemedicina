<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->all();

        // se for payment.updated
        if ($payload['type'] === 'payment') {
            $mpPaymentId = $payload['data']['id'];
            $sale = Sale::where('payment_id', $mpPaymentId)->first();
            if ($sale) {
                // supomos que aqui você checa via API do MP se está realmente paid
                $sale->status = 'paid';
                $sale->save();

                event(new SaleStatusUpdated($sale));
            }
        }

        // se for merchant_order
        if ($payload['type'] === 'topic_merchant_order_wh') {
            $orderId = $payload['id'];
            // se você guardou merchant_order_id em Sale, use aqui...
            // $sale = Sale::where('merchant_order_id', $orderId)->first();
            // $sale->status = $payload['data']['status'] === 'closed' ? 'paid' : $sale->status;
            // $sale->save();
            // event(new SaleStatusUpdated($sale));
        }

        return response()->json(['ok'], 200);
    }
}
