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
        Schema::create('images_guides', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('type');
            $table->unsignedBigInteger('guide_id');
            $table->foreign('guide_id')->references('id')->on('guide_pedagogiques');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images_guides');
    }
};
