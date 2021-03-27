<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Client as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\NotifyApproval;
use Illuminate\Database\Eloquent\Model;

class Client extends Authenticatable
{
    use HasFactory,Notifiable;



    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'country',
        'gender'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
