<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'release_date', 'description', 'status', 'gender_id'
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
    * Gender associated with a movie
    * @var collection
    */
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

}
