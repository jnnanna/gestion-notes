<?php
// gestnotes/database/seeders/DepartmentSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['name' => 'Informatique', 'code' => 'INFO', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mathématiques', 'code' => 'MATH', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Physique', 'code' => 'PHYS', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Biologie', 'code' => 'BIO', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('departments')->insert($departments);
    }
}
