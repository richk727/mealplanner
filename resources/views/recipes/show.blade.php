@extends('layouts.app')

@section('content')
    <div class="row justify-content-space-between mb-4 py-4">
        <div class="col-md-6">
            <div class="text-large"><a class="text-muted" href="/recipes">My Recipes</a>  / <span class="text-primary">{{ $recipe->title }}</span></div>
        </div>
        
        <div class="col-md-6 text-md-right">
            <a class="button button-primary" href="{{ $recipe->path() . '/edit' }}">Edit Recipe</a>
        </div>        
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">
                        <img class="img-fluid" src="https://source.unsplash.com/random/445x335?food" alt="" srcset="">
                    </div>
                    <div class="col-md-6">
                        <div class="py-4 pr-4">
                            <h3 class="my-4">{{ $recipe->title }}</h3>
                            <p class="mb-4">{{ $recipe->description }}</p>
                            <h3 class="mb-4">Methods</h3>
                            <ol class="list-group">                            
                                @forelse ($recipe->steps as $step)                     
                                    <li class="list-group-item">{{ $step->body }}</li>
                                @empty
                                    <li class="list-group-item">This recipe has no steps!</li>
                                @endforelse
                            </ol>
                        </div>                                   
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card__body">
                    <h3 class="mb-4">Ingredients</h3>
                    <ul class="list-group">
                        @forelse ($recipe->ingredients as $ingredient)                     
                            <li class="list-group-item">{{ $ingredient->title }}</li>
                        @empty 
                            <li class="list-group-item">This recipe has no ingredients!</li>
                        @endforelse
                    </ul>
                </div>                
            </div>
        </div>
    </div>

@endsection