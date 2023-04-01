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
            $table->unsignedInteger('user_id');
            $table->foreign('user_id','user_id_fk_3')->references('id')->on('users')->onDelete('cascade');
            $table->string('nom');
            $table->string('ville');
            $table->string('pays');
            $table->integer('capacite')->nullable();
            $table->integer('surface')->nullable();
            $table->integer('longitude')->nullable();
            $table->integer('altitude')->nullable();
            $table->string('proprietaire');
            $table->string('telephone');
            $table->string('adresse');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->date('date_dernier_travaux');

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
