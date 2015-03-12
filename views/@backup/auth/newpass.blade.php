@extends('layouts.ace.login')


@section('header_script')
<!-- header_script -->
@stop



@section('pagecontent')
<div class="col-xs-12" style="margin-top:20px;">
    
    {{ Form::open(array('url'=>'newpass','class'=>'form-horizontal')) }}
    <input type="hidden" name="code" value="{{ Request::segment(2) }}" />
    
    <div class="form-group">
        {{ Form::label('newpass','รหัสผ่านใหม่',array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-8">
        {{ Form::text('newpass',null,array('class'=>'form-control')) }}
        
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            {{ Form::submit('ส่งค่า',array('class'=>'btn btn-success')) }}
        </div>
    </div>
    
    {{ Form::close() }}
</div>
@stop


@section('footer_script')
<!-- footer_script -->
@stop