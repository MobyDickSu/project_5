@extends('layouts.app')

@section('content')
<h1> Post List
@if (request()->category)
    /{{request()->category->name}}
@endif

@if (request()->tag)
    #{{ request()->tag->name }}
@endif
</h1>
    <div class="page-content">
        <div class="container">
        <div class="row"> 
            <div class="col-md-8">
                <ul class="list-group">
                    @foreach ($posts as $key => $post)

                        <div class="date">
                            <span>{{ $post->created_at->year}}/ {{ strtoupper($post->created_at->shortEnglishMonth)}} / {{$post->created_at->day }}</span>
                        </div>
                        
                        <div class="full-width">
                            @if (!$post->thumbnail)
                                <img width="320" src="/storage/banner-sm-03.jpg" alt="thumbnail">
                            @else
                                <img width="320" src="{{ $post->thumbnail }}" alt="thumbnail">
                            @endif
                        </div>

                        <li class="list-group-item clearfix">
                            {{$post->title}}
                        </li>
                        @if ($post->category)
                        <li class="list-group-item clearfix"> <a href="/posts/category/{{$post->category_id}}">
                            {{ $post->category->name }}</a>
                        @endif
                        </li>
                        <li class="list-group-item clearfix">
                            {{str_limit($post->content, 250) }}
                        </li>
                        <a href="/posts/{{ $post->id }}" class="btn btn-small btn-dark-solid">read</a>
                    @endforeach

                        <div class="text-center">
                            {{ $posts->links() }}
                        </div>
                </ul>

            </div>
            <div class="col-md-4">
                @include('posts._sidebar')  
            </div>
            
        </div>
        </div>    
    </div>
@endsection
