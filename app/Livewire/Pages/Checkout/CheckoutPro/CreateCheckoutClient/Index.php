<?php

namespace App\Livewire\Pages\Checkout\CheckoutPro\CreateCheckoutClient;

use App\Factories\MercadoPago\CheckoutPro\CreatePreferencePayloadFactory;
use App\Models\Plan;
use App\Models\SubAcquirer;
use App\Notifications\Cheackout\CreateCheckout\SendAccessTokenNotification;
use App\Service\Checkout\CheckoutService;
use App\Service\MercadoPago\CheckoutPro\CreatePreferenceService;
use App\Service\Token\TokenService;
use App\Traits\Traits\Pages\Checkout\CheckoutPro\CreateCheckoutClient\FormProperties as CreateCheckoutClientFormProperties;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    use CreateCheckoutClientFormProperties;

    private CheckoutService $checkoutService;
    private TokenService $tokenService;
    private CreatePreferenceService $createPreferenceService;

    public function __construct()
    {
        $this->checkoutService = new CheckoutService();
        $this->tokenService = new TokenService();
        $this->createPreferenceService = New CreatePreferenceService();
    }
    public function mount($plan, ?string $referral = '')
    {
        //$this->mockFormData();

        $this->planId   = $plan;
        $this->referral = $referral;
        $this->plan     = Plan::findOrFail($plan);

        if ($referral) {
            $this->subAcquirer = SubAcquirer::where('prefix_url', $referral)->first();
        }
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

        DB::beginTransaction();

        try {
            $clientName = $data['client_name'] ?: "{$data['first_name']} {$data['second_name']}";
            $token = $this->tokenService->generateSixDigitToken();
            $user   = $this->checkoutService->createOrUpdateUser($data, $clientName, $token);
            $client = $this->checkoutService->createOrGetClient($user, $clientName);

            $sale = $this->checkoutService->createSale($this->plan, $this->subAcquirer, $client);

            $digits = preg_replace('/\D+/', '', $this->cpf_cnpj);
            $docType = strlen($digits) > 11 ? 'CNPJ' : 'CPF';

            $payerData = [
                'name'           => $this->first_name,
                'surname'        => $this->second_name,
                'email'          => $this->email,
                'phone' => [
                    'area_code' => substr($this->phone, 0, 2),
                    'number'    => substr($this->phone, 2),
                ],
                'identification' => [
                    'type'   => $docType,
                    'number' => $digits,
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
            ];

            $payload = CreatePreferencePayloadFactory::make($this->plan, $payerData, $clientName, $user->id);
            $preference = $this->createPreferenceService->createPreference($payload);

            $preferenceId = $preference->id ?? null;
            $sale->update([
                'preference_id' => $preferenceId,
            ]);

            $loginUrl = route('login');
            $user->notify(new SendAccessTokenNotification($token, $loginUrl));

            DB::commit();

            $checkoutUrl = $preference->init_point ?? $preference->sandbox_init_point;
            $this->dispatch('mp-redirect', url: $checkoutUrl);
        } catch (Exception $e) {
            DB::rollBack();

            // Log, tratar erro ou disparar alerta
            logger()->error('Erro ao criar preferência MP: ' . $e->getMessage());

            $this->dispatch('error', [
                'title' => 'Erro ao processar o pagamento. Tente novamente.',
            ]);
        }
    }
}
