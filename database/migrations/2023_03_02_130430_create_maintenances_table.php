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
            $table->unsignedInteger('admin_ste_id');
            $table->foreign('admin_ste_id','admin_ste_id_fk_5')->references('id')->on('users')->onDelete('cascade');
            
            $table->unsignedInteger('admin_fed_id');
            $table->foreign('admin_fed_id','admin_fed_id_fk_5')->references('id')->on('users')->onDelete('cascade');
            
            $table->unsignedInteger('stade_id');
            $table->foreign('stade_id','stade_id_fk_5')->references('id')->on('stades')->onDelete('cascade');

            $table->date('date_debut');
            $table->time('heure_debut');
            $table->date('date_fin');
            $table->time('heure_fin');
            $table->string('description')->nullable(); //description de la nature de la maintenance
            $table->string('etat');
            $table->string('statut');

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
