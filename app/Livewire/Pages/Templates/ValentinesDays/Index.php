<?php

namespace App\Livewire\Pages\Templates\ValentinesDays;

use App\Models\Plan;
use App\Service\MercadoPago\CheckoutPro\CreatePreferenceService;
use Livewire\Component;

class Index extends Component
{
    public $plans;
    protected CreatePreferenceService $createPreferenceService;

    public function __construct()
    {
        $this->createPreferenceService = New CreatePreferenceService();
    }

    public function mount()
    {

        // pega os parâmetros
        $status = request()->query('status');
        $email  = request()->query('email');

        if ($status === 'success') {
            $this->dispatch('success', [
                'title' => "Tudo certo! Instruções e confirmações de pagamento foram enviadas para {$email}."
            ]);
        } elseif ($status === 'error') {
            $this->dispatch('error', [
                'title' => "Ops! Houve um problema no pagamento. Por favor, tente novamente."
            ]);
        } elseif ($status === 'pending') {
            $this->dispatch('success', [
                'title' => "Pagamento pendente. Você receberá um e-mail assim que for aprovado."
            ]);
        }
        $this->plans = Plan::all();
    }


    public function render()
    {

        return view('livewire.pages.templates.valentines-days.index')->layout('components.layouts.templates.valentines_day.app_valentines_day');
    }
}
