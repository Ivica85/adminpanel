@extends('layouts.app')
{{--@extends('layouts.blog-home')--}}

@section('content')
<div class="container">
    @if(Auth::user()->isAdmin())
        <h3 class="text-center"><a href="{{route('admin.index')}}">Admin page</a></h3>
    @else
        <h3 class="text-center"><a style="color:red" href="{{route('admin.index')}}">Access is for active administrators only</a></h3>

    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
