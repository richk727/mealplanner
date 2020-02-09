@extends('layouts.app')

@section('content')
    {{ $recipe->title }}
    {{ $recipe->description }}
@endsection