<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('nom');
            $table->text('description')->nullable();
            $table->foreignId('filiere_id')->constrained()->cascadeOnDelete();
            $table->foreignId('semestre_id')->constrained()->cascadeOnDelete();
            $table->foreignId('responsable_id')->nullable()->constrained('users')->nullOnDelete();
            $table->integer('coefficient')->default(1);
            $table->decimal('credit_ects', 4, 2)->default(0);
            $table->boolean('actif')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};