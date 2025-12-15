<?php
// gestnotes/database/seeders/RoleSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Administrateur',
                'slug' => 'admin',
                'description' => 'Accès complet au système',
                'permissions' => json_encode([
                    'scan_documents',
                    'edit_grades',
                    'validate_grades',
                    'manage_modules',
                    'manage_users',
                    'export_data',
                    'view_logs'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chef de Département',
                'slug' => 'chef-departement',
                'description' => 'Gestion du département',
                'permissions' => json_encode([
                    'scan_documents',
                    'edit_grades',
                    'validate_grades',
                    'manage_modules',
                    'export_data',
                    'view_logs'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Responsable Module',
                'slug' => 'responsable-module',
                'description' => 'Gestion des modules assignés',
                'permissions' => json_encode([
                    'edit_grades',
                    'validate_grades',
                    'export_data'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Enseignant',
                'slug' => 'enseignant',
                'description' => 'Consultation des notes',
                'permissions' => json_encode([
                    'view_grades'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}
