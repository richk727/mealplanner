<?php

namespace Tests\Feature;

use App\Recipe;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\RecipeFactory;

class RecipesTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_recipe()
    {
        $this->signIn();

        $this->get('recipes/create')->assertStatus(200);
        
        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence
        ];

        $response = $this->post('/recipes', $attributes);

        $recipe = Recipe::where($attributes)->first();

        $response->assertRedirect($recipe->path());

        $this->get('/recipes')
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description']);
    }
    
    /** @test */
    public function a_user_can_view_their_recipe()
    {
        $recipe = RecipeFactory::ownedBy($this->signIn())
            ->create();
        
        $this->get($recipe->path())
            ->assertSee($recipe->title)
            ->assertSee($recipe->description);
    }

    /** @test */
    public function a_user_can_edit_their_recipe()
    {
        $recipe = RecipeFactory::ownedBy($this->signIn())
            ->create();
        
        $this->get($recipe->path() . '/edit')
            ->assertSee($recipe->title)
            ->assertSee($recipe->description);
    }

    /** @test */
    public function a_user_can_update_a_recipe()
    {
        $recipe = RecipeFactory::create();        
        
        $attributes = [
            'title' => 'Changed Title',
            'description' => 'Changed decription'
        ];

        $this->actingAs($recipe->owner)
            ->patch($recipe->path(), $attributes)
            ->assertRedirect($recipe->path());       
            
        $this->get($recipe->path() . '/edit')
            ->assertOk();
        
        $this->assertDatabaseHas('recipes', $attributes);
    }

    /** @test */
	public function unauthorized_users_cannot_delete_recipes()
	{
        $recipe = RecipeFactory::create();
        
		$this->delete($recipe->path())
			->assertRedirect('/login');

		$user = $this->signIn();

		$this->delete($recipe->path())
            ->assertStatus(403);
        
        $this->actingAs($recipe->owner)
            ->delete($recipe->path());

        $this->assertDatabaseMissing('recipes', ['title' => $recipe->title]);
	}

    /** @test */
    public function an_authenticated_user_cannot_update_the_recipes_of_others()
    {
        $this->signIn();
        
        $recipe = factory(Recipe::class)->create();
        
        $this->patch($recipe->path(), [])
            ->assertStatus(403);
    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_recipes_of_others()
    {
        $this->signIn();
        
        $recipe = factory(Recipe::class)->create();
        
        $this->get($recipe->path())
            ->assertStatus(403);
    }

    /** @test */
    public function guests_cannot_manage_recipes()
    {
        $recipe = factory(Recipe::class)->create();

        $this->get('/recipes')->assertRedirect('login');
        $this->get($recipe->path())->assertRedirect('login');
        $this->post('/recipes', $recipe->toArray())
            ->assertRedirect('login');
    }

    /** @test */
    public function guests_may_not_view_recipes()
    {
        $this->get('/recipes')->assertRedirect('login');
    }

    /** @test */
    public function guests_may_not_view_a_single_recipe()
    {
        $recipe = factory(Recipe::class)->create();
        $this->get($recipe->path())->assertRedirect('login');
    }

    /** @test */
    public function a_recipe_requires_a_title()
    {
        $this->signIn();
        $attributes = factory(Recipe::class)->raw(['title' => '']);

        $this->post('/recipes', $attributes)
            ->assertSessionHasErrors('title');
    }   
}
