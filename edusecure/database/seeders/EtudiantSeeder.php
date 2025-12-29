<?php

namespace Database\Seeders;

use App\Models\Etudiant;
use App\Models\Filiere;
use Illuminate\Database\Seeder;

class EtudiantSeeder extends Seeder
{
    public function run(): void
    {
        $filieres = Filiere::all();

        foreach ($filieres as $filiere) {
            // Créer entre 30 et 50 étudiants par filière
            $nombre = rand(30, 50);
            
            Etudiant::factory($nombre)->create([
                'filiere_id' => $filiere->id,
                'niveau' => $filiere->niveau,
            ]);
        }
    }
}