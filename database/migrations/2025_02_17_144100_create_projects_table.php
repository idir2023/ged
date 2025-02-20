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
            $table->text('description')->nullable();
              // Clé étrangère vers la zone
            $table->foreignId('zone_id')->constrained('zones')->onDelete('cascade');
             // Clé étrangère vers le Chef de Projet
            $table->foreignId('chef_projet_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('employe_id')->nullable()->constrained('users')->onDelete('set null'); // Chef de Département

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
