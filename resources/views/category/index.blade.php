@extends('components.layout')

@section('title', 'Categorys')

@section('content')

<h1>Categorys</h1>

@include('components.alert.success_message')

<div class="row">
    <div class="col">
        <a href="{{ url('category/create') }}" class="btn btn-primary">Create</a>
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
@foreach($categorys as $category)
<tr>
    <th scope="row">{{ $category->id }}</th>
    <td>
        <div>{{ $category->name }}</div>
    </td>
    <td>
        {{($category->is_active == 1) ? 'Active' : 'Disable' }}
    </td>
    <td>
        <a href="{{ route('categorys.edit', ['id' => $category->id]) }}" class="btn btn-info">Edit</a>
    </td>
    <td>
        <form action="{{ route('categorys.delete', ['id' => $category->id]) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </td>
</tr>
@endforeach
</table>
{{ $categorys->links('components.pagination') }}
@endsection