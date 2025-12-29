@extends('layouts.guest')

@section('title', 'Connexion')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="text-center">
            <h2 class="text-2xl font-bold text-[#0d121b] dark:text-white">Bienvenue</h2>
            <p class="text-sm text-[#4c669a] dark:text-gray-400 mt-1">
                Connectez-vous à votre espace de gestion
            </p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <x-alert type="success" :dismissible="false">
                {{ session('status') }}
            </x-alert>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <x-input name="email" type="email" label="Adresse Email" placeholder="exemple@university.edu" icon="email" value="{{ old('email') }}" required autofocus />

            <!-- Password -->
            <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                    <label for="password" class="text-sm font-semibold text-[#0d121b] dark:text-white">
                        Mot de passe
                        <span class="text-red-500">*</span>
                    </label>
                    <a href="{{ route('password.request') }}"
                        class="text-xs font-medium text-[#135bec] hover:text-[#0f4bc4] transition-colors">
                        Mot de passe oublié ?
                    </a>
                </div>
                <div class="relative" x-data="{ showPassword: false }">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#4c669a] text-[20px]">lock</span>
                    <input :type="showPassword ? 'text' : 'password'" name="password" id="password" required
                        class="w-full rounded-lg border bg-[#f8f9fc] dark:bg-gray-800 text-sm text-[#0d121b] dark:text-white focus:ring-[#135bec] focus:border-[#135bec] placeholder:text-[#4c669a] pl-10 pr-12 py-2.5 border-[#e7ebf3] dark:border-gray-700"
                        placeholder="••••••••" />
                    <button type="button" @click="showPassword = !showPassword"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-[20px]"
                            x-text="showPassword ? 'visibility_off' : 'visibility'"></span>
                    </button>
                </div>
                @error('password')
                    <p class="text-xs text-red-500 ml-1 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">error</span>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Remember Me -->
            <x-checkbox name="remember" label="Se souvenir de moi" />

            <!-- Submit Button -->
            <div class="pt-2">
                <x-button type="submit" variant="primary" size="lg" class="w-full">
                    Se connecter
                </x-button>
            </div>
        </form>

        <!-- Divider -->
        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-[#e7ebf3] dark:border-gray-700"></div>
            </div>
            <div class="relative flex justify-center text-xs">
                <span class="px-2 bg-white dark:bg-[#1a2234] text-[#4c669a] dark:text-gray-400">
                    Besoin d'aide ?
                </span>
            </div>
        </div>

        <!-- Help Links -->
        <div class="flex items-center justify-center gap-4 text-xs">
            <a href="#"
                class="text-[#4c669a] dark:text-gray-400 hover:text-[#135bec] transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">help</span>
                Support
            </a>
            <span class="text-[#e7ebf3] dark:text-gray-700">|</span>
            <a href="#"
                class="text-[#4c669a] dark:text-gray-400 hover:text-[#135bec] transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">privacy_tip</span>
                Confidentialité
            </a>
        </div>

        <!-- Security Notice -->
        <div class="bg-[#f8f9fc] dark:bg-gray-800/50 rounded-lg p-3 border border-[#e7ebf3] dark:border-gray-700">
            <div class="flex items-start gap-2">
                <span class="material-symbols-outlined text-[#135bec] text-[18px] mt-0.5">shield</span>
                <div class="flex-1">
                    <p class="text-xs font-semibold text-[#0d121b] dark:text-white">Connexion sécurisée</p>
                    <p class="text-xs text-[#4c669a] dark:text-gray-400 mt-0.5">
                        Vos données sont protégées par un chiffrement de bout en bout.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection