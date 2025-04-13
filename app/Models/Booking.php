<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    protected $primaryKey = 'BOOK_ID';
    const STATUS_PENDING = 'PENDING';
    const STATUS_PAID = 'PAID';
    const STATUS_CANCELLED = 'CANCELLED';
    protected $fillable = [
        'car_id',
        'email',
        'book_place',
        'book_date',
        'duration',
        'phone_num',
        'destination',
        'return_date',
        'price',
        'book_status',
    ];
    public function payment()
    {
        return $this->hasOne(Payment::class, 'BOOK_ID', 'BOOK_ID');
    }
    public function car()
    {
        return $this->belongsTo(Cars::class, 'car_id', 'CAR_ID');
    }
}
