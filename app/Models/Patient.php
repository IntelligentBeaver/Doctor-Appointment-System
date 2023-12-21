<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $primaryKey = 'PatientID';

    protected $fillable = ['PatientName', 'Address', 'Phone', 'Email'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'PatientID');
    }
}