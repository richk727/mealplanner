<?php

namespace Tests\Feature;

use App\Step;
use App\Recipe;
use Facades\Tests\Setup\RecipeFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecipeStepsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    function guests_cannot_add_a_step()
    {
        $recipe = factory(Recipe::class)->create();

        $attributes = [
            'body' => 'Test step',
        ];

        $this->post($recipe->path() . '/steps', $attributes)
            ->assertRedirect('login');
    }

    /** @test */
    function only_the_owner_of_a_recipe_may_add_steps()
    {
        $this->signIn();

        $recipe = factory(Recipe::class)->create();

        $attributes = [
            'body' => 'Test step',
        ];

        $this->post($recipe->path() . '/steps', $attributes)
            ->assertStatus(403);

        $this->assertDatabaseMissing('steps', ['body' => 'Test step']);
    }

    /** @test */
    public function a_recipe_can_have_steps()
    {
        $this->signIn();

        $recipe = auth()->user()->recipes()->create(
            factory(Recipe::class)->raw()
        );

        $attributes = [
            'body' => 'Test step',
        ];

        $this->post($recipe->path() . '/steps', $attributes);
        
        $this->get($recipe->path())
            ->assertSee('Test step');
    }

    /** @test */
    public function a_step_can_be_updated() {

        $this->withoutExceptionHandling();        
        $this->signIn();

        $recipe = auth()->user()->recipes()->create(
            factory(Recipe::class)->raw()
        );

        $step = $recipe->addStep(['body' => 'Example step']);

        $this->patch($step->path(), [
            'body' => 'Changed step'
        ]);
        
        $this->assertDatabaseHas('steps', [
            'body' => 'Changed step'
        ]);
    }

    /** @test */
    public function a_step_requires_a_body()
    {
        $this->signIn();

        $recipe = auth()->user()->recipes()->create(
            factory(Recipe::class)->raw()
        );

        $attributes = factory(Step::class)->raw(['body' => '']);

        $this->post($recipe->path() . '/steps', $attributes)
            ->assertSessionHasErrors('body');
    }
}

