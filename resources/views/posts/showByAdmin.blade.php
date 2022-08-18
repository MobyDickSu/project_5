@extends('layouts.app')

@section('content')
<div class="page-content">
    <div class="container">
        <h1 class="mb-0">{{$post->title}}</h1>
        @if (isset($post->category)) 
        <small class="d-block text-muted">{{ $post->category->name }}</small>
        @endif
        <small class="d-block text-muted">{{$post->tagsString()}}</small>
        <small class="d-block text-muted">{{$post->user->name}}</small>

        <div class="toolbox text-left mt-3">
            <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
            <button class="btn btn-danger" onclick="deletePost({{ $post->id }})">Delete</button>

        </div>

        @if (!$post->thumbnail)
        <div class="text-danger">no thumbnail</div>
        @else
        <img width="640" src="{{$post->thumbnail}}" alt="thumbnail">
        @endif
        
        <div class="content ">
            {{$post->content}}
        </div>
    </div>
</div>
<form id="delete-form" action="/posts/id" method="post">
    <input type="hidden" name="_method" value="delete">
    @csrf
</form>
@endsection
