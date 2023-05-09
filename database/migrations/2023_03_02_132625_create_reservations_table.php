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
            $table->date('date_debut')->format('Y-m-d')->nullable();
            $table->time('heure_debut');
            $table->date('date_fin')->format('Y-m-d')->nullable();
            $table->time('heure_fin');
            $table->enum('type_reservation',['Match','Entraînement','Evénements spéciaux'])->default('Evénements spéciaux');
            $table->enum('statut',['en attente', 'refusé', "accepté"])->default('en attente'); //statut de la réservation (confirmé, en attente, annulé, etc.)
            $table->string('nom_match')->nullable();
            $table->enum('type_match',['National','International'])->default('National')->nullable();
            $table->string('nom_equipe_adversaire')->nullable();
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
