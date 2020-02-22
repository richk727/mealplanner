<?php

namespace Tests\Unit;

use App\Step;
use App\Recipe;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StepTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_recipe()
    {
        $step = factory(Step::class)->create();

        $this->assertInstanceOf(Recipe::class, $step->recipe);
    }
    
    /** @test */
    public function it_has_a_path()
    {
        $step = factory(Step::class)->create();

        $this->assertEquals('/recipes/' . $step->recipe->id . '/steps/' . $step->id, $step->path());

    }
}
