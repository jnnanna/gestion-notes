<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Créer les permissions
        $permissions = [
            // Gestion académique
            'gerer_departements',
            'gerer_filieres',
            'gerer_modules',
            'gerer_semestres',
            
            // Gestion utilisateurs
            'gerer_utilisateurs',
            'assigner_roles',
            
            // Gestion étudiants
            'gerer_etudiants',
            'voir_etudiants',
            
            // Importation
            'importer_notes',
            'voir_importations',
            
            // Validation
            'valider_notes',
            'modifier_notes',
            'voir_notes',
            
            // Exportation
            'exporter_donnees',
            'generer_rapports',
            
            // Archives
            'archiver_documents',
            'consulter_archives',
            
            // Système
            'voir_logs',
            'configurer_systeme',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Créer les rôles et assigner les permissions

        // 1. Super Admin - Tous les droits
        $superAdmin = Role::create(['name' => 'super-admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // 2. Gestionnaire (Scolarité) - Gestion complète sauf config système
        $gestionnaire = Role::create(['name' => 'gestionnaire']);
        $gestionnaire->givePermissionTo([
            'gerer_departements',
            'gerer_filieres',
            'gerer_modules',
            'gerer_semestres',
            'gerer_etudiants',
            'voir_etudiants',
            'importer_notes',
            'voir_importations',
            'valider_notes',
            'modifier_notes',
            'voir_notes',
            'exporter_donnees',
            'generer_rapports',
            'archiver_documents',
            'consulter_archives',
        ]);

        // 3. Chef de Département
        $chefDepartement = Role::create(['name' => 'chef-departement']);
        $chefDepartement->givePermissionTo([
            'gerer_filieres',
            'gerer_modules',
            'voir_etudiants',
            'voir_importations',
            'valider_notes',
            'voir_notes',
            'exporter_donnees',
            'generer_rapports',
            'consulter_archives',
        ]);

        // 4. Chef de Filière
        $chefFiliere = Role::create(['name' => 'chef-filiere']);
        $chefFiliere->givePermissionTo([
            'gerer_modules',
            'voir_etudiants',
            'voir_importations',
            'valider_notes',
            'voir_notes',
            'exporter_donnees',
            'consulter_archives',
        ]);

        // 5. Responsable Module (Enseignant)
        $enseignant = Role::create(['name' => 'enseignant']);
        $enseignant->givePermissionTo([
            'voir_etudiants',
            'importer_notes',
            'voir_importations',
            'modifier_notes',
            'voir_notes',
            'exporter_donnees',
        ]);

        // 6. Consultation (lecture seule)
        $consultant = Role::create(['name' => 'consultant']);
        $consultant->givePermissionTo([
            'voir_etudiants',
            'voir_importations',
            'voir_notes',
            'consulter_archives',
        ]);
    }
}