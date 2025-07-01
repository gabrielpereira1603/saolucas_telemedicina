{{-- resources/views/livewire/pages/checkout/create-checkout-client/index.blade.php --}}
<div class="w-full">
    {{-- ========== CHECKOUT ========== --}}
    <section id="checkout-section"
             class="relative w-full bg-[#FDFDFC] py-20 overflow-hidden">
        {{-- faint valentines bg pattern --}}
        <div class="absolute inset-0"
             style="background-image:
                linear-gradient(rgba(249,250,251,0.22), rgba(249,250,251,0.25)),
                url('{{ asset('images/backgrounds/bg-itens-health.png') }}');
                background-size: cover;
                opacity: .1;">
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-2 gap-12">
            {{-- === ZONA VERMELHA: FORMULÁRIO === --}}
            <div class="bg-white rounded-lg shadow-2xl p-8">
                <h2 class="text-3xl font-extrabold text-blue-900 mb-6">
                    Cadastro de Cliente
                </h2>

                @if (session()->has('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                <form class="space-y-6">
                    {{-- Nome --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1">Primeiro Nome <span class="text-red-600">*</span></label>
                            <input type="text" wire:model.defer="first_name"
                                   class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-pink-500 focus:border-pink-500"/>
                            @error('first_name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1">Segundo Nome <span class="text-red-600">*</span></label>
                            <input type="text" wire:model.defer="second_name"
                                   class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-pink-500 focus:border-pink-500"/>
                            @error('second_name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- CPF/CNPJ e Telefone --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1">CPF/CNPJ <span class="text-red-600">*</span></label>
                            <input type="text" wire:model.defer="cpf_cnpj"
                                   x-mask:dynamic="$input.length > 14 ? '99.999.999/9999-99' : '999.999.999-99'"
                                   class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-pink-500 focus:border-pink-500"/>
                            @error('cpf_cpnj') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1">Telefone <span class="text-red-600">*</span></label>
                            <input type="text" wire:model.defer="phone"
                                   x-mask="(99)99999-9999"
                                   class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-pink-500 focus:border-pink-500"/>
                            @error('phone') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- E-mail e Nome do Cliente --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1">E-mail <span class="text-red-600">*</span></label>
                            <input type="email" wire:model.defer="email"
                                   class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-pink-500 focus:border-pink-500"/>
                            @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1">Nome do Cliente <small class="text-gray-500"> (opcional)</small></label>
                            <input type="text" wire:model.defer="client_name"
                                   class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-pink-500 focus:border-pink-500"/>
                            @error('client_name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Endereço --}}
                    <h3 class="mt-6 text-lg font-semibold text-blue-900">Endereço </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1">Rua <span class="text-red-600">*</span></label>
                            <input type="text" wire:model.defer="street"
                                   class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-pink-500 focus:border-pink-500"/>
                            @error('street') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1">Bairro <span class="text-red-600">*</span></label>
                            <input type="text" wire:model.defer="neighborhood"
                                   class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-pink-500 focus:border-pink-500"/>
                            @error('neighborhood') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1">Cidade <span class="text-red-600">*</span></label>
                            <input type="text" wire:model.defer="city"
                                   class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-pink-500 focus:border-pink-500"/>
                            @error('city') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1">CEP <span class="text-red-600">*</span></label>
                            <input type="text" wire:model.defer="zip_code"
                                   class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-pink-500 focus:border-pink-500"/>
                            @error('zip_code') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1">
                                Número <small class="text-gray-500"> (opcional)</small>
                            </label>
                            <input type="text" wire:model.defer="number"
                                   class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-pink-500 focus:border-pink-500"/>
                            @error('number') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-1">Complemento <small class="text-gray-500"> (opcional)</small></label>
                            <input type="text" wire:model.defer="complement"
                                   class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-pink-500 focus:border-pink-500"/>
                            @error('complement') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <button type="button"
                            wire:click="criarPreference"
                            class="w-full bg-blue-900 hover:bg-blue-900/80 text-white font-semibold py-3 rounded-full transition cursor-pointer">
                        Finalizar Cadastro
                    </button>
                </form>
            </div>

            {{-- === ZONA AZUL: RESUMO ABAIXO DA ILUSTRAÇÃO === --}}
            <div class="bg-white rounded-lg shadow-2xl p-8 flex flex-col">
                {{-- ilustração no topo --}}
                <div class="mb-6">
                    <img src="{{ asset('images/templates/default/about.png') }}"
                         alt="Ilustração"
                         class="w-full rounded-lg shadow-inner object-cover"/>
                </div>

                {{-- detalhes do pedido --}}
                <div>
                    <h2 class="text-3xl font-extrabold text-blue-900 mb-4">Resumo do Plano</h2>
                    <ul class="space-y-4 text-gray-800 text-lg">
                        <li><strong>Plano:</strong> {{ $plan->name }}</li>
                        <li><strong>Valor total:</strong> R$ {{ number_format($plan->value,2,',','.') }}</li>
                        <li><strong>Mensalidade:</strong> R$ {{ number_format($plan->value/12,2,',','.') }} / mês</li>
                        @if($referral)
                            <li><strong>Código de indicação:</strong> {{ $referral }}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('mp-redirect', (event) => {
                    window.location.replace(event.url)
                });
            });
        </script>
    @endpush
</div>
