@extends('layouts.ace.main')


@section('header_script')
{{ HTML::style('assets/css/ace/jquery-ui.custom.css') }}
{{ HTML::style('assets/css/ace/jquery.gritter.css') }}
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li><a href="{{ URL::to('subcate') }}"><i class="fa fa-cog fa-lg"></i>ตั้งค่า</a></li>
    <li class="active">รายละเอียดหมวดหมู่ย่อย</li>
</ul>
@stop


@section('pageheader')
<h1>รายละเอียดหมวดหมู่ย่อย</h1>
@stop


@section('pagecontent')
<div class="row">
    <div class="col-xs-12">

        @include('layouts.ace.message')
            
	<div class="profile-user-info profile-user-info-striped" style="margin-top:10px;">
            <div class="profile-info-row">
                    <div class="profile-info-name"> หมวดหมู่ : </div>
                    <div class="profile-info-value">{{ $subcate->de_set_cate_nameth }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> ชื่อหมวดหมู่ภาษาไทย : </div>
                    <div class="profile-info-value">{{ $subcate->de_set_scate_nameth }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> ชื่อหมวดหมู่ภาษาอังกฤษ : </div>
                    <div class="profile-info-value">{{ $subcate->de_set_scate_nameen }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> หมายเหตุ : </div>
                    <div class="profile-info-value">{{ $subcate->de_set_scate_remark }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> สถานะใช้งาน : </div>
                    @if($subcate->de_set_scate_status=='Enable')
                        <div class="profile-info-value">ใช้งาน</div>
                    @else
                        <div class="profile-info-value">ไม่ใช้งาน</div>
                    @endif
            </div>
    	

    	
    </div><br />
    <div class="center">
        <a class="btn btn-info" href="{{ URL::to('subcate') }}">ย้อนกลับ</a>
    </div>
</div>
@stop

@section('footer_script')

@stop