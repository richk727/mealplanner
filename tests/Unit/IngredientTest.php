<?php

namespace Tests\Unit;

use App\Recipe;
use App\Ingredient;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IngredientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_recipe()
    {
        $ingredient = factory(Ingredient::class)->create();

        $this->assertInstanceOf(Recipe::class, $ingredient->recipe);
    }

    /** @test */
    public function it_has_a_path()
    {
        $ingredient = factory(Ingredient::class)->create();

        $this->assertEquals('/recipes/' . $ingredient->recipe->id . '/ingredients/' . $ingredient->id, $ingredient->path());

    }
}
