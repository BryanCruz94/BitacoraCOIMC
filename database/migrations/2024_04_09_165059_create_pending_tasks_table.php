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
        Schema::create('pending_tasks', function (Blueprint $table) {
            $table->id();
            $table->dateTime('hour_create');
            $table->dateTime('hour_done')->nullable();
            $table->string('pending_task');
            $table->boolean('task_done');
            $table->foreignId('userCreate_id');
            $table->foreignId('userDone_id')->nullable();
            $table->string('observations')->nullable();
            $table->foreign('userCreate_id')->references('id')->on('users');
            $table->foreign('userDone_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_tasks');
    }
};
