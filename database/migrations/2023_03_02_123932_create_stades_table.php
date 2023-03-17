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
            $table->foreign('user_id','user_id_fk_4')->references('id')->on('users')->onDelete('cascade');
            $table->string('nom',30);
            $table->string('adresse');
            $table->string('ville',50);
            $table->string('pays',50);
            $table->text('description');
            $table->integer('capacite')->nullable();
            $table->integer('longitude')->nullable();
            $table->integer('altitude')->nullable();
            $table->date('date_dernier_traveaux');

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
