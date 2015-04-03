@extends('layouts.ace.main')


@section('header_script')
<!-- header_script -->
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li><a href="{{ URL::to('cate') }}"><i class="fa  fa-gear fa-lg"></i>ตั้งค่า</a></li>
    <li class="active">รายละเอียดหมวดหมู่</li>
</ul>
@stop


@section('pageheader')
<h1>รายละเอียดหมวดหมู่</h1>
@stop


@section('pagecontent')
<div class="row">
    <div class="col-xs-12">
        
        @include('layouts.ace.message')
        
        <div class="profile-user-info profile-user-info-striped" style="margin-top:10px;">
           
            <div class="profile-info-row">
                    <div class="profile-info-name"> ชื่อหมวดหมู่ภาษาไทย : </div>
                    <div class="profile-info-value">{{ $cate->de_set_cate_nameth }}</div>
            </div>
             <div class="profile-info-row">
                    <div class="profile-info-name"> ชื่อหมวดหมู่ภาษาอังกฤษ : </div>
                    <div class="profile-info-value">{{ $cate->de_set_cate_nameen }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> หมายเหตุ: </div>
                    <div class="profile-info-value">{{ $cate->de_set_cate_remark }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> สถานะ : </div>
                    @if($cate->de_set_cate_status=='Enable')
                    <div class="profile-info-value">ใช้งาน</div>
                    @else
                    <div class="profile-info-value">ไม่ใช้งาน</div>
                    @endif
            </div>

        </div>

        <div class="row" style="margin-top:20px;">
            <div class="col-xs-12 center">
                {{ HTML::link('cate/'.$cate->de_set_cate_id.'/edit','แก้ไข',array('class'=>'btn btn-success')) }}
                {{ HTML::link('cate','ย้อนกลับ',array('class'=>'btn btn-warning','style'=>'margin-left:7px;')) }}
            </div>
        </div>
        
    </div>
</div>


@stop


@section('footer_script')
<!-- footer_script -->
@stop