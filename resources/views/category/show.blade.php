@extends('layouts.app')

@section('content')
<div class="page-content">
    <div class="container">
        <h1>{{$post->title}}</h1>
        <small class="author">{{$post->user->name}}</small>   
        <!-- <div class="toolbox">
            <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
            <button class="btn btn-danger" onclick="deletePost({{ $post->id }})">Delete</button>

        </div> -->
        <div class="content">
            {{$post->content}}
        </div>
    </div>
</div>
<form id="delete-form" action="/posts/id" method="post">
    <input type="hidden" name="_method" value="delete">
    @csrf
</form>
@endsection
