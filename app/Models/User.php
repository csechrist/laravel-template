<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Traits\Uuids;

class User extends Authenticatable implements MustVerifyEmail {
    use Notifiable, Uuids;

    /**
    * Indicates if the IDs are auto-incrementing.
    *
    * @var bool
    */
    public $incrementing = false;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
    * Get the authentication methods for a user
    *
    *
    */

    public function connections() {
        return $this->hasMany( 'App\Models\UserConnection' );
    }
}
