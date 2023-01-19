@if(Session::has('comment_message'))
    <div class="alert alert-success col-sm-6">
        <p>{{Session('comment_message')}}</p>
    </div>

@elseif(Session::has('reply_message'))
    <div class="alert alert-success col-sm-6">
        <p class="text-center">{{Session('reply_message')}}</p>
    </div>
@endif
