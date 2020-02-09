<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class UserTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function has_recipes()
    {
        
        $user = factory('App\User')->create();

        $this->assertInstanceOf(Collection::class, $user->recipes);

    }
}
