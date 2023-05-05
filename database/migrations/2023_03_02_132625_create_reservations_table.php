<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('admin_equipe_id');
            $table->foreign('admin_equipe_id','admin_equipe_id_fk_9')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('admin_fed_id');
            $table->foreign('admin_fed_id','admin_fed_id_fk_9')->references('id')->on('users')->onDelete('cascade');

            $table->string('note');
            $table->date('date_debut');
            $table->time('heure_debut');
            $table->date('date_fin');
            $table->time('heure_fin');
            $table->string('type_reservation')->default('match'); //type de réservation (entraînement, match, événement, etc.)
            $table->string('statut')->default('en attente'); //statut de la réservation (confirmé, en attente, annulé, etc.)
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
