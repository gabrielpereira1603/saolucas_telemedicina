<?php

namespace App\Livewire\Pages\Client\Dashboard;

use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['refresh-sales' => '$refresh'];

    public function render()
    {
        $sales = Sale::with(['plan', 'subAcquirer'])
            ->where('client_id', Auth::user()->client->id)
            ->latest()
            ->take(10)
            ->get();

        return view('livewire.pages.client.dashboard.index', compact('sales'))
            ->layout('components.layouts.app');
    }
}
