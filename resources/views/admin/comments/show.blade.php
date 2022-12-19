@extends('layouts.admin')


@section('content')



    @if(count($comments) > 0)

        <h1>Comments</h1>

        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
                <th>Post link</th>
                <th>Reply link</th>
            </tr>
            </thead>
            <tbody>

            @foreach($comments as $comment)

                <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->author}}</td>
                    <td>{{$comment->email}}</td>
                    <td>{{Illuminate\Support\Str::limit($comment->body, 25)}}</td>
                    <td><a href="{{route('home.post',$comment->post->id)}}">View Post</a></td>
                    <td><a href="{{route('replies.show',$comment->id)}}">View Replies</a></td>

                    <td>
                        @if($comment->is_active == 1)

                            <form method="POST" action="{{route('comments.update',$comment->id)}}" >
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="is_active" value="0">

                                <div class="form-group">
                                    <button class="btn btn-success">Un-approve</button>
                                </div>
                            </form>
                        @else
                            <form method="POST" action="{{route('comments.update',$comment->id)}}" >
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="is_active" value="1">

                                <div class="form-group">
                                    <button class="btn btn-info">Approve</button>
                                </div>
                            </form>
                        @endif
                    </td>

                    <td>
                        <form method="POST" action="{{route('comments.destroy',$comment->id)}}">
                            @csrf
                            @method('delete')
                            <div class="form-group">
                                <button class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </td>


                </tr>

            @endforeach

            </tbody>
        </table>

    @else
        <h1 class="text-center">No Comments</h1>

    @endif

@stop
