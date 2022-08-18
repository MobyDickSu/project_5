@extends('layouts.app')

@section('content')
    <h1>create form</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $key => $error)
                    <li>{{ $error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <form method="post" action="/posts" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Title">
            </div>
            <div class="form-group">
                <label>Thumbnail</label>
            
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="thumbnail">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            

            <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="category_id">
                    <option selected value>Please select a category</option>
                    @foreach ($categories as $key => $category)
                    <option value="{{ $category->id}}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Tags</label>
                <input type="text" class="form-control" name="tags" value="{{ $post->tagsString() }}">
            </div>

            
            <div class="form-group">
                <label for="exampleInputPassword1">Content</label>
                <textarea class="form-control" name="content"  cols="50" rows="10"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancel</button>

        </form>
    </div>
@endsection