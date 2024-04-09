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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rank_id');
            $table->foreignId('military_unit_id');
            $table->string('identification_card');
            $table->string('names');
            $table->string('last_names');
            $table->string('phone');
            $table->string('blood_type');
            $table->string('license_type');
            $table->foreign('rank_id')->references('id')->on('ranks');
            $table->foreign('military_unit_id')->references('id')->on('military_units');
            $table->timestamps();
            $table->boolean('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
