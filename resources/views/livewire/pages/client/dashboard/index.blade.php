@php
    use Illuminate\Support\Carbon;
@endphp

<div title="Dashboard">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <!-- INFORMAÇÕES DO USUÁRIO -->
        <div class="p-6 rounded-xl border bg-white dark:bg-neutral-900 border-neutral-200 dark:border-neutral-700 mb-2">
            <div class="flex flex-col md:flex-row md:items-center gap-2 justify-between">
                <div>
                    <div class="font-semibold text-lg">{{ auth()->user()->name ?? 'Não informado' }}</div>
                    <div class="text-sm text-neutral-500">{{ auth()->user()->email ?? 'Não informado' }}</div>
                    <div class="text-xs mt-1">CPF: <span class="font-medium">{{ auth()->user()->cpf_cnpj ?? 'Não informado' }}</span></div>
                    <div class="text-xs">Número: <span class="font-medium">{{ auth()->user()->number ?? 'Não informado' }}</span></div>
                </div>
                <div class="text-xs text-neutral-400">
                    Último login: {{ auth()->user()->last_login_at?->format('d/m/Y H:i') ?? 'Não registrado' }}
                </div>
            </div>
        </div>

        <!-- Últimas Vendas -->
        <div class="p-6 rounded-xl border bg-white dark:bg-neutral-900 border-neutral-200 dark:border-neutral-700">
            <div class="font-semibold text-lg mb-4">Últimas Compras</div>

            @if($sales->isEmpty())
                <div class="flex flex-col items-center justify-center text-center text-sm text-neutral-500 p-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-neutral-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l-2-2m0 0l-2-2m2 2h6m2 2l2-2m0 0l2-2m-2 2h-6" />
                    </svg>
                    Nenhuma compra encontrada ainda.<br>
                    <a href="/planos" class="text-blue-600 dark:text-blue-400 underline mt-2">Clique aqui para adquirir um plano</a>
                </div>
            @else
                <ul class="space-y-2 text-sm">
                    @foreach($sales as $sale)
                        <li class="border-b pb-2">
                            <div><span class="font-medium">Plano:</span> {{ $sale->plan->name ?? 'Não informado' }}</div>
                            <div><span class="font-medium">Valor:</span> R$ {{ number_format($sale->value, 2, ',', '.') }}</div>
                            <div><span class="font-medium">Data:</span> {{ Carbon::parse($sale->created_at)->format('d/m/Y H:i') }}</div>
                            @if ($sale->sub_acquirer_id)
                                <div><span class="font-medium">Subadquirente:</span> {{ $sale->subAcquirer->name ?? 'Não informado' }}</div>
                            @endif
                            <div>
                                <span class="font-medium">Status:</span>
                                @switch($sale->status)
                                    @case('pending') Pendente @break
                                    @case('paid') Pago @break
                                    @case('cancelled') Cancelado @break
                                    @default Não informado
                                @endswitch
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- FAQ / Contato -->
        <div class="p-6 rounded-xl border bg-white dark:bg-neutral-900 border-neutral-200 dark:border-neutral-700">
            <div class="font-semibold text-lg mb-4">Dúvidas / Suporte</div>
            <form wire:submit.prevent>
                <div class="flex flex-col gap-2 mb-4">
                    <flux:input type="text" label="Assunto" for="subject" placeholder="Assunto" />

                    <flux:select id="subject" name="subject" variant="default" class="w-full">
                        <option value="duvida">Dúvida</option>
                        <option value="problema">Problema</option>
                        <option value="outro">Outro</option>
                    </flux:select>
                </div>

                <div class="mb-4">
                    <flux:textarea label="Descrição" id="description" name="description" rows="4" class="w-full" placeholder="Descreva sua dúvida ou problema..."></flux:textarea>
                </div>

                <flux:button type="submit" variant="primary" disabled>Enviar</flux:button>
            </form>
        </div>

    </div>

    @push('scripts')
        <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
        <script>
            Pusher.logToConsole = false;

            const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
                cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
                encrypted: true,
                authEndpoint: '/broadcasting/auth',
                auth: {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }
            });

            const channel = pusher.subscribe('private-user.{{ auth()->id() }}');
            channel.bind('payment-updated', function(data) {
                Livewire.dispatch('refresh-sales');
            });
        </script>
    @endpush

</div>
