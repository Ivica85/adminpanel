<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="/">Home</a>
</div>
<!-- /.navbar-header -->


<!--TOP NAVIGATION -->
<ul class="nav navbar-top-links navbar-right">


    <!-- /.dropdown -->



    @if(Auth()->user()->photo_id != null )
        <img height="44" class="comment-picture" src="{{Auth()->user()->photo->file}}" alt="">
    @endif

    <li class="dropdown">

        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            {{--                    <i class="fa fa-user fa-fw"></i>--}}
            {{Auth::user()->name}} <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu">
            <li><a href="{{route('users.edit',Auth::user()->id)}}"><i class="fa fa-user fa-fw"></i> User Profile</a>
            </li>
            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
            </li>
            <li><a href="{{ route('logout') }}" class="fa fa-sign-out" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->


</ul>
