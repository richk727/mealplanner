@extends('layouts.app')

@section('content')

    <div class="row justify-content-space-between mb-4 py-4">
        <div class="col-md-6">
            <div class="text-large"><a class="text-muted" href="/recipes">My Recipes</a>  / <span class="text-primary">{{ $recipe->title }}</span></div>
        </div>
        
        <div class="col-md-6 text-md-right d-flex justify-content-end">
            <form action="{{ $recipe->path() }}" method="post">
                @method("DELETE")
                @csrf
                <button type="submit" class="button button-muted text-red">Delete Recipe</button>            
            </form>
            <a class="button button-muted" href="{{ $recipe->path() }}">Cancel Editing</a>            
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
                        <div class="recipe__content pr-4 pb-4">                            
                            <form class="mb-4" action="{{ $recipe->path() }}" method="POST" id="recipe-form">
                                @csrf 
                                @method('PATCH') 
                                <div class="my-4">
                                    <label for="title">Title</label>
                                    <input class="form-control"
                                        type="text"
                                        name="title"
                                        placeholder="Title of my awesome recipe!"
                                        value="{{ $recipe->title }}">
                                </div>
                                @if ($errors->has('title'))
                                    <div class="form-errors">
                                        @foreach ($errors->get('title') as $error)
                                            <div class="form-error">{{ $error }}</div>
                                        @endforeach
                                    </div>
                                @endif

                                <p>
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="4">{{ $recipe->description }}</textarea>
                                </p>
                                @if ($errors->has('description'))
                                    <div class="form-errors">
                                        @foreach ($errors->get('description') as $error)
                                            <div class="form-error">{{ $error }}</div>
                                        @endforeach
                                    </div>
                                @endif
                                <button class="btn btn-success btn-sm text-white" type="submit" onclick="document.getElementById('recipe-form').submit()">Save Changes</button>
                            </form>

                            <h3>Methods</h3>
                            <ol>                            
                                @foreach ($recipe->steps as $step)           
                                    <li>
                                        <div class="d-flex justify-content-between mb-2 d-flex align-items-center">
                                            <form action="{{ $step->path() }}" method="POST" class="mr-4" style="width: 100%;">
                                                @csrf
                                                @method('PATCH')
                                                <input class="form-control" type="text" name="body" value="{{ $step->body }}">                                        
                                            </form>
                                            <form action="{{ $step->path() }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit" title="Remove Step">X</button>                                
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ol>
                            <form action="{{ $recipe->path() . '/steps' }}" method="POST" class="d-flex align-items-center">
                                @csrf
                                <input class="form-control mr-2" type="text" name="body" placeholder="Add a step to this recipe...">
                                <button class="btn btn-success text-white" type="submit" title="Add Step">+</button> 
                            </form>
                        </div>
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
                                <div class="d-flex justify-content-between mb-2 d-flex align-items-center">
                                    <form action="{{ $ingredient->path() }}" method="POST"  class="mr-4" style="width: 100%;">
                                        @csrf
                                        @method('PATCH')
                                        <input class="form-control" type="text" name="title" value="{{ $ingredient->title }}">                                            
                                    </form>

                                    <form action="{{ $ingredient->path() }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit" title="Remove Ingredient">X</button>                                
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <form action="{{ $recipe->path() . '/ingredients' }}" method="POST" class="d-flex align-items-center">
                        @csrf
                        <input class="form-control mr-2" type="text" name="title" placeholder="Add an ingredient...">
                        <button class="btn btn-success text-white" type="submit" title="Add Ingredient">+</button>      
                    </form>
                </div>                
            </div>
        </div>
    </div>
@endsection