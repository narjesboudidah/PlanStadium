<?php

namespace Database\Seeders;

use App\Models\matchs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatchSeeder extends Seeder
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
            'nom'=>'nom match',
            'date'=>'2022-07-03',
            'heure'=>'11:30',
            'type_match'=>'National',
            'competition_id'=>1,
            'stade_id'=>1,
            'equipe1_id'=>1,
            'equipe2_id'=>2,
        ]);
        matchs::create([
            'nom'=>'nom match',
            'date'=>'2022-07-04',
            'heure'=>'11:30',
            'type_match'=>'National',
            'competition_id'=>1,
            'stade_id'=>1,
            'equipe1_id'=>1,
            'equipe2_id'=>2,
        ]);
    }
}
