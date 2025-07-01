<?php

namespace App\Livewire\Pages\WhiteLabel\Dashboard;

use Livewire\Component;
use App\Models\Client;
use App\Models\SubAcquirer;
use App\Models\Sale;
use Illuminate\Support\Collection;

class Index extends Component
{
    public Collection $topClients;
    public Collection $subAcquirerCommissions;
    public Collection $sales;

    protected $listeners = [
        'refresh-sales' => 'loadSales',
    ];

    public function mount()
    {
        $clients = Client::withCount('sales')
            ->orderByDesc('sales_count')
            ->take(5)
            ->get();

        if ($clients->isEmpty()) {
            $clients = collect([
                (object)['name' => 'Cliente A', 'sales_count' => 12],
                (object)['name' => 'Cliente B', 'sales_count' => 9],
                (object)['name' => 'Cliente C', 'sales_count' => 7],
                (object)['name' => 'Cliente D', 'sales_count' => 5],
                (object)['name' => 'Cliente E', 'sales_count' => 3],
            ]);
        }

        $this->topClients = $clients;

        $subs = SubAcquirer::all()->map(function (SubAcquirer $sub) {
            $totalSales = $sub->sales()->sum('value');
            return (object)[
                'name'       => $sub->name,
                'commission' => $totalSales * $sub->commission_rate,
            ];
        });

        if ($subs->isEmpty()) {
            // fallback de demonstração
            $subs = collect([
                (object)['name' => 'Sub A', 'commission' => 1200],
                (object)['name' => 'Sub B', 'commission' => 950],
                (object)['name' => 'Sub C', 'commission' => 700],
                (object)['name' => 'Sub D', 'commission' => 450],
                (object)['name' => 'Sub E', 'commission' => 300],
            ]);
        }

        $this->subAcquirerCommissions = $subs;



        $this->loadSales();
    }

    /**
     * Se for cliente pega client->sales,
     * se sub-acquirer pega subAcquirer->sales,
     * se white-label busca via plans vinculados,
     * senão retorna coleção vazia.
     */
    public function loadSales(): void
    {
        $user = auth()->user();

        if ($user->client()->exists()) {
            $query = $user->client->sales();
        } elseif ($user->subAcquirer()->exists()) {
            $query = $user->subAcquirer->sales();
        } elseif ($user->whiteLabel()->exists()) {
            $wlId = $user->whiteLabel->id;
            $query = Sale::whereHas('plan.whiteLabels', fn($q) => $q->where('white_label_id', $wlId));
        } else {
            $this->sales = collect();
            return;
        }

        $this->sales = $query
            ->with(['plan', 'client', 'subAcquirer'])
            ->latest('created_at')
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.white-label.dashboard.index', [
            'topClients'             => $this->topClients,
            'subAcquirerCommissions' => $this->subAcquirerCommissions,
            'sales'                  => $this->sales,
        ]);
    }
}
