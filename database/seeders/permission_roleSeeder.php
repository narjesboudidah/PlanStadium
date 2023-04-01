<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\permission_role;

class permission_roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //permission_role::truncate(); //is used to delete all the records from a database table and reset the auto-incrementing ID to 1.
        
        permission_role::create([
            'role_id'=>1,
            'permission_id'=>1,
        ]);
    }
}
