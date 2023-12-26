<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $primaryKey = 'SpecializationID';

    protected $fillable = ['SpecializationName', 'Description'];
    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'SpecializationID');
    }
    public static function getSpecializationList()
{
    return self::pluck('SpecializationName', 'SpecializationID')->toArray();
}
}