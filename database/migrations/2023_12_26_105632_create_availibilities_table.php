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
        Schema::create('availabilities', function (Blueprint $table) {
            $table->id('AvailabilityID');
            // $table->primary('AvailibilityID');
            $table->unsignedBigInteger('DoctorID');
            $table->unsignedBigInteger('TimeSlotID');
            $table->date('Date');
            $table->string('Status', 50);
            $table->timestamps();

            $table->foreign('DoctorID')->references('DoctorID')->on('doctors');
            $table->foreign('TimeSlotID')->references('TimeSlotID')->on('timeslots');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('availabilities');
    }
};