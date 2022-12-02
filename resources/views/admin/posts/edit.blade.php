@extends('layouts.admin')


@section('content')

    <h1>Edit Post</h1>

    <div class="row">

        <div class="col-sm-3">

            <img width=250px src="{{$post->photo ? $post->photo->file : 'https://upload.wikimedia.org/wikipedia/commons/6/65/No-Image-Placeholder.svg'}}" alt="no picture" >

        </div>


        <div class="col-sm-9">

            <form action="{{route('posts.update',$post->id)}}" method="Post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control" value="{{$post->title}}" type="text" name="title" id="title">
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" name="category_id" id="category_id">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{$post->category_id == $category->id ? 'selected':''}}>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="photo_id">File</label>
                    <input type="file" name="photo_id" id="photo_id">
                </div>

                <div class="form-group">
                    <label for="body">Description</label>
                    <textarea  rows="6" name="body"  id="body" class="form-control">{{$post->body}}</textarea>
                </div>

                <div class="form-group">
                    <button  class="btn btn-primary col-sm-6" type="submit">Update Post</button>
                </div>
            </form>


            <div class="form-group">
                <form action="{{route('posts.destroy',$post->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button  class="btn btn-danger col-sm-6" type="submit">Delete Post</button>
                </form>
            </div>

        </div>

    </div>

    <div class="row">
        @include('includes.form_error')
    </div>


@stop
