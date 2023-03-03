@extends('components.layout')

@section('title', 'Category-edit')

@section('content')

<h1>Edit Category: {{$category->name}}</h1>

<form action="{{ url('category/edit', ['id' => $category->id]) }}" method="post"  enctype="multipart/form-data" class="row g-3">
    @csrf
<div class="input-group">
    <span class="input-group-text">
        Edit name: 
    </span>
    <input type="text" name="name" value="{{old('name', $category->name)}}" class="form-control @error('name') is-invalid @enderror" >
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div  class="input-group mb-3">
    <div class="form-check form-switch">
        <input name ="is_active" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="1" @if($category->is_active == 1) checked @endif>
        <label class="form-check-label" for="flexSwitchCheckDefault">Is it active ?</label>
    </div>
</div>

<div class="col-12 mt-2">
    <button type="submit" class="btn btn-info">Save</button>
</div>
</form>
@endsection