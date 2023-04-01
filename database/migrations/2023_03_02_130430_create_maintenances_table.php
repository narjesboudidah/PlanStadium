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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id','user_id_fk_5')->references('id')->on('users')->onDelete('cascade');
           
            $table->unsignedInteger('ste_id');
            $table->foreign('ste_id','ste_id_fk_5')->references('id')->on('societe_maintenances')->onDelete('cascade');
           
            $table->unsignedInteger('stade_id');
            $table->foreign('stade_id','stade_id_fk_5')->references('id')->on('stades')->onDelete('cascade');

            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('statut');
            $table->string('description')->nullable(); //description de la nature de la maintenance

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
        Schema::dropIfExists('maintenances');
    }
};
