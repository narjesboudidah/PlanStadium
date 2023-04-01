<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\maintenances;

class maintenanceSeeder extends Seeder
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
            'date_debut'=>'2023-03-03',
            'date_fin'=>'2023-03-30',
            'statut'=>'urgente',
            'description'=>'description',
            'user_id'=>1,
            'ste_id'=>1,
            'stade_id'=>1,
        ]);
    }
}
