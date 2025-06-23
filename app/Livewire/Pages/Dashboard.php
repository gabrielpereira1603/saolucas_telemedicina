<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $user = auth()->user();
        $binding = $user->getRoleBinding();

        // Compras do usuário

        $activePlans = collect();
        $whiteLabel = null;

        // Se o usuário for client, carrega planos ativos
        if ($binding === 'client') {
            $client = $user->client;
            $activePlans = $client
                ? $client->sales()->where('status', 'paid')->with('plan')->get()->pluck('plan')
                : collect();
        }

        // Se o usuário for white label
        if ($binding === 'white_label') {
            $whiteLabel = $user->whiteLabel;
        }

        return view('livewire.pages.dashboard', compact(
            'user', 'activePlans', 'whiteLabel', 'binding'
        ));
    }

}
