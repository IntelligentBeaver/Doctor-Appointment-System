<?php

namespace App\Console\Commands;

use App\Models\Doctor; // Corrected case
use App\Models\Patient; // Corrected case
use App\Models\TimeSlot; // Corrected case
use App\Models\Appointment; // Corrected case
use App\Models\Availability; // Corrected case
use App\Models\Specialization; // Corrected case
use Illuminate\Console\Command;

class InsertTestData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:test-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will try to insert some data into all tables.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Create a Specialization
        $specialization = new Specialization();
        $specialization->SpecializationName = 'Cardiology';
        $specialization->Description = 'Specialization in heart-related issues';
        $specialization->save();

        // Create a Doctor with the associated Specialization
        $doctor = new Doctor();
        $doctor->DoctorName = 'Dr. Smith';
        $doctor->ContactInformation = '123-456-7890';
        $doctor->SpecializationID = $specialization->SpecializationID;
        $doctor->save();

        // Create a Patient
        $patient = new Patient();
        $patient->PatientName = 'John Doe';
        $patient->Address = '123 Main Street';
        $patient->Phone = '987-654-3210';
        $patient->Email = 'john@example.com';
        $patient->save();

        // Create a TimeSlot
        $timeSlot = new TimeSlot();
        $timeSlot->StartTime = '08:00:00';
        $timeSlot->EndTime = '09:00:00';
        $timeSlot->DayOfWeek = 'Monday';
        $timeSlot->save();

        // Create an Availability for the Doctor and TimeSlot
        $availability = new Availability();
        $availability->DoctorID = $doctor->DoctorID;
        $availability->TimeSlotID = $timeSlot->TimeSlotID;
        $availability->Date = now()->toDateString();
        $availability->Status = 'Available';
        $availability->save();

        // Create an Appointment for the Patient, Doctor, and TimeSlot
        $appointment = new Appointment();
        $appointment->PatientID = $patient->PatientID;
        $appointment->DoctorID = $doctor->DoctorID;
        $appointment->TimeSlotID = $timeSlot->TimeSlotID;
        $appointment->Date = now()->toDateString();
        $appointment->Status = 'Scheduled';
        $appointment->save();
        $this->info('Test data inserted successfully!');
    }
}