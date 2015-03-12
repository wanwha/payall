@extends('layouts.ace.main')


@section('header_script')
{{ HTML::style('assets/css/ace/jquery-ui.custom.css') }}
{{ HTML::style('assets/css/ace/jquery.gritter.css') }}
{{ HTML::style('assets/css/ace/select2.css') }}
{{ HTML::style('assets/css/ace/datepicker.css') }}
{{ HTML::style('assets/css/ace/bootstrap-editable.css') }}
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li><a href="{{ URL::to('user') }}"><i class="fa fa-sitemap fa-lg"></i>โครงสร้างระบบ</a></li>
    <li class="active">รายละเอียดผู้ใช้งานระบบ</li>
</ul>
@stop


@section('pageheader')
<h1>รายละเอียดผู้ใช้งานระบบ</h1>
@stop


@section('pagecontent')
<div class="row">
    <div class="col-xs-12">
        
        @include('layouts.ace.message')
        
        <div class="profile-user-info profile-user-info-striped" style="margin-top:10px;">
            <div class="profile-info-row">
                    <div class="profile-info-name"> ไอดี : </div>
                    <div class="profile-info-value">{{ $user->id }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> อีเมล : </div>
                    <div class="profile-info-value">{{ $user->email }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> ชื่อ-สกุล : </div>
                    <div class="profile-info-value">{{ $user->first_name.' '.$user->last_name}}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> วันที่แก้ไข : </div>
                    <div class="profile-info-value">{{ GetFormat::format_DateTime($user->created_at) }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> สิทธิการใช้งาน : </div>
                    <div class="profile-info-value">{{ $list_group[$user->group_id] }}</div>
            </div>
           
         
            
        </div>

        <div class="row">
            <div class="col-xs-12 center">
                {{ HTML::link('user','ย้อนกลับ',array('class'=>'btn btn-info btn-lg','style'=>'margin:20px;')) }}
            </div>
        </div>
        
    </div>
</div>



<!--# Modal Allow Refunds -->

<!--/ Modal Allow Refunds -->


@stop


@section('footer_script')
<!--[if lte IE 8]>
  <script src="{{ URL::asset('assets/js/ace/excanvas.js') }}"></script>
<![endif]-->
{{ HTML::script('assets/js/ace/jquery-ui.custom.js') }}
{{ HTML::script('assets/js/ace/date-time/bootstrap-datepicker.js') }}

<script type="text/javascript">
    jQuery(function($) {

            //datepicker plugin
            //link
            $('.date-picker').datepicker({
                    autoclose: true,
                    todayHighlight: true
            })
            //show datepicker when clicking on the icon
            .next().on(ace.click_event, function(){
                    $(this).prev().focus();
            });

    });
</script>

<script type="text/javascript">
$('#modalRefunds').on('shown.bs.modal', function () {
    $('#allow_Refunds_Remark').focus()
})
</script>

@stop