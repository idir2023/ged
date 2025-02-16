<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('zones', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('coordinates')->nullable(); // Correction de la syntaxe
            $table->string('créé_par')->nullable(); // Correction et ajout des accents
            $table->unsignedBigInteger('id_chef_zone')->nullable(); // Correction
            $table->string('city')->nullable(); // Correction de 'tabel' à 'table'
            $table->string('country')->nullable(); // Correction de 'tabel' à 'table'

            $table->foreign('id_chef_zone')->references('id')->on('users')->onDelete('cascade'); // Correction de 'forieng'
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('zones');
    }
};
