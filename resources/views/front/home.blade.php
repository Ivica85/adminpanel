@extends('layouts.blog-home')

@section('content')

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <!-- First Blog Post -->

            @if($posts)

                @foreach($posts as $post)

                    <h2>
                        <a href="#">{{$post->title}}</a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php">{{$post->user->name}}</a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span>{{$post->created_at->diffForHumans()}}</p>
                    <hr>
                    @if($post->photo_id != null)
                        <img class="img-responsive" src="{{$post->photo->file}}" alt="picture">
                    @else
                        <img class="img-responsive" width=500 height=400 src="{{$post->photoPlaceholder()}}" alt="picture">
                    @endif
                    <hr>
                    <td>{{Illuminate\Support\Str::limit( nl2br($post->body), 100)}}</td>
                    <a class="btn btn-primary" href="{{route('home.post',[$post->id,$post->slug])}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>

            @endforeach

        @endif

        <!-- Pagination -->


        </div>

        <!-- Blog Sidebar-->
        @include('includes.front_sidebar')

    </div>
    <!-- /.row -->


@endsection
