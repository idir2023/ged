<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('zone_id')->constrained('zones')->onDelete('cascade'); // Lien avec Zone
            $table->foreignId('chef_id')->nullable()->constrained('users')->onDelete('set null'); // Chef de Projet
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('projects');
    }
};

