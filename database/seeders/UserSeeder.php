<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
       // societe_maintenances::truncate(); //is used to delete all the records from a database table and reset the auto-incrementing ID to 1.
       app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = ["Consulter Events",
        "Consulter Event",
        "Ajout Event",
        "Modifier Event",
        "Supprimer Event",
        "Consulter Users",
        "Consulter User",
        "Ajout User",
        "Modifier User",
        "Supprimer User",
        "Consulter Maintenances",
        "Consulter Maintenance",
        "Ajout Maintenance",
        "Modifier Maintenance",
        "Supprimer Maintenance",
        "Consulter Equipes",
        "Consulter Equipe",
        "Ajout Equipe",
        "Modifier Equipe",
        "Supprimer Equipe",
        "Consulter Matchs",
        "Consulter Match",
        "Ajout Match",
        "Modifier Match",
        "Supprimer Match"
    ];
    for ($i = 0 ; $i < count($permissions); $i++){
        Permission::create(['name' => $permissions[$i]]);
    }
    $role1 = Role::create(['name' => 'Admin Federation']);
    $role2 = Role::create(['name' => 'Admin Equipe']);
    $role3 = Role::create(['name' => 'Admin Ste']);
    for ($i = 0 ; $i < count($permissions); $i++){
        $role1->givePermissionTo($permissions[$i]);
    }

        $user = User::create([
            'nom'=>'sirine',
            'prenom'=>'balghouthi',
            'telephone'=>'29701966',
            'email'=>'sirine@gmail.com',
            'adresse'=>'xxxxxx',
            'password'=>bcrypt('123'),
        ]);
        $user->assignRole('Admin Federation');

        User::create([
            'nom'=>'narjes',
            'prenom'=>'boudidah',
            'telephone'=>'77777777',
            'email'=>'narjes@gmail.com',
            'adresse'=>'xxxxxxxx',
            'password'=>bcrypt('321'),
        ]);
        User::create([
            'nom'=>'narjes',
            'prenom'=>'boudidah',
            'telephone'=>'11111111',
            'email'=>'hamza@gmail.com',
            'adresse'=>'xxxxxxxx',
            'password'=>bcrypt('123'),
        ]);
    }
}
