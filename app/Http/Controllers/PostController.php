<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBlogPost;
use App\Post;
use App\Category;
use App\Tag;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 找到所有post的文章(all)
        $posts = Post::orderBy('created_at', 'asc')->where('category_id', '=', '2')->paginate(5);
        $categories = Category::all();
        $tags = Tag::has('posts')->withCount('posts')->orderBy('posts_count', 'desc')->get();
        return view('posts.index', ['posts' => $posts, 'categories' => $categories, 'tags' => $tags]);

    }

    public function indexWithCategory(Category $category)
    {
        $posts = Post::where('category_id', $category->id)->paginate(10);
        $categories = Category::all();
        $tags = Tag::has('posts')->withCount('posts')->orderBy('posts_count', 'desc')->get();
        return view('posts.index', ['posts' => $posts, 'categories' => $categories, 'tags' => $tags]);
    }

    public function indexWithTag(Tag $tag)
    {
        $posts = $tag->posts()->paginate(5);;
        $categories = Category::all();
        $tags = Tag::has('posts')->withCount('posts')->orderBy('posts_count', 'desc')->get();
        return view('posts.index', ['posts' => $posts, 'categories' => $categories, 'tags' => $tags]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post;
        $categories = Category::all();
        return view('posts.create', ['post' =>$post, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogPost $request)
    {
        $path = $request->file('thumbnail')->store('public');
        $path = str_replace('public/', '/storage/', $path);

        $post = new Post;
        $post->fill($request->all());
        $post->user_id = Auth::id();
        $post->thumbnail = $path;
        $post->save();

        $tags = $this->stringToTags($request->tags);
        $this->addTagsToPost($tags, $post);

        return redirect('/posts/admin');
    }

    public function stringToTags($string)
    {
        $tags = explode(',', $string);
        $tags = array_filter($tags);
        foreach ($tags as $key => $tag){
            $tags[$key] = trim($tag);
        }
        return $tags;
    }

    private function addTagsToPost($tags, $post)
    {
        foreach ($tags as $key => $tag){
            $model = Tag::firstOrCreate(['name' => $tag]);
            $post->tags()->attach($model->id);
    }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.show', ['post' =>$post, 'categories' => $categories, 'tags' => $tags]);
    }
    
    public function showByAdmin(Post $post)
    {
        return view('posts.showByAdmin', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $user = Auth::user();
        if(is_null($user) || $user->cant('update', $post)){
            return redirect('/posts/admin');
        }
        $categories = Category::all();

        return view('posts.edit', ['post' => $post, 'categories' => $categories]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBlogPost $request, Post $post)
    {
        $post->fill($request->all());

        if (!is_null($request->file('thumbnail'))){
            $path = $request->file('thumbnail')->store('public');
            $path = str_replace('public/', '/storage/', $path);
            $post->thumbnail = $path;
        }
        
        $post->save();

        $post->tags()->detach();

        $tags = $this->stringToTags($request->tags);
        $this->addTagsToPost($tags, $post);

        return redirect('/posts/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        
        return redirect('/posts/admin');
    }

    public function admin()
    {
        $posts = Post::all();

        return view('posts.admin', ['posts' => $posts]);
    }


}
