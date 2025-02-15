<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->id('id_employe');
            $table->string('nom_employe', 50);
            $table->string('prenom_employe', 50);
            $table->string('email_employe', 100)->unique();
            $table->string('telephone_employe', 15)->nullable();
            $table->enum('type_employe', ['Département', 'Projet', 'Externe'])->default('Département');
            $table->foreignId('id_departement')->nullable()->constrained('departements')->onDelete('set null');
            $table->foreignId('id_projet')->nullable()->constrained('projets')->onDelete('set null');
            $table->foreignId('id_chef')->constrained('chef_de_departements')->onDelete('cascade');
            $table->foreignId('ajoute_par')->nullable()->constrained('chef_de_departements')->onDelete('set null');
            $table->string('mot_de_passe_employe');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employes');
    }
};

