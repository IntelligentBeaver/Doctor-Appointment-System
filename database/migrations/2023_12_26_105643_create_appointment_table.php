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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('AppointmentID');
            // $table->primary('AppointmentID');
            $table->unsignedBigInteger('PatientID');
            $table->unsignedBigInteger('DoctorID');
            $table->unsignedBigInteger('TimeSlotID');
            $table->date('Date');
            $table->string('Status', 50);
            $table->timestamps();

            $table->foreign('PatientID')->references('PatientID')->on('patients');
            $table->foreign('DoctorID')->references('DoctorID')->on('doctors');
            $table->foreign('TimeSlotID')->references('TimeSlotID')->on('timeslots');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};