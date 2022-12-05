@extends('layouts.admin')



@section('content')

    <h1>Update Category</h1>

    <div class="col-sm-6">

        <form method="POST" action="{{route('categories.update',$category->id)}}">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="name" name="name" id="name" class="form-control" value="{{$category->name}}">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary col-sm-6">Update Category</button>
            </div>
        </form>

        <form method="POST" action="{{route('categories.destroy',$category->id)}}">
            @csrf
            @method('delete')

            <div class="form-group">
                <button type="submit" class="btn btn-danger col-sm-6">Delete Category</button>
            </div>
        </form>

    </div>



@stop
