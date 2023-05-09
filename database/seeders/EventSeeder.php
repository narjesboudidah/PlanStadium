<?php

namespace Database\Seeders;

use App\Models\events;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //events::truncate(); //is used to delete all the records from a database table and reset the auto-incrementing ID to 1.
        
        events::create([
            'date_debut'=>'2023-01-01',
            'heure_debut'=>'10:00',
            'date_fin'=>'2023-02-02',
            'heure_fin'=>'12:00',
            'type_event'=>'Match',
            'nom_event'=>'match',
            'type_match'=>'National',
            'nom_equipe_adversaire'=>'CSS',
            'stade_id'=>1,
        ]);
        events::create([
            'date_debut'=>'2023-02-02',
            'heure_debut'=>'15:00',
            'date_fin'=>'2023-03-03',
            'heure_fin'=>'16:00',
            'type_event'=>'Match',
            'nom_event'=>'match',
            'type_match'=>'National',
            'nom_equipe_adversaire'=>'Esperance Tunis',
            'stade_id'=>1,
        ]);
        
    }
}
