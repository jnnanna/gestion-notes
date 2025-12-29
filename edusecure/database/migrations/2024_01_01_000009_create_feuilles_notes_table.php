<?php

use App\Enums\StatutFeuilleNote;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema:: create('feuilles_notes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('module_id')->constrained()->cascadeOnDelete();
            $table->foreignId('importation_id')->nullable()->constrained()->nullOnDelete();
            
            // ✅ CORRECTION ICI :  Utiliser le bon nom de table
            $table->foreignId('fichier_importe_id')
                ->nullable()
                ->constrained('fichiers_importes')  // ✅ Avec 's' (pluriel)
                ->nullOnDelete();
            
            $table->foreignId('enseignant_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('annee_academique_id')->nullable()->constrained('annees_academiques')->nullOnDelete();
            $table->string('statut')->default(StatutFeuilleNote:: BROUILLON->value);
            $table->date('date_examen')->nullable();
            $table->string('type_evaluation')->nullable();
            $table->text('remarques')->nullable();
            $table->timestamp('soumis_at')->nullable();
            $table->timestamp('valide_at')->nullable();
            $table->foreignId('validateur_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('verrouille_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feuilles_notes');
    }
};