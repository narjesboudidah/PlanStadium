<?php

namespace Database\Seeders;

use App\Models\maintenances;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\role_user_pivot;

class MaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // maintenances::truncate(); //is used to delete all the records from a database table and reset the auto-incrementing ID to 1.

        maintenances::create([
            'date_debut'=>'2023-01-01',
            'heure_debut'=>'10:00',
            'date_fin'=>'2023-02-02',
            'heure_fin'=>'12:00',
            'etat'=>'urgent',
            'statut'=>'en attente',
            'description'=>'description',
            'admin_ste_id'=>1,
            'admin_fed_id'=>1,
            'stade_id'=>1,
        ]);
        role_user_pivot::create([
            "user_id" => 1,
            "role_id" => 1
        ]);
        role_user_pivot::create([
            "user_id" => 2,
            "role_id" => 2,
        ]);
        role_user_pivot::create([
            "user_id" => 3,
            "role_id" => 3,
        ]);
    }
}
