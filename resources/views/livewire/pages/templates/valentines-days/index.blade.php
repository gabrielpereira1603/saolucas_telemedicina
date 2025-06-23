<div class="w-full">
    {{-- ========== TELA DE HOME ========== --}}
    <section
        id="valentine-section"
        class="relative w-full h-screen overflow-hidden flex justify-items-center bg-[#f4f4f4]"
    >
        {{-- 2.1) Fundo full-width --}}
        <div class="absolute inset-0">
            <img
                src="{{ asset('images/templates/valentines-day/home.png') }}"
                alt="Fundo Dia dos Namorados + Telemedicina"
                class="w-full h-full object-cover opacity-20"
            >
        </div>

        {{-- 2.2) Conteúdo centralizado (logo, texto, botão) --}}
        <div class="relative z-10 max-w-4xl mx-auto text-center px-4 mt-42">
            <div class="flex justify-center">
                <img
                    src="{{ asset('logo_transparent.png') }}"
                    alt="São Lucas Telemedicina"
                    class="h-36 w-auto sm:block hidden"
                >
            </div>

            <h1 class="text-4xl sm:text-5xl font-extrabold text-blue-900 mb-4">
                Demonstre que você se importa neste Dia dos Namorados
            </h1>

            <p class="text-lg sm:text-xl text-blue-900 mb-6">
                Presenteie quem você ama com cuidado e carinho:
                <strong>São Lucas Telemedicina</strong> oferece
                super descontos exclusivos para você cuidar da saúde de quem é importante.
                Garanta agora um momento de atenção e tranquilidade para o seu par!
                <span class="text-blue-900 font-semibold">Oferta válida até 30/06.</span>
            </p>

            <a
                href="#plans-section"
                class="inline-block bg-pink-500 hover:bg-pink-600 text-white font-semibold px-6 py-3 rounded-full shadow-lg transition"
            >
                Quero o Meu Desconto
                <i class="fa-solid fa-heart-pulse"></i>
            </a>
        </div>

    </section>

    {{-- ========== TELA DE ABOUT ========== --}}
    <section
        id="about-section"
        class="relative w-full bg-white py-20 overflow-hidden"
    >

        {{-- Container centralizado --}}
        <div class="relative z-10 max-w-5xl mx-auto px-4 flex flex-col lg:flex-row items-center gap-12">
            {{-- 1) Coluna da esquerda: imagem ilustrativa --}}
            <div class="w-full lg:w-1/2 flex justify-center">
                {{-- Substitua esta imagem por uma ilustração/coerente com telemedicina --}}
                <img
                    src="{{ asset('images/templates/valentines-day/about.png') }}"
                    alt="Ilustração de telemedicina"
                    class="w-[100%] max-w-sm sm:max-w-lg rounded-lg shadow-2xl"
                >
            </div>

            {{-- 2) Coluna da direita: conteúdo textual --}}
            <div class="w-full lg:w-1/2 text-center lg:text-left">
                {{-- Título principal --}}
                <h2 class="text-3xl sm:text-4xl font-extrabold text-blue-900 mb-6">
                    Sobre a São Lucas Telemedicina
                </h2>

                {{-- Parágrafo introdutório --}}
                <p class="text-lg text-gray-700 mb-6">
                    Na Telemedicina São Lucas, acreditamos que cuidar de quem você ama começa com atenção de qualidade, mesmo à distância. Somos uma equipe multidisciplinar de médicos, enfermeiros e especialistas em tecnologia, unida pelo propósito de levar atendimento humanizado direto para a sua tela.
                </p>

                {{-- Lista de destaques / valores --}}
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 w-6 h-6 text-pink-500 mt-1 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-800">
                            <strong>Atendimento 100% online:</strong> consulta via vídeo com médicos especialistas sem sair de casa.
                        </span>
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 w-6 h-6 text-pink-500 mt-1 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-800">
                            <strong>Equipe especializada:</strong> profissionais capacitados em cardiologia, clínica geral, saúde mental e muito mais.
                        </span>
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 w-6 h-6 text-pink-500 mt-1 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-800">
                            <strong>Atenção personalizada:</strong> um histórico único de cada paciente, garantindo cuidado contínuo e humanizado.
                        </span>
                    </li>
                </ul>

                {{-- Chamada para ação secundária --}}
                <a
                    href="#plans-section"
                    class="inline-block bg-pink-500 hover:bg-pink-600 text-white font-semibold px-6 py-3 rounded-full shadow-lg transition-colors"
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
          linear-gradient(rgba(249,250,251,0.5), rgba(249,250,251,0.7)),
          url('{{ asset('images/backgrounds/bg-itens-health.png') }}');
        background-repeat: repeat;
        background-size: auto;
        background-position: center;
    "
    >
        <div class="relative z-10 max-w-5xl mx-auto px-4 text-center">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-blue-900 mb-4">
                Escolha o Plano Ideal para Você
            </h2>
            <p class="text-lg text-gray-700 mb-12">
                Opções flexíveis e acessíveis para cuidar da saúde de quem você ama.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($plans as $plan)
                    @php
                        // marcar o plano de Dia dos Namorados
                        $isValentine = $plan->slug === 'promocao-dia-dos-namorados';
                    @endphp

                    <div
                        class="bg-white rounded-lg shadow-lg p-6 flex flex-col
                           {{ $isValentine ? 'border-4 border-pink-500 transform scale-105' : '' }}
                           {{ $isValentine ? 'md:col-start-2' : '' }}"
                    >
                        {{-- Título dinâmico --}}
                        <h3 class="text-xl font-semibold text-blue-900 mb-2">
                            {{ $plan->name }}
                        </h3>

                        {{-- Descrição fixa --}}
                        <p class="text-sm text-gray-500 mb-6">
                            Atendimento essencial para acompanhamento geral.
                        </p>

                        {{-- Preço mensal --}}
                        <div class="flex items-baseline justify-center mb-6">
                        <span class="text-4xl font-extrabold text-pink-500">
                            R$ {{ number_format($plan->value / 12, 2, ',', '.') }}
                        </span>
                            <span class="text-gray-500 ml-1 self-end">/mês</span>
                        </div>

                        {{-- Benefícios fixos --}}
                        <ul class="space-y-3 text-left mb-8 flex-1">
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-pink-500 mt-1 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">1 consulta mensal ■</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-pink-500 mt-1 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">Acesso a histórico online</span>
                            </li>
                            <li class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-pink-500 mt-1 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">Suporte via chat 24h</span>
                            </li>
                        </ul>

                        {{-- Botão de contratação --}}
                        @php
                            $referral = request()->route('referral');
                        @endphp

                        <a
                            href="{{ route('subscribe.index', ['plan' => $plan->id, 'referral' => $referral]) }}"
                            class="mt-auto inline-block bg-pink-500 hover:bg-pink-600 text-white font-semibold px-4 py-2 rounded-full shadow transition-colors"
                        >
                            Assinar {{ $plan->name }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    {{-- ========== SEÇÃO DE CONTATO ========== --}}
    <section
        id="contato"
        class="relative w-full bg-white py-20 overflow-hidden"
    >

        {{-- 2) Conteúdo centralizado --}}
        <div class="relative z-10 max-w-5xl mx-auto px-4 flex flex-col lg:flex-row gap-12">
            {{-- 2.1) Coluna esquerda: Formulário de Contato --}}
            <div class="w-full lg:w-1/2 bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-blue-900 mb-6 text-center">
                    Entre em Contato
                </h2>
                <form action="" method="POST" class="space-y-6">
                    @csrf {{-- Proteção CSRF --}}

                    {{-- Campo: Nome --}}
                    <div>
                        <label for="name" class="block text-gray-700 font-semibold mb-2">Seu Nome</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500"
                            placeholder="Digite seu nome completo"
                        >
                    </div>

                    {{-- Campo: E-mail --}}
                    <div>
                        <label for="email" class="block text-gray-700 font-semibold mb-2">E-mail</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500"
                            placeholder="seu@exemplo.com"
                        >
                    </div>

                    {{-- Campo: Telefone --}}
                    <div>
                        <label for="phone" class="block text-gray-700 font-semibold mb-2">Telefone</label>
                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500"
                            placeholder="(XX) XXXXX-XXXX"
                        >
                    </div>

                    {{-- Campo: Mensagem --}}
                    <div>
                        <label for="message" class="block text-gray-700 font-semibold mb-2">Mensagem</label>
                        <textarea
                            id="message"
                            name="message"
                            rows="4"
                            required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-500"
                            placeholder="Escreva aqui sua dúvida ou comentário"
                        ></textarea>
                    </div>

                    {{-- Botão de envio --}}
                    <div class="text-center">
                        <button
                            type="submit"
                            class="bg-pink-500 hover:bg-pink-600 text-white font-semibold px-8 py-3 rounded-full shadow-lg transition-colors"
                        >
                            Enviar Mensagem
                        </button>
                    </div>
                </form>
            </div>

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
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-pink-500 flex-shrink-0 mt-1 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 10c0 4.418 4.03 8 9 8s9-3.582 9-8a9 9 0 10-18 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 12a2 2 0 100-4 2 2 0 000 4z" />
                    </svg>
                    <div>
                        <h3 class="text-lg font-semibold text-blue-900">Endereço</h3>
                        <p class="text-gray-700">
                            Rua das Orquídeas, 123<br>
                            Centro Médico São Lucas – Sala 405<br>
                            Cidade Exemplo, SP – CEP 01234-567
                        </p>
                    </div>
                </div>

                {{-- Item 2: Telefone --}}
                <div class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-pink-500 flex-shrink-0 mt-1 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 5a2 2 0 012-2h3.6a1 1 0 01.96.74l1.2 4.8a1 1 0 01-.27.93L8.9 11.9a11.042 11.042 0 005.2 5.2l1.3-1.6a1 1 0 01.93-.27l4.8 1.2a1 1 0 01.74.96V19a2 2 0 01-2 2h-1C8.373 21 3 15.627 3 9V5z" />
                    </svg>
                    <div>
                        <h3 class="text-lg font-semibold text-blue-900">Telefone</h3>
                        <p class="text-gray-700">
                            Comercial: <a href="tel:+55113157-1878" class="text-pink-500 hover:underline"> (11) 3157-1878</a><br>
                            Suporte: <a href="tel:+55113157-1878" class="text-pink-500 hover:underline"> (11) 3157-1878</a>
                        </p>
                    </div>
                </div>

                {{-- Item 3: E-mail --}}
                <div class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-pink-500 flex-shrink-0 mt-1 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 12H8m8 0L8 8m8 4l-8 4" />
                    </svg>
                    <div>
                        <h3 class="text-lg font-semibold text-blue-900">E-mail</h3>
                        <p class="text-gray-700">
                            Atendimento: <a href="mailto:contato@saolucastelemedicina.com.br" class="text-pink-500 hover:underline">contato@saolucastelemedicina.com.br</a><br>
                            Suporte: <a href="mailto:contato@saolucastelemedicina.com.br" class="text-pink-500 hover:underline">contato@saolucastelemedicina.com.br</a>
                        </p>
                    </div>
                </div>

                {{-- Item 4: Horário de Atendimento --}}
                <div class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-pink-500 flex-shrink-0 mt-1 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4l3 3m6 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h3 class="text-lg font-semibold text-blue-900">Horário</h3>
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

    {{-- ========== TELA DE PERGUNTAS FREQUENTES ========== --}}
    <section
        id="faq-section"
        class="relative w-full bg-gray-50 py-20 overflow-hidden"
        style="
                background-image:
                  linear-gradient(rgba(249, 250, 251, 0.8), rgba(249, 250, 251, 0.7)),
                  url('{{ asset('images/backgrounds/bg-itens-health.png') }}');
                background-repeat: repeat;
                background-size: auto;
                background-position: center; "
    >

        {{-- 2) Conteúdo centralizado --}}
        <div class="relative z-10 max-w-5xl mx-auto px-4">
            {{-- Título da seção --}}
            <h2 class="text-3xl sm:text-4xl font-extrabold text-blue-900 text-center mb-8">
                Perguntas Frequentes
            </h2>

            {{-- Lista de Perguntas e Respostas --}}
            <div class="space-y-8">
                {{-- Pergunta 1 --}}
                <div>
                    <h3 class="text-xl font-semibold text-blue-900 mb-2">
                        <i class="fa-solid fa-circle-question"></i>
                        Como funciona o atendimento por telemedicina?
                    </h3>
                    <p class="text-gray-700">
                        O atendimento por telemedicina ocorre através de uma plataforma online segura,
                        onde você agenda sua consulta, entra em contato com o médico por vídeo ou chat
                        e recebe orientação sem precisar sair de casa. Basta ter acesso à internet
                        (computador, tablet ou celular) e um ambiente reservado para falar com o profissional.
                    </p>
                </div>

                {{-- Pergunta 2 --}}
                <div>
                    <h3 class="text-xl font-semibold text-blue-900 mb-2">
                        <i class="fa-solid fa-circle-question"></i>
                        Quais são as vantagens de contratar um plano de telemedicina?
                    </h3>
                    <p class="text-gray-700">
                        Contratar um plano de telemedicina traz benefícios como:
                    </p>
                    <ul class="list-disc list-inside text-gray-700 mt-2 space-y-2">
                        <li>Economia de tempo e deslocamento, pois não é necessário ir ao consultório.</li>
                        <li>Atendimento rápido em casos de dúvidas simples, evitando urgências desnecessárias.</li>
                        <li>Acesso a profissionais especializados, independente da sua localização geográfica.</li>
                        <li>Histórico de consultas acessível a qualquer momento no ambiente online.</li>
                    </ul>
                </div>

                {{-- Pergunta 3 --}}
                <div>
                    <h3 class="text-xl font-semibold text-blue-900 mb-2">
                        <i class="fa-solid fa-circle-question"></i>
                        Como saber se a telemedicina está disponível na minha cidade?
                    </h3>
                    <p class="text-gray-700">
                        Para verificar cobertura na sua região, acesse nossa página de contato e informe
                        seu CEP ou cidade. Nossa equipe retornará com todas as informações de disponibilidade.
                        Caso o serviço não esteja ativo no momento, você será avisado assim que formos atender
                        sua localidade.
                    </p>
                </div>

                {{-- Pergunta 4 --}}
                <div>
                    <h3 class="text-xl font-semibold text-blue-900 mb-2">
                        <i class="fa-solid fa-circle-question"></i>
                        Posso marcar consulta com qualquer especialidade médica?
                    </h3>
                    <p class="text-gray-700">
                        Sim. Oferecemos diferentes especialidades, como Clínica Geral, Cardiologia, Saúde Mental,
                        Dermatologia, Nutrição e muito mais. Ao contratar seu plano, verifique quais especialidades
                        já estão incluídas e, se desejar, consulte a lista completa de médicos disponíveis
                        na área restrita ao assinante.
                    </p>
                </div>

                {{-- Pergunta 5 --}}
                <div>
                    <h3 class="text-xl font-semibold text-blue-900 mb-2">
                        <i class="fa-solid fa-circle-question"></i>
                        Como recebo receita ou atestado médico?
                    </h3>
                    <p class="text-gray-700">
                        Durante a consulta por telemedicina, caso o médico julgue necessário,
                        ele emitirá receita ou atestado digital. Você receberá o documento em PDF por e-mail
                        ou poderá baixá-lo diretamente na área do assinante. Em alguns casos, a receita
                        poderá ser impressa e apresentada em farmácias físicas ou laboratórios credenciados.
                    </p>
                </div>

                {{-- Pergunta 6 --}}
                <div>
                    <h3 class="text-xl font-semibold text-blue-900 mb-2">
                        <i class="fa-solid fa-circle-question"></i>
                        O que devo fazer em caso de urgência ou emergência?
                    </h3>
                    <p class="text-gray-700">
                        A telemedicina é indicada para consultas eletivas e orientações gerais. Em caso de
                        urgência ou emergência (dor intensa, dificuldade respiratória, sangramento,
                        entre outros), procure imediatamente o serviço de emergência mais próximo
                        (SAMU 192 ou UPA/Hospital). Nosso serviço não substitui atendimento presencial
                        em situações críticas.
                    </p>
                </div>
            </div>
        </div>
    </section>

</div>
