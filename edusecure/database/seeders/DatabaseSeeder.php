<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database. 
     */
    public function run(): void
    {
        $this->call([
            // 1. Rôles et Permissions (PREMIER)
            RolePermissionSeeder::class,
            
            // 2. Utilisateurs (avec rôles)
            AdminUserSeeder::class,
            
            // 3. Structure académique de base
            SemestreSeeder::class,
            AnneeAcademiqueSeeder::class,
            DepartementSeeder::class,
            
            // 4. Filières et Modules
            FiliereSeeder::class,
            ModuleSeeder::class,
            
            // 5. Étudiants
            EtudiantSeeder::class,
        ]);
    }
}