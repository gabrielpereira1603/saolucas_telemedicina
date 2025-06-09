<div class="max-w-md mx-auto py-12 space-y-4">
    <h2 class="text-2xl font-semibold">Status do Pagamento</h2>

    <p><strong>Venda ID:</strong> {{ $sale->id }}</p>
    <p><strong>Plano:</strong> {{ $sale->plan->name }}</p>
    <p><strong>Valor:</strong>
        R$ {{ number_format($sale->value/100, 2, ',', '.') }}
    </p>

    <p>
        <strong>Status:</strong>
        <span class="font-bold
            @if($sale->status === 'paid') text-green-600
            @elseif($sale->status === 'pending') text-yellow-600
            @else text-red-600 @endif
        ">
            {{ ucfirst($sale->status) }}
        </span>
    </p>

    @if($sale->payment_id)
        <p><strong>Payment ID:</strong> {{ $sale->payment_id }}</p>
    @endif

    <button
        wire:click="$refresh"
        class="mt-6 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded"
    >
        Atualizar Status
    </button>
    @push('scripts')
        <script>
            Echo.channel('sale.{{ $sale->id }}')
                .listen('SaleStatusUpdated', e => {
                    Livewire.emit('saleUpdated', e);
                });
        </script>
    @endpush

</div>
