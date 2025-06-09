{{-- resources/views/livewire/pages/checkout/create-checkout-client/index.blade.php --}}
<div class="w-full">
    {{-- ========== CHECKOUT ========== --}}
    <section id="checkout-section"
             class="relative w-full bg-[#FDFDFC] py-20 overflow-hidden">
        {{-- faint valentines bg pattern --}}
        <div class="absolute inset-0"
             style="background-image:
                linear-gradient(rgba(249,250,251,0.5), rgba(249,250,251,0.7)),
                url('{{ asset('images/templates/valentines-day/home.png') }}');
                background-size: cover;
                opacity: .1;">
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-2 gap-12">
            {{-- Formulário de cadastro --}}
            <div class="bg-white rounded-lg shadow-2xl p-8">
                <h2 class="text-3xl font-extrabold text-pink-600 mb-6">
                    Cadastro de Cliente
                </h2>

                @if (session()->has('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                <form class="space-y-5">
                    {{-- Nome e E-mail --}}
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Primeiro Nome</label>
                        <input type="text" wire:model.defer="first_name"
                               class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-pink-500 focus:border-pink-500"/>
                        @error('first_name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Segundo Nome</label>
                        <input type="text" wire:model.defer="second_name"
                               class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-pink-500 focus:border-pink-500"/>
                        @error('second_name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">E-mail</label>
                        <input type="email" wire:model.defer="email"
                               class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-pink-500 focus:border-pink-500"/>
                        @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    {{-- Endereço --}}
                    <h3 class="mt-6 text-lg font-semibold text-blue-900">Endereço</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach(['street'=>'Rua','neighborhood'=>'Bairro','city'=>'Cidade','zip_code'=>'CEP','number'=>'Número','complement'=>'Complemento'] as $f=>$label)
                            <div>
                                <label class="block text-gray-700 font-semibold mb-1">{{ $label }}</label>
                                <input type="text" wire:model.defer="{{ $f }}"
                                       class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-pink-500 focus:border-pink-500"/>
                                @error($f) <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                            </div>
                        @endforeach
                    </div>

                    {{-- Cliente --}}
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Nome do Cliente</label>
                        <input type="text" wire:model.defer="client_name"
                               class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-pink-500 focus:border-pink-500"/>
                        @error('client_name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <button type="button"
                            wire:click="criarPreference"
                            class="w-full bg-pink-500 hover:bg-pink-600 text-white font-semibold py-3 rounded-full transition">
                        Finalizar Cadastro
                    </button>
                </form>
            </div>

            {{-- Resumo do pedido --}}
            <div class="bg-white rounded-lg shadow-2xl p-8">
                <h2 class="text-3xl font-extrabold text-blue-900 mb-6">Resumo do Plano</h2>
                <ul class="space-y-4 text-gray-800 text-lg">
                    <li><strong>Plano:</strong> {{ $plan->name }}</li>
                    <li><strong>Valor total:</strong> R$ {{ number_format($plan->value,2,',','.') }}</li>
                    <li><strong>Mensalidade:</strong> R$ {{ number_format($plan->value/12,2,',','.') }} / mês</li>
                    @if($referral)
                        <li><strong>Código de indicação:</strong> {{ $referral }}</li>
                    @endif
                </ul>
                <img src="{{ asset('images/templates/valentines-day/about.png') }}"
                     alt="Ilustração"
                     class="mt-8 w-full rounded-lg shadow-inner object-cover"/>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('mp-redirect', (event) => {
                    console.log(event)
                    window.location.replace(event.url)
                });
            });
        </script>
    @endpush
</div>
