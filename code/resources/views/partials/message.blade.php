@if(Session::has('Success'))
    <div class="clearfix"></div>
    <div class="alert alert-success" role="alert" style="margin-top: 24px;z-index:10000">
        <strong>Success: </strong>{{Session::get('Success')}}
    </div>
@endif
@if(Session::has('Danger'))
    <div class="clearfix"></div>
    <div class="alert alert-warning" role="alert" style="margin-top: 24px;z-index:10000">
        <strong>Success: </strong>{{Session::get('Danger')}}
    </div>
@endif
@if(count($errors)>0)
    <div class="clearfix"></div>
    <div class="alert alert-danger" role="alert" style="margin-top: 24px;">
        <ul>
            @foreach($errors->all() as $error)
                <li> <strong>Error:</strong>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif