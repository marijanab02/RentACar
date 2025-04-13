<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cars extends Model
{
    use HasFactory;

    protected $primaryKey = 'CAR_ID';
    public $timestamps = false;

    protected $fillable = [
        'CAR_NAME',
        'FUEL_TYPE',
        'CAPACITY',
        'PRICE',
        'CAR_IMG',
        'AVAILABLE'
    ];

    // Accessor for image URL
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->CAR_IMG);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'car_id', 'CAR_ID');
    }
}
