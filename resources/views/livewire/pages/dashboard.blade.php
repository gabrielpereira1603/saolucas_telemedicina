<div :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <!-- INFORMAÇÕES DO USUÁRIO -->
        <div class="p-6 rounded-xl border bg-white dark:bg-neutral-900 border-neutral-200 dark:border-neutral-700 mb-2">
            <div class="flex flex-col md:flex-row md:items-center gap-2 justify-between">
                <div>
                    <div class="font-semibold text-lg">{{ $user->name }}</div>
                    <div class="text-sm text-neutral-500">{{ $user->email }}</div>
                    <div class="text-xs mt-1">Perfil: <span class="font-medium">{{ __($user->role) }}</span></div>
                </div>
                <div>
                    <div class="text-xs text-neutral-400">
                        Último login: {{ optional($user->last_login_at)->format('d/m/Y H:i') ?? '-' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- CARDS -->
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <!-- COMPRAS -->
            <div class="relative aspect-video overflow-hidden rounded-xl border bg-white dark:bg-neutral-900 border-neutral-200 dark:border-neutral-700 p-4 flex flex-col">
                <div class="font-semibold mb-2">Últimas Compras</div>
                <ul class="flex-1 overflow-auto">
                    @forelse($sales as $sale)
                        <li class="mb-1 text-sm">
                            {{ $sale->plan->name ?? 'N/A' }}
                            <span class="text-xs text-neutral-400">
                                ({{ number_format($sale->value / 100, 2, ',', '.') }} - {{ __($sale->status) }})
                            </span>
                        </li>
                    @empty
                        <li class="text-neutral-400 text-xs">Nenhuma compra encontrada.</li>
                    @endforelse
                </ul>
            </div>

            <!-- PLANOS ATIVOS -->
            <div class="relative aspect-video overflow-hidden rounded-xl border bg-white dark:bg-neutral-900 border-neutral-200 dark:border-neutral-700 p-4 flex flex-col">
                <div class="font-semibold mb-2">Planos Ativos</div>
                <ul class="flex-1 overflow-auto">
                    @forelse($activePlans as $plan)
                        <li class="mb-1 text-sm">{{ $plan->name ?? 'N/A' }}</li>
                    @empty
                        <li class="text-neutral-400 text-xs">Nenhum plano ativo.</li>
                    @endforelse
                </ul>
            </div>

            <!-- WHITE LABEL -->
            <div class="relative aspect-video overflow-hidden rounded-xl border bg-white dark:bg-neutral-900 border-neutral-200 dark:border-neutral-700 p-4 flex flex-col">
                <div class="font-semibold mb-2">White Label Adquirido</div>
                @if($whiteLabel)
                    <div>
                        <div class="text-sm">{{ $whiteLabel->name }}</div>
                        <div class="text-xs text-neutral-400">Slug: {{ $whiteLabel->slug }}</div>
                    </div>
                @else
                    <div class="text-neutral-400 text-xs">Nenhum white label adquirido.</div>
                @endif
            </div>
        </div>
    </div>
</div>
