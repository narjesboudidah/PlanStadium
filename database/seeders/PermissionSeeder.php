<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'titre'=>'Gérer Rôles',
        ]);
        Permission::create([
            'titre'=>'Gérer permissions',
        ]);
        Permission::create([
            'titre'=>'Consulter historique',
        ]);
    }
}
