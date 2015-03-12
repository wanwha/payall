@extends('layouts.ace.main')


@section('header_script')
{{ HTML::style('assets/css/ace/jquery-ui.custom.css') }}
{{ HTML::style('assets/css/ace/jquery.gritter.css') }}
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li><a href="{{ URL::to('businesscenter') }}"><i class="menu-icon fa fa-code-fork fa-lg"></i>จัดการสาขา</a></li>
    <li class="active">รายละเอียดสาขา</li>
</ul>
@stop


@section('pageheader')
<h1>รายละเอียดสาขา</h1>
@stop


@section('pagecontent')
<div class="row">
    <div class="col-xs-12">

         @if( Session::has('message') )
            <div class="alert alert-block alert-info">
                <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                </button>
                <i class="ace-icon fa fa-check green"></i>
                {{ Session::get('message') }}
            </div>
            @endif
            
    <div class="profile-user-info profile-user-info-striped" style="margin-top:10px;">
            <div class="profile-info-row">
                    <div class="profile-info-name"> รูปภาพสาขา : </div>
                    <img src = "/../payall/assets/images/{{ $businesscenter->bu_center_pic }}"></img>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> รหัสสาขา : </div>
                    <div class="profile-info-value">{{ $businesscenter->bu_center_code }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> ชื่อสาขาภาษาไทย : </div>
                    <div class="profile-info-value">{{ $businesscenter->bu_center_name }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> รายละเอียด : </div>
                    <div class="profile-info-value">{{ $businesscenter->bu_center_detail }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> ที่อยู่ : </div>
                    <div class="profile-info-value">{{ $businesscenter->bu_center_addr }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> ตำบล/แขวง : </div>
                    <div class="profile-info-value">{{ $businesscenter->sys_district_name }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> อำเภอ/เขต : </div>
                    <div class="profile-info-value">{{ $businesscenter->sys_subprovince_name }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> จังหวัด : </div>
                    <div class="profile-info-value">{{ $businesscenter->sys_province_name }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> ไปรษณีย์ : </div>
                    <div class="profile-info-value">{{ $businesscenter->bu_center_postcode }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> เบอร์ติดต่อ : </div>
                    <div class="profile-info-value">{{ $businesscenter->bu_center_tel }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> แฟกซ์ : </div>
                    <div class="profile-info-value">{{ $businesscenter->bu_center_fax }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> อีเมล์ : </div>
                    <div class="profile-info-value">{{ $businesscenter->bu_center_email }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> แผนที่/พิกัด : </div>
                    <div class="profile-info-value">{{ $businesscenter->bu_center_latitude, ',', $businesscenter->bu_center_longitude }}</div>
            </div>

            @if($businesscenter->bu_center_mappic != 'NULL')
                    <div class="profile-info-row">
                        <div class="profile-info-name"> รูปภาพแผนที่ : </div>
                        <img src = "/../payall/assets/images/{{ $businesscenter->bu_center_mappic }}"></img>
                    </div>
            @else
                    <div class="hidden"></div>
            @endif

            <div class="profile-info-row">
                    <div class="profile-info-name"> เว็บไซต์ : </div>
                    <div class="profile-info-value">{{ $businesscenter->bu_center_website }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> ผู้ประสานงานประจำสาขา : </div>
                    <div class="profile-info-value">{{ $businesscenter->bu_center_ctrname }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> เบอร์ติดต่อผู้ประสานงานประจำสาขา : </div>
                    <div class="profile-info-value">{{ $businesscenter->bu_center_ctrphone }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> อีเมล์ผู้ประสานงานประจำสาขา : </div>
                    <div class="profile-info-value">{{ $businesscenter->bu_center_ctremail }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> ไอดีไลน์ผู้ประสานงานประจำสาขา : </div>
                    <div class="profile-info-value">{{ $businesscenter->bu_center_ctrline }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> สถานะใช้งาน : </div>
                    @if($businesscenter->bu_center_status=='Enable')
                        <div class="profile-info-value">ใช้งาน</div>
                    @else
                        <div class="profile-info-value">ไม่ใช้งาน</div>
                    @endif
            </div>
        

        
    </div><br />
    <div class="center">
        <a class="btn btn-info" href="{{ URL::to('businesscenter') }}">ย้อนกลับ</a>
    </div>
</div>
@stop

@section('footer_script')

@stop