@extends('components.layout')

@section('title', 'Recipes')

@section('content')

<h1>Recipes</h1>

@include('components.alert.success_message')

<div class="row">
    <div class="col">
        <a href="{{ url('recipe/create') }}" class="btn btn-primary">Create</a>
    </div>
</div>

<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Category</th>
        <th>Description</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
@foreach($recipes as $recipe)
<tr>
    <th scope="row">{{ $recipe->id }}</th>
    <td>
        <a href="{{ url('guest/recipe', ['id' => $recipe->id]) }}">{{ $recipe->name }}</a>
    </td>
    <td>
        @if ($recipe->category)
                {{ $recipe->category->name }}
        @endif
    </td>
    <td>
        @if($recipe->description)
            {{ Str::limit($recipe->description, 50) }}
        @endif
    </td>
    <td>
        <a href="{{ route('recipes.edit', ['id' => $recipe->id]) }}" class="btn btn-info">Edit</a>
    </td>
    <td>
        <form action="{{ route('recipes.delete', ['id' => $recipe->id]) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>
@endforeach
</table>
{{ $recipes->links('components.pagination') }}
@endsection