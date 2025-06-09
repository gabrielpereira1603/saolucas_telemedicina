<?php
namespace App\Livewire\Pages\Checkout\Response;

use Livewire\Component;
use App\Models\Sale;

class Index extends Component
{
    public Sale $sale;

    protected $listeners = [
        'saleUpdated' => 'onSaleUpdated',
    ];

    public function mount(Sale $sale)
    {
        $this->sale = $sale;
    }

    public function onSaleUpdated($payload)
    {
        // atualiza o status na instância
        if ($payload['id'] === $this->sale->id) {
            $this->sale->status = $payload['status'];
        }
    }

    public function render()
    {
        return view('livewire.pages.checkout.response.index');
    }
}
