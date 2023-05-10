<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'titre'=>'Admin fédération',
        ]);
        Role::create([
            'titre'=>'Admin équipe',
        ]);
        Role::create([
            'titre'=>'Admin ste',
        ]);
    }
}
