<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable implements BannableContract
{
    use HasFactory, Notifiable,HasRoles,HasApiTokens,Bannable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     public function shouldApplyBannedAtScope()
    {
        return true;
    }
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'national_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
