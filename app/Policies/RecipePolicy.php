<?php

namespace App\Policies;

use App\Recipe;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecipePolicy
{
    use HandlesAuthorization;

    public function update(User $user, Recipe $recipe)
    {
        return $user->is($recipe->owner);
    }        
}
