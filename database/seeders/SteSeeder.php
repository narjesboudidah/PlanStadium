<?php

namespace Database\Seeders;

use App\Models\societe_maintenances;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // societe_maintenances::truncate(); //is used to delete all the records from a database table and reset the auto-incrementing ID to 1.
        
        societe_maintenances::create([
            'nom'=>'Sociéte des Travaux',
            'adresse'=>'Parc Hassèn Belkhodja, Av. Mohamed V, Tunis B.P. 700, Tunis RP 1000 Tunis',
            'tel'=>'71 468 477',
            'logo'=>asset('images/ste1.png'),
            'email'=>'STADE@gmail.com',
            'description'=>'xxxxxxxxxxxxxxx',
        ]);

        societe_maintenances::create([
            'nom'=>'Sociéte Tunisienne des Travaux',
            'adresse'=>'14 Rue Tamra , ZI Mégrine Saint Gobain, Megrine, Tunisie، 36.772598, 10.219239, Mégrine 2014',
            'tel'=>'71 427 123',
            'logo'=>asset('images/ste2.png'),
            'email'=>'STT@gmail.com',
            'description'=>'xxxxxxxxxxxxxxx',
        ]);
    }
}
