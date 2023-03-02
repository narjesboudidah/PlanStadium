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
        Schema::create('role_user_pivots', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_1')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_8')->references('id')->on('roles')->onDelete('cascade');
            $table->unsignedInteger('ste_id');
            $table->foreign('ste_id','ste_id_fk_9')->references('id')->on('societe_maintenances')->onDelete('cascade');
           
            $table->unsignedInteger('equipe_id');
            $table->foreign('equipe_id','equipe_id_fk_14')->references('id')->on('equipes')->onDelete('cascade');
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
        Schema::dropIfExists('role_user_pivots');
    }
};
