<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    protected $primaryKey = 'TimeSlotID';

    protected $fillable = ['StartTime', 'EndTime', 'DayOfWeek'];
    public function availabilities()
    {
        return $this->hasMany(Availability::class, 'TimeSlotID');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'TimeSlotID');
    }
}