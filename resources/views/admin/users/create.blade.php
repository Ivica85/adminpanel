@extends('layouts.admin')





@section('content')

    <h1>Create Users</h1>

    <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name">
        </div>



        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="text" name="email" id="email">
        </div>



        <div class="form-group">
            <label for="role_id">Role</label>
            <select class="form-control" name="role_id">
                @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="is_active">Status</label>
            <select class="form-control" name="is_active">
                <option value="1">Active</option>
                <option value="0" selected>Not Active</option>
            </select>
        </div>

        <div class="form-group">
            <label for="photo_id">File</label>
            <input type="file" name="photo_id" id="photo_id">
        </div>


        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password">
        </div>


        <div class="form-group">
           <button class="btn btn-primary" type="submit">Create User</button>
        </div>
    </form>

   @include('includes.form_error')

@stop
