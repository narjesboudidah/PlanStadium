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
        Schema::create('matchs', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('competition_id');
            $table->foreign('competition_id','competition_id_fk_8')->references('id')->on('competitions')->onDelete('cascade');

            $table->unsignedInteger('stade_id');
            $table->foreign('stade_id','stade_id_fk_8')->references('id')->on('stades')->onDelete('cascade');

            $table->unsignedInteger('equipe1_id');
            $table->foreign('equipe1_id','equipe1_id_fk_8')->references('id')->on('equipes')->onDelete('cascade');
            
            $table->unsignedInteger('equipe2_id');
            $table->foreign('equipe2_id','equipe2_id_fk_8')->references('id')->on('equipes')->onDelete('cascade');

            $table->date('date');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->string('type_match');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matchs');
    }
};
