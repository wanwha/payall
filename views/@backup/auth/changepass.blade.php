@extends('layouts.ace.main')


@section('header_script')
<!-- header_script -->
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li><a href="{{ URL::to('home') }}"><i class="fa fa-home fa-lg"></i>หน้าแรก</a></li>
    <li><a href="{{ URL::to('profile') }}">ข้อมูลส่วนตัว</a></li>
    <li class="active">เปลี่ยนรหัสผ่าน</li>
</ul>
@stop


@section('pageheader')
<h1>เปลี่ยนรหัสผ่าน</h1>
@stop


@section('pagecontent')
<div class="row">
    <div class="col-xs-12">
        {{ Form::open(array('url'=>'changepass','class'=>'form-horizontal','role'=>'form')) }}
        
        <div class="form-group">
            {{ Form::label('oldpass','รหัสผ่านเก่า',array('class'=>'col-sm-2 control-label')) }}
            <div class="col-sm-8">
                {{ Form::text('oldpass',null,array('class'=>'form-control')) }}
            </div> 
        </div>
        
        <div class="form-group">
            {{ Form::label('newpass','รหัสผ่านใหม่',array('class'=>'col-sm-2 control-label')) }}
            <div class="col-sm-8">
                {{ Form::text('newpass',null,array('class'=>'form-control')) }}
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