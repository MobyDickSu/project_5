@extends('layouts.app')

@section('content')
<div class="row"> 
    <div class="col-md-8">
        <div class="page-content">
            <div class="container">
                <h1>{{$post->title}}</h1>
                <div class="full-width">
                    @if (!$post->thumbnail)
                        <img width="320" src="/storage/banner-sm-03.jpg" alt="thumbnail">
                    @else
                        <img width="320" src="{{ $post->thumbnail }}" alt="thumbnail">
                    @endif
                </div>
                <small class="author">{{$post->user->name}}</small>
                @if ($post->category)   
                <small class="author">{{$post->category->name}}</small>
                @endif
                <li>
                    <i class="fa fa-comments"></i> <a href="">{{ $post->comments->count() }} comments</a>
                </li>
                <div class="content">
                    {{$post->content}}
                </div>
                <br>

                @if ($post ->tags ->count()>0)
                    <div class="widget-tags">
                        <h6 class="text-uppercase">Taags</h6>
                        @foreach ($post->tags as $key => $tag)
                            <a href="/posts/tag/{{$tag->id}}">{{$tag->name}}</a>
                        @endforeach
                    </div>
                @endif
                <br>
                <div class="heading-title-alt text-left heading-border-bottom">
                    <h4 class="text-uppercase">{{$post->comments->count() }} Comments</h4>
                <ul class="media-list comments-list m-bot-50 clearlist">
                    @foreach ($post->comments as $key => $comment)
                        <li class="media">
                            <a href="" class="pull-left">
                                <img src="" alt="" class="media-object comment-avatar" width="50" height="50">
                            </a>
                            <div class="media-body">
                                <div class="comment-info">
                                    <div class="comment-author">
                                        <a href="">{{ $comment->name }}</a>
                                        <button class="btn btn-secondary">edit</button>
                                        <button class="btn btn-secondary">delete</button>

                                    </div>
                                    {{$comment->created_at->format('l jS \\of F Y h:i:s A') }}
                                </div>

                                <p>
                                    {{ $comment->comment}}
                                </p>
                                <form action="
                                "></form>
                            </div>
                        </li>
                    @endforeach
                    <li class="media"></li>
                </ul>
                </div>
                <h4 class="text-uppercase">Leave a Comments</h4>


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $key => $error)
                                <li>{{ $error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" action="/comments" id="form" role="form" class="blog-comments">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            @if (Auth::check())
                                <input type="text" name="name" id="name" class="form-control" placeholder="name *" value="{{Auth::user()->name}}" required>
                            @else
                                <input type="text" name="name" id="name" class="form-control" placeholder="name *"  required>
                            @endif
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name="comment" id="text" rows="6" class="form-control" placeholder="Comment"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">
                                Send comment
                            </button>
                        </div>
                    </div>
                </form>  

            </div>
        </div>
    </div>
    <div class="col-md-4">
        @include('posts._sidebar')
    </div>
</div>
<form id="delete-form" action="/posts/id" method="post">
    <input type="hidden" name="_method" value="delete">
    @csrf
</form>
@endsection
