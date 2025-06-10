<div class="w-full bg-white py-12 px-4 md:px-8 lg:px-16">
    <h2 class="text-3xl font-semibold mb-6">Status do Pagamento</h2>

    {{-- DADOS DA VENDA --}}
    <div class="w-full bg-gray-50 rounded-lg shadow p-6 mb-8">
        <h3 class="text-xl font-medium mb-4">Dados da Venda</h3>

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
            class="mt-6 inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded"
        >
            Atualizar Status
        </button>
    </div>

    {{-- DADOS DO CLIENTE/USUÁRIO --}}
    <div class="w-full bg-gray-50 rounded-lg shadow p-6">
        <h3 class="text-xl font-medium mb-4">Dados do Cliente</h3>

        <p><strong>Cliente:</strong> {{ $sale->client->name }}</p>
        <p><strong>Usuário (Name):</strong> {{ $sale->user->name }}</p>
        <p><strong>E-mail:</strong> {{ $sale->user->email }}</p>

        <h4 class="mt-4 font-semibold">Endereço</h4>
        <p>
            {{ $sale->user->street }}
            @if($sale->user->number)
                , {{ $sale->user->number }}
            @endif
            @if($sale->user->complement)
                ({{ $sale->user->complement }})
            @endif
        </p>
        <p>{{ $sale->user->neighborhood }} – {{ $sale->user->city }}, {{ $sale->user->zip_code }}</p>
    </div>

    @push('scripts')
        <script>
            Echo.channel('sale.{{ $sale->id }}')
                .listen('SaleStatusUpdated', e => {
                    Livewire.emit('saleUpdated', e);
                });
        </script>
    @endpush
</div>
