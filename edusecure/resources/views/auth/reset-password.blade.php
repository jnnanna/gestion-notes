@extends('layouts.guest')

@section('title', 'Réinitialisation du mot de passe')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="text-center">
            <div
                class="inline-flex items-center justify-center size-12 rounded-full bg-green-50 dark:bg-green-900/20 text-green-600 mb-4">
                <span class="material-symbols-outlined text-2xl">lock_open</span>
            </div>
            <h2 class="text-2xl font-bold text-[#0d121b] dark:text-white">Nouveau mot de passe</h2>
            <p class="text-sm text-[#4c669a] dark:text-gray-400 mt-2">
                Choisissez un mot de passe fort pour sécuriser votre compte
            </p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <x-input name="email" type="email" label="Adresse Email" placeholder="exemple@university.edu" icon="email" :
                value="old('email', $request->email)" required readonly />

            <!-- Password -->
            <div class="space-y-1.5">
                <label for="password" class="text-sm font-semibold text-[#0d121b] dark: text-white">
                    Nouveau mot de passe
                    <span class="text-red-500">*</span>
                </label>
                <div class="relative" x-data="{ showPassword: false }">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#4c669a] text-[20px]">lock</span>
                    <input :type="showPassword ?  'text' : 'password'" name="password" id="password" required
                        class="w-full rounded-lg border bg-[#f8f9fc] dark: bg-gray-800 text-sm text-[#0d121b] dark:text-white focus:ring-[#135bec] focus:border-[#135bec] placeholder:text-[#4c669a] pl-10 pr-12 py-2.5 border-[#e7ebf3] dark: border-gray-700"
                        placeholder="Minimum 8 caractères" />
                    <button type="button" @click="showPassword = !showPassword"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-[#4c669a] hover:text-[#0d121b] dark: hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-[20px]"
                            x-text="showPassword ? 'visibility_off' :  'visibility'"></span>
                    </button>
                </div>
                <p class="text-xs text-[#4c669a] dark: text-gray-400 ml-1">
                    Utilisez au moins 8 caractères avec des lettres, chiffres et symboles
                </p>
                @error('password')
                    <p class="text-xs text-red-500 ml-1 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">error</span>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="space-y-1.5">
                <label for="password_confirmation" class="text-sm font-semibold text-[#0d121b] dark:text-white">
                    Confirmer le mot de passe
                    <span class="text-red-500">*</span>
                </label>
                <div class="relative" x-data="{ showConfirmPassword: false }">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#4c669a] text-[20px]">lock</span>
                    <input :type="showConfirmPassword ?  'text' : 'password'" name="password_confirmation"
                        id="password_confirmation" required
                        class="w-full rounded-lg border bg-[#f8f9fc] dark:bg-gray-800 text-sm text-sm text-[#0d121b] dark:text-white focus:ring-[#135bec] focus:border-[#135bec] placeholder:text-[#4c669a] pl-10 pr-12 py-2.5 border-[#e7ebf3] dark:border-gray-700"
                        placeholder="Confirmez votre mot de passe" />
                    <button type="button" @click="showConfirmPassword = !showConfirmPassword"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-[#4c669a] hover:text-[#0d121b] dark:hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-[20px]"
                            x-text="showConfirmPassword ? 'visibility_off' : 'visibility'"></span>
                    </button>
                </div>
                @error('password_confirmation')
                    <p class="text-xs text-red-500 ml-1 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">error</span>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password Strength Indicator -->
            <div class="bg-[#f8f9fc] dark:bg-gray-800/50 rounded-lg p-3 border border-[#e7ebf3] dark:border-gray-700">
                <p class="text-xs font-semibold text-[#0d121b] dark:text-white mb-2">Critères de sécurité :</p>
                <ul class="space-y-1 text-xs text-[#4c669a] dark:text-gray-400">
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[14px] text-gray-400">check_circle</span>
                        Au moins 8 caractères
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[14px] text-gray-400">check_circle</span>
                        Une lettre majuscule
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[14px] text-gray-400">check_circle</span>
                        Un chiffre
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[14px] text-gray-400">check_circle</span>
                        Un caractère spécial (@, #, $, etc.)
                    </li>
                </ul>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <x-button type="submit" variant="primary" size="lg" icon="check" class="w-full">
                    Réinitialiser le mot de passe
                </x-button>
            </div>
        </form>

        <!-- Back to Login -->
        <div class="text-center pt-2">
            <a href="{{ route('login') }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-[#4c669a] dark:text-gray-400 hover:text-[#135bec] transition-colors">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Retour à la connexion
            </a>
        </div>
    </div>
@endsection