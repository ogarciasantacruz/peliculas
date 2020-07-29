<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name' , 'email', 'password', 'phone', 'age', 'active'
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


    /*
    ***********************************************************************
        >>>> Relationships
    ***********************************************************************
    */


    /**
    * Movies associated with a user
    * @var collection
    */
    public function moviesUser()
    {
        return $this->belongsToMany(Movie::class);
    }


    /**
    * Roles associated with a user
    * @var collection
    */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /*
    ***********************************************************************
    >>>> Functions
    ***********************************************************************
    */

    /**
    * Verify is a user owns a specific role as a string or integer
    * @var array
    */
    public function hasRole($role)
    {
        if (is_string($role)) {

            return $this->roles->contains('name', $role);
        }
        
        return !! $role->intersect($this->roles)->count();
    }
}
