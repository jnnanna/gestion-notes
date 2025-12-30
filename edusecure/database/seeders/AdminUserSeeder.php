<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@edusecure.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'telephone' => '+212 6 00 00 00 00',
            'actif' => true,
        ]);
        $superAdmin->assignRole('super-admin');

        // Gestionnaire (Scolarité)
        $gestionnaire = User:: create([
            'name' => 'Jean Dupont',
            'email' => 'gestionnaire@edusecure.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'telephone' => '+212 6 11 11 11 11',
            'actif' => true,
        ]);
        $gestionnaire->assignRole('gestionnaire');

        // Chef Département Informatique
        $chefDept = User::create([
            'name' => 'Pr.  Ahmed Benali',
            'email' => 'a.benali@edusecure.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'telephone' => '+212 6 22 22 22 22',
            'actif' => true,
        ]);
        $chefDept->assignRole('chef-departement');

        // Chef Filière
        $chefFiliere = User::create([
            'name' => 'Dr. Marie Dubois',
            'email' => 'm.dubois@edusecure.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'telephone' => '+212 6 33 33 33 33',
            'actif' => true,
        ]);
        $chefFiliere->assignRole('chef-filiere');

        // Enseignants
        $enseignants = [
            ['name' => 'Pr.  Mansouri Ahmed', 'email' => 'mansouri@edusecure.com'],
            ['name' => 'Dr. Sarah Martin', 'email' => 's.martin@edusecure. com'],
            ['name' => 'Pr. Karim El Amrani', 'email' => 'k.amrani@edusecure.com'],
            ['name' => 'Dr.  Fatima Zahra', 'email' => 'f.zahra@edusecure.com'],
            ['name' => 'Pr. Hassan Idrissi', 'email' => 'h.idrissi@edusecure.com'],
        ];

        foreach ($enseignants as $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'telephone' => '+212 6 ' .  rand(10, 99) . ' ' . rand(10, 99) . ' ' . rand(10, 99) . ' ' . rand(10, 99),
                'actif' => true,
            ]);
            $user->assignRole('enseignant');
        }
    }
}