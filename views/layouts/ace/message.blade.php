@section('message')

@if( Session::has('success') )
<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="alert alert-block alert-success">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>
            <i class="ace-icon fa fa-check green"></i>
            &nbsp;{{ Session::get('success') }}
        </div>
    </div>
</div>
@endif
 
@if(Session::has('danger'))
<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="alert alert-block alert-danger">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>
            {{ Session::get('danger') }}
        </div>
    </div>
</div>
@endif

@if(Session::has('message'))
<div class="row">
    <div class="col-sm-10 col-sm-offset-1">    
        <div class="alert alert-block alert-info">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>
            {{ Session::get('message') }}
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

