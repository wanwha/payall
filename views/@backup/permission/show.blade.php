@extends('layouts.ace.main')


@section('header_script')
{{ HTML::style('assets/css/ace/jquery-ui.custom.css') }}
{{ HTML::style('assets/css/ace/jquery.gritter.css') }}
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li><a href="{{ URL::to('permission') }}"><i class="menu-icon fa fa-sitemap fa-lg"></i>โครงสร้างระบบ</a></li>
    <li class="active">รายละเอียดสิทธิ์การใช้งาน</li>
</ul>
@stop


@section('pageheader')
<h1>รายละเอียดสิทธิ์การใช้งาน</h1>
@stop


@section('pagecontent')
<div class="row">
    <div class="col-xs-12">
    	

	<div class="profile-user-info profile-user-info-striped" style="margin-top:10px;">
            
            <div class="profile-info-row">
                    <div class="profile-info-name"> ชื่อสิทธิ์การใช้งาน : </div>
                    <div class="profile-info-value">{{ $permission->name }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> รายละเอียดสิทธิ์การใช้งาน : </div>
                    <div class="profile-info-value">{{ $permission->permissions }}</div>
            </div>
    	

    	
    </div><br />
    <div class="form-group">
            <div class="center">
        <a class="btn btn-danger" href="{{ URL::to('permission') }}">ย้อนกลับ</a>
            </div>
        </div>
</div>
@stop

@section('footer_script')

@stop