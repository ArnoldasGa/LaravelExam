@extends('components.layout')

@section('title', 'Ingredients')

@section('content')

<h1>Ingredients</h1>

@include('components.alert.success_message')

<div class="row">
    <div class="col">
        <a href="{{ url('ingredient/create') }}" class="btn btn-primary">Create</a>
    </div>
</div>

<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Is active</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
@foreach($ingredients as $ingredient)
<tr>
    <th scope="row">{{ $ingredient->id }}</th>
    <td>
        <div>{{ $ingredient->name }}</div>
    </td>
    <td>
        {{($ingredient->is_active == 1) ? 'Active' : 'Disable' }}
    </td>
    <td>
        <a href="{{ route('ingredients.edit', ['id' => $ingredient->id]) }}" class="btn btn-info">Edit</a>
    </td>
    <td>
        <form action="{{ route('ingredients.delete', ['id' => $ingredient->id]) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>
@endforeach
</table>
{{ $ingredients->links('components.pagination') }}
@endsection