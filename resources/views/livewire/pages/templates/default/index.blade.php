<div class="w-full">
    {{-- ========== TELA DE HOME ========== --}}
    <section
        id="home-section"
        class="relative w-full h-screen overflow-hidden flex items-center justify-center bg-[#f4f4f4]"
    >
        {{-- Fundo full-width: torcida do time em jogo --}}
        <div class="absolute inset-0">
            <img
                src="{{ asset('images/templates/default/home-time.png') }}"
                alt="Torcida e Telemedicina"
                class="w-full h-full object-cover opacity-40"
            >
        </div>

        {{-- Conteúdo centralizado (logo, texto, botão) --}}
        <div class="relative z-10 max-w-4xl mx-auto text-center px-4">
            <div class="flex justify-center mb-6">
                <img
                    src="{{ asset('logo_transparent.png') }}"
                    alt="São Lucas Telemedicina"
                    class="h-36 w-auto"
                >
            </div>

            <h1 class="text-4xl sm:text-5xl font-extrabold text-blue-900 mb-4">
                Descontos exclusivos para torcedores do {{ $teamName }}!
            </h1>

            <p class="text-lg sm:text-xl text-blue-900 mb-6">
                A São Lucas Telemedicina valoriza sua paixão pelo futebol. Faça parte do clube de torcedores do <strong>{{ $teamName }}</strong> e garanta super descontos em consultas e serviços de saúde online.
                <span class="text-blue-900 font-semibold">Oferta válida até {{ $validDate }}.</span>
            </p>

            <a
                href="#plans-section"
                class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-3 rounded-full shadow-lg transition"
            >
                Quero meu Desconto
                <i class="fa-solid fa-medkit ml-2"></i>
            </a>
        </div>

    </section>

    {{-- ========== TELA SOBRE A CLÍNICA ========== --}}
    <section
        id="about-section"
        class="relative w-full bg-white py-20 overflow-hidden"
    >
        <div class="relative z-10 max-w-5xl mx-auto px-4 flex flex-col lg:flex-row items-center gap-12">
            {{-- Imagem ilustrativa em card circular --}}
            <div class="w-full lg:w-1/2 flex justify-center">
                <div class="bg-white rounded-full border-5 border-blue-900 p-2 shadow-2xl overflow-hidden w-80 h-80 flex items-center justify-center">
                    <img
                        src="{{ asset('images/templates/default/about-2.png') }}"
                        alt="Equipe São Lucas Telemedicina"
                        class="object-cover w-full h-full"
                    >
                </div>
            </div>

            {{-- Conteúdo textual --}}
            <div class="w-full lg:w-1/2 text-center lg:text-left">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-blue-900 mb-6">
                    Sobre a São Lucas Telemedicina
                </h2>

                <p class="text-lg text-gray-700 mb-6">
                    Na Telemedicina São Lucas, acreditamos que cuidar de quem você ama começa com atenção de qualidade, mesmo à distância. Nossa equipe multidisciplinar de médicos e especialistas está pronta para atender você de forma rápida, segura e humanizada.
                </p>

                <ul class="space-y-4 mb-8 text-left lg:text-left">
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 w-6 h-6 text-blue-900 mt-1 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-800">
                            <strong>Atendimento 100% online:</strong> consultas por vídeo sem sair de casa.
                        </span>
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 w-6 h-6 text-blue-900 mt-1 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-800">
                            <strong>Equipe especializada:</strong> cardiologia, clínica geral, saúde mental e muito mais.
                        </span>
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 w-6 h-6 text-blue-900 mt-1 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-800">
                            <strong>Atenção personalizada:</strong> histórico único do paciente para cuidado contínuo.
                        </span>
                    </li>
                </ul>

                <a
                    href="#plans-section"
                    class="inline-block bg-blue-900 hover:bg-green-600 text-white font-semibold px-6 py-3 rounded-full shadow-lg transition-colors"
                >
                    Conheça nossos serviços
                </a>
            </div>
        </div>
    </section>

    {{-- ========== TELA DE PLANOS ========== --}}
    <section
        id="plans-section"
        class="relative w-full bg-gray-50 py-20 overflow-hidden"
        style="
        background-image:
          linear-gradient(rgba(255,255,255,0.32), rgba(204,218,223,0.74)),
          url('{{ asset('images/backgrounds/bg-itens-health.png') }}');
        background-repeat: repeat;
        background-size: auto;
        background-position: center;"
    >
        <div class="relative z-10 max-w-5xl mx-auto px-4 text-center">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-blue-900 mb-4">
                Escolha o Plano Ideal para Você
            </h2>
            <p class="text-lg text-gray-700 mb-12">
                Planos flexíveis e acessíveis para cuidar da saúde de quem você ama.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($plans as $plan)
                    <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col">
                        <h3 class="text-xl font-semibold text-blue-900 mb-2">{{ $plan->name }}</h3>
                        <p class="text-sm text-gray-500 mb-6">Atendimento essencial para acompanhamento geral.</p>
                        <div class="flex items-baseline justify-center mb-6">
                            <span class="text-4xl font-extrabold text-blue-900">R$ {{ number_format($plan->value/12,2,',','.') }}</span>
                            <span class="text-gray-500 ml-1 self-end">/mês</span>
                        </div>
                        <ul class="space-y-3 text-left mb-8 flex-1">
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-900 mt-1 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-700">1 consulta mensal</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-900 mt-1 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-700">Acesso a histórico online</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-900 mt-1 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-700">Suporte via chat 24h</span>
                            </li>
                        </ul>
                        @php $referral = request()->route('referral'); @endphp
                        <a href="{{ route('subscribe.index', ['plan' => $plan->id,'referral'=>$referral]) }}" class="mt-auto inline-block bg-blue-900 hover:bg-blue-900/80 text-white font-semibold px-4 py-2 rounded-full shadow transition-colors">
                            Assinar {{ $plan->name }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========== SEÇÃO DE CONTATO ========== --}}
    <section
        id="contato-section"
        class="relative w-full bg-gray-50 py-20 overflow-hidden"
    >
        <!-- elemento decorativo atrás -->

        <div class="relative z-10 max-w-5xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- cartão do formulário -->
            <div class="bg-white border border-blue-200 rounded-lg shadow-lg p-8">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-blue-900 mb-6 text-center">
                    Entre em Contato
                </h2>
                <form method="POST" action="" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-gray-700 font-semibold mb-2">Nome</label>
                        <input
                            id="name" name="name" type="text" required
                            class="w-full border border-blue-200 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300"
                            placeholder="Seu nome"
                        />
                    </div>
                    <div>
                        <label for="email" class="block text-gray-700 font-semibold mb-2">E-mail</label>
                        <input
                            id="email" name="email" type="email" required
                            class="w-full border border-blue-200 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300"
                            placeholder="seu@exemplo.com"
                        />
                    </div>
                    <div>
                        <label for="phone" class="block text-gray-700 font-semibold mb-2">Telefone</label>
                        <input
                            id="phone" name="phone" type="tel" required
                            class="w-full border border-blue-200 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300"
                            placeholder="(XX) XXXXX-XXXX"
                        />
                    </div>
                    <div>
                        <label for="message" class="block text-gray-700 font-semibold mb-2">Mensagem</label>
                        <textarea
                            id="message" name="message" rows="4" required
                            class="w-full border border-blue-200 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300"
                            placeholder="Como podemos ajudar?"
                        ></textarea>
                    </div>
                    <div class="text-center">
                        <button
                            type="submit"
                            class="bg-blue-300 hover:bg-blue-400 text-white font-semibold px-8 py-3 rounded-full shadow transition-colors"
                        >
                            Enviar Mensagem
                        </button>
                    </div>
                </form>
            </div>

            <!-- cartão de informações -->
            {{-- 2.2) Coluna direita: Informações da Empresa --}}
            <div class="w-full lg:w-1/2 flex flex-col justify-center space-y-8">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-blue-900 mb-2 text-center lg:text-left">
                    Fale Direto Conosco
                </h2>
                <p class="text-lg text-gray-700 mb-4 text-center lg:text-left">
                    Estamos aqui para ajudar! Se preferir, utilize um dos canais abaixo:
                </p>

                {{-- Item 1: Endereço --}}
                <div class="flex items-start">
                    <div>
                        <h3 class="text-lg font-semibold text-blue-900">
                            <i class="fa-solid fa-location-crosshairs"></i>
                            Endereço
                        </h3>
                        <p class="text-gray-700">
                            Rua das Orquídeas, 123<br>
                            Centro Médico São Lucas – Sala 405<br>
                            Cidade Exemplo, SP – CEP 01234-567
                        </p>
                    </div>
                </div>

                {{-- Item 2: Telefone --}}
                <div class="flex items-start">
                    <div>
                        <h3 class="text-lg font-semibold text-blue-900">
                            <i class="fa-solid fa-phone"></i>
                            Telefone
                        </h3>
                        <p class="text-gray-700">
                            Comercial: <a href="tel:+55113157-1878" class="text-blue-900 hover:underline"> (11) 3157-1878</a><br>
                            Suporte: <a href="tel:+55113157-1878" class="text-blue-900 hover:underline"> (11) 3157-1878</a>
                        </p>
                    </div>
                </div>

                {{-- Item 3: E-mail --}}
                <div class="flex items-start">
                    <div>
                        <h3 class="text-lg font-semibold text-blue-900">
                            <i class="fa-solid fa-envelope"></i>
                            E-mail
                        </h3>
                        <p class="text-gray-700">
                            Atendimento: <a href="mailto:contato@saolucastelemedicina.com.br" class="text-blue-900 hover:underline">contato@saolucastelemedicina.com.br</a><br>
                            Suporte: <a href="mailto:contato@saolucastelemedicina.com.br" class="text-blue-900 hover:underline">contato@saolucastelemedicina.com.br</a>
                        </p>
                    </div>
                </div>

                {{-- Item 4: Horário de Atendimento --}}
                <div class="flex items-start">
                    <div>
                        <h3 class="text-lg font-semibold text-blue-900">
                            <i class="fa-solid fa-clock"></i>
                            Horário
                        </h3>
                        <p class="text-gray-700">
                            Segunda a Sexta: 08:00 – 18:00<br>
                            Sábado: 09:00 – 13:00<br>
                            Domingo: Fechado
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== FAQ ========== --}}
    <section
        id="faq-section"
        class="relative w-full bg-cover bg-center py-20 overflow-hidden"
        style="
        background-image:
          linear-gradient(rgba(255,255,255,0.7), rgba(255,255,255,0.87)),
          url('{{ asset('images/backgrounds/bg_frequently_asked_questions.png') }}');
        background-repeat: repeat;
        background-size: auto;
        background-position: center;"
    >
    <div class="relative z-10 max-w-5xl mx-auto px-4">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-blue-900 text-center mb-8">Perguntas Frequentes</h2>
            <div class="space-y-8">
                <div>
                    <h3 class="text-xl font-semibold text-blue-900 mb-2"><i class="fa-solid fa-circle-question mr-2"></i>Como funciona o atendimento por telemedicina?</h3>
                    <p class="text-gray-700">O atendimento ocorre via plataforma online segura, com agendamento, consulta por vídeo/chat e emissão de documentos digitais (receitas/atestados), sem precisar sair de casa.</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-blue-900 mb-2"><i class="fa-solid fa-circle-question mr-2"></i>Quais as vantagens de contratar um plano?</h3>
                    <p class="text-gray-700">Economia de tempo e deslocamento, rapidez no atendimento de dúvidas simples e acesso a profissionais especializados onde você estiver.</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-blue-900 mb-2"><i class="fa-solid fa-circle-question mr-2"></i>Posso marcar consulta com qualquer especialidade?</h3>
                    <p class="text-gray-700">Sim, oferecemos Clínica Geral, Cardiologia, Saúde Mental, Dermatologia, Nutrição e muito mais. Verifique no seu plano quais especialidades estão incluídas.</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-blue-900 mb-2"><i class="fa-solid fa-circle-question mr-2"></i>Como recebo receita ou atestado?</h3>
                    <p class="text-gray-700">Após a consulta, o médico emite documentos digitais em PDF, enviados por e-mail ou disponíveis em sua área do assinante.</p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-blue-900 mb-2"><i class="fa-solid fa-circle-question mr-2"></i>O que fazer em caso de emergência?</h3>
                    <p class="text-gray-700">Em situações críticas, procure imediatamente o serviço de emergência local (SAMU 192 ou hospital). A telemedicina não substitui atendimento presencial emergencial.</p>
                </div>
            </div>
        </div>
    </section>
</div>
