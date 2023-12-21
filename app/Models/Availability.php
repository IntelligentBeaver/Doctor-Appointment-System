<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    protected $primaryKey = 'AvailabilityID';

    protected $fillable = ['DoctorID', 'TimeSlotID', 'Date', 'Status'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'DoctorID');
    }

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class, 'TimeSlotID');
    }
}