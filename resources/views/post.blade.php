@extends('layouts.blog-post')


@section('content')



    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span>Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    @if($post->photo_id != null)
        <img class="img-responsive" src="{{$post->photo->file}}" alt="slika">
    @endif

    <hr>

    <!-- Post Content -->
    <p class="lead">{!! nl2br($post->body) !!}</p>

    <hr>

    @if(Session::has('comment_message'))
        <h4 class="bg-success" >{{Session('comment_message')}}</h4>
    @elseif(Session::has('reply_message'))
        <h4 class="bg-success" >{{Session('reply_message')}}</h4>
    @endif
    <!-- Blog Comments -->




    @if(Auth::check())
    <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>
            <form action="{{route('comments.store')}}" method="POST" >
                @csrf

                <input type="hidden" name="post_id" value="{{$post->id}}">

                <div class="form-group">
                    <textarea class="form-control" name="body" rows=3></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    @endif
    @if ($errors->any())
        <h4><ul>{!! implode('', $errors->all('<li style="color:red">:message</li>')) !!}</ul></h4>
    @endif
    <hr>

    <!-- Posted Comments -->

@if(count($comments) > 0)

        @foreach($comments as $comment)

            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img height="64" class="media-object" src="{{$comment->photo}}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->author}}
                        <small>{{$comment->created_at->diffForHumans()}}</small>
                    </h4>
                    <p>{{$comment->body}}</p>


                    <div class="comment-reply-container">


                        <button class="toggle-reply btn btn-primary pull-left">Reply</button>

                        <div class="comment-reply">
                            <form action="{{route('createReply')}}" method="post">
                                @csrf

                                <input type="hidden" name="comment_id" value="{{$comment->id}}">

                                <div class="form-group">
                                    <textarea class='form-control' rows="1" name="body"></textarea>

                                    <div class="form-group">
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>




                @if(count($comment->replies) > 0)

                    @foreach($comment->replies as $reply)

                        @if($reply->is_active == 1)


                    <!-- Nested Comment -->
                            <div id='nested-comment' class="media">
                                <a class="pull-left" href="#">
                                    <img height="64" class="media-object" src="{{$reply->photo}}" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">{{$reply->author}}
                                        <small>{{$reply->created_at->diffForHumans()}}</small>
                                    </h4>
                                  <p>{{$reply->body}}</p>
                                </div>


                    <!-- End Nested Comment -->


                            </div>



                                @endif
                             @endforeach



                       @endif


                </div>
            </div>
        @endforeach
@else
    <h1 class="text-center">No Comments</h1>


@endif


@stop

@section('scripts')

    <script>

        $(".comment-reply-container .toggle-reply").click(function(){
            $(this).next().slideToggle("slow");
        });
    </script>

@stop


