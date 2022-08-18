@extends('layouts.app')

@section('content')
<div class="page-content">
    <div class="container">
        <h1>Tag</h1>
        
        <ul class="list-group navbar-light">
            @foreach ($tags as $key => $tag)
                <li class="list-group-item clearfix">
                    <div class="float-left">
                        <div class="title">{{$tag->name}}</div>
                    </div>
                    <span class="float-right">
                        <button class="btn btn-danger" onclick="deleteTag({{ $tag->id }})">Delete</button>
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

