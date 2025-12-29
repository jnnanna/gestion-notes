<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Accès Interdit | EduSecure</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body class="bg-[#f8f9fc] dark:bg-[#0d121b] min-h-screen flex items-center justify-center p-4">
    <div class="max-w-2xl w-full">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-3">
                <div
                    class="size-12 rounded-xl bg-gradient-to-br from-[#135bec] to-blue-600 flex items-center justify-center shadow-lg shadow-blue-500/20">
                    <span class="material-symbols-outlined text-white text-2xl icon-filled">school</span>
                </div>
                <span class="text-2xl font-black text-[#0d121b] dark:text-white">EduSecure</span>
            </a>
        </div>

        {{-- Error Card --}}
        <div
            class="bg-white dark:bg-[#1a2234] rounded-2xl shadow-2xl border border-[#e7ebf3] dark:border-gray-800 overflow-hidden">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-red-500 to-red-600 p-8 text-center">
                <div
                    class="inline-flex items-center justify-center size-24 rounded-full bg-white/20 backdrop-blur-sm mb-4">
                    <span class="material-symbols-outlined text-white" style="font-size: 64px;">block</span>
                </div>
                <h1 class="text-8xl font-black text-white mb-2">403</h1>
                <p class="text-xl text-red-100 font-medium">Accès Interdit</p>
            </div>

            {{-- Content --}}
            <div class="p-8 text-center">
                <p class="text-lg text-[#4c669a] dark:text-gray-400 mb-6">
                    Désolé, vous n'avez pas les permissions nécessaires pour accéder à cette page.
                </p>

                {{-- Info Box --}}
                <div
                    class="bg-red-50 dark:bg-red-900/10 rounded-xl p-6 mb-8 border border-red-100 dark:border-red-900/20">
                    <div class="flex items-start gap-3 text-left">
                        <span class="material-symbols-outlined text-red-600 text-xl mt-0.5">info</span>
                        <div>
                            <p class="text-sm font-semibold text-red-900 dark:text-red-300 mb-2">Pourquoi suis-je bloqué?
                            </p>
                            <ul class="text-sm text-red-700 dark:text-red-400 space-y-2">
                                <li class="flex items-start gap-2">
                                    <span class="material-symbols-outlined text-[16px] mt-0.5">chevron_right</span>
                                    <span>Votre rôle ne vous donne pas accès à cette ressource</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="material-symbols-outlined text-[16px] mt-0.5">chevron_right</span>
                                    <span>Cette section est réservée aux administrateurs</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="material-symbols-outlined text-[16px] mt-0.5">chevron_right</span>
                                    <span>Vous n'êtes peut-être pas autorisé à effectuer cette action</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-[#135bec] text-white text-sm font-bold rounded-lg hover:bg-[#0f4bc4] transition-all shadow-lg shadow-blue-500/30">
                        <span class="material-symbols-outlined">home</span>
                        Retour à l'Accueil
                    </a>

                    <button onclick="window.history.back()"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 border-2 border-[#e7ebf3] dark:border-gray-700 text-[#4c669a] dark:text-gray-400 text-sm font-bold rounded-lg hover:bg-[#f8f9fc] dark:hover:bg-gray-800 transition-all">
                        <span class="material-symbols-outlined">arrow_back</span>
                        Page Précédente
                    </button>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="text-center mt-8">
            <p class="text-sm text-[#4c669a] dark:text-gray-400">
                Vous pensez qu'il s'agit d'une erreur?
                <a href="mailto:support@edusecure.ma" class="text-[#135bec] hover:underline font-medium">Contactez
                    l'administrateur</a>
            </p>
        </div>
    </div>

    {{-- Dark Mode Toggle --}}
    <button onclick="document.documentElement.classList.toggle('dark')"
        class="fixed bottom-6 right-6 size-12 rounded-full bg-white dark:bg-[#1a2234] border border-[#e7ebf3] dark:border-gray-800 shadow-lg flex items-center justify-center text-[#4c669a] hover:text-[#135bec] transition">
        <span class="material-symbols-outlined">dark_mode</span>
    </button>
</body>

</html>