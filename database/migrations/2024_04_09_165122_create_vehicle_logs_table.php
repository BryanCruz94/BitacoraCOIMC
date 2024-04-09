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
        Schema::create('vehicle_logs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('departure_time');

            $table->dateTime('entry_time')->nullable();
            $table->string('departure_km');
            $table->string('entry_km')->nullable();
            $table->string('observation')->nullable();
            $table->foreignId('userOut_id');
            $table->foreignId('userIn_id')->nullable();
            $table->foreignId('pass_id');
            $table->foreign('pass_id')->references('id')->on('passes');
            $table->foreign('userOut_id')->references('id')->on('users');
            $table->foreign('userIn_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_logs');
    }
};
