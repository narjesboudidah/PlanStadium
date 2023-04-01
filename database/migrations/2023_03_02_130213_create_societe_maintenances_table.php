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
            $table->unsignedInteger('user_id');
            $table->foreign('user_id','user_id_fk_4')->references('id')->on('users')->onDelete('cascade');
            $table->string('nom');
            $table->string('adresse');
            $table->string('tel');
            $table->string('logo');
            $table->string('email');
            $table->string('contact_nom')->nullable(); //nom du contact principal de la société de maintenance
            $table->string('contact_telephone')->nullable(); //numéro de téléphone du contact principal de la société de maintenance
            $table->string('contact_email')->nullable(); //adresse e-mail du contact principal de la société de maintenance
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
