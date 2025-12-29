<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('telephone')->nullable()->after('email');
            $table->foreignId('departement_id')->nullable()->after('telephone')->constrained()->nullOnDelete();
            $table->string('avatar_url')->nullable()->after('departement_id');
            $table->boolean('actif')->default(true)->after('avatar_url');
            $table->boolean('two_factor_enabled')->default(false)->after('actif');
            $table->timestamp('last_login_at')->nullable()->after('two_factor_enabled');
            $table->string('last_login_ip')->nullable()->after('last_login_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['departement_id']);
            $table->dropColumn([
                'telephone',
                'departement_id',
                'avatar_url',
                'actif',
                'two_factor_enabled',
                'last_login_at',
                'last_login_ip',
            ]);
        });
    }
};