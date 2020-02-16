<?php 

namespace Tests\Setup;

use App\User;
use App\Recipe;

class RecipeFactory
{
    /**
     * The owner of the recipe
     * 
     * @var $user
     */
    protected $user;

    /**
     * Set the owner of a recipe
     * 
     * @param User $user
     * 
     * @return $this
     */
    public function ownedBy($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Fully assemble a complete recipe
     * 
     * @return Recipe
     */
    public function create()
    {
        $recipe = factory(Recipe::class)->create([
            'owner_id' => $this->user ?? factory(User::class)
        ]);


        return $recipe;
    }

}