<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\historiques;

class historiqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // historiques::truncate(); //is used to delete all the records from a database table and reset the auto-incrementing ID to 1.
        
        historiques::create([
            'date'=>'',
            'action'=>'supprimer equipe',
            'user_id'=>2,
        ]);
    }
}
