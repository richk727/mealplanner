<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'title',
        'description'
    ];

    /**
     * Get the path to the project
     * 
     * @return string
     */
    public function path()
    {
        return "/recipes/{$this->id}";
    }


    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
