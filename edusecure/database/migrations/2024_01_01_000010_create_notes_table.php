<?php

use App\Enums\StatutNote;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('module_id')->constrained()->cascadeOnDelete();
            $table->foreignId('feuille_note_id')->nullable()->constrained('feuilles_notes')->nullOnDelete();
            $table->decimal('note_examen', 5, 2)->nullable();
            $table->decimal('note_cc', 5, 2)->nullable(); // Contrôle Continu
            $table->decimal('note_tp', 5, 2)->nullable();
            $table->decimal('moyenne', 5, 2)->nullable();
            $table->string('statut')->default(StatutNote::EN_ATTENTE->value);
            $table->text('commentaire')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Index pour performance
            $table->index(['etudiant_id', 'module_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};