@extends('layouts.ace.main')


@section('header_script')
{{ HTML::style('assets/css/ace/jquery-ui.custom.css') }}
{{ HTML::style('assets/css/ace/datepicker.css') }}
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li>{{ HTML::decode(link_to('member', '<i class="fa fa-users fa-lg"></i>จัดการสมาชิก')) }}</li>
    <li class="active">สร้างสมาชิกทั่วไป</li>
</ul>
@stop


@section('pageheader')
<h1>สร้างสมาชิกทั่วไป</h1>
@stop


@section('pagecontent')
<div class="row">
    <div class="col-xs-12">        
        {{ Form::open(array('url'=>'refunds','class'=>'form-horizontal','role'=>'form')) }}
            
            <!-- if there are creation error, they will show here -->
            @if($errors->all())
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8 alert alert-danger">
                    {{ HTML::ul($errors->all()) }}
                </div>
            </div>
            @endif
            
            <div class="form-group">
                {{ Form::label('code','รหัสสมาชิก 10 หลัก',array('class'=>'col-sm-3 control-label')) }}
                <div class="col-sm-5">
                    <div class="input-group">
                        {{ Form::text('code',null,array('class'=>'form-control','placeholder'=>'รหัสสมาชิก','readonly')) }}
                        <span class="input-group-addon">
                                <i class="fa fa-search bigger-110"></i>
                        </span>
                    </div>
                </div>
            </div>
        
            <div class="form-group">
                {{ Form::label('name','ชื่อ - สกุล',array('class'=>'col-sm-3 control-label')) }}    
                <div class="col-sm-5">
                    {{ Form::text('name',null,array('class'=>'form-control','placeholder'=>'ชื่อ - สกุล','disabled')) }}
                </div>
            </div>
        
            <div class="form-group">
                {{ Form::label('crate_date','สมัครเมื่อวันที่',array('class'=>'col-sm-3 control-label')) }}    
                <div class="col-sm-5">
                    <div class="input-group">
                        {{ Form::input('text','crated_date',null,array('class'=>'form-control date-picker','data-date-format'=>'dd-mm-yyyy','placeholder'=>'dd-mm-yyyy','disabled')) }}
                        <span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
                    </div>
                </div>
            </div>
        
            <div class="form-group">
                {{ Form::label('refunds_date','ขอคืนเงินเมื่อวันที่',array('class'=>'col-sm-3 control-label')) }}    
                <div class="col-sm-5">
                    <div class="input-group">
                        {{ Form::input('text','refunds_date',null,array('class'=>'form-control date-picker','data-date-format'=>'dd-mm-yyyy','placeholder'=>'dd-mm-yyyy')) }}
                        <span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                {{ Form::label('reason','เหตุผลการขอคืนเงิน',array('class'=>'col-sm-3 control-label')) }}    
                <div class="col-sm-5">
                    {{ Form::select('reason',['เลือกเหตุผล','ไม่มีเวลาทำ','มีปัญหาด้านการเงิน'], null, array('class'=>'form-control')) }}
                </div>
            </div>
            
                        <div class="form-group">
                {{ Form::label('status','สถานะรายการ',array('class'=>'col-sm-3 control-label')) }}    
                <div class="col-sm-5">
                    {{ Form::select('status',['เลือกสถานะ','รออนุมัติ','ยกเลิก'], null, array('class'=>'form-control')) }}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-5">
                {{ Form::submit('บันทึกรายการขอคืน',array('class'=>'btn btn-success')) }}&nbsp;&nbsp;
                <a href="{{ URL::to('refunds') }}" class="btn btn-warning">ยกเลิกรายการ</a>
                </div>
            </div>
            
        {{ Form::close() }}
    </div>
</div>
@stop


@section('footer_script')
<!--[if lte IE 8]>
  <script src="{{ asset('assets/js/ace/excanvas.js') }}"></script>
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
@stop