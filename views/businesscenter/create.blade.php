@extends('layouts.ace.main')


@section('header_script')
{{ HTML::style('assets/css/ace/jquery-ui.custom.css') }}
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li><a href="{{ URL::to('businesscenter') }}"><i class="menu-icon fa fa-code-fork fa-lg"></i>จัดการสาขา</a></li>
    <li class="active">สร้างข้อมูลสาขา</li>
</ul>
@stop

@section('pageheader')
<h1>สร้างข้อมูลสาขา</h1>
@stop

@section('pagecontent')
<div class="row">
    <div class="col-xs-12">
            
        
        {{ Form::open(array('url'=>'businesscenter', 'files'=>true, 'class'=>'form-horizontal','role'=>'form')) }}
        
        <!-- if there are creation error, they will show here -->
            @if($errors->all())
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8 alert alert-danger">
                    {{ HTML::ul($errors->all()) }}
                </div>
            </div>
            @endif
            <div class="form-group">
                {{ Form::label('bu_center_pic', 'รูปภาพ :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-8" >
                    {{ Form::file('bu_center_pic',array('class'=>'form-control','id'=>'id-input-file-2')) }}
                </div>
            </div>

            <div class="form-group" id="title_thai">
                {{ Form::label('bu_center_name','ชื่อสาขาภาษาไทย :',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-6">
                    <div class="row">
                    {{ Form::text('bu_center_name', null, array('class'=>'form-control', 'id'=>'bu_center_name')) }}
                    <span style="color:#dd5a43"><b>*</b></span>
                </div>
                </div>
                <div class="col-xs-6 col-sm-2">
                    {{ Form::select('selectLang_title', Getlist::$list_lang, null, array('id'=>'selectLang_title', 'class'=>'form-control', 'style'=>'width:98%;')) }}
                </div>
            <div class="col-xs-6 col-sm-2">
                    <a href="javascript:void(0)" id="addTitle" class="btn btn-mini btn-inverse"><i class="fa fa-plus"></i><span style="margin-left:5px;">เพิ่มภาษา</span></a>
                </div>
            </div>
             <div class="form-group" id="title_eng">
                {{ Form::label('input_titleen','ชื่อสาขาภาษาอังกฤษ',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-6">
                    {{ Form::text('input_titleen',null,array('class'=>'form-control', 'id'=>'input_titleen')) }}
                </div>
                <div class="col-xs-6 col-sm-2">
                    <a href="javascript:void(0)" id="delTitle_eng" class="btn btn-mini btn-light"><i class="fa fa-minus"></i><span style="margin-left:5px;">ลบ</span></a>
                </div>
            </div>

            <div class="form-group" id="title_thai">
                {{ Form::label('bu_center_detail','รายละเอียดภาษาไทย :',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-6">
                    {{ Form::textarea('bu_center_detail', null, array('class'=>'form-control', 'id'=>'bu_center_detail', 'rows'=>'3')) }}
                </div>
                <div class="col-xs-6 col-sm-2">
                    {{ Form::select('selectLang_detail', Getlist::$list_lang, null, array('id'=>'selectLang_detail', 'class'=>'form-control', 'style'=>'width:98%;')) }}
                </div>
            <div class="col-xs-6 col-sm-2">
                    <a href="javascript:void(0)" id="addDetail" class="btn btn-mini btn-inverse"><i class="fa fa-plus"></i><span style="margin-left:5px;">เพิ่มภาษา</span></a>
                </div>
            </div>
             <div class="form-group" id="detail_eng">
                {{ Form::label('input_detailen','รายละเอียดภาษาอังกฤษ',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-6">
                    {{ Form::textarea('input_detailen',null,array('class'=>'form-control', 'id'=>'input_detailen', 'rows'=>'3')) }}
                </div>
                <div class="col-xs-6 col-sm-2">
                    <a href="javascript:void(0)" id="delDetail_eng" class="btn btn-mini btn-light"><i class="fa fa-minus"></i><span style="margin-left:5px;">ลบ</span></a>
                </div>
            </div>

            <div class="form-group" id="title_thai">
                {{ Form::label('bu_center_addr','ที่อยู่ภาษาไทย :',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-6">
                    {{ Form::textarea('bu_center_addr', null, array('class'=>'form-control', 'id'=>'bu_center_addr', 'rows'=>'3')) }}
                </div>
                <div class="col-xs-6 col-sm-2">
                    {{ Form::select('selectLang_addr', Getlist::$list_lang, null, array('id'=>'selectLang_addr', 'class'=>'form-control', 'style'=>'width:98%;')) }}
                </div>
            <div class="col-xs-6 col-sm-2">
                    <a href="javascript:void(0)" id="addAddr" class="btn btn-mini btn-inverse"><i class="fa fa-plus"></i><span style="margin-left:5px;">เพิ่มภาษา</span></a>
                </div>
            </div>
             <div class="form-group" id="addr_eng">
                {{ Form::label('input_addren','ที่อยู่ภาษาอังกฤษ',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-6">
                    {{ Form::textarea('input_addren',null,array('class'=>'form-control', 'id'=>'input_addren', 'rows'=>'3')) }}
                </div>
                <div class="col-xs-6 col-sm-2">
                    <a href="javascript:void(0)" id="delAddr_eng" class="btn btn-mini btn-light"><i class="fa fa-minus"></i><span style="margin-left:5px;">ลบ</span></a>
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('bu_center_disid', 'ตำบล/แขวง :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-8" >
                    {{ Form::select('bu_center_disid', $list_dis, null,array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('bu_center_subprovid', 'อำเภอ/เขต :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-8" >
                    {{ Form::select('bu_center_subprovid', $list_subpro, null,array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('bu_center_provid', 'จังหวัด :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-8" >
                    {{ Form::select('bu_center_provid', $list_pro, null,array('class'=>'form-control')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('bu_center_postcode', 'ไปรษณีย์ :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-8" >
                    {{ Form::text('bu_center_postcode',null,array('class'=>'form-control','placeholder'=>'ไปรษณีย์')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('bu_center_tel', 'เบอร์ติดต่อ :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-8" >
                    {{ Form::text('bu_center_tel',null,array('class'=>'form-control','placeholder'=>'เบอร์ติดต่อ')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('bu_center_fax', 'แฟกซ์ :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-8" >
                    {{ Form::text('bu_center_fax',null,array('class'=>'form-control','placeholder'=>'แฟกซ์')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('bu_center_email', 'อีเมล์ :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-8" >
                    {{ Form::email('bu_center_email',null,array('class'=>'form-control','placeholder'=>'อีเมล์')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('bu_center_map', 'แผนที่/พิกัด :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-4" >
                    {{ Form::text('bu_center_latitude',null,array('class'=>'form-control','placeholder'=>'ละติจูด')) }}
                </div>
                <div class="col-sm-4" >
                    {{ Form::text('bu_center_longitude',null,array('class'=>'form-control','placeholder'=>'ลองติจูด')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('bu_center_mappic', 'แนบไฟล์แผนที่ :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-8" >
                    {{ Form::file('bu_center_mappic',array('class'=>'form-control','id'=>'id-input-file-2')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('bu_center_website', 'เว็บไซต์ :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-8" >
                    {{ Form::text('bu_center_website',null,array('class'=>'form-control','placeholder'=>'เว็บไซต์')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('bu_center_ctrname', 'ผู้ประสานงานประจำสาขา :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-8" >
                    {{ Form::text('bu_center_ctrname',null,array('class'=>'form-control','placeholder'=>'ผู้ประสานงานประจำสาขา')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('bu_center_ctrphone', 'เบอร์ติดต่อ :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-8" >
                    {{ Form::text('bu_center_ctrphone',null,array('class'=>'form-control','placeholder'=>'เบอร์ติดต่อผู้ประสานงานประจำสาขา')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('bu_center_ctremail', 'อีเมล์ :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-8" >
                    {{ Form::text('bu_center_ctremail',null,array('class'=>'form-control','placeholder'=>'อีเมล์ผู้ประสานงานประจำสาขา')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('bu_center_ctrline', 'Line ID :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-8" >
                    {{ Form::text('bu_center_ctrline',null,array('class'=>'form-control','placeholder'=>'ไอดีไลน์ผู้ประสานงานประจำสาขา')) }}
                </div>
            </div>

            <div class="form-group">
                    {{ Form::label('bu_center_status','สถานะใช้งาน :',array('class'=>'col-sm-2 control-label')) }}
                    <div class="radio col-sm-8 ">
                        <label>
                                {{ Form::radio('bu_center_status', 'Enable', true, array('class'=>'ace')) }}
                                <span class="lbl">&nbsp;&nbsp;ใช้งาน</span>
                            </label>&nbsp;&nbsp;&nbsp;
                            <label>
                                {{ Form::radio('bu_center_status', 'Disable',  false, array('class'=>'ace') ) }}
                                <span class="lbl">&nbsp;&nbsp;ไม่ใช้งาน</span>
                            </label>
                        </div>
          </div>

          



            <div class="form-group">
                <div class="center">
                    {{ Form::submit('บันทึก' ,array('class'=>'btn btn-success')) }}
                    <a class="btn btn-danger" href="{{ URL::to('businesscenter') }}" style="margin-left:7px">ยกเลิก</a>
                </div>
        </div>
        {{ Form::close() }}
        
    </div>
</div>

@stop

@section('footer_script')

<script type="text/javascript">
     jQuery(document).ready(function(){ 
    $('#input_titleen').val(null); 
    $('#title_eng').hide(); 
            });
 
//Name
$('#addTitle').click(function(){
    if($('#selectLang_title').val()==0){
        alert('โปรดเลือกภาษา');
    }else if($('#selectLang_title').val()==1){
        alert('มีช่องกรอกชื่อสาขาภาษาไทยอยู่แล้ว');
    }else if($('#selectLang_title').val()==2){
         $('#title_eng').show("slow");
    }    
});
$('#delTitle_eng').click(function(){
    $('#input_titleen').val(null); 
    $('#title_eng').hide("slow"); 
});
</script>

<script type="text/javascript">
     jQuery(document).ready(function(){ 
    $('#input_detailen').val(null); 
    $('#detail_eng').hide(); 
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
     jQuery(document).ready(function(){ 
    $('#input_addren').val(null); 
    $('#addr_eng').hide(); 
            });
 
//Addr
$('#addAddr').click(function(){
    if($('#selectLang_addr').val()==0){
        alert('โปรดเลือกภาษา');
    }else if($('#selectLang_addr').val()==1){
        alert('มีช่องกรอกที่อยู่ภาษาไทยอยู่แล้ว');
    }else if($('#selectLang_addr').val()==2){
         $('#addr_eng').show("slow");
    }    
});
$('#delAddr_eng').click(function(){
    $('#input_addren').val(null); 
    $('#addr_eng').hide("slow"); 
});
</script>

<script type="text/javascript">

   

             $('#id-input-file-1 , #id-input-file-2').ace_file_input({
                    no_file:'No File ...',
                    btn_choose:'Choose',
                    btn_change:'Change',
                    droppable:false,
                    onchange:null,
                    thumbnail:false //| true | large
                    //whitelist:'gif|png|jpg|jpeg'
                    //blacklist:'exe|php'
                    //onchange:''
                    //
                });

</script>

@stop