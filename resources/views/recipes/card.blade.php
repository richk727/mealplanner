<div class="card">
    <div class="card__header">
        <img class="img-fluid" src="https://source.unsplash.com/random/326x245?food" alt="" srcset="">        
    </div>
    <div class="card__body">
        <h3 class="">
            <a class="text-default-700" href="{{ $recipe->path() }}">{{ $recipe->title }}</a>
        </h3>
        <p class="">{{ Str::limit($recipe->description, 75) }}</p>
    </div>
    <div class="card__footer"></div>
</div>