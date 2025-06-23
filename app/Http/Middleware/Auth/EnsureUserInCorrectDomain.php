<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserInCorrectDomain
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (! $user) {
            Log::warning('Usuário não autenticado tentando acessar: ' . $request->path());
            abort(403);
        }

        $routeName = Route::currentRouteName(); // Exemplo: clients.dashboard
        $binding = $user->getRoleBinding();     // Exemplo: white_label

        Log::info('Middleware check - User: ' . $user->id . ' | Binding: ' . $binding . ' | Route: ' . $routeName);

        // Regras de acesso por domínio
        if (
            ($binding === 'client' && !str_starts_with($routeName, 'clients.')) ||
            ($binding === 'white_label' && !str_starts_with($routeName, 'white_labels.')) ||
            ($binding === 'sub_acquirer' && !str_starts_with($routeName, 'sub_acquirers.')) ||
            ($binding === null && !str_starts_with($routeName, 'admin.'))
        ) {
            Log::warning("Acesso bloqueado - User $user->id tentou acessar $routeName fora do domínio $binding");
            return response()->view('fallbacks.invalid-access', [
                'binding' => $binding,
            ]);
        }

        Log::info("Acesso liberado - User $user->id para rota $routeName");
        return $next($request);
    }
}
