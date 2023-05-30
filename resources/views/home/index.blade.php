@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <h1>Dashboard</h1>
        <p class="lead">Only authenticated users can access this section.</p>
        <a class="btn btn-lg btn-primary mb-2" href="{{route('roles.index')}}" role="button">Add Role&raquo;</a>&nbsp; <br>
        {{-- <a class="btn btn-lg btn-success mb-2" href="{{route('roles.index')}}" role="button">Add Permission&raquo;</a> <br> --}}
        <a class="btn btn-lg btn-success mb-2" href="{{route('products.index')}}" role="button">Add Product &raquo;</a> <br>
       
        <a class="btn btn-lg btn-warning" href="{{route('users.index')}}" role="button">Add User&raquo;</a>

        


        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        @endguest
    </div>
@endsection