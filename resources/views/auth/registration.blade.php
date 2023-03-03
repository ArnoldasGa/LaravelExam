@extends('components.guestLayout')

@section('title', 'Registration')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form  action="{{route('registration')}}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input name="email" type="email" class="form-control" value="{{old('email')}}" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input name="password" type="password" class="form-control">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Name</label>
        <input name="name" type="text" class="form-control" value="{{old('name')}}" placeholder="Input your name">
    </div>
    <select name="auth">
        <option value=""></option>
        <option value="ADMIN">Admin</option>
        <option value="CUSTOMER">Customer</option>
    </select>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection