<?php

namespace App\Livewire\Pages\Templates\Default;

use App\Models\Plan;
use App\Service\MercadoPago\CheckoutPro\CreatePreferenceService;
use Illuminate\Http\Request;
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

    public function render(Request $request)
    {
        $teamName  = 'Corinthians';
        $validDate = '31/07/2025';
        $referral  = $request->route('referral'); // pode ser null ou string

        return view('livewire.pages.templates.default.index', compact('teamName', 'validDate', 'referral'))->layout('components.layouts.templates.valentines_day.app_valentines_day');
    }
}
