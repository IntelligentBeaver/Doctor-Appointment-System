<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $primaryKey = 'DoctorID';

    protected $fillable = ['user_id', 'DoctorName', 'SpecializationID', 'ContactInformation'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'SpecializationID');
    }

    public function availabilities()
    {
        return $this->hasMany(Availability::class, 'DoctorID');
    }


    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'DoctorID');
    }
}