<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('titre',['Consulter Events','Consulter Event','Ajout Event','Modifier Event','Supprimer Event','Consulter Users','Consulter User','Ajout User','Modifier User','Supprimer User','Consulter Maintenances','Consulter Maintenance','Ajout Maintenance','Modifier Maintenance','Supprimer Maintenance','Consulter Equipes','Consulter Equipe','Ajout Equipe','Modifier Equipe','Supprimer Equipe','Consulter Matchs','Consulter Match','Ajout Match','Modifier Match','Supprimer Match','Consulter Stes','Consulter Ste','Ajout Ste','Modifier Ste','Supprimer Ste','Consulter Stades','Consulter Stade','Ajout Stade','Modifier Stade','Supprimer Stade','Consulter Permissions','Consulter Permission','Ajout Permission','Modifier Permission','Supprimer Permission','Consulter Roles','Consulter Role','Ajout Role','Modifier Role','Supprimer Role','Consulter Competiotions','Consulter Competiotion','Ajout Competiotion','Modifier Competiotion','Supprimer Competiotion','Consulter Réservations','Consulter Réservation','Ajout Réservation','Modifier Réservation','Supprimer Réservation','Consulter historique']);
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
