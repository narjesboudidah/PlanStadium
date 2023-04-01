<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\matchs;

class matchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // matchs::truncate(); //is used to delete all the records from a database table and reset the auto-incrementing ID to 1.
        
        matchs::create([
            'date'=>'2022-07-03',
            'heure'=>'11:30',
            'type_match'=>'national',
            'user_id'=>1,
            'competition_id'=>1,
            'stade_id'=>1,
            'equipe1_id'=>1,
            'equipe2_id'=>2,
        ]);
    }
}
