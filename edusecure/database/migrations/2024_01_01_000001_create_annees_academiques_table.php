<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema:: create('annees_academiques', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique(); // Ex: 2023-2024
            $table->string('libelle');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->boolean('actif')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('annees_academiques');
    }
};