<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    protected $primaryKey = 'AppointmentID';

    protected $fillable = ['PatientID', 'DoctorID', 'TimeSlotID', 'Date', 'Status','TokenNumber'];

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
    public function orders()
    {
        return $this->hasMany(Order::class, 'AppointmentID');
    }
}