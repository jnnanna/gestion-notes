{{-- gestnotes/resources/views/auth/forgot-password.blade.php --}}
<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Mot de passe oublié — EduSecure</title>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">tailwind.config = {darkMode: 'class', theme:{extend:{colors:{primary:'#135bec','background-light':'#f6f6f8','background-dark':'#101622'},fontFamily:{display:['Lexend','sans-serif']}}}};</script>
    <style>body{font-family:Lexend, sans-serif}</style>
</head>
<body class="bg-background-light dark:bg-background-dark text-[#0d121b] dark:text-white min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md">
        <header class="mb-6 text-center">
            <div class="inline-flex items-center gap-3 justify-center">
                <div class="flex items-center justify-center size-10 rounded-xl bg-primary text-white p-3">
                    <span class="material-symbols-outlined icon-filled text-2xl">security</span>
                </div>
                <div class="flex flex-col">
                    <h1 class="text-2xl font-bold leading-none">EduSecure</h1>
                </div>
            </div>
            <p class="text-sm text-[#4c669a] mt-2">Réinitialisation du mot de passe</p>
        </header>

        <main class="bg-white dark:bg-[#1a202c] rounded-xl border border-[#e7ebf3] dark:border-gray-700 p-6 shadow-sm">
            @if (session('status'))
                <div class="mb-4 p-3 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800">
                    <p class="text-sm text-green-600 dark:text-green-400">{{ session('status') }}</p>
                </div>
            @endif

            <p class="text-sm text-[#4c669a] mb-4">Entrez votre adresse e-mail et nous vous enverrons un lien pour réinitialiser votre mot de passe.</p>

            <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-4">
                @csrf
                
                <label class="text-sm font-medium">Adresse e‑mail</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="votre@exemple.com" required autofocus class="w-full h-12 rounded-lg border border-[#cfd7e7] dark:border-gray-600 bg-[#f8f9fc] dark:bg-gray-800 px-4 focus:outline-none focus:border-primary" />

                <button type="submit" class="mt-2 w-full h-12 rounded-lg bg-primary text-white font-bold hover:bg-blue-700 transition-colors">Envoyer le lien</button>

                <div class="pt-3 text-center text-sm text-[#4c669a]">
                    <a href="{{ route('login') }}" class="text-primary font-medium">Retour à la connexion</a>
                </div>
            </form>
        </main>

        <footer class="mt-4 text-xs text-center text-[#4c669a]">
            <p>Université — Département • © 2025</p>
        </footer>
    </div>
</body>
</html>