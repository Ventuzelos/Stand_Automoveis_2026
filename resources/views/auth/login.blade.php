<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-slate-900">Entrar</h1>
        <p class="mt-2 text-sm text-slate-600">
            Aceda à área de gestão da UrbanMotors.
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Palavra-passe')" />
            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    name="remember"
                >
                <span class="ms-2 text-sm text-gray-600">Manter sessão iniciada</span>
            </label>
        </div>

        <div class="mt-6 space-y-3">
            <x-primary-button class="w-full justify-center">
                {{ __('Entrar') }}
            </x-primary-button>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 text-sm">
                @if (Route::has('password.request'))
                    <a
                        class="text-gray-600 underline hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}"
                    >
                        Esqueceu-se da palavra-passe?
                    </a>
                @endif

                @if (Route::has('register'))
                    <a
                        class="font-semibold text-indigo-600 hover:text-indigo-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('register') }}"
                    >
                        Criar conta
                    </a>
                @endif
            </div>
        </div>
    </form>
</x-guest-layout>
