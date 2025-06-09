<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use App\Models\Sale;

class SaleStatusUpdated implements ShouldBroadcast
{
    use SerializesModels;

    public Sale $sale;

    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }

    public function broadcastOn()
    {
        // canal público, could be private if precisar auth
        return new Channel("sale.{$this->sale->id}");
    }

    public function broadcastWith()
    {
        return [
            'id'     => $this->sale->id,
            'status' => $this->sale->status,
        ];
    }
}
