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
        Schema::create('equipes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('admin_equipe_id');
            $table->foreign('admin_equipe_id','admin_equipe_id_fk_2')->references('id')->on('users')->onDelete('cascade');
            $table->string('nom_equipe')->unique();
            $table->string('adresse')->unique();
            $table->string('pays');
            $table->string('logo')->unique();
            $table->string('site_web')->nullable()->unique();
            $table->string('type_equipe');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('equipes');
    }
};
