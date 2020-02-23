<?php

namespace Tests\Feature;

use App\Recipe;
use App\Ingredient;
use Tests\TestCase;
use Facades\Tests\Setup\RecipeFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecipeIngredientsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function guests_cannot_add_ingredients_to_recipes()
    {
        $project = factory(Recipe::class)->create();

        $this->post($project->path() . '/ingredients')->assertRedirect('login');
    }

   /** @test */
    public function only_the_owner_of_a_recipe_may_add_ingredients()
    {
        $this->signIn();

        $project = factory(Recipe::class)->create();
        
        $attributes = [
            'title' => 'Test Ingredient'
        ];

        $this->post($project->path() . '/ingredients', $attributes)
            ->assertStatus(403);

        $this->assertDatabaseMissing('ingredients', $attributes);
    }

    /** @test */
    public function only_the_owner_of_a_recipe_may_update_ingredients()
    {
        $this->signIn();

        $recipe = RecipeFactory::withIngredients(1)
            ->create();

        $attributes = [
            'title' => 'Changed Ingredient'
        ];

        $this->patch($recipe->ingredients->first()->path(), $attributes)
            ->assertStatus(403);

        $this->assertDatabaseMissing('ingredients', $attributes);
    }

    /** @test */
    public function a_recipe_can_have_ingredients()
    {        
        $recipe = RecipeFactory::ownedBy($this->signIn())
            ->create();

        $attributes = [
            'title' => 'Test Ingredient'
        ];

        $this->post($recipe->path() . '/ingredients', $attributes);

        $this->assertDatabaseHas('ingredients', $attributes);

        $this->get($recipe->path())
            ->assertSee('Test Ingredient');
    }

    /** @test */
    public function an_ingredient_can_be_updated()
    {
        $recipe = RecipeFactory::ownedBy($this->signIn())
            ->withIngredients(1)
            ->create();

        $this->patch($recipe->ingredients->first()->path(), [
            'title' => 'Changed ingredient'
        ]);
        
        $this->assertDatabaseHas('ingredients', [
            'title' => 'Changed ingredient'
        ]);
    }

    /** @test */
	public function unauthorized_users_cannot_delete_an_ingredient()
	{        
		$ingredient = factory(Ingredient::class)->create();

		$this->delete($ingredient->path())
			->assertRedirect('/login');

		$user = $this->signIn();

		$this->delete($ingredient->path())
            ->assertStatus(403);
            
        $this->actingAs($ingredient->recipe->owner)
            ->delete($ingredient->path());

        $this->assertDatabaseMissing('ingredients', ['title' => $ingredient->title]);
	}

    /** @test */
    public function an_ingredient_requires_a_title()
    {
        $recipe = RecipeFactory::ownedBy($this->signIn())
            ->create();

        $attributes = factory(Ingredient::class)->raw(['title' => '']);

        $this->post($recipe->path() . '/ingredients', $attributes)
            ->assertSessionHasErrors('title');
    }
}
