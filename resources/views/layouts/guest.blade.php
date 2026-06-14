<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>UrbanMotors</title>

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900">
    <div class="min-h-screen bg-slate-950 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-slate-900 to-blue-950"></div>
        <div class="absolute inset-0 bg-black/20"></div>

        <div class="relative z-10 min-h-screen flex items-center justify-center px-4 py-10">
            <div class="w-full max-w-6xl grid lg:grid-cols-2 gap-10 items-center">
                <div class="hidden lg:block text-white">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-3 mb-6 no-underline text-white">
                        <img src="{{ asset('favicon.png') }}" alt="Logo" class="rounded-full bg-white p-1" width="45" height="45">
                        <span class="text-2xl font-bold">UrbanMotors</span>
                    </a>

                    <h1 class="mt-6 text-5xl font-bold leading-tight">
                        Entre na área reservada do seu stand.
                    </h1>

                    <p class="mt-4 max-w-xl text-lg text-slate-300 leading-8">
                        Faça login para gerir clientes, viaturas e vendas com uma interface moderna,
                        rápida e preparada para o dia a dia da UrbanMotors.
                    </p>

                    <div class="mt-8 flex flex-wrap gap-4 text-sm text-slate-300">
                        <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 backdrop-blur">
                            Gestão de clientes
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 backdrop-blur">
                            Controlo de viaturas
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 backdrop-blur">
                            Registo de vendas
                        </div>
                    </div>
                </div>

                <div class="w-full max-w-md mx-auto">
                    <div class="mb-6 text-center lg:hidden">
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-3 no-underline text-white">
                            <img src="{{ asset('favicon.png') }}" alt="Logo" class="rounded-full bg-white p-1" width="45" height="45">
                            <span class="text-2xl font-bold">UrbanMotors</span>
                        </a>
                    </div>

                    <div class="rounded-3xl bg-white shadow-2xl border border-slate-200 px-6 py-8 sm:px-8">
                        {{ $slot }}
                    </div>

                    <div class="mt-4 text-center">
                        <a href="{{ route('home') }}" class="text-sm text-slate-300 hover:text-white transition">
                            Voltar ao site
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
