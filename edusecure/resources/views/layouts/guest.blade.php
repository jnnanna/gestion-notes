<! DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'EduSecure') }} - @yield('title', 'Authentification')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">
        <link
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
            rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            }

            .icon-filled {
                font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            }
        </style>

        @stack('styles')
    </head>

    <body class="bg-[#f6f6f8] dark:bg-[#101622] font-[Lexend] antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <!-- Logo -->
            <div class="flex items-center gap-3 mb-8">
                <div class="flex items-center justify-center size-12 rounded-xl bg-[#135bec] text-white">
                    <span class="material-symbols-outlined icon-filled text-3xl">security</span>
                </div>
                <div class="flex flex-col">
                    <h1 class="text-2xl font-bold leading-none tracking-tight text-[#0d121b] dark: text-white">EduSecure
                    </h1>
                    <p class="text-[#4c669a] dark:text-gray-400 text-sm font-normal mt-1">Gestion des Notes</p>
                </div>
            </div>

            <!-- Card Container -->
            <div
                class="w-full sm:max-w-md px-6 py-8 bg-white dark:bg-[#1a2234] shadow-lg rounded-xl border border-[#e7ebf3] dark:border-gray-800">
                @yield('content')
            </div>

            <!-- Footer -->
            <div class="mt-6 text-center">
                <p class="text-sm text-[#4c669a] dark: text-gray-400">
                    &copy; {{ date('Y') }} EduSecure. Tous droits réservés.
                </p>
            </div>
        </div>

        @stack('scripts')
    </body>

    </html>