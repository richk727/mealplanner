@extends('layouts.app')

@section('content')
    <ul>
        @forelse ($recipes as $recipe)
            <li><a href="{{ $recipe->path() }}">{{ $recipe->title }}</a></li>
        @empty
            <li>No recipes yet.</li>   
        @endforelse
    </ul>
@endsection