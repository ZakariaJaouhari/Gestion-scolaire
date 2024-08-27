<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formateurs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nom');
            $table->string('prenom');
            $table->string('matricule');
            $table->enum('sexe', ['Homme', 'Femme']);
            $table->date('date_naissance');
            $table->enum('situation', ['Marié(e)', 'Célibataire']);
            $table->string('CIN');
            $table->date('date_recrutement');
            $table->string('email');
            $table->string('password');
            $table->string('profile_picture');
            $table->unsignedBigInteger('directeur_id');
            $table->foreign('directeur_id')->references('id')->on('directeurs')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formateurs');
    }
};
