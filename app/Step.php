<?php

namespace App;

use App\Recipe;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'body'
    ];

    /**
     * Get recipe this step belongs to
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    /**
     * Get the path to the step
     * 
     * @return string
     */
    public function path()
    {
        return "{$this->recipe->path()}/steps/{$this->id}";
    }
}
