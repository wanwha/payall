@extends('layouts.ace.main')


@section('header_script')
{{ HTML::style('assets/css/ace/jquery-ui.custom.css') }}
{{ HTML::style('assets/css/ace/bootstrap-duallistbox.css') }}
{{ HTML::style('assets/css/ace/daterangepicker.css') }}
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li>{{ HTML::decode(link_to('deal', '<i class="fa fa-barcode fa-lg"></i>จัดการดีล/คูปอง')) }}</li>
    <li class="active">สร้างดีล/คูปอง</li>
</ul>
@stop


@section('pageheader')
<h1>สร้างดีล/คูปอง</h1>
@stop


@section('pagecontent')
<div class="row">
    <div class="col-xs-12"> 
        
        @include('layouts.ace.message')
        
        {{ Form::open(array('url'=>'deal','class'=>'form-horizontal','role'=>'form')) }}
            
            <div class="form-group">
                {{ Form::label('input_pic','เพิ่มรูปภาพ',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{-- Form::file('code',null,array('class'=>'form-control')) --}}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('input_typeid','ประเภทดีล/คูปอง',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::select('input_typeid', $list_dealtype, null, array('class'=>'form-control')) }}
                </div>
            </div>
            
            <div class="form-group">
                {{ Form::label('input_shopid','ร้านค้า', array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::select('input_shopid', $list_shop, null, array('class'=>'form-control')) }}
                </div>
            </div>
            
            @include('deal.ajax.input_branch')
            
            <div id="ajaxshop_cate">
                @include('deal.ajax.input_cate')
            </div>

            <div class="form-group" id="title_TH">
                {{ Form::label('input_titleth','หัวข้อ (ไทย)',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::text('input_titleth', null, array('class'=>'form-control', 'id'=>'input_titleth')) }}
                </div>
                <div class="col-xs-6 col-sm-2">
                    {{ Form::select('selectLang_title', Getlist::$list_lang, null, array('id'=>'selectLang_title', 'class'=>'form-control', 'style'=>'width:98%;')) }}
                </div>
                <div class="col-xs-6 col-sm-2">
                    <a href="javascript:void(0)" id="addTitle" class="btn btn-mini btn-inverse"><i class="fa fa-plus"></i><span style="margin-left:5px;">เพิ่มภาษา</span></a>
                </div>
            </div>
            
            <div class="form-group" id="title_eng">
                {{ Form::label('input_titleen','หัวข้อ (อังกฤษ)',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::text('input_titleen',null,array('class'=>'form-control', 'id'=>'input_titleen')) }}
                </div>
                <div class="col-xs-6 col-sm-2">
                    <a href="javascript:void(0)" id="delTitle_eng" class="btn btn-mini btn-light"><i class="fa fa-minus"></i><span style="margin-left:5px;">ลบ</span></a>
                </div>
            </div>
            
            <div class="form-group" id="detail_TH">
                {{ Form::label('input_detailth', 'รายละเอียด (ไทย)', array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::textarea('input_detailth', null, array('class'=>'form-control', 'id'=>'input_detailth', 'rows'=>'5' )) }}
                </div>
                <div class="col-xs-6 col-sm-2">
                    {{ Form::select('selectLang_detail', Getlist::$list_lang, null, array('id'=>'selectLang_detail', 'class'=>'form-control', 'style'=>'width:98%;')) }}
                </div>
                <div class="col-xs-6 col-sm-2">
                    <a href="javascript:void(0)" id="addDetail" class="btn btn-mini btn-inverse"><i class="fa fa-plus"></i><span style="margin-left:5px;">เพิ่มภาษา</span></a>
                </div>
            </div>
            
            <div class="form-group" id="detail_eng">
                {{ Form::label('input_detailen','รายละเอียด (อังกฤษ)',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::textarea('input_detailen', null, array('class'=>'form-control', 'id'=>'input_detailen', 'rows'=>'5' )) }}
                </div>
                <div class="col-xs-6 col-sm-2">
                    <a href="javascript:void(0)" id="delDetail_eng" class="btn btn-mini btn-light"><i class="fa fa-minus"></i><span style="margin-left:5px;">ลบ</span></a>
                </div>
            </div>
            
            <div class="form-group">
                {{ Form::label('date-range-picker','ระยะเวลา',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    <div class="input-group">
                            {{ Form::text('date-range-picker', null, array('class'=>'form-control', 'id'=>'id-date-range-picker-1')) }}
                            <span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                {{ Form::label('input_price','ราคาเต็ม',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::text('input_price', null, array('class'=>'form-control')) }}
                </div>บาท
            </div>
            
            <div class="form-group">
                {{ Form::label('input_shopdis', 'ร้านค้าลด', array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::text('input_shopdis', null, array('class'=>'form-control')) }}
                </div>%
            </div>
            
            <div class="form-group">
                {{ Form::label('input_cusdis', 'ส่วนลดลูกค้า', array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::text('input_cusdis', null, array('class'=>'form-control')) }}
                </div>%
            </div>
            
            <div class="form-group">
                {{ Form::label('input_pa', 'PA', array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::text('input_pa', null, array('class'=>'form-control')) }}
                </div>
            </div>
            
            <div class="form-group">
                {{ Form::label('input_point', 'Potint ที่ได้', array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::text('input_point', null, array('class'=>'form-control')) }}
                </div>Point
            </div>
            
            <div class="row" style="margin-top: 40px;">
                <div class="col-xs-12 center">
                    {{ Form::submit('บันทึก' ,array('class'=>'btn btn-info')) }}
                    {{ HTML::link('deal','ยกเลิก',array('class'=>'btn btn-default','style'=>'margin-left:7px;')) }}
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
{{ HTML::script('assets/js/ace/jquery.bootstrap-duallistbox.js') }}
{{ HTML::script('assets/js/ace/date-time/moment.js') }}
{{ HTML::script('assets/js/ace/date-time/daterangepicker.js') }}

<script type="text/javascript">
    jQuery(function($) {
        var demo1 = $('select[name="input_branchid[]"]').bootstrapDualListbox({infoTextFiltered: '<span class="label label-purple label-lg">Filtered</span>'});
        var container1 = demo1.bootstrapDualListbox('getContainer');
        container1.find('.btn').addClass('btn-white btn-info btn-bold');
                   
    });
</script>

<script type="text/javascript">
function selectShop() {
    $.ajax({
        type: 'POST',
        url: '{{ URL::to("deal/ajax_branch") }}',
        cache: true,
        data : {input_shopid:$("#input_shopid").val()},
        beforeSend: function(){
            // Disable selectbox
            $('#input_branchid').prop('disabled', true);
            $('select[name="input_branchid[]_helper1"]').prop('disabled', true);
            $('select[name="input_branchid[]_helper2"]').prop('disabled', true);
        },
        success: function(data){
        
            $('select[name="input_branchid[]_helper1"]').empty();
            $('select[name="input_branchid[]_helper2"]').empty();
            $('#input_branchid').empty().html(data);
            
            $('select[name="input_branchid[]"]').bootstrapDualListbox('refresh');
            
            // Re-enable selectbox
            $('#input_branchid').prop('disabled', false);
            $('select[name="input_branchid[]_helper1"]').prop('disabled', false);
            $('select[name="input_branchid[]_helper2"]').prop('disabled', false);
            
        }
    });
    return false;
};

$("#input_shopid").change(function(){ selectShop(); selectShop2(); });
$(document).ready(function(){ selectShop(); selectShop2(); });

$(document).one('ajaxloadstart.page', function(e) {
    $('select[name="input_branchid[]"]').bootstrapDualListbox('destroy');
});
</script>

<script type="text/javascript">
$(document).ready(function(){ 
    $('#input_titleen').val(null); 
    $('#title_eng').hide(); 
    $('#input_detailen').val(null); 
    $('#detail_eng').hide(); 
    
});

//Title
$('#addTitle').click(function(){
    if($('#selectLang_title').val()==0){
        alert('โปรดเลือกภาษา');
    }else if($('#selectLang_title').val()==1){
        alert('มีช่องกรอกหัวข้อภาษาไทยอยู่แล้ว');
    }else if($('#selectLang_title').val()==2){
         $('#title_eng').show("slow");
    }    
});
$('#delTitle_eng').click(function(){
    $('#input_titleen').val(null); 
    $('#title_eng').hide("slow"); 
});

//Detail
$('#addDetail').click(function(){
    if($('#selectLang_detail').val()==0){
        alert('โปรดเลือกภาษา');
    }else if($('#selectLang_detail').val()==1){
        alert('มีช่องกรอกรายละเอียดภาษาไทยอยู่แล้ว');
    }else if($('#selectLang_detail').val()==2){
         $('#detail_eng').show("slow");
    }    
});
$('#delDetail_eng').click(function(){
    $('#input_detailen').val(null); 
    $('#detail_eng').hide("slow");  
});
</script>

<script type="text/javascript">
$('input[name=date-range-picker]').daterangepicker({
        'applyClass' : 'btn-sm btn-success',
        'cancelClass' : 'btn-sm btn-default',
        locale: {
                applyLabel: 'Apply',
                cancelLabel: 'Cancel',
        }
})
.prev().on(ace.click_event, function(){
        $(this).next().focus();
});

$(document).one('ajaxloadstart.page', function(e) {
    $('.daterangepicker.dropdown-menu').remove();
});
</script>
@stop