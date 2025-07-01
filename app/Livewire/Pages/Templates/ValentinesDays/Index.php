<?php

namespace App\Livewire\Pages\Templates\ValentinesDays;

use App\Models\Plan;
use App\Service\MercadoPago\CheckoutPro\CreatePreferenceService;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {

        return view('livewire.pages.templates.valentines-days.index')->layout('components.layouts.templates.valentines_day.app_valentines_day');
    }
}
