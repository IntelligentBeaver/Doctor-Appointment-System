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
        Schema::create('patients', function (Blueprint $table) {
            $table->id('PatientID');
            $table->unsignedBigInteger('user_id')->unique();
            // $table->primary('PatientID');
            $table->string('PatientName')->nullable(false);
            $table->string('Address')->nullable();
            $table->string('Phone')->nullable(false);
            $table->string('Email')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');

    }
};