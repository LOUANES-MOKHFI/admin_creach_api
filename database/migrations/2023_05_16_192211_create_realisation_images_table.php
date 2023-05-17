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
        Schema::create('realisation_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('realisation_id');
            $table->string('image');
            $table->foreign('realisation_id')->references('id')->on('realisations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisation_images');
    }
};
