@extends('layouts.admin')





@section('content')

    <h1>Edit User</h1>

    <div class="row">

        <div class="col-sm-3">
            <img width=250 src="{{$user->photo ? $user->photo->file : '/images/1669209988placeholder.jpg'}}" alt="" class="img-responsive img-rounded">
        </div>

        <div class="col-sm-9">
            <form action="{{route('users.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input value={{$user->name}}  class="form-control" type="text" name="name" id="name">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input value={{$user->email}} class="form-control" type="text" name="email" id="email">
                </div>

                <div class="form-group">
                    <label for="role_id">Role</label>
                    <select class="form-control" name="role_id">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}" {{$user->role_id == $role->id ? 'selected' : ''}}>{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="is_active">Status</label>
                    <select class="form-control" name="is_active">
                        <option value="1" {{$user->is_active == 1 ? 'selected':''}}>Active</option>
                        <option value="0" {{$user->is_active == 0 ? 'selected':''}}>Not Active</option>
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
                    <button class="btn btn-primary" type="submit">Create Post</button>
                </div>
            </form>

        </div>

    </div>

    <div class="row">
        @include('includes.form_error')
    </div>


@stop
