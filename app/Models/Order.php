<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'OrderID';
    protected $fillable = [
        'user_id', 'Name', 'Email', 'product_id', 'amount', 'esewa_status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'id');
    }
}