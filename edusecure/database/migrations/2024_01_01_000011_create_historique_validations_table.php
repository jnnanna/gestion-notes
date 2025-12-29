<?php

use App\Enums\TypeAction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historique_validations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feuille_note_id')->nullable()->constrained('feuilles_notes')->cascadeOnDelete();
            $table->foreignId('note_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('action'); // TypeAction enum
            $table->text('description')->nullable();
            $table->json('valeur_avant')->nullable();
            $table->json('valeur_apres')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();

            // Index pour performance
            $table->index(['feuille_note_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historique_validations');
    }
};