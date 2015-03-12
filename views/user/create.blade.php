@extends('layouts.ace.main')


@section('header_script')
<!-- header_script -->
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li><a href="{{ URL::to('user') }}"><i class="fa fa-sitemap fa-lg"></i>โครงสร้างระบบ</a></li>
    <li class="active">สร้างผู้ใช้งาน</li>
</ul>
@stop


@section('pageheader')
<h1>สร้างผู้ใช้งาน</h1>
@stop


@section('pagecontent')
<div class="row">
    <div class="col-xs-12">
        
        @include('layouts.ace.message')
        
        {{ Form::open(array('url'=>'user','class'=>'form-horizontal','role'=>'form')) }}

           <div class="form-group">
                {{ Form::label('name', 'สิทธิ์การใช้งาน:', array('class' => 'col-sm-2 control-label')) }}
              <div class="col-sm-8">
            {{ Form::select('id', $list_group ,null, array('class'=>'form-control')) }}
              </div>
               <span  style="color:#dd5a43;" ><b>*</b></span>
           </div>
            
            <div class="form-group">
                {{ Form::label('email','อีเมล',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-8">
                    {{ Form::email('email',null,array('class'=>'form-control','placeholder'=>'อีเมล')) }}
                </div>
                 <span  style="color:#dd5a43;" ><b>*</b></span>
            </div>
        
            <div class="form-group">
                {{ Form::label('first_name','ชื่อ',array('class'=>'col-sm-2 control-label')) }}    
                <div class="col-sm-8">
                    {{ Form::text('first_name',null,array('class'=>'form-control','placeholder'=>'ชื่อ')) }}
                </div>
                 <span  style="color:#dd5a43;" ><b>*</b></span>
            </div>
        
            <div class="form-group">
                {{ Form::label('last_name','นามสกุล',array('class'=>'col-sm-2 control-label')) }}    
                <div class="col-sm-8">
                    {{ Form::text('last_name',null,array('class'=>'form-control','placeholder'=>'นามสกุล')) }}
                </div>
                 <span  style="color:#dd5a43;" ><b>*</b></span>
            </div>
        
            <div class="form-group">
                {{ Form::label('password','รหัสผ่าน',array('class'=>'col-sm-2 control-label')) }}    
                <div class="col-sm-8">
                    {{ Form::password('password',null,array('class'=>'form-control','placeholder'=>'รหัสผ่าน')) }}
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