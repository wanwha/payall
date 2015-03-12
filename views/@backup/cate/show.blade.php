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
        
        
        <div class="table-header">
            @if( Session::has('message') )
            <div class="alert alert-block alert-info">
                <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                </button>
                <i class="ace-icon fa fa-check green"></i>
                {{ Session::get('message') }}
            </div>
            @endif
            
            @if($errors->all())
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8 alert alert-danger">
                    {{ HTML::ul($errors->all()) }}
                </div>
            </div>
            @endif
        </div>
        
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

        <div class="row">
            <div class="col-xs-12 center">
                {{ HTML::link('cate','ย้อนกลับ',array('class'=>'btn btn-info btn-lg','style'=>'margin:20px;')) }}
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