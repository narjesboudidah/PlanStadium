<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class permissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permission::truncate(); //is used to delete all the records from a database table and reset the auto-incrementing ID to 1.
        Permission::create([
            'title'=>'Créer une nouvelle équipe',
        ]);
    }
}
