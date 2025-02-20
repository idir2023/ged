<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('departements', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('chef_id')->nullable()->constrained('users')->onDelete('set null'); // Chef de Département
            $table->foreignId('employe_id')->nullable()->constrained('users')->onDelete('set null'); // Chef de Département

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('departements');
    }
};
