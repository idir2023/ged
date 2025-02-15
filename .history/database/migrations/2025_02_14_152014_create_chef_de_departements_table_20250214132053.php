<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('chef_de_departements', function (Blueprint $table) {
            $table->id('id_chef');
            $table->string('nom_chef', 50);
            $table->string('prenom_chef', 50);
            $table->string('email_chef', 100)->unique();
            $table->string('telephone_chef', 15)->nullable();
            $table->string('mot_de_passe_chef_projet');
            $table->foreignId('id_dep')->nullable()->constrained('departements')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chef_de_departements');
    }
};

