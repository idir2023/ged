<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            
            // Clé étrangère vers le département
            $table->foreignId('departement_id')->nullable()->constrained('departements')->onDelete('set null');

            // Latitude et Longitude (coordonnées du projet)
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            // Clé étrangère vers la zone
            $table->foreignId('zone_id')->constrained('zones')->onDelete('cascade');

            // Clé étrangère vers le Chef de Projet
            $table->foreignId('chef_id')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
