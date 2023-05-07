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
        Schema::create('societe_maintenances', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('admin_ste_id');
            $table->foreign('admin_ste_id','admin_ste_id_fk_4')->references('id')->on('users')->onDelete('cascade');
            $table->string('nom')->unique();
            $table->string('adresse')->unique();
            $table->string('tel')->unique();
            $table->string('logo');
            $table->string('email')->unique();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('societe_maintenances');
    }
};
