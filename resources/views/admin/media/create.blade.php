
@extends('layouts.admin')

@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">

@endsection



@section('content')


    <h1>Upload Media</h1>

    <form method="POST" class='dropzone' action="{{route('media.store')}}"  enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for=""></label>
        </div>
    </form>



@stop


@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

@stop
