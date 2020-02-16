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
                        <img class="img-fluid" src="https://placedog.net/445/335?random" alt="" srcset="">
                    </div>
                    <div class="col-md-6">
                        <h3 class="my-4">{{ $recipe->title }}</h3>
                        <p>{{ $recipe->description }}</p>
                        <ol>                            
                            @foreach ($recipe->steps as $step)                     
                                <li>{{ $step->body }}</li>
                            @endforeach
                        </ol> 
                        <form action="{{ $recipe->path() . '/steps' }}" method="POST">
                            @csrf
                            <input type="text" name="body" placeholder="Add a step to this recipe...">
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card__body">
                    <h3>Ingredients</h3>
                </div>                
            </div>
        </div>
    </div>

@endsection