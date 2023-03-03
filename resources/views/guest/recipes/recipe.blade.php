@extends('components.guestLayout')

@section('title', 'Recipes')

@section('content')
<div style="display: flex; justify-content: space-between;">
    <img src={{asset('storage/'.$recipe->image)}} width='45%' class="rounded float-start" alt="No image added">
    <div class="card" style="width: 45%;">
        <div class="card-body">
          <h5 class="card-title text-center fw-bold mb-2">{{$recipe->name}}</h5>
          <h6 class="card-subtitle text-center mb-5">{{$recipe->category->name}}</h6>
          <ul class="list-group">
            @if ($recipe->ingredients !== null)
            @foreach($recipe->ingredients as $ingredient)
            <li class="list-group-item">
                <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox">
                <label class="form-check-label" for="firstCheckbox">{{ $ingredient->name }}</label>
            </li>
            @endforeach
            @endif
          </ul>
        </div>
    </div>
</div>
<div class="card mt-5">
    <h5 class="card-title">Description:</h5>
    <p>
        {{$recipe->description}}
    </p>    
</div>

@endsection