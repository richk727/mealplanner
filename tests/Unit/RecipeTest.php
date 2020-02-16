<?php

namespace Tests\Unit;

use App\Recipe;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecipeTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_has_a_path()
    {
        $recipe = factory(Recipe::class)->create();

        $this->assertEquals('/recipes/' . $recipe->id, $recipe->path());
    }

    /** @test */
    public function it_belongs_to_an_owner()
    {
        $recipe = factory(Recipe::class)->create();

        $this->assertInstanceOf('App\User', $recipe->owner);
    }

    /** @test */
    public function it_can_add_a_step()
    {
        $recipe = factory(Recipe::class)->create();

        $step = $recipe->addStep(['body' => 'Example Step']);

        $this->assertCount(1, $recipe->steps);
        $this->assertTrue($recipe->steps->contains($step));
    }
}
