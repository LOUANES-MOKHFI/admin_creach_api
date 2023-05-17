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
        Schema::table('about', function (Blueprint $table) {
            $table->text('description')->nullable()->after('logo');
            $table->text('gerant_name')->nullable()->after('logo');
            $table->text('image')->nullable()->after('logo');
            $table->text('video')->nullable()->after('logo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about', function (Blueprint $table) {
            //
        });
    }
};
