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
        Schema::create('stades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom')->unique();
            $table->string('pays');
            $table->integer('capacite')->nullable();
            $table->integer('surface')->nullable();
            $table->integer('longitude')->nullable();
            $table->integer('latitude')->nullable();
            $table->string('proprietaire');
            $table->string('telephone')->unique();
            $table->string('adresse')->unique();
            $table->string('image')->nullable();
            $table->enum('etat',['disponible','reserver','en maintenance'])->default('disponible');
            $table->text('description')->nullable();
            $table->date('date_dernier_travaux')->format('m-d-Y')->nullable();

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
        Schema::dropIfExists('stades');
    }
};
