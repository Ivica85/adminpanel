
@extends('layouts.admin')





@section('content')
    @if(Session::has('deleted_media'))
        <p class="bg-danger">{{session('deleted_media')}}</p>
    @elseif(Session::has('created_media'))
        <p class="bg-success">{{session('created_media')}}</p>
    @endif

    <h1>Media</h1>

    @if($photos)

        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Created</th>
            </tr>
            </thead>
            <tbody>


            @foreach($photos as $photo)

                <tr>
                    <td>{{$photo->id}}</td>
                    <td><img height="50" src="{{$photo->file}}" alt=""></td>
                    <td>{{$photo->created_at ? $photo->created_at : 'no date' }}</td>
                    <td>
                        <div class="form-group">
                            <form action="{{route('media.destroy',$photo->id)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type=submit class="btn btn-danger">Delete</button>
                            </form>
                        </div>

                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>

    @endif

@stop
