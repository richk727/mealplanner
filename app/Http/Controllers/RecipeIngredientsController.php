<?php

namespace App\Http\Controllers;

use App\Ingredient;
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
        return redirect($recipe->path() . '/edit');
    }

    /**
     * Update an ingredient
     * 
     * @param Recipe $recipe
     * @param Ingredient $ingredient
     * 
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Recipe $recipe, Ingredient $ingredient)
    {
        $this->authorize('update', $ingredient->recipe);

        $attributes = $this->validateRequest();

        $ingredient->update($attributes);

        return redirect($recipe->path() . '/edit');
    }

    /**
     * Delete an ingredient
     * 
     * @param Recipe $recipe
     * @param Ingredient $ingredient
     * 
     * * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe, Ingredient $ingredient)
    {
        $this->authorize('update', $ingredient->recipe);

        $ingredient->delete();
        
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
            'title' => 'required|min:2'
        ]);
    }
}
