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
        Schema::create('timeslots', function (Blueprint $table) {
        $table->id('TimeSlotID');
        $table->time('StartTime');
        $table->time('EndTime');
        // $table->string('SelectedDay');
        // $table->unsignedBigInteger('DoctorID');
        $table->timestamps();

        // $table->foreign('DoctorID')->references('DoctorID')->on('doctors')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timeslots');
    }
};