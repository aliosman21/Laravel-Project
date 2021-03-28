<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable=[
        'accompany_number',
        'price',
        'status',
        'start_date',
        'end_date',
        'client_id',
        'room_id'
    ];
    public function rooms()
    {
        return $this->hasOne(Room::class);
    }
}
