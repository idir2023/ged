<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
   {
    Schema::create('departements', function (Blueprint $table) {
        $table->id('id_dep'); // Clé primaire
        $table->string('nom_dep'); // Nom du département
        $table->timestamps();
    });
   }

};
