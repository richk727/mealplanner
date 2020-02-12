@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-4">
            <div class="card">
                <form method="POST" action="/recipes">
                    <div class="card__body">
                        <h1 class="text-center mb-4">Create a recipe!</h1>
                        @csrf 
                        <div class="form-group row">
                            <label for="title" class="col-md-12 col-form-label">{{ __('Title') }}</label>

                            <div class="col-md-12">
                                <input
                                    class="form-control"
                                    type="text"
                                    name="title"
                                    placeholder="The best recipe ever!">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-12 col-form-label">{{ __('Description') }}</label>
                            <div class="col-md-12">
                                <textarea
                                    class="form-control"
                                    name="description"
                                    rows="5"
                                    placeholder="A breif overview of your awesome recipe!"></textarea>
                            </div>
                        </div>
                        @if ($errors->any)
                        <div class="form-errors">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach 
                        </div>
                        @endif

                        
                    </div>
                    <div class="card__footer">
                        <button class="button button-primary button--full" type="submit">Submit Recipe</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection