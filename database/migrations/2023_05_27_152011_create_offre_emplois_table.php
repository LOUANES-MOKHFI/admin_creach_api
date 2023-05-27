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
        Schema::create('offre_emplois', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->unsignedBigInteger('creche_id');
            $table->unsignedBigInteger('emploi_id');
            $table->integer('wilaya_id');
            $table->integer('commune_id');
            $table->string('degre_etude')->nullable();
            $table->string('experience')->nullable();
            $table->string('phone')->nullable();
            $table->integer('is_active')->default(1);
            $table->foreign('creche_id')->references('id')->on('users');
            $table->foreign('emploi_id')->references('id')->on('emplois');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offre_emplois');
    }
};
