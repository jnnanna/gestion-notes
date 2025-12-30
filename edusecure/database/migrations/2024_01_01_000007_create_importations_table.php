<?php

use App\Enums\StatutImportation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('importations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('annee_academique_id')->nullable()->constrained('annees_academiques')->nullOnDelete();
            $table->foreignId('module_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('filiere_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('semestre_id')->nullable()->constrained()->nullOnDelete();
            $table->string('statut')->default(StatutImportation::EN_COURS->value);
            $table->integer('fichiers_total')->default(0);
            $table->integer('fichiers_traites')->default(0);
            $table->integer('fichiers_echoues')->default(0);
            $table->text('notes')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('importations');
    }
};