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

    /**
     * Create a new recipe
     * 
     * @return \Illuminate\Http\Response
     */
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
     * @param Recipe $recipe
     * 
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Recipe $recipe)
    {
        if(auth()->user()->isNot($recipe->owner) ) {
            abort(403);
        };
        
        return view('recipes.show', compact('recipe')); 
    }

    /**
     * Update a recipe
     * 
     * @param Recipe $recipe
     * 
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Recipe $recipe)
    {
        if(auth()->user()->isNot($recipe->owner) ) {
            abort(403);
        };
        
        $attributes = $this->validateRequest();

        $recipe->update($attributes);

        return redirect($recipe->path());
    }

    /**
     * Edit a recipe
     * 
     * @param Recipe $recipe
     * 
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Recipe $recipe)
    {
        if(auth()->user()->isNot($recipe->owner) ) {
            abort(403);
        };
        
        return view('recipes.edit', compact('recipe')); 
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
