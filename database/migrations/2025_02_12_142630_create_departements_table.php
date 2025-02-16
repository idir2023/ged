<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('departements', function (Blueprint $table) {
            $table->id(); // Laravel crée automatiquement une clé primaire auto-incrémentée nommée "id"
            $table->string('nom_dep'); // Nom du département
            $table->unsignedBigInteger('id_chef_departement')->nullable(); // Chef du département optionnel

            // Clé étrangère pour lier le chef de département à la table "users"
            $table->foreign('id_chef_departement')->references('id')->on('users')->onDelete('set null');

            $table->timestamps(); // Ajout des timestamps (created_at, updated_at)
        });
    }

    public function down()
    {
        Schema::dropIfExists('departements');
    }
};
