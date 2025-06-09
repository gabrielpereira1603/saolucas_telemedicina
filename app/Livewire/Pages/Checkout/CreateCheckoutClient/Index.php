<?php

namespace App\Livewire\Pages\Checkout\CreateCheckoutClient;

use App\Service\MercadoPago\CreatePreferenceService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use App\Models\Plan;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class Index extends Component
{
    public $planId;
    public $referral;
    public $plan;

    // campos do usuário
    public $name        = 'Maria da Silva';
    public $email       = 'maria.silva@example.com';
    public $street      = 'Rua das Flores, 123';
    public $neighborhood= 'Centro';
    public $city        = 'São Paulo';
    public $zip_code    = '01234-567';
    public $number      = '123';
    public $complement  = 'Apto 45';


    // campo do cliente
    public $client_name = 'Clínica Exemplo';
    protected CreatePreferenceService $createPreferenceService;

    public function __construct()
    {
        $this->createPreferenceService = New CreatePreferenceService();
    }
    public function mount($plan, $referral = null)
    {
        $this->planId   = $plan;
        $this->referral = $referral;
        $this->plan     = Plan::findOrFail($plan);
    }

    protected function rules()
    {
        return [
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'street'         => 'nullable|string|max:255',
            'neighborhood'   => 'nullable|string|max:255',
            'city'           => 'nullable|string|max:255',
            'zip_code'       => 'nullable|string|max:20',
            'number'         => 'nullable|string|max:20',
            'complement'     => 'nullable|string|max:255',
            'client_name'    => 'required|string|max:255',
        ];
    }


    public function criarPreference()
    {
        // 1) Monte o payload exatamente igual à API espera
        $now = Carbon::now();
        $expiresInOneHour = $now->copy()->addHour();

        $payload = [
            'items' => [[
                'title'       => $this->plan->name,
                'quantity'    => 1,
                'currency_id' => 'BRL',
                'unit_price'  => (float) $this->plan->value,
            ]],
            'back_urls' => [
                'success' => 'www.success.com.br',
                'failure' => 'www.failure.com.br',
                'pending' => 'www.pending.com.br',
            ],
            'auto_return' => 'approved',
            'expires' => true,
            'expiration_date_from' => $now->toIso8601String(),
            'expiration_date_to'   => $expiresInOneHour->toIso8601String(),
        ];

        // 2) Passe o payload para o serviço
        $preference = $this->createPreferenceService->createPreference($payload);

        // 3) Pega o sandbox init point (ou, se estiver em produção, o init_point)
        $checkoutUrl = $preference->sandbox_init_point
            ?? $preference->init_point;

        // 4) Emite evento para o navegador redirecionar por replace()
        $this->dispatch('mp-redirect',  url: $checkoutUrl);
    }

    public function render()
    {
        return view('livewire.pages.checkout.create-checkout-client.index', [
            'plan'     => $this->plan,
            'referral' => $this->referral,
        ])->layout('components.layouts.templates.valentines_day.app_valentines_day');
    }
}
