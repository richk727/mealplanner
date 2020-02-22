@extends('layouts.app')

@section('content')

    <div class="row justify-content-space-between mb-4 py-4">
        <div class="col-md-6">
            <div class="text-large"><a class="text-muted" href="/recipes">My Recipes</a>  / <span class="text-primary">{{ $recipe->title }}</span></div>
        </div>
        
        <div class="col-md-6 text-md-right">
            <a class="button button-muted" href="{{ $recipe->path() }}">Cancel Editing</a>
            <button class="button button-primary" type="submit" onclick="document.getElementById('recipe-form').submit()">Save Changes</button>
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
                        <form action="{{ $recipe->path() }}" method="POST" id="recipe-form">
                            @csrf 
                            @method('PATCH') 
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
                        </form>

                        <ol>                            
                            @foreach ($recipe->steps as $step)           
                                <li>
                                    <form action="{{ $step->path() }}" method="POST" >
                                        @csrf
                                        @method('PATCH')
                                        <input type="text" name="body" value="{{ $step->body }}">                                            
                                    </form>
                                </li>
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
                    <ul>
                        @foreach ($recipe->ingredients as $ingredient)
                            <li>
                                <form action="{{ $ingredient->path() }}" method="POST" >
                                    @csrf
                                    @method('PATCH')
                                    <input type="text" name="title" value="{{ $ingredient->title }}">                                            
                                </form>
                            </li>
                        @endforeach
                    </ul>
                    <form action="{{ $recipe->path() . '/ingredients' }}" method="POST">
                        @csrf
                        <input type="text" name="title" placeholder="Add an ingredient to this recipe...">
                    </form>
                </div>                
            </div>
        </div>
    </div>
@endsection