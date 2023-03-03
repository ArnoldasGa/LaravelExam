@extends('components.guestLayout')

@section('title', 'Recipes')

@section('content')
<div class = "row" style="justify-content: space-around;">
    @foreach ($recipes as $recipe)
    <div class="card" style="width: 350px;">
      <img src="{{asset('storage/'.$recipe->image)}}" class=" img-fluid" alt="No image added">
      <div class="card-body">
        <h5 class="card-title">{{$recipe->name}}</h5>
        <p class="card-text">{{$recipe->description}}</p>
        <a href="{{ route('recipe', ['id' => $recipe->id]) }}" class="btn btn-primary">Open recipe</a>
      </div>
    </div>
    @endforeach
</div>
@endsection