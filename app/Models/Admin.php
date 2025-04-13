<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admins';

    protected $fillable = [
        'ADMIN_ID',
        'ADMIN_PASSWORD',
    ];

    protected $hidden = [
        'ADMIN_PASSWORD',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->ADMIN_PASSWORD;
    }
}