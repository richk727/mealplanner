<?php

namespace Tests\Feature;

use App\Recipe;
use Tests\TestCase;
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
    public function only_the_recipe_owner_may_add_ingredients()
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
    public function a_recipe_can_have_ingredients()
    {        
        $this->signIn();

        $recipe = auth()->user()->recipes()->create(
            factory(Recipe::class)->raw()
        );

        $attributes = [
            'title' => 'Test Ingredient'
        ];

        $this->post($recipe->path() . '/ingredients', $attributes);

        $this->assertDatabaseHas('ingredients', $attributes);

        $this->get($recipe->path())
            ->assertSee('Test Ingredient');
    }
}
