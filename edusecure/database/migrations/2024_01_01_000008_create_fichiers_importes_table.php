<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fichiers_importes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('importation_id')->constrained()->cascadeOnDelete();
            $table->string('nom_original');
            $table->string('nom_stockage');
            $table->string('chemin');
            $table->string('type_mime');
            $table->integer('taille'); // en bytes
            $table->boolean('ocr_traite')->default(false);
            $table->text('ocr_resultat')->nullable();
            $table->decimal('ocr_confiance', 5, 2)->nullable(); // 0-100%
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fichiers_importes');
    }
};