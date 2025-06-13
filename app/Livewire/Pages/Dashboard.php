<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $user = auth()->user();

        // Compras do usuário
        $sales = $user->sales()->with(['plan', 'client'])->latest()->take(5)->get();

        // Planos ativos pelo client (supondo 1 client por user)
        $client = $user->clients()->first();
        $activePlans = $client
            ? $client->sales()->where('status', 'paid')->with('plan')->get()->pluck('plan')
            : collect();

        // White label comprado
        $whiteLabel = $user->whiteLabels()->first();
        return view('livewire.pages.dashboard', compact('user', 'sales', 'activePlans', 'whiteLabel'));
    }
}
