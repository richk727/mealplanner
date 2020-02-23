<?php

namespace App;

use App\Recipe;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
     /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'title'
    ];

    /**
     * All the relationships to be touched
     * 
     * @var array
     */
    protected $touches = ['recipe'];
    
    /**
     * The recipe the ingredient belongs to
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    /**
     * Get the path of the ingredient
     * 
     * @return string
     */
    public function path()
    {
        return "{$this->recipe->path()}/ingredients/{$this->id}";
    }
}
