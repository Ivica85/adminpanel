@extends('layouts.admin')


@section('content')

    <h1>Create Post</h1>

    <div class="row">

    <form action="{{route('posts.store')}}" method="Post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title">
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" name="category_id" id="category_id">
                <option value="0">Horror game</option>
                <option value="1">Psychological game</option>
                <option value="2">Adventure game</option>
            </select>
        </div>

        <div class="form-group">
            <label for="photo_id">File</label>
            <input type="file" name="photo_id" id="photo_id">
        </div>

        <div class="form-group">
            <label for="body">Description</label>
            <textarea rows="6" name="body"  id="body" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <button  class="btn btn-primary" type="submit">Create Post</button>
        </div>
    </form>
    </div>

    <div class="row">
        @include('includes.form_error')
    </div>
@stop
