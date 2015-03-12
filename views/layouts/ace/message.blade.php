@section('message')
<div class="table-header">
    @if( Session::has('message') )
    <div class="alert alert-block alert-info">
        <button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
        <i class="ace-icon fa fa-check green"></i>{{ Session::get('message') }}
    </div>
    @endif

    @if($errors->all())
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8 alert alert-danger">
            {{ HTML::ul($errors->all()) }}
        </div>
    </div>
    @endif
</div>
@show

