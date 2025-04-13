<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

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
}
