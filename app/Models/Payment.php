<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $primaryKey = 'PAY_ID';
    protected $fillable = [
        'BOOK_ID', 'CARD_NO', 'EXP_DATE', 'CVV', 'PRICE'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'BOOK_ID', 'BOOK_ID');
    }
}
