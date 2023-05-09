<?php

namespace Database\Seeders;

use App\Models\competitions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // competitions::truncate(); //is used to delete all the records from a database table and reset the auto-incrementing ID to 1.
        
        competitions::create([
            'nom'=>'Coupe du monde',
            'annee'=>'2022',
            'date_debut'=>'2022-11-20',
            'date_fin'=>'2022-12-18',
            'type_competition'=>'championnat',
            'categorie'=>'jeunes',
            'organisateur'=>'nom de l\'organisateur',
            'description'=>'description de la compétition',
        ]);

        competitions::create([
            'nom'=>'Coupe de la CAF',
            'annee'=>'2018',
            'date_debut'=>'2018-11-20',
            'date_fin'=>'2018-12-18',
            'type_competition'=>'Coupe',
            'categorie'=>'amateurs',
            'organisateur'=>'nom de l\'organisateur',
            'description'=>'description de la compétition',
        ]);
    }
}
