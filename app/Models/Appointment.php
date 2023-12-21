<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $primaryKey = 'AppointmentID';

    protected $fillable = ['PatientID', 'DoctorID', 'TimeSlotID', 'Date', 'Status'];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'PatientID');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'DoctorID');
    }

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class, 'TimeSlotID');
    }
}