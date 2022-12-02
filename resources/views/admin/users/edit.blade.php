@extends('layouts.admin')




@section('content')


    <h1>Edit User</h1>


    <div class="row">


        <div class="col-sm-3">

            <img width=250px src="{{$user->photo ? $user->photo->file : 'https://upload.wikimedia.org/wikipedia/commons/6/65/No-Image-Placeholder.svg'}}" alt="no picture" >

        </div>



        <div class="col-sm-9">

            <form method="POST" action="{{route('users.update',$user->id)}}" enctype='multipart/form-data' >
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" value="{{$user->name}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" value="{{$user->email}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="role_id">Role:</label>
                    <select class="form-control" name="role_id">
                        <ul>
                            @foreach($roles as $role)
                                <li>
                                    <option value="{{$role->id}}" {{$user->role_id == $role->id ? 'selected':''}}>{{$role->name}}</option>
                                </li>
                            @endforeach
                        </ul>
                    </select>
                </div>

                <div class="form-group">
                    <label for="is_active">Status:</label>
                    <select class="form-control" name="is_active">
                        <option value="1" {{$user->is_active == 1 ? 'selected' : ''}}>Active</option>
                        <option value="0" {{$user->is_active == 0 ? 'selected' : ''}}>Not Active</option>
                    </select>

                </div>

                <div class="form-group">
                    <label for="photo_id">File:</label>
                    <input type="file" name="photo_id" >
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <button name="submit" class="btn btn-primary col-sm-6">Update user</button>
                </div>
            </form>


            <div class="form-group">
                <form method="POST" action="{{route('users.destroy',$user->id)}}">
                    @csrf
                    @method('delete')
                    <button name="submit" class="btn btn-danger col-sm-6">Delete user</button>
                </form>
           </div>

        </div>

    </div>

    <div class="row">
        @include('includes.form_error')
    </div>


@stop

