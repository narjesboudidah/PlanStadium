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

            $table->unsignedInteger('user_id');
            $table->foreign('user_id','user_id_fk_10')->references('id')->on('users')->onDelete('cascade');
           
            $table->unsignedInteger('equipe_id');
            $table->foreign('equipe_id','equipe_id_fk_10')->references('id')->on('equipes')->onDelete('cascade');
           
            $table->unsignedInteger('stade_id');
            $table->foreign('stade_id','stade_id_fk_10')->references('id')->on('stades')->onDelete('cascade');

            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('type_event')->default('compétition'); //(concert, conférence, compétition, etc.)

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
