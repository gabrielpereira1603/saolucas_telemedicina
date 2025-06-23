<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Acesso Negado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center px-4">
<div class="text-center">
    <div class="text-6xl mb-4">😢</div>
    <h1 class="text-2xl font-semibold text-gray-700 mb-2">Acesso negado</h1>
    <p class="text-gray-500 mb-6">Você não tem permissão para acessar esta área.</p>

    @php
        $route = match($binding) {
            'client' => route('clients.dashboard'),
            'white_label' => route('white_labels.dashboard'),
            'sub_acquirer' => route('sub_acquirers.dashboard'),
            default => route('dashboard'),
        };
    @endphp

    <a href="{{ $route }}"
       class="inline-block bg-[#1C398E] text-white px-6 py-2 rounded-md shadow hover:bg-[#172f72] transition">
        Ir para minha área
    </a>
</div>
</body>
</html>
