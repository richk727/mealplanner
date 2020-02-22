<?php

namespace App\Http\Controllers;

use App\Step;
use App\Recipe;
use Illuminate\Http\Request;

class RecipeStepsController extends Controller
{
    /**
     * Persists a new recipe step
     * 
     * @return mixed
     */
    public function store(Recipe $recipe)
    {
        // Validate
        if(auth()->user()->isNot($recipe->owner)) {
            abort(403);
        }
        $attributes = $this->validateRequest();        
        // Persist
        $recipe->addStep($attributes);   
        // Redirect
        return redirect($recipe->path() . '/edit');
    }

    /**
     * Update a step
     * 
     * @param Recipe $recipe
     * @param Step $step
     * 
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Recipe $recipe, Step $step)
    {
        if(auth()->user()->isNot($recipe->owner) ) {
            abort(403);
        };
        
        $attributes = $this->validateRequest();

        $step->update($attributes);

        return redirect($recipe->path() . '/edit');
    }

    /**
     * Validate the request attributes
     * 
     * @return array
     */
    public function validateRequest()
    {
        return request()->validate([
            'body' => 'sometimes|required|min:3'
        ]);
    }
}
