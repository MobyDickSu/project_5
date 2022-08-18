
@php 

$categories = \App\Category::all();
$tags = \App\Tag::has('posts')->withCount('posts')->orderBy('posts_count', 'desc')->get();
@endphp

<div class="widget">
    <div class="heading-title-all text-left heading-border-bottom">
        <h6 class="text-uppercase">Category</h6>
    </div>
    <ul class="widget-category">
        @foreach ($categories as $key => $category)
            <li>
                <a href="/posts/category/{{ $category->id}}">{{ $category->name }}</a>
            </li>
        @endforeach
    </ul>
    <div class="widget-tags">
        @foreach($tags as $key => $tag)
            <a href="/posts/tag/{{ $tag->id}}">{{ $tag->name }}</a>
        @endforeach
    </div>
</div>