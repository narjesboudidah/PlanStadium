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

            $table->unsignedInteger('user_id');
            $table->foreign('user_id','user_id_fk_9')->references('id')->on('users')->onDelete('cascade');
           
            $table->unsignedInteger('equipe_id');
            $table->foreign('equipe_id','equipe_id_fk_9')->references('id')->on('equipes')->onDelete('cascade');
           
            $table->unsignedInteger('stade_id');
            $table->foreign('stade_id','stade_id_fk_9')->references('id')->on('stades')->onDelete('cascade');

            $table->date('date_debut');
            $table->date('date_fin');
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
