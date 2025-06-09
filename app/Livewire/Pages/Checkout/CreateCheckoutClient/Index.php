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

    public $first_name        = 'Maria';
    public $second_name        = 'da Silva';
    public $cpf_cpnj        = '05157133170';

    public $email       = 'vania_paracatu@yahoo.com.br';
    public $phone       = '67981957833';
    public $street      = 'Rua das Flores, 123';
    public $neighborhood= 'Centro';
    public $city        = 'São Paulo';
    public $zip_code    = '01234-567';

    public $number      = '123';
    public $complement  = 'Apto 45';

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
        $now               = Carbon::now();
        $expiresInOneHour  = $now->copy()->addHour();

        $payload = [
            // itens
            'items' => [[
                'id'           => $this->plan->slug,
                'title'        => $this->plan->name,
                'description'  => $this->plan->simple_description ?: 'Plano de assinatura',
                'quantity'     => 1,
                'currency_id'  => 'BRL',
                'unit_price'   => 1.00,
                'picture_url'  => $this->plan->image_url ?? null,
                'category_id'  => 'health_services',
            ]],

            // URLs de retorno
            'back_urls' => [
                'success' => route('home', ['status' => 'success', 'email' => $this->email]),
                'failure' => route('home', ['status' => 'error'  , 'email' => $this->email]),
                'pending' => route('home', ['status' => 'pending', 'email' => $this->email]),
            ],
            // expiração em 1 hora
            'expires'                => true,
            'expiration_date_from'   => $now->toIso8601String(),
            'expiration_date_to'     => $expiresInOneHour->toIso8601String(),

            // dados do comprador
            'payer' => [
                'name'           => $this->first_name,
                'surname'        => $this->second_name,
                'email'          => $this->email,
                'phone' => [
                    'area_code' => substr($this->phone, 0, 2),
                    'number'    => substr($this->phone, 2),
                ],
                'identification' => [
                    'type'   => 'CPF',
                    'number' => $this->cpf_cpnj ?? null,
                ],
                'address' => [
                    'zip_code'     => $this->zip_code,
                    'street_name'  => $this->street,
                    'street_number'=> $this->number,
                    'floor'        => null,
                    'apartment'    => $this->complement,
                    'city_name'    => $this->city,
                    'neighborhood' => $this->neighborhood,
                    'country'      => 'BR',
                ],
            ],

            // informações adicionais (pode ser JSON/string)
            'additional_info'      => "Cliente: {$this->client_name}",

            // referencia externa sua (pode ser id de usuário, uuid, etc)
            'external_reference'   => (string) Str::uuid(),

            // notificações de pagamento (webhook)
            'notification_url'     => 'https://somosdevteam.com',

            // descriptor que aparece no extrato
            'statement_descriptor' => 'SAO LUCAS TM',
        ];
        $preference = $this->createPreferenceService->createPreference($payload);

        // 3) Pega o sandbox init point (ou, se estiver em produção, o init_point)
        $checkoutUrl = $preference->init_point
            ?? $preference->sandbox_init_point;

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
