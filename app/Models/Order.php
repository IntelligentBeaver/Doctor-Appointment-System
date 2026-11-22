<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public const STATUS_UNVERIFIED = 'unverified';

    public const STATUS_VERIFIED = 'verified';

    public const STATUS_FAILED = 'failed';

    protected $primaryKey = 'OrderID';

    protected $fillable = [
        'user_id', 'AppointmentID', 'Name', 'Email', 'product_id', 'amount', 'esewa_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'AppointmentID');
    }
}
