
@extends('layouts.admin')





@section('content')
    @if(Session::has('deleted_media'))
        <p class="bg-danger">{{session('deleted_media')}}</p>
    @elseif(Session::has('created_media'))
        <p class="bg-success">{{session('created_media')}}</p>
    @elseif(Session::has('checkboxed_media_deleted'))
        <p class="bg-danger">{{session('checkboxed_media_deleted')}}</p>
    @endif

    <h1>Media</h1>

    @if($photos)

        <form action="{{route('delete.media')}}" method="post" class="form-inline">
            @csrf
            @method('delete')
            <div class="form-group">
                <select name="checkBoxArray" class="form-control">
                    <option value="">Delete</option>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" class="btn-primary" name="delete_all" value="Submit">
            </div>





            <table class="table">
                <thead>
                <tr>
                    <th><input type="checkbox" id="option"></th>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Created</th>
                </tr>
                </thead>
                <tbody>


                @foreach($photos as $photo)

                    <tr>
                        <td><input  class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}"></td>
                        <td>{{$photo->id}}</td>
                        <td><img height="50" src="{{$photo->file}}" alt=""></td>
                        <td>{{$photo->created_at ? $photo->created_at : 'no date' }}</td>

                    </tr>

                @endforeach

                </tbody>
            </table>
        </form>
    @endif





@stop

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#option').click(function(){
                if(this.checked){
                    $('.checkBoxes').each(function(){
                        this.checked = true;
                    });
                }else{
                    $('.checkBoxes').each(function(){
                        this.checked = false;
                    })

                }
            })
        });
    </script>

@stop
