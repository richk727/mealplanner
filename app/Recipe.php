<?php

namespace App;

use App\Step;
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

    /**
     * Retrieves the owner of the recipe
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retrieves the Steps of a Recipe
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    /**
     * Adds a step to a recipe
     * 
     * @param array $attributes 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addStep($attributes)
    {
        return $this->steps()->create($attributes);
    }

    /**
     * Retrieves the Steps of a Recipe
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }

    /**
     * Adds an ingredient to a recipe
     * 
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addIngredient($attributes)
    {
        return $this->ingredients()->create($attributes);
    }
}
