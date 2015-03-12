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
    <li>{{ HTML::decode(link_to('refunds', '<i class="fa fa-users fa-lg"></i>จัดการสมาชิก')) }}</li>
    <li><a href="{{ URL::to('refunds') }}">ขอคืนเงิน</a></li>
    <li class="active">รายละเอียดรายการขอคืนเงิน</li>
</ul>
@stop


@section('pageheader')
<h1>รายละเอียดรายการขอคืนเงิน</h1>
@stop


@section('pagecontent')
<div class="row">
    <div class="col-xs-12">
        
        @include('layouts.ace.message')
        
        <div class="profile-user-info profile-user-info-striped" style="margin-top:10px;">
            <div class="profile-info-row">
                    <div class="profile-info-name"> รหัส : </div>
                    <div class="profile-info-value">{{ $refund->mb_refund_id }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> รหัสสมาชิก 10 หลัก : </div>
                    <div class="profile-info-value">{{ $refund->mb_mem_code }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> ชื่อ-สกุล : </div>
                    <div class="profile-info-value">{{ GetList::$list_prefix[$refund->mb_mem_prefix].$refund->mb_mem_fnameth.' '.$refund->mb_mem_lnameth }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> สมัครเมื่อวันที่ : </div>
                    <div class="profile-info-value">{{ GetFormat::format_DateTime($refund->mb_refund_credate) }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> ขอคืนเงินเมื่อวันที่ : </div>
                    <div class="profile-info-value">{{ GetFormat::format_DateTime($refund->mb_refund_issuedate) }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> สถานะรายการ : </div>
                    <div class="profile-info-value">
                        {{ GetList::$list_status[$refund->mb_refund_status] }}&nbsp;&nbsp;
                        @if($refund->mb_refund_status == 1)
                        <a href="javascript:void(0)" title="View" id="modalRefunds" data-toggle="modal" data-target="#myModal" 
                            onclick=" document.getElementById('allow_Refunds_ID').value='{{ $refund->mb_refund_id }}' ">
                            <span class="orange">
                                <i class="ace-icon fa fa-gavel bigger-120"></i>
                            </span>
                        </a>
                        @endif
                    </div>
            </div>
            
            @if($refund->mb_refund_status != 1)
            <div class="profile-info-row">
                    <div class="profile-info-name"> วันที่อนุมัติ : </div>
                    <div class="profile-info-value">{{ GetFormat::format_DateTime($refund->mb_refund_appdate) }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> เหตุผลการอนุมัติ : </div>
                    <div class="profile-info-value">{{ GetList::$list_remark[$refund->mb_refund_remark] }}</div>
            </div>
            @endif
            
        </div>

        <div class="row">
            <div class="col-xs-12 center">
                {{ HTML::link('refunds','ย้อนกลับ',array('class'=>'btn btn-info btn-lg','style'=>'margin:20px;')) }}
            </div>
        </div>
        
    </div>
</div>



<!--# Modal Allow Refunds -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
        <!--# TITLE AREA -->
        <h4 class="modal-title" id="myModalLabel">อนุมัติการขอคืนเงิน</h4>
        <!--# TITLE AREA -->
        
      </div>
      <div class="modal-body">
      {{ Form::open(array('url'=>'allowrefund','class'=>'form-horizontal','role'=>'form')) }}
      {{ Form::hidden('allow_Refunds_ID', null, array('id'=>'allow_Refunds_ID')) }}
        <!--# CONTENT AREA -->
        <div class="row">
            <div class="col-xs-12">

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <label class="line-height-1 blue">
                            {{ Form::radio('allow_Refunds_Status', 2, false, ['class' => 'ace']) }}
                            <span class="lbl"> อนุมัติ</span>&nbsp;&nbsp;&nbsp;
                        </label>
                        <label class="line-height-1 blue">
                            {{ Form::radio('allow_Refunds_Status', 3, false, ['class' => 'ace']) }}
                            <span class="lbl"> ไม่อนุมัติ</span>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('allow_Refunds_Date','เมื่อวันที่',array('class'=>'col-sm-2 control-label')) }} 
                    <div class="col-sm-8">
                        <div class="input-group">
                            {{ Form::input('text','allow_Refunds_Date',null,array('class'=>'form-control date-picker','data-date-format'=>'dd-mm-yyyy','placeholder'=>'dd-mm-yyyy')) }}
                            <span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    {{ Form::label('allow_Refunds_Remark','หมายเหตุ',array('class'=>'col-sm-2 control-label')) }}  
                    <div class="col-sm-8">
                        <div class="input-group" style="width:100%">
                            {{ Form::select('allow_Refunds_Remark', GetList::$list_remark, null, array('class'=>'form-control', 'style'=>'width:inherit;')
                             ) }}
                        </div>
                    </div>
                </div>  

            </div>
        </div>
        <!--/ CONTENT AREA -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        {{ Form::submit('บันทึก', array('class'=>'btn btn-primary')) }}
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
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