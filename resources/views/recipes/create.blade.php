@extends('layouts.app')

@section('content')
    <h1>Create a recipe!</h1>
    <form method="POST" action="/recipes">
        @csrf 
        <div>
            <label for="title">Title</label>
            <input
                type="text"
                name="title"
                placeholder="The best recipe ever!">
        </div>
        <div>
            <label for="description">Description</label>
            <textarea
                name="description"
                rows="5"
                placeholder="A breif overview of your awesome recipe!"></textarea>
        </div>
        @if ($errors->any)
        <div class="form-errors">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach 
        </div>
        @endif

        <button type="submit">Submit Recipe</button>
    </form>
@endsection