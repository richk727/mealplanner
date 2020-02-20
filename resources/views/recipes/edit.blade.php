@extends('layouts.app')

@section('content')
    <form action="{{ $recipe->path() }}" method="POST">
        @csrf 
        @method('PATCH') 
        <div class="row justify-content-space-between mb-4 py-4">
            <div class="col-md-6">
                <div class="text-large"><a class="text-muted" href="/recipes">My Recipes</a>  / <span class="text-primary">{{ $recipe->title }}</span></div>
            </div>
            
            <div class="col-md-6 text-md-right">
                <a class="button button-muted" href="{{ $recipe->path() }}">Cancel Editing</a>
                <button class="button button-primary" type="submit">Save Changes</button>
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
                            <h3 class="my-4">
                                <input
                                    type="text"
                                    name="title"
                                    placeholder="Title of my awesome recipe!"
                                    value="{{ $recipe->title }}">
                            </h3>
                            <p>
                                <textarea name="description" id="description" rows="4">{{ $recipe->description }}</textarea>
                            </p>
                            <ol>                            
                                @foreach ($recipe->steps as $step)                     
                                    <li>{{ $step->body }}</li>
                                @endforeach
                            </ol>                
                        </div>
                    </div>                   
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card__body">
                        <h3>Ingredients</h3>
                        <ul>
                            @foreach ($recipe->ingredients as $ingredient)                     
                                <li>{{ $ingredient->title }}</li>
                            @endforeach
                        </ul>
                    </div>                
                </div>
            </div>
        </div>
    </form>
@endsection