<?php

namespace Database\Seeders;

use App\Models\reservations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //role_user_pivot::truncate(); //is used to delete all the records from a database table and reset the auto-incrementing ID to 1.
        
        reservations::create([
            'note'=>'xxxxxxxxxxx',
            'date_debut'=>'2023-01-01',
            'heure_debut'=>'10:00',
            'date_fin'=>'2023-02-02',
            'heure_fin'=>'12:00',
            'type_reservation'=>'Match',
            'statut'=>'refusé',
            'nom_match'=>'xxxxxx',
            'type_match'=>'National',
            'nom_equipe_adversaire'=>'CSS',
            'admin_equipe_id'=>2,
            'admin_fed_id'=>1,
        ]);
    }
}
