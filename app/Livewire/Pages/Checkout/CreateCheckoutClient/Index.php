<?php

namespace App\Livewire\Pages\Checkout\CreateCheckoutClient;

use App\Models\Sale;
use App\Service\MercadoPago\CreatePreferenceService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
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

    #[Validate('string|required')]
    public $first_name = '';
    #[Validate('string|required')]
    public $second_name = '';
    #[Validate('required')]
    public $cpf_cpnj = '';

    #[Validate('required|string|email|ends_with:com,br')]
    public $email = '';
    #[Validate('required|string')]
    public $phone = '';
    #[Validate('string|required')]
    public $street      = '';
    #[Validate('string|required')]
    public $neighborhood= '';
    #[Validate('string|required')]
    public $city        = '';
    #[Validate('string|required')]
    public $zip_code    = '';

    #[Validate('string|nullable')]
    public $number      = '';
    #[Validate('string|nullable')]
    public $complement  = '';
    #[Validate('string|nullable')]
    public $client_name = '';
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

    public function render()
    {
        return view('livewire.pages.checkout.create-checkout-client.index', [
            'plan'     => $this->plan,
            'referral' => $this->referral,
        ])->layout('components.layouts.templates.valentines_day.app_valentines_day');
    }

    public function criarPreference()
    {
        $data = $this->validate();

        // 2) prepara nome final
        $clientName = $data['client_name']
            ?: "{$data['first_name']} {$data['second_name']}";

        // 3) extrai senha padrão (4 primeiros dígitos do CPF/CNPJ)
        $digits       = preg_replace('/\D+/', '', $data['cpf_cpnj']);
        $passwordBase = substr($digits, 0, 4);

        // 4) cria usuário
        $user = User::firstOrCreate(
            ['email' => $data['email']],          // busca só por email
            [
                'name'         => $clientName,    // só usado se criar
                'password'     => Hash::make($passwordBase),
                'street'       => $data['street'],
                'neighborhood' => $data['neighborhood'],
                'city'         => $data['city'],
                'zip_code'     => $data['zip_code'],
                'number'       => $data['number'] ?? null,
                'complement'   => $data['complement'] ?? null,
            ]
        );

        // 5) cria client vinculado
        $client = Client::firstOrCreate(
            ['user_id' => $user->id],            // busca só por user_id
            [
                'slug' => Str::slug($clientName),
                'name' => $clientName,
            ]
        );

        $sale = Sale::create([
            'plan_id'    => $this->plan->id,
            'user_id'    => $user->id,
            'client_id'  => $client->id,
            'value'      => $this->plan->value,
            'status'     => 'pending',
        ]);

        // 6) dados de expiração
        $now              = Carbon::now();
        $expiresInOneHour = $now->copy()->addHour();

        // 7) monta payload MercadoPago já usando o user->id
        $payload = [
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
            'back_urls' => [
                'success' => route('checkout.status', ['sale' => $sale->id]),
                'failure' => route('checkout.status', ['sale' => $sale->id]),
                'pending' => route('checkout.status', ['sale' => $sale->id]),
            ],
            'expires'               => true,
            'expiration_date_from'  => $now->toIso8601String(),
            'expiration_date_to'    => $expiresInOneHour->toIso8601String(),
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
                    'number' => $this->cpf_cpnj,
                ],
                'address' => [
                    'zip_code'      => $this->zip_code,
                    'street_name'   => $this->street,
                    'street_number' => $this->number,
                    'floor'         => null,
                    'apartment'     => $this->complement,
                    'city_name'     => $this->city,
                    'neighborhood'  => $this->neighborhood,
                    'country'       => 'BR',
                ],
            ],
            'payment_methods' => [
                'excluded_payment_types' => [],
                'default_payment_method_id' => null,
            ],
            'additional_info'    => "Cliente: {$clientName}",
            'external_reference' => (string) $user->id,
            'notification_url'   => 'https://somosdevteam.com',
            'statement_descriptor'=> 'SAO LUCAS TM',
        ];

        // 8) cria preferência e dispara redirect
        $preference  = $this->createPreferenceService->createPreference($payload);


        $checkoutUrl = $preference->init_point ?? $preference->sandbox_init_point;

        $this->dispatch('mp-redirect', url: $checkoutUrl);
    }

}
