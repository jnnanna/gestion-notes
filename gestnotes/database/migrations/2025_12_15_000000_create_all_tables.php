<?php
// gestnotes/database/migrations/2025_12_15_000000_create_all_tables.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Roles
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->json('permissions')->nullable();
            $table->timestamps();
        });

        // 2. Departments
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->timestamps();
        });

        // 3. Update Users table (APRÈS roles et departments)
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->after('id');
            $table->string('last_name')->after('first_name');
            $table->string('phone')->nullable()->after('email');
            $table->foreignId('department_id')->nullable()->after('phone')->constrained()->nullOnDelete();
            $table->foreignId('role_id')->default(1)->after('department_id')->constrained();
            $table->string('avatar')->nullable()->after('password');
            $table->boolean('2fa_enabled')->default(false)->after('avatar');
            $table->dropColumn('name');
        });

        // 4. Filieres
        Schema::create('filieres', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->string('level');
            $table->timestamps();
        });

        // 5. Modules
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->foreignId('filiere_id')->constrained()->cascadeOnDelete();
            $table->string('semester');
            $table->integer('coefficient')->default(1);
            $table->integer('ects')->default(0);
            $table->foreignId('responsible_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status', ['active', 'pending', 'archived'])->default('active');
            $table->timestamps();
        });

        // 6. Students
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->foreignId('filiere_id')->constrained()->cascadeOnDelete();
            $table->year('promotion_year');
            $table->string('group')->nullable();
            $table->timestamps();
        });

        // 7. Scanned Documents
        Schema::create('scanned_documents', function (Blueprint $table) {
            $table->id();
            $table->string('file_path');
            $table->string('file_type');
            $table->unsignedBigInteger('file_size');
            $table->foreignId('module_id')->constrained()->cascadeOnDelete();
            $table->date('exam_date');
            $table->foreignId('uploaded_by_user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('ocr_status', ['pending', 'processing', 'completed', 'failed'])->default('pending');
            $table->timestamps();
        });

        // 8. Grades
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('module_id')->constrained()->cascadeOnDelete();
            $table->decimal('exam_grade', 5, 2)->nullable();
            $table->decimal('cc_grade', 5, 2)->nullable();
            $table->decimal('final_grade', 5, 2)->nullable();
            $table->enum('status', ['pending', 'validated', 'rejected'])->default('pending');
            $table->foreignId('validated_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('validated_at')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();
            
            $table->unique(['student_id', 'module_id']);
        });

        // 9. Exports
        Schema::create('exports', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['releve', 'jury', 'list', 'raw']);
            $table->enum('format', ['pdf', 'xlsx', 'csv']);
            $table->json('filters')->nullable();
            $table->string('file_path')->nullable();
            $table->foreignId('generated_by_user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });

        // 10. Activity Logs
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('action');
            $table->string('entity_type')->nullable();
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->json('changes')->nullable();
            $table->timestamps();
            
            $table->index(['entity_type', 'entity_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('exports');
        Schema::dropIfExists('grades');
        Schema::dropIfExists('scanned_documents');
        Schema::dropIfExists('students');
        Schema::dropIfExists('modules');
        Schema::dropIfExists('filieres');
        
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->dropForeign(['department_id']);
            $table->dropForeign(['role_id']);
            $table->dropColumn([
                'first_name',
                'last_name',
                'phone',
                'department_id',
                'role_id',
                'avatar',
                '2fa_enabled'
            ]);
        });
        
        Schema::dropIfExists('departments');
        Schema::dropIfExists('roles');
    }
};