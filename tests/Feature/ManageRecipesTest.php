<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecipesTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_recipe()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $this->get('recipes/create')->assertStatus(200);
        
        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence
        ];

        $this->post('/recipes', $attributes)
            ->assertRedirect('/recipes');

        $this->assertDatabaseHas('recipes', $attributes);

        $this->get('/recipes')->assertSee($attributes['title']);
    }
    
    /** @test */
    public function a_user_can_view_their_recipe()
    {
        $this->be(factory('App\User')->create());
        
        $recipe = factory('App\Recipe')->create(['owner_id' => auth()->id()]);
        
        $this->get($recipe->path())
            ->assertSee($recipe->title)
            ->assertSee($recipe->description);
    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_recipes_of_others()
    {
        $this->be(factory('App\User')->create());
        
        $recipe = factory('App\Recipe')->create();
        
        $this->get($recipe->path())
            ->assertStatus(403);
    }

    /** @test */
    public function guests_cannot_manage_recipes()
    {
        $recipe = factory('App\Recipe')->create();

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
        $recipe = factory('App\Recipe')->create();
        $this->get($recipe->path())->assertRedirect('login');
    }

    /** @test */
    public function a_recipe_requires_a_title()
    {
        $this->signIn();
        $attributes = factory('App\Recipe')->raw(['title' => '']);

        $this->post('/recipes', $attributes)
            ->assertSessionHasErrors('title');
    }   
}
