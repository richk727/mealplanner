<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Http\Request;

class RecipeIngredientsController extends Controller
{
    /**
     * Persists a new recipe ingredient
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
        $recipe->addIngredient($attributes);   
        // Redirect
        return redirect($recipe->path());
    }

    /**
     * Validate the request attributes
     * 
     * @return array
     */
    public function validateRequest()
    {
        return request()->validate([
            'title' => 'required|min:2'
        ]);
    }
}
