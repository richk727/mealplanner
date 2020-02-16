<?php 

namespace Tests\Setup;

use App\Step;
use App\User;
use App\Recipe;

class RecipeFactory
{
    /**
     * Number of steps for the recipe
     * @var int
     */
    protected $stepsCount = 0;

    /**
     * The owner of the recipe
     * 
     * @var $user
     */
    protected $user;

    /**
     * Sets the number of steps created for the recipe
     * 
     * @param int $count
     * @return $this
     */
    public function withSteps($count)
    {
        $this->stepsCount = $count;

        return $this;
    }

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

        factory(Step::class, $this->stepsCount)->create([
            'recipe_id' => $recipe->id
        ]);

        return $recipe;
    }

}