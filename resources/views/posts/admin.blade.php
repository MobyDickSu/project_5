@extends('layouts.app')

@section('content')
<div class="page-content">
    <div class="container">
        <div class="clearfix toolbox">
                <a href="/posts/create" class="btn btn-primary">create post</a>
                </br>
                </br>
        </div>
        <ul class="list-group navbar-light">
            @foreach ($posts as $key => $post)
                <li class="list-group-item clearfix">
                    <div class="float-left">
                        <div class="title">{{$post->title}}</div>
                        @if (isset($post->category)) <small class="d-block text-muted">{{$post->category->name}}</small> @endif
                        <small class="author">{{$post->user->name }}</small>
                    </div>
                    <span class="float-right">
                        <a href="/posts/show/{{$post->id}}" class="btn btn-secondary">View</a>
                        <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
                        <button class="btn btn-danger" onclick="deletePost({{ $post->id }})">Delete</button>
                    </span>
                </li>
            @endforeach
        </ul>
    </div>    
</div>
<form id="delete-form" action="/posts/id" method="post">
    <input type="hidden" name="_method" value="delete">
    @csrf
</form>
@endsection

