<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('zones', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->decimal('latitude', 10, 8)->index();
            $table->decimal('longitude', 11, 8)->index();
            $table->string('coordinates')->nullable();
            $table->string('created_by')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->foreignId('chef_id')->nullable()->constrained('users')->onDelete('set null'); // Chef de Zone
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('zones');
    }
};


