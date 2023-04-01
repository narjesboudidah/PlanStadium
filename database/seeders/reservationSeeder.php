<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\role_user_pivot;

class reservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //role_user_pivot::truncate(); //is used to delete all the records from a database table and reset the auto-incrementing ID to 1.
        
        role_user_pivot::create([
            'date_debut'=>'2023-01-01',
            'date_fin'=>'2023-02-02',
            'type_reservation'=>'xxxxxxxx',
            'statut'=>'xxxxxx',
            'description'=>'xxxxxx',
            'user_id'=>1,
            'stade_id'=>1,
            'equipe_id'=>1,
        ]);
    }
}
