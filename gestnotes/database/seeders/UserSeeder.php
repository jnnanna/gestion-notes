<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'Martin',
                'last_name' => 'Dubois',
                'email' => 'martin.dubois@university.edu',
                'phone' => '+33 6 12 34 56 78',
                'department_id' => 1, // Informatique
                'role_id' => 2, // Chef de Département
                'password' => Hash::make('password'),
                'avatar' => null,
                '2fa_enabled' => true,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Jean',
                'last_name' => 'Dupont',
                'email' => 'jean.dupont@university.edu',
                'phone' => '+33 6 12 34 56 78',
                'department_id' => 1,
                'role_id' => 1, // Administrateur
                'password' => Hash::make('password'),
                'avatar' => null,
                '2fa_enabled' => true,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Sarah',
                'last_name' => 'Connor',
                'email' => 'sarah.connor@university.edu',
                'phone' => '+33 6 23 45 67 89',
                'department_id' => 1,
                'role_id' => 3, // Responsable Module
                'password' => Hash::make('password'),
                'avatar' => null,
                '2fa_enabled' => false,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@university.edu',
                'phone' => '+33 6 34 56 78 90',
                'department_id' => 2, // Mathématiques
                'role_id' => 3,
                'password' => Hash::make('password'),
                'avatar' => null,
                '2fa_enabled' => false,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Albert',
                'last_name' => 'Einstein',
                'email' => 'albert.einstein@university.edu',
                'phone' => '+33 6 45 67 89 01',
                'department_id' => 3, // Physique
                'role_id' => 3,
                'password' => Hash::make('password'),
                'avatar' => null,
                '2fa_enabled' => false,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
