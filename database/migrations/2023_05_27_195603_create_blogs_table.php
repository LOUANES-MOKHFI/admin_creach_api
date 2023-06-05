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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creche_id');
            
            $table->string('uuid');
            $table->string('title');
            $table->string('slug');
            $table->string('type');
            $table->text('content')->nullable();
            $table->string('video')->nullable();
            $table->integer('nbr_heart')->default(0);
            $table->integer('nbr_view')->default(0);
            $table->foreign('creche_id')->references('id')->on('users');
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
