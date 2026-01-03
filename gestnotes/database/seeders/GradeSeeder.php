<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            [
                'student_id' => 1, // Alice Lemoine
                'module_id' => 4, // Algorithmique Avancée
                'exam_grade' => 14.50,
                'cc_grade' => 12.00,
                'final_grade' => 13.25,
                'status' => 'pending',
                'validated_by_user_id' => null,
                'validated_at' => null,
                'comments' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 2, // Bastien Girard
                'module_id' => 4,
                'exam_grade' => 8.00,
                'cc_grade' => 10.50,
                'final_grade' => 9.25,
                'status' => 'pending',
                'validated_by_user_id' => null,
                'validated_at' => null,
                'comments' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 3, // Chloé Rousseau
                'module_id' => 4,
                'exam_grade' => 16.00,
                'cc_grade' => 15.50,
                'final_grade' => 15.75,
                'status' => 'validated',
                'validated_by_user_id' => 1,
                'validated_at' => now(),
                'comments' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 4, // Jean Dupont (pour l'export)
                'module_id' => 4, // INF301
                'exam_grade' => 14.50,
                'cc_grade' => null,
                'final_grade' => 14.50,
                'status' => 'validated',
                'validated_by_user_id' => 1,
                'validated_at' => now(),
                'comments' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 4,
                'module_id' => 5, // INF302
                'exam_grade' => 16.00,
                'cc_grade' => null,
                'final_grade' => 16.00,
                'status' => 'validated',
                'validated_by_user_id' => 1,
                'validated_at' => now(),
                'comments' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 4,
                'module_id' => 6, // MAT205
                'exam_grade' => 10.25,
                'cc_grade' => null,
                'final_grade' => 10.25,
                'status' => 'validated',
                'validated_by_user_id' => 1,
                'validated_at' => now(),
                'comments' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 4,
                'module_id' => 7, // ANG101
                'exam_grade' => 15.00,
                'cc_grade' => null,
                'final_grade' => 15.00,
                'status' => 'validated',
                'validated_by_user_id' => 1,
                'validated_at' => now(),
                'comments' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 4,
                'module_id' => 8, // PROJ30
                'exam_grade' => 17.50,
                'cc_grade' => null,
                'final_grade' => 17.50,
                'status' => 'validated',
                'validated_by_user_id' => 1,
                'validated_at' => now(),
                'comments' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('grades')->insert($grades);
    }
}
