<div title="Dashboard">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <!-- INFORMAÇÕES DO USUÁRIO -->
        <div class="p-6 rounded-xl border bg-white dark:bg-neutral-900 border-neutral-200 dark:border-neutral-700 mb-2">
            <div class="flex flex-col md:flex-row md:items-center gap-2 justify-between">
                <div>
                    <div class="font-semibold text-lg">João da Silva</div>
                    <div class="text-sm text-neutral-500">joao@email.com</div>
                    <div class="text-xs mt-1">Perfil: <span class="font-medium">client</span></div>
                </div>
                <div>
                    <div class="text-xs text-neutral-400">
                        Último login: 14/06/2025 15:22
                    </div>
                </div>
            </div>
        </div>

        <!-- CARDS -->
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <!-- COMPRAS -->
            <div class="relative aspect-video overflow-hidden rounded-xl border bg-white dark:bg-neutral-900 border-neutral-200 dark:border-neutral-700 p-4 flex flex-col">
                <div class="font-semibold mb-2">Últimas Compras</div>
                <ul class="flex-1 overflow-auto text-sm">
                    <li class="mb-1">
                        Plano Anual
                        <span class="text-xs text-neutral-400">(R$ 149,00 - pago)</span>
                    </li>
                    <li class="mb-1">
                        Plano Mensal
                        <span class="text-xs text-neutral-400">(R$ 14,90 - aguardando)</span>
                    </li>
                </ul>
            </div>

            <!-- PLANOS ATIVOS -->
            <div class="relative aspect-video overflow-hidden rounded-xl border bg-white dark:bg-neutral-900 border-neutral-200 dark:border-neutral-700 p-4 flex flex-col">
                <div class="font-semibold mb-2">Planos Ativos</div>
                <ul class="flex-1 overflow-auto text-sm">
                    <li class="mb-1">Promoção Dia dos Namorados</li>
                </ul>
            </div>

            <!-- WHITE LABEL -->
            <div class="relative aspect-video overflow-hidden rounded-xl border bg-white dark:bg-neutral-900 border-neutral-200 dark:border-neutral-700 p-4 flex flex-col">
                <div class="font-semibold mb-2">White Label Adquirido</div>
                <div>
                    <div class="text-sm">São Lucas Saúde</div>
                    <div class="text-xs text-neutral-400">Slug: sao-lucas-saude</div>
                </div>
            </div>
        </div>
    </div>
</div>
