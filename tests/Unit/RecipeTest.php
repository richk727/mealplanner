<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecipeTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_has_a_path()
    {
        $recipe = factory('App\Recipe')->create();

        $this->assertEquals('/recipes/' . $recipe->id, $recipe->path());
    }

    /** @test */
    public function it_belongs_to_an_owner()
    {
        $recipe = factory('App\Recipe')->create();

        $this->assertInstanceOf('App\User', $recipe->owner);
    }
}
