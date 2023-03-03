@extends('components.layout')

@section('title', 'Recipe-edit')

@section('content')

<h1>Edit recipe: {{$recipe->name}}</h1>

<form action="{{ url('recipe/edit', ['id' => $recipe->id]) }}" method="post"  enctype="multipart/form-data" class="row g-3">
    @csrf
<div class="input-group">
    <span class="input-group-text">
        Edit name: 
    </span>
    <input type="text" name="name" value="{{old('name', $recipe->name)}}" class="form-control @error('name') is-invalid @enderror" >
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="input-group">
    <span class="input-group-text">
        Edit category: 
    </span>
    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
        <option value="">-</option>
        @foreach($categories as $category)
            <option @if(old('category_id', isset($recipe->category->id) ? $recipe->category->id : null) == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category_id')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class=" mb-3">
        <span class="input-group-text">
            Edit ingredients: 
        </span>
        @if ($recipe->ingredients !== null)
            @foreach($recipe->ingredients as $setIngredients)
            @if ($setIngredients->is_active)
            <select name="ingredient_id[]" class="form-control @error('ingredient_id[]') is-invalid @enderror">
                <option value="">-</option>
                @foreach($ingredients as $ingredient)
                <option @if(old('ingredient_id[]', isset($setIngredients->id) ? $setIngredients->id : null) == $ingredient->id ) selected @endif  value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                @endforeach
            </select>
            @endif
            @endforeach
        @endif
        <select name="ingredient_id[]" class="form-control @error('ingredient_id[]') is-invalid @enderror">
            <option value="">-</option>
            @foreach($ingredients as $ingredient)
                <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
            @endforeach
        </select>
        @error('ingredient_id[]')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
</div>

<div class="input-group">
        <span class="input-group-text">Description:</span>
        <input type="text" name="description" class="form-control  @error('description') is-invalid @enderror" aria-label="With textarea" value="{{old('description', $recipe->description)}}">
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
</div>
<div  class="input-group mb-3">
    <div class="form-check form-switch">
        <input name ="is_active" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="1" @if($recipe->is_active == 1) checked @endif>
        <label class="form-check-label" for="flexSwitchCheckDefault">Is it active ?</label>
    </div>
</div>
<div>
@if($recipe->image)
<figure class="figure">
    <img src="{{asset('storage/'.$recipe->image)}}" style="width: 400px;" class="figure-img img-fluid rounded" alt="...">
    <figcaption class="figure-caption">Picure that is added now</figcaption>
</figure>
@endif
</div>
<div class="input-group mb-3">
        <label class="input-group-text" for="inputGroupFile01">Update</label>
        <input  name="image" type="file" class="form-control @error('image') is-invalid @enderror" id="inputGroupFile01">
        @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
</div>

<div class="col-12 mt-2">
    <button type="submit" class="btn btn-info">Save</button>
</div>
</form>
@endsection