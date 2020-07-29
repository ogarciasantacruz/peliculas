<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group', 'name', 'description'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
                
    ];


    protected $dates = [
        'release_date'
    ];

    /*
    ***********************************************************************
        >>>> Relationships
    ***********************************************************************
    */

    /**
    * Get the roles asociated to this permissions
    * @var array
    */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
