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
            'titre'=>'Consulter Events',
        ]);
        Permission::create([
            'titre'=>'Consulter Event',
        ]);
        Permission::create([
            'titre'=>'Ajout Event',
        ]);
        Permission::create([
            'titre'=>'Modifier Event',
        ]);
        Permission::create([
            'titre'=>'Supprimer Event',
        ]);
        Permission::create([
            'titre'=>'Consulter Users',
        ]);
        Permission::create([
            'titre'=>'Consulter User',
        ]);
        Permission::create([
            'titre'=>'Ajout User',
        ]);
        Permission::create([
            'titre'=>'Modifier User',
        ]);
        Permission::create([
            'titre'=>'Supprimer User',
        ]);
        Permission::create([
            'titre'=>'Consulter Maintenances',
        ]);
        Permission::create([
            'titre'=>'Consulter Maintenance',
        ]);
        Permission::create([
            'titre'=>'Ajout Maintenance',
        ]);
        Permission::create([
            'titre'=>'Modifier Maintenance',
        ]);
        Permission::create([
            'titre'=>'Supprimer Maintenance',
        ]);
        Permission::create([
            'titre'=>'Consulter Equipes',
        ]);
        Permission::create([
            'titre'=>'Consulter Equipe',
        ]);
        Permission::create([
            'titre'=>'Ajout Equipe',
        ]);
        Permission::create([
            'titre'=>'Modifier Equipe',
        ]);
        Permission::create([
            'titre'=>'Supprimer Equipe',
        ]);
        Permission::create([
            'titre'=>'Consulter Matchs',
        ]);
        Permission::create([
            'titre'=>'Consulter Match',
        ]);
        Permission::create([
            'titre'=>'Ajout Match',
        ]);
        Permission::create([
            'titre'=>'Modifier Match',
        ]);
        Permission::create([
            'titre'=>'Supprimer Match',
        ]);
        Permission::create([
            'titre'=>'Consulter Stes',
        ]);
        Permission::create([
            'titre'=>'Consulter Ste',
        ]);
        Permission::create([
            'titre'=>'Ajout Ste',
        ]);
        Permission::create([
            'titre'=>'Modifier Ste',
        ]);
        Permission::create([
            'titre'=>'Supprimer Ste',
        ]);
        Permission::create([
            'titre'=>'Consulter Stades',
        ]);
        Permission::create([
            'titre'=>'Consulter Stade',
        ]);
        Permission::create([
            'titre'=>'Ajout Stade',
        ]);
        Permission::create([
            'titre'=>'Modifier Stade',
        ]);
        Permission::create([
            'titre'=>'Supprimer Stade',
        ]);
        Permission::create([
            'titre'=>'Consulter Permissions',
        ]);
        Permission::create([
            'titre'=>'Consulter Permission',
        ]);
        Permission::create([
            'titre'=>'Ajout Permission',
        ]);
        Permission::create([
            'titre'=>'Modifier Permission',
        ]);
        Permission::create([
            'titre'=>'Supprimer Permission',
        ]);
        Permission::create([
            'titre'=>'Consulter Roles',
        ]);
        Permission::create([
            'titre'=>'Consulter Role',
        ]);
        Permission::create([
            'titre'=>'Ajout Role',
        ]);
        Permission::create([
            'titre'=>'Modifier Role',
        ]);
        Permission::create([
            'titre'=>'Supprimer Role',
        ]);
        Permission::create([
            'titre'=>'Consulter Competiotions',
        ]);
        Permission::create([
            'titre'=>'Consulter Competiotion',
        ]);
        Permission::create([
            'titre'=>'Ajout Competiotion',
        ]);
        Permission::create([
            'titre'=>'Modifier Competiotion',
        ]);
        Permission::create([
            'titre'=>'Supprimer Competiotion',
        ]);
        Permission::create([
            'titre'=>'Consulter Réservations',
        ]);
        Permission::create([
            'titre'=>'Consulter Réservation',
        ]);
        Permission::create([
            'titre'=>'Ajout Réservation',
        ]);
        Permission::create([
            'titre'=>'Modifier Réservation',
        ]);
        Permission::create([
            'titre'=>'Supprimer Réservation',
        ]);















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
