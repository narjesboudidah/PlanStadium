<?php

namespace Database\Seeders;

use App\Models\stades;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //stades::truncate(); //is used to delete all the records from a database table and reset the auto-incrementing ID to 1.

        stades::create([
            'nom'=>'Stade olympique de Radès',
            'pays'=>'Tunisie',
            'capacite'=>'6000 ',
            'surface'=>'6000 ',
            'proprietaire'=>'proprietaire',
            'telephone'=>'77777777',
            'adresse'=>' Cité Olympique 2040 Radès, Ben Arous',
            'image'=>null,//asset('images/Espérance.png'),
            'etat'=>'reserver',
            'description'=>'est un stade situé à Radès, dans la banlieue sud-est de Tunis (Tunisie), au cœur d\'un complexe sportif situé à une dizaine de kilomètres du centre-ville de la capitale tunisienne.',
            'date_dernier_travaux'=>'2022-12-02',
        ]);
    }
}
