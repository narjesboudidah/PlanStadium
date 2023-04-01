<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\role_user_pivot;

class role_user_pivotSeeder extends Seeder
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
            'role_id'=>1,
            'user_id'=>1,
            'ste_id'=>null,
            'equipe_id'=>null,
        ]);
        role_user_pivot::create([
            'role_id'=>2,
            'user_id'=>2,
            'ste_id'=>null,
            'equipe_id'=>null,
        ]);
        role_user_pivot::create([
            'role_id'=>3,
            'user_id'=>3,
            'ste_id'=>null,
            'equipe_id'=>null,
        ]);
       /* role_user_pivot::create([
            'role_id'=>3,
            'user_id'=>4,
            'ste_id'=>null,
            'equipe_id'=>null,
        ]);*/
    }
}
