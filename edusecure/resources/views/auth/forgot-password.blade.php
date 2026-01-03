@extends('layouts.guest')

@section('title', 'Mot de passe oublié')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="text-center">
            <div class="inline-flex items-center justify-center size-12 rounded-full bg-[#135bec]/10 text-[#135bec] mb-4">
                <span class="material-symbols-outlined text-2xl">lock_reset</span>
            </div>
            <h2 class="text-2xl font-bold text-[#0d121b] dark:text-white">Mot de passe oublié ? </h2>
            <p class="text-sm text-[#4c669a] dark:text-gray-400 mt-2 max-w-sm mx-auto">
                Pas de problème. Indiquez-nous votre adresse email et nous vous enverrons un lien de réinitialisation.
            </p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <x-alert type="success" :dismissible="false">
                <p class="text-sm font-semibold text-green-700 dark:text-green-400">Email envoyé ! </p>
                <p class="text-sm text-green-600 dark:text-green-400 mt-1">{{ session('status') }}</p>
            </x-alert>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <x-input name="email" type="email" label="Adresse Email" placeholder="exemple@university.edu" icon="email"
                :value="old('email')" helper="Entrez l'adresse email associée à votre compte" required autofocus />

            <!-- Submit Button -->
            <div class="pt-2 space-y-3">
                <x-button type="submit" variant="primary" size="lg" icon="send" class="w-full">
                    Envoyer le lien de réinitialisation
                </x-button>

                <!-- Back to Login -->
                <a href="{{ route('login') }}"
                    class="flex items-center justify-center gap-2 text-sm font-medium text-[#4c669a] dark:text-gray-400 hover:text-[#135bec] transition-colors">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Retour à la connexion
                </a>
            </div>
        </form>

        <!-- Information Card -->
        <div class="bg-blue-50 dark:bg-blue-900/10 rounded-lg p-4 border border-blue-100 dark:border-blue-900/20">
            <div class="flex items-start gap-3">
                <span class="material-symbols-outlined text-blue-600 text-[20px] mt-0.5">info</span>
                <div>
                    <p class="text-sm font-semibold text-blue-900 dark:text-blue-300">Vérifiez votre boîte de réception</p>
                    <p class="text-xs text-blue-700 dark:text-blue-400 mt-1">
                        Le lien de réinitialisation sera envoyé à l'adresse email si un compte existe.
                        Le lien est valable pendant 60 minutes.
                    </p>
                </div>
            </div>
        </div>

        <!-- Contact Support -->
        <div class="text-center pt-2">
            <p class="text-xs text-[#4c669a] dark:text-gray-400">
                Vous n'avez pas reçu d'email ? Vérifiez vos spams ou
                <a href="#" class="text-[#135bec] hover:text-[#0f4bc4] font-medium transition-colors">contactez le
                    support</a>
            </p>
        </div>
    </div>
@endsection