<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Client as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\NotifyApproval;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;
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
        'gender',
        'avatar_img',
        'user_id'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
