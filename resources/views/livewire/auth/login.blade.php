<?php

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string')]
    public string $cpf_cnpj = '';


    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        // Remove qualquer formatação do CPF/CNPJ
        $cpfCnpj = preg_replace('/\D+/', '', $this->cpf_cnpj);

        $user = User::where('cpf_cnpj', $cpfCnpj)
            ->where(function ($query) {
                $query->whereHas('client')
                    ->orWhereHas('subAcquirer')
                    ->orWhereHas('whiteLabel');
            })
            ->first();

        if (!$user || !Auth::attempt(['id' => $user->id, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'cpf_cnpj' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $binding = $user->getRoleBinding();

        $route = match ($binding) {
            'sub_acquirer' => route('sub_acquirers.dashboard'),
            'client'       => route('clients.dashboard'),
            'white_label'  => route('white_labels.dashboard'),
            default        => route('dashboard'),
        };

        $this->redirectIntended(default: $route, navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->cpf_cnpj) . '|' . request()->ip());
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Entre na sua conta')"
                   :description="__('Digite seu e-mail e senha abaixo para fazer login')"/>

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')"/>

    <form wire:submit="login" class="flex flex-col gap-6 bg-">
        <!-- Email Address -->
        <flux:input
            wire:model="cpf_cnpj"
            :label="__('CPF ou CNPJ')"
            required
            autofocus
            autocomplete="username"
            placeholder="Digite seu CPF ou CNPJ"
        />

        <!-- Password -->
        <div class="relative">
            <flux:input
                wire:model="password"
                :label="__('Password')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('Password')"
                viewable
            />

            @if (Route::has('password.request'))
                <flux:link class="absolute end-0 top-0 text-sm" :href="route('password.request')" wire:navigate>
                    {{ __('Forgot your password?') }}
                </flux:link>
            @endif
        </div>

        <!-- Remember Me -->
        <flux:checkbox wire:model="remember" :label="__('Remember me')"/>

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full">{{ __('Log in') }}</flux:button>
        </div>
    </form>


    {{--    @if (Route::has('register'))
            <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
                {{ __('Don\'t have an account?') }}
                <flux:link :href="route('register')" wire:navigate>{{ __('Sign up') }}</flux:link>
            </div>
        @endif--}}
    @php
        $status = request()->route('status');
    @endphp

    @if($status === 'success' || $status === 'pending')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Pedido Recebido!',
                    text: 'As instruções para acompanhar sua compra foram enviadas para seu e-mail cadastrado.',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#1c398e'
                });
            });
        </script>
    @elseif($status === 'error' || $status === 'failure')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Algo deu errado!',
                    text: 'Houve um problema ao processar sua compra. Por favor, aguarde um momento e tente novamente. Qualquer dúvida, entre em contato conosco.',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#1c398e'
                });
            });
        </script>
    @endif

</div>
