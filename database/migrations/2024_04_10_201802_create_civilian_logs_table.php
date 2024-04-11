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
        Schema::create('civilian_logs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('hour_in');
            $table->dateTime('hour_out')->nullable();
            $table->string('names');
            $table->string('last_names');
            $table->string('activity');
            $table->foreignId('userIn_id');
            $table->foreignId('userOut_id')->nullable();
            $table->string('transport')->nullable();
            $table->foreign('userIn_id')->references('id')->on('users');
            $table->foreign('userOut_id')->references('id')->on('users');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('civilians');
    }
};
