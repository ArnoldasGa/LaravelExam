@extends('components.guestLayout')

@section('title', 'Recipes')

@section('content')

<form class="input-group input-group-sm mb-3" >
    <div class="input-group-prepend">
      <span class="input-group-text" id="inputGroup-sizing-sm">Name</span>
    </div>
    <input type="text" class="form-control" style="flex-grow: 5;" name="search" aria-label="Small" placeholder="Input name" aria-describedby="inputGroup-sizing-sm">
    <select name="category" class="form-select form-select-lg bg-secondary text-white" aria-label=".form-select-lg example">
      <option value="">Categories</option>
      @foreach($categorys as $category)
        <option class="dropdown-item" name="category" value="{{$category->name}}">{{$category->name}}</option>
      @endforeach
    </select>
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="submit" >Search</button>
  </div>
</form>


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
{{ $recipes->links('components.pagination') }}
@endsection