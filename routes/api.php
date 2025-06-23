<?php

use App\Http\Controllers\Webhook\MercadoPagoWebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/webhook/mercadopago', [MercadoPagoWebhookController::class, 'handle']);
