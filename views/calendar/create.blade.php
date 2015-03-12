@extends('layouts.ace.main')


@section('header_script')
<!-- header_script -->
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li><a href="{{ URL::to('user') }}">ผู้ใช้งานระบบ</a></li>
    <li class="active">สร้างผู้ใช้งานใหม่</li>
</ul>
@stop


@section('pageheader')
<h1>สร้างผู้ใช้งานใหม่</h1>
@stop


@section('pagecontent')
<div class="row">
    <div class="col-xs-12">
        <!-- if there are creation error, they will show here -->
        {{ Form::open(array('url'=>'user','class'=>'form-horizontal','role'=>'form')) }}
            
            @if($errors->all())
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8 alert alert-danger">
                    {{ HTML::ul($errors->all()) }}
                </div>
            </div>
            @endif
            
            <div class="form-group">
                {{ Form::label('email','Email',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-8">
                    {{ Form::email('email',null,array('class'=>'form-control','placeholder'=>'Email Address')) }}
                </div>
            </div>
        
            <div class="form-group">
                {{ Form::label('first_name','Firstname',array('class'=>'col-sm-2 control-label')) }}    
                <div class="col-sm-8">
                    {{ Form::text('first_name',null,array('class'=>'form-control','placeholder'=>'First Name')) }}
                </div>
            </div>
        
            <div class="form-group">
                {{ Form::label('last_name','Lastname',array('class'=>'col-sm-2 control-label')) }}    
                <div class="col-sm-8">
                    {{ Form::text('last_name',null,array('class'=>'form-control','placeholder'=>'Last Name')) }}
                </div>
            </div>
        
            <div class="form-group">
                {{ Form::label('password','Password',array('class'=>'col-sm-2 control-label')) }}    
                <div class="col-sm-8">
                    {{ Form::password('password',null,array('class'=>'form-control','placeholder'=>'Password')) }}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                {{ Form::submit('บันทึก',array('class'=>'btn btn-success')) }}
                </div>
            </div>
            
        {{ Form::close() }}
    </div>
</div>
@stop


@section('footer_script')
<!-- footer_script -->
@stop