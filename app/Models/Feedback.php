<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    

    protected $fillable = [
        
        
        'comment',
        'user_id',
    ];

 public function user()
{
    return $this->belongsTo(\App\Models\User::class, 'user_id');
}

}
