<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('annee_academique_id')->constrained('annees_academiques')->cascadeOnDelete();
            $table->foreignId('feuille_note_id')->nullable()->constrained('feuilles_notes')->nullOnDelete();
            $table->string('type'); // feuille_note, export, document
            $table->string('nom');
            $table->string('chemin');
            $table->json('metadata')->nullable();
            $table->foreignId('archive_par')->constrained('users')->cascadeOnDelete();
            $table->timestamps();

            // Index pour recherche
            $table->index(['annee_academique_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};