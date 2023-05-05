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
        Schema::create('competitions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('annee');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('type_competition')->default('championnat'); //championnat, coupe, tournoi, etc
            $table->string('categorie'); //jeunes, amateurs, professionnels, etc
            $table->string('organisateur'); //nom de l'organisateur de la compétition
            $table->string('description')->nullable(); // description de la compétition
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
        Schema::dropIfExists('competitions');
    }
};
