@extends('layouts.admin')


@section('content')

    <h1>Categories</h1>

    <div class="col-sm-6">

        <form method="POST" action="{{route('categories.store')}}">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="name" name="name" id="name" class="form-control">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Create Category</button>
            </div>
        </form>

    </div>




    <div class="col-sm-6">

        @if($categories)
            <table class="table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Created date</th>
                </tr>
                </thead>

                <body>
                @foreach($categories as $category)
                    <tr>
                        <th>{{$category->id}}</th>
                        <th><a href="{{route('categories.edit',$category->id)}}">{{$category->name}}</a></th>
                        <th>{{$category->created_at->diffForHumans()}}</th>
                    </tr>
                @endforeach
                </body>
            </table>
        @endif

    </div>

@stop
