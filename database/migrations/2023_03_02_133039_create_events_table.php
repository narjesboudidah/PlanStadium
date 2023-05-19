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
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('admin_fed_id');
            $table->foreign('admin_fed_id','admin_fed_id_fk_10')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('stade_id');
            $table->foreign('stade_id','stade_id_fk_10')->references('id')->on('stades')->onDelete('cascade');

            $table->unsignedInteger('equipe1_id')->nullable();
            $table->foreign('equipe1_id','equipe1_id_fk_10')->references('id')->on('equipes')->onDelete('cascade');
            
            $table->unsignedInteger('equipe2_id')->nullable();
            $table->foreign('equipe2_id','equipe2_id_fk_10')->references('id')->on('equipes')->onDelete('cascade');

            $table->date('date_debut')->format('Y-m-d');
            $table->time('heure_debut');
            $table->date('date_fin')->format('Y-m-d');
            $table->time('heure_fin');
            $table->enum('type_event',['Match','Entraînement','Evénements spéciaux'])->default('Evénements spéciaux'); //(concert, conférence, compétition, etc.)
            $table->string('nom_event')->nullable(); //(concert, conférence, compétition, etc.)
            $table->enum('type_match',['National','International'])->default('National')->nullable();

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
        Schema::dropIfExists('events');
    }
};
