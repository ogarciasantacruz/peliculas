<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
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
    * Get the users asociated with this role
    * @var array
    */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
    * Get the permissions asociated with this role
    * @var array
    */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /*
    ***********************************************************************
        >>>> Methods
    ***********************************************************************
    */

    /**
    * Assing a permission to a role
    * @var array
    */
    public function givePermissionTo(Permission $permission)
    {
        return $this->permissions()->save($permission);
    }
}
