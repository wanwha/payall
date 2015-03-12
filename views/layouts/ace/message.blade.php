@section('message')

@if( Session::has('message') )
<div class="row">
    <div class="col-sm-offset-3 col-sm-6">
        <div class="alert alert-block alert-info">
            <button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
            <i class="ace-icon fa fa-check green"></i>{{ Session::get('message') }}
        </div>
    </div>
</div>
@endif

@if($errors->all())
<div class="row">
    <div class="col-sm-offset-3 col-sm-6 alert alert-danger">
        <div class="form-group">
            {{ HTML::ul($errors->all()) }}
        </div>
    </div>
</div>
@endif


@show

