<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\stades;

class stadeSeeder extends Seeder
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
            'ville'=>'Tunis ',
            'pays'=>'Tunisie',
            'capacite'=>'60 000 ',
            'surface'=>'60 000 ',
            'longitude'=>'455',
            'altitude'=>'556',
            'proprietaire'=>'proprietaire',
            'telephone'=>'77777777',
            'adresse'=>' Cité Olympique 2040 Radès, Ben Arous',
            'image'=>null,//asset('images/Espérance.png'),
            'description'=>'est un stade situé à Radès, dans la banlieue sud-est de Tunis (Tunisie), au cœur d\'un complexe sportif situé à une dizaine de kilomètres du centre-ville de la capitale tunisienne.',
            'date_dernier_traveaux'=>'2022-12-02',
            'user_id'=>2,
        ]);
    }
}
