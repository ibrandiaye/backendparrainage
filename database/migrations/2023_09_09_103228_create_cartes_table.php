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
        Schema::create('cartes', function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->string("prenom");
            $table->bigInteger("numelec")->unique();
            $table->bigInteger("numcni")->unique();
            $table->unsignedBigInteger("commune_id");
            $table->unsignedBigInteger("collecteur_id");
            $table->foreign("commune_id")
            ->references("id")
            ->on("communes");
            $table->foreign("collecteur_id")
            ->references("id")
            ->on("collecteurs");
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
        Schema::dropIfExists('cartes');
    }
};
