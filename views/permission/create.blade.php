@extends('layouts.ace.main')


@section('header_script')
{{ HTML::style('assets/css/ace/jquery-ui.custom.css') }}
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li><a href="{{ URL::to('permission') }}"><i class="menu-icon fa fa-sitemap fa-lg"></i>โครงสร้างระบบ</a></li>
    <li class="active">สร้างสิทธิ์การใช้งาน</li>
</ul>
@stop

@section('pageheader')
<h1>สร้างสิทธิ์การใช้งาน</h1>
@stop

@section('pagecontent')
<div class="row">
    <div class="col-xs-12">

        @include('layouts.ace.message')
        
        {{ Form::open(array('url'=>'permission','class'=>'form-horizontal','role'=>'form')) }}
        
	<div class="form-group">
		{{ Form::label('name', 'ชื่อสิทธิ์การใช้งาน :', array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-8">
			{{ Form::text('name',null,array('class'=>'form-control','placeholder'=>'ชื่อสิทธิ์การใช้งาน','required')) }}
		</div>
                        <span style="color:#dd5a43"><b>*</b></span>
	</div>

	<div class="form-group">
		{{ Form::label('permission', 'รายละเอียดสิทธิ์การใช้งาน :', array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-8">
			{{ Form::textarea('permission',null,array('class'=>'form-control')) }}
		</div>
	</div>

	<div class="form-group">
            <div class="center">
		{{ Form::submit('บันทึก' ,array('class'=>'btn btn-success')) }}
		<a class="btn btn-info" href="{{ URL::to('permission') }}" style="margin-left:7px">ยกเลิก</a>
            </div>
        </div>
        {{ Form::close() }}
        
    </div>
</div>

@stop

@section('footer_script')

@stop