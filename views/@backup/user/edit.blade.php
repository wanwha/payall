@extends('layouts.ace.main')


@section('header_script')
<!-- header_script -->
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li><a href="{{ URL::to('user') }}"><i class="fa fa-sitemap fa-lg"></i>โครงสร้างระบบ</a></li>
    <li class="active">แก้ไขผู้ใช้งานระบบ</li>
</ul>
@stop


@section('pageheader')
<h1>แก้ไขผู้ใช้งานระบบ</h1>
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
              {{ Form::label('group_id','สิทธิการใช้งาน:', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-8">
            {{ Form::select('id', $list_group,null,array('class'=>'form-control')) }}
                </div>
                 <span  style="color:#dd5a43;" ><b>*</b></span>
            </div>
        
            <div class="form-group">
                {{ Form::label('email','Email',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-8">
                    {{ Form::email('email',$user->email,array(
                                'class'=>'form-control',
                                'placeholder'=>'อีเมล',
                                'disabled'=>'disabled',
                                'readonly'
                    )) }}
                </div>
            </div>
        
            <div class="form-group">
                {{ Form::label('first_name','Firstname',array('class'=>'col-sm-2 control-label')) }}    
                <div class="col-sm-8">
                    {{ Form::text('first_name',$user->first_name,array('class'=>'form-control','placeholder'=>'ชื่อ')) }}
                </div>
                 <span  style="color:#dd5a43;" ><b>*</b></span>
            </div>
        
            <div class="form-group">
                {{ Form::label('last_name','Lastname',array('class'=>'col-sm-2 control-label')) }}    
                <div class="col-sm-8">
                    {{ Form::text('last_name',$user->last_name,array('class'=>'form-control','placeholder'=>'นามสกุล')) }}
                </div>
                 <span  style="color:#dd5a43;" ><b>*</b></span>
            </div>

            <div class="form-group">
                <div class="center">
                {{ Form::submit('บันทึก',array('class'=>'btn btn-success')) }}
                <a class="btn btn-info" style="margin-left:7px;" href="{{ URL::to('user') }}">ย้อนกลับ</a>
                </div>
            </div>
            
        {{ Form::close() }}
    </div>
</div>
@stop


@section('footer_script')
<!-- footer_script -->
@stop