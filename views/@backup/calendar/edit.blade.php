@extends('layouts.ace.main')


@section('header_script')
<!-- header_script -->
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li><a href="{{ URL::to('user') }}">ผู้ใช้งานระบบ</a></li>
    <li class="active">แก้ไขข้อมูลผู้ใช้งาน</li>
</ul>
@stop


@section('pageheader')
<h1>แก้ไขข้อมูลผู้ใช้งาน</h1>
@stop


@section('pagecontent')
<div class="row">
    <div class="col-xs-12">

        <!-- if there are creation error, they will show here -->
        {{ Form::model($user,array('route'=>array('user.update',$user->id),'method'=>'PUT','class'=>'form-horizontal')) }}

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
                    {{ Form::email('email',$user->email,array('class'=>'form-control','placeholder'=>'Email Address','disabled')) }}
                </div>
            </div>
        
            <div class="form-group">
                {{ Form::label('first_name','Firstname',array('class'=>'col-sm-2 control-label')) }}    
                <div class="col-sm-8">
                    {{ Form::text('first_name',$user->first_name,array('class'=>'form-control','placeholder'=>'First Name')) }}
                </div>
            </div>
        
            <div class="form-group">
                {{ Form::label('last_name','Lastname',array('class'=>'col-sm-2 control-label')) }}    
                <div class="col-sm-8">
                    {{ Form::text('last_name',$user->last_name,array('class'=>'form-control','placeholder'=>'Last Name')) }}
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