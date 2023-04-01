<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Role::truncate(); //is used to delete all the records from a database table and reset the auto-incrementing ID to 1.
        Role::create([
            'title'=>'superadmin',
        ]);

        Role::create([
            'title'=>'admin_equipe',
        ]);
        Role::create([
            'title'=>'admin_ste',
        ]);
    }
}
