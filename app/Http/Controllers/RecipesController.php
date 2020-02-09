<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Http\Request;

class RecipesController extends Controller
{
    /**
     * View all recipes
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = auth()->user()->recipes;

        return view('recipes.index', compact('recipes'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    /**
     * Persists a new recipe
     * 
     * @return mixed
     */
    public function store()
    {
        // Validate
        $attributes = $this->validateRequest();
        // Persist
        auth()->user()->recipes()->create($attributes);        
        // Redirect
        return redirect('recipes');
    }

    /**
     * Show a recipe
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        if(auth()->user()->isNot($recipe->owner) ) {
            abort(403);
        };
        
        return view('recipes.show', compact('recipe')); 
    }

    /**
     * Validate the request attributes
     * 
     * @return array
     */
    public function validateRequest()
    {
        return request()->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|max:150'
        ]);
    }
}
