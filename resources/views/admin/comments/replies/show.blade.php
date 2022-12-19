@extends('layouts.admin')


@section('content')

    @if(Session::has('reply_deleted'))
        <p class="bg-success">{{session('reply_deleted')}}</p>
    @endif

    @if(count($replies) > 0)

        <h1>Replies</h1>

        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
                <th>Post</th>
            </tr>
            </thead>
            <tbody>

            @foreach($replies as $reply)

                <tr>
                    <td>{{$reply->id}}</td>
                    <td>{{$reply->author}}</td>
                    <td>{{$reply->email}}</td>
                    <td>{{Illuminate\Support\Str::limit($reply->body, 25)}}</td>
                    <td><a href="{{route('home.post',$reply->comment->post_id)}}">View Post</a></td>

                    <td>
                        @if($reply->is_active == 1)

                            <form method="POST" action="{{route('replies.update',$reply->id)}}" >
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="is_active" value="0">

                                <div class="form-group">
                                    <button class="btn btn-success">Un-approve</button>
                                </div>
                            </form>
                        @else
                            <form method="POST" action="{{route('replies.update',$reply->id)}}" >
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
                        <form method="POST" action="{{route('replies.destroy',$reply->id)}}">
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
        <h1 class="text-center">No Replies</h1>

    @endif

@stop
