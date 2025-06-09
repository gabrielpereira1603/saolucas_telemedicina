<?php

namespace App\Livewire\Pages\Templates\ValentinesDays;

use App\Models\Plan;
use App\Service\MercadoPago\CreatePreferenceService;
use App\Traits\Payments\ConfigAmbientTrait;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use MercadoPago\Client\Preference\PreferenceClient;

class Index extends Component
{
    use ConfigAmbientTrait;

    public $plans;
    protected CreatePreferenceService $createPreferenceService;

    public function __construct()
    {
        $this->createPreferenceService = New CreatePreferenceService();
    }

    public function mount()
    {
        $this->plans = Plan::all();
    }


    public function render()
    {

        return view('livewire.pages.templates.valentines-days.index')->layout('components.layouts.templates.valentines_day.app_valentines_day');
    }
}
