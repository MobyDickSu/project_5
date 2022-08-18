@extends('layouts.app')

@section('content')
<div class="page-content">
    <div class="container">
        <h1>Category</h1>
        <div class="clearfix toolbox">
                <a href="/category/create" class="btn btn-primary">create category</a>
                </br>
                </br>
        </div>
        <ul class="list-group navbar-light">
            @foreach ($categories as $key => $category)
                <li class="list-group-item clearfix">
                    <div class="float-left">
                        <div class="title">{{$category->name}}</div>
                    </div>
                    <span class="float-right">
                        <a href="/category/{{$category->id}}/edit" class="btn btn-primary">Edit</a>
                        <button class="btn btn-danger" onclick="deleteCategory({{ $category->id }})">Delete</button>
                    </span>
                </li>
            @endforeach
        </ul>
    </div>    
</div>
<form id="delete-form" action="/category/id" method="post">
    <input type="hidden" name="_method" value="delete">
    @csrf
</form>
@endsection

