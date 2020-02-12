@extends('layouts.app')

@section('content')
    <div class="row justify-content-space-between mb-4 py-4">
        <div class="col-md-6">
            <div class="text-large text-primary">My Recipes</div>
        </div>
        
        <div class="col-md-6 text-md-right">
            <a class="button button-primary" href="/recipes/create">Add Recipe</a>
        </div>        
    </div>
    
    <div class="row">

        @forelse ($recipes as $recipe)
            <div class="col-sm-6 col-md-4 col-lg-3 d-flex">
                @include ('recipes.card')
            </div>
        @empty
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card">
                    <div class="card__header">
                        <h3 class="">
                            :O You don't have any recipes!
                        </h3>
                    </div>
                    <div class="card__body">
                        <p class="">Get started and add your favorite recipes! 🍔🍕🍉🥓🍗 </p>
                    </div>
                    <div class="card__footer"></div>
                </div>
            </div>
        @endforelse
    </div>
    
@endsection