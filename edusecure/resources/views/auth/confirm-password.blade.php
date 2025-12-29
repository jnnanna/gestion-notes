@extends('layouts.guest')

@section('title', 'Confirmation du mot de passe')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="text-center">
            <div
                class="inline-flex items-center justify-center size-12 rounded-full bg-orange-50 dark:bg-orange-900/20 text-orange-600 mb-4">
                <span class="material-symbols-outlined text-2xl">verified_user</span>
            </div>
            <h2 class="text-2xl font-bold text-[#0d121b] dark:text-white">Zone sécurisée</h2>
            <p class="text-sm text-[#4c669a] dark:text-gray-400 mt-2 max-w-sm mx-auto">
                Pour continuer, veuillez confirmer votre mot de passe.
            </p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
            @csrf

            <!-- Password -->
            <div class="space-y-1.5">
                <label for="password" class="text-sm font-semibold text-[#0d121b] dark:text-white">
                    Mot de passe
                    <span class="text-red-500">*</span>
                </label>
                <div class="relative" x-data="{ showPassword: false }">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#4c669a] text-[20px]">lock</span>
                    <input :type="showPassword ? 'text' : 'password'" name="password" id="password" required autofocus
                        class="w-full rounded-lg border bg-[#f8f9fc] dark:bg-gray-800 text-sm text-[#0d121b] dark:text-white focus:ring-[#135bec] focus:border-[#135bec] placeholder:text-[#4c669a] pl-10 pr-12 py-2.5 border-[#e7ebf3] dark:border-gray-700"
                        placeholder="Entrez votre mot de passe" />
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

            <!-- Submit Button -->
            <div class="pt-2">
                <x-button type="submit" variant="primary" size="lg" icon="lock_open" class="w-full">
                    Confirmer
                </x-button>
            </div>
        </form>

        <!-- Security Notice -->
        <div class="bg-[#f8f9fc] dark:bg-gray-800/50 rounded-lg p-3 border border-[#e7ebf3] dark:border-gray-700">
            <div class="flex items-start gap-2">
                <span class="material-symbols-outlined text-[#135bec] text-[18px] mt-0.5">info</span>
                <p class="text-xs text-[#4c669a] dark:text-gray-400">
                    Cette action nécessite une confirmation de votre identité pour des raisons de sécurité.
                </p>
            </div>
        </div>
    </div>
@endsection