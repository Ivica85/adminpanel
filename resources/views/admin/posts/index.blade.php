
@extends('layouts.admin')





@section('content')

    @if(Session::has('deleted_post'))
        <p class="bg-danger">{{session('deleted_post')}}</p>
    @elseif(Session::has('updated_post'))
        <p class="bg-success">{{session('updated_post')}}</p>
    @elseif(Session::has('created_post'))
        <p class="bg-success">{{session('created_post')}}</p>
    @endif

    <h1>Posts</h1>


    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>photo_id</th>
            <th>Owner</th>
            <th>Category_id</th>
            <th>title</th>
            <th>body</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody>
          @if($posts)
              @foreach($posts as $post)
                  <tr>
                      <td>{{$post->id}}</td>
                      <td> <img height="50" src="{{$post->photo ? $post->photo->file : 'https://upload.wikimedia.org/wikipedia/commons/6/65/No-Image-Placeholder.svg'}}" alt="no picture" ></td>
                      <td><a href="{{route('posts.edit',$post->id)}}">{{$post->user->name}}</a></td>
                      <td>{{$post->category ? $post->category->name : 'Uncategorized'}}</td>
                      <td>{{$post->title}}</td>
                      <td>{{Illuminate\Support\Str::limit($post->body, 25)}}</td>
                      <td>{{$post->created_at->diffForHumans()}}</td>
                      <td>{{$post->updated_at->diffForHumans()}}</td>
                  </tr>
              @endforeach
          @endif
        </tbody>
    </table>


@stop
