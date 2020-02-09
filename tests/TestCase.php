<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Creates a user a signs them in
     * 
     * @return App\User
     */
    protected function signIn($user = null)
    {
        $user = $user ?: factory('App\User')->create();

        $this->actingAs($user);

        return $user;
    }
}
