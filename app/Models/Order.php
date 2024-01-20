<?php

namespace App\Models;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'OrderID';
    protected $fillable = [
        'user_id','AppointmentID', 'Name', 'Email', 'product_id', 'amount', 'esewa_status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'id');
    }
    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'AppointmentID');
    }
}