@extends('components.layout')

@section('title', 'Recipe-edit')

@section('content')

<h1>Create recipe:</h1>

<form action="{{ url('recipe/create') }}" method="post"  enctype="multipart/form-data" class="row g-3">
    @csrf
<div class="input-group">
    <span class="input-group-text">
        Name: 
    </span>
    <input type="text" name="name" value="{{old('name')}}" placeholder="Input recipe name" class="form-control @error('name') is-invalid @enderror" >
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="input-group">
    <span class="input-group-text">
        Category: 
    </span>
    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
        <option value="">-</option>
        @foreach($categories as $category)
            <option @if(old('category_id')) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category_id')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class=" mb-3">
        <span class="input-group-text">
            Ingredients: 
        </span>
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
        <input type="text" name="description" class="form-control  @error('description') is-invalid @enderror" aria-label="With textarea" placeholder="Desciption" value="{{old('description')}}">
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
</div>
<div  class="input-group mb-3">
    <div class="form-check form-switch">
        <input name ="is_active" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="1">
        <label class="form-check-label" for="flexSwitchCheckDefault">Is it active ?</label>
    </div>
</div>
<div class="input-group mb-3">
        <label class="input-group-text" for="inputGroupFile01">Update</label>
        <input  name="image" type="file" class="form-control @error('image') is-invalid @enderror" id="inputGroupFile01">
        @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
</div>

<div class="col-12 mt-2">
    <button type="submit" class="btn btn-info">Create</button>
</div>
</form>
@endsection