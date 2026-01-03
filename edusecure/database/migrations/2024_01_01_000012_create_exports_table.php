<?php

use App\Enums\TypeDocument;
use App\Enums\TypeExport;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('type_document'); // TypeDocument enum
            $table->string('format'); // TypeExport enum
            $table->string('nom_fichier');
            $table->string('chemin');
            $table->json('parametres')->nullable(); // Filtres appliqués
            $table->integer('taille')->nullable(); // en bytes
            $table->integer('nb_telechargementsƒ')->default(0);
            $table->timestamp('expire_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exports');
    }
};