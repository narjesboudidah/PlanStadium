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
       $admin_ste_permissions = [
        "Consulter Events",
        "Consulter Event",
        "Consulter Maintenances",
        "Consulter Maintenance",
        "Ajout Maintenance",
        "Modifier Maintenance",
        "Supprimer Maintenance",
        "Annuler Maintenance",
        "Consulter Stes",
        "Consulter Ste",
        "Consulter Stades",
        "Consulter Stade",
       ];
       $admin_equipe_permissions = [
        "Consulter Events",
        "Consulter Equipes",
        "Consulter Equipe",
        "Consulter Event",
        "Consulter Matchs",
        "Consulter Match",
        "Consulter Stades",
        "Consulter Competitions",
        "Consulter Competition",
        "Consulter Stade",
        "Consulter Reservations",
        "Consulter Reservation",
        "Ajout Reservation",
        "Modifier Reservation",
        "Supprimer Reservation",
        "Annuler Reservation",
       ];
        $admin_federation_permissions = [
        "Consulter Events",
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
        "Confirmer Maintenance",
        "Annuler Maintenance",
        "Consulter Equipes",
        "Consulter Equipe",
        "Ajout Equipe",
        "Modifier Equipe",
        "Supprimer Equipe",
        "Consulter Matchs",
        "Consulter Match",
        "Ajout Match",
        "Modifier Match",
        "Supprimer Match",
        "Consulter Stes",
        "Consulter Ste",
        "Ajout Ste",
        "Modifier Ste",
        "Supprimer Ste",
        "Consulter Stades",
        "Consulter Stade",
        "Ajout Stade",
        "Modifier Stade",
        "Supprimer Stade",
        "Consulter Permissions",
        "Consulter Permission",
        "Ajout Permission",
        "Modifier Permission",
        "Supprimer Permission",
        "Consulter Roles",
        "Consulter Role",
        "Ajout Role",
        "Modifier Role",
        "Supprimer Role",
        "Consulter Competitions",
        "Consulter Competition",
        "Ajout Competition",
        "Modifier Competition",
        "Supprimer Competition",
        "Consulter Reservations",
        "Consulter Reservation",
        "Ajout Reservation",
        "Modifier Reservation",
        "Supprimer Reservation",
        "Annuler Reservation",
        "Confirmer Reservation",
        "Consulter Historiques"
    ];
    for ($i = 0 ; $i < count($admin_federation_permissions); $i++){
        Permission::create(['name' => $admin_federation_permissions[$i]]);
    }
    $role1 = Role::create(['name' => 'Admin Federation']);
    $role2 = Role::create(['name' => 'Admin Equipe']);
    $role3 = Role::create(['name' => 'Admin Ste']);
    for ($i = 0 ; $i < count($admin_equipe_permissions); $i++){
        $role2->givePermissionTo($admin_equipe_permissions[$i]);
    }
    for ($i = 0 ; $i < count($admin_ste_permissions); $i++){
        $role3->givePermissionTo($admin_ste_permissions[$i]);
    }
    $user = User::create([
        'nom'=>'sirine',
        'prenom'=>'balghouthi',
        'telephone'=>'29701966',
        'email'=>'sirine@gmail.com',
        'adresse'=>'xxxxxx',
        'password'=>bcrypt('123'),
    ]);
    for ($i = 0 ; $i < count($admin_federation_permissions); $i++){
        $user->givePermissionTo($admin_federation_permissions[$i]);
    }
    $user->assignRole('Admin Federation');


    $user1 = User::create([
        'nom'=>'narjes',
        'prenom'=>'boudidah',
        'telephone'=>'29701566',
        'email'=>'narjes@gmail.com',
        'adresse'=>'xxxsxxx',
        'password'=>bcrypt('123'),
    ]);
    $user1->assignRole('Admin Equipe');
    // $user1->givePermissionTo('Consulter Equipes');



    User::create([
        'nom'=>'Hamza',
        'prenom'=>'boudidah',
        'telephone'=>'29801566',
        'email'=>'hamza@gmail.com',
        'adresse'=>'xxxuxxx',
        'password'=>bcrypt('123'),
    ]);
    $user1->assignRole('Admin Ste');

}
}
