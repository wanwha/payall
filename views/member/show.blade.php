@extends('layouts.ace.main')


@section('header_script')
{{ HTML::style('assets/css/ace/jquery-ui.custom.css') }}
{{ HTML::style('assets/css/ace/jquery.gritter.css') }}
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li>{{ HTML::decode(link_to('member', '<i class="fa fa-users fa-lg"></i>จัดการสมาชิก')) }}</li>
    <li class="active">รายละเอียดสมาชิกทั่วไป</li>
</ul>
@stop


@section('pageheader')
<h1>รายละเอียดสมาชิกทั่วไป</h1>
@stop


@section('pagecontent')
<div class="row">
    <div class="col-xs-12">

        @include('layouts.ace.message')
        
        <div class="profile-user-info profile-user-info-striped" style="margin-top:10px;">
            <div class="profile-info-row">
                    <div class="profile-info-name"> คำนำหน้า : </div>
                    <div class="profile-info-value">{{ GetList::$list_prefix[$mem->mb_mem_prefix] }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> ชื่อ : </div>
                    <div class="profile-info-value">{{ $mem->mb_mem_fnameth }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> สกุล : </div>
                    <div class="profile-info-value">{{ $mem->mb_mem_lnameth }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> อีเมล : </div>
                    <div class="profile-info-value">{{ $mem->mb_mem_email }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> ที่อยู่ : </div>
                    <div class="profile-info-value">{{ $mem->mb_mem_addr }}</div>
            </div>     
            <div class="profile-info-row">
                    <div class="profile-info-name"> จังหวัด : </div>
                    <div class="profile-info-value">{{ $list_province[$mem->mb_mem_provid] }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> อำเภอ/เขต : </div>
                    <div class="profile-info-value">{{ $list_province[$mem->mb_mem_subprovid] }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> ตำบล/แขวง : </div>
                    <div class="profile-info-value">{{ $list_district[$mem->mb_mem_distid] }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> รหัสไปรษณีย์ : </div>
                    <div class="profile-info-value">{{ $mem->mb_mem_postcode }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> รหัสผ่าน : </div>
                    <div class="profile-info-value">{{ $mem->mb_mem_password }}</div>
            </div>
            
        </div>

        <div class="row">
            <div class="col-xs-12 center">
                {{ HTML::link('member','ย้อนกลับ',array('class'=>'btn btn-info btn-lg','style'=>'margin:20px;')) }}
            </div>
        </div>    
        
        
    </div>
</div>

@stop


@section('footer_script')
{{ HTML::script('assets/js/ace/dataTables/jquery.dataTables.js') }}
{{ HTML::script('assets/js/ace/dataTables/jquery.dataTables.bootstrap.js') }}

<script type="text/javascript">
    //initiate dataTables plugin
    var oTable1 =
        $('#dynamic-table')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .dataTable({
            bAutoWidth: false,
            "aoColumns": [
                null, null, null, null, null, null
            ],
            "aaSorting": [],
        });
</script>
@stop