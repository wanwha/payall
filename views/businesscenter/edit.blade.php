@extends('layouts.ace.main')


@section('header_script')
{{ HTML::style('assets/css/ace/jquery-ui.custom.css') }}
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li><a href="{{ URL::to('businesscenter') }}"><i class="menu-icon fa fa-code-fork fa-lg"></i>จัดการสาขา</a></li>
    <li class="active">แก้ไขข้อมูลสาขา</li>
</ul>
@stop

@section('pageheader')
<h1>แก้ไขข้อมูลสาขา</h1>
@stop

@section('pagecontent')
<div class="row">
    <div class="col-xs-12">

        
        
        {{ Form::model($businesscenter, array('route'=>array('businesscenter.update', $businesscenter->bu_center_id), 'method' => 'PUT', 'class'=>'form-horizontal' )) }}



        
        <!-- if there are creation error, they will show here -->
            @if($errors->all())
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8 alert alert-danger">
                    {{ HTML::ul($errors->all()) }}
                </div>
            </div>
            @endif

            <div class="form-group">
                {{ Form::label('bu_center_name', 'ชื่อสาขาภาษาไทย :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-5" >
                    {{ Form::text('bu_center_name',$businesscenter->bu_center_name,array('class'=>'form-control','placeholder'=>'ชื่อสาขาภาษาไทย','required')) }}
                </div>
                <span style="color:#dd5a43"><b>*</b></span>
            </div>
            <!--<div class="form-group">
                {{ Form::label('bu_center_name', 'ชื่อสาขาภาษาอังกฤษ :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-8" >
                    {{ Form::text('bu_center_nameen',null,array('class'=>'form-control','placeholder'=>'ชื่อสาขาภาษาอังกฤษ','required')) }}
                </div>
                <span style="color:#dd5a43"><b>*</b></span>
            </div>-->

            <div class="form-group">
                {{ Form::label('bu_center_detail', 'รายละเอียด :', array('class' =>'col-sm-2 control-label')) }}
                    <div class="col-sm-5">
                        {{ Form::textarea('bu_center_detail',$businesscenter->bu_center_detail,array('class'=>'form-control','placeholder'=>'รายละเอียด','rows'=>'3')) }}
                    </div>
            </div>
            <!--<div class="form-group">
                {{ Form::label('bu_center_detail', 'รายละเอียดภาษาอังกฤษ :', array('class' =>'col-sm-2 control-label')) }}
                    <div class="col-sm-8">
                        {{ Form::textarea('bu_center_detail',null,array('class'=>'form-control','placeholder'=>'รายละเอียดภาษาอังกฤษ','rows'=>'3')) }}
                    </div>
            </div>-->

            <div class="form-group">
                {{ Form::label('bu_center_addr', 'ที่อยู่ :', array('class' =>'col-sm-2 control-label')) }}
                    <div class="col-sm-5">
                        {{ Form::textarea('bu_center_addr',$businesscenter->bu_center_addr,array('class'=>'form-control','placeholder'=>'ที่อยู่','rows'=>'3')) }}
                    </div>
            </div>
            <!--<div class="form-group">
                {{ Form::label('bu_center_addr', 'ที่อยู่ภาษาอังกฤษ :', array('class' =>'col-sm-2 control-label')) }}
                    <div class="col-sm-8">
                        {{ Form::textarea('bu_center_addr',null,array('class'=>'form-control','placeholder'=>'ที่อยู่ภาษาอังกฤษ','rows'=>'3')) }}
                    </div>
            </div>-->

            <div class="form-group">
                {{ Form::label('bu_center_disid', 'ตำบล/แขวง :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-5" >
                    {{ Form::select('bu_center_disid', $list_dis, $businesscenter->bu_center_disid,array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('bu_center_subprovid', 'อำเภอ/เขต :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-5" >
                    {{ Form::select('bu_center_subprovid', $list_subpro, $businesscenter->bu_center_subprovid,array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('bu_center_provid', 'จังหวัด :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-5" >
                    {{ Form::select('bu_center_provid', $list_pro, $businesscenter->bu_center_provid,array('class'=>'form-control')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('bu_center_postcode', 'ไปรษณีย์ :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-5" >
                    {{ Form::text('bu_center_postcode',$businesscenter->bu_center_postcode,array('class'=>'form-control','placeholder'=>'ไปรษณีย์')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('bu_center_tel', 'เบอร์ติดต่อ :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-5" >
                    {{ Form::text('bu_center_tel',$businesscenter->bu_center_tel,array('class'=>'form-control','placeholder'=>'เบอร์ติดต่อ')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('bu_center_fax', 'แฟกซ์ :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-5" >
                    {{ Form::text('bu_center_fax',$businesscenter->bu_center_fax,array('class'=>'form-control','placeholder'=>'แฟกซ์')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('bu_center_email', 'อีเมล์ :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-5" >
                    {{ Form::email('bu_center_email',$businesscenter->bu_center_email,array('class'=>'form-control','placeholder'=>'อีเมล์')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('bu_center_map', 'แผนที่/พิกัด :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-2" >
                    {{ Form::text('bu_center_latitude',$businesscenter->bu_center_latitude,array('class'=>'form-control','placeholder'=>'ละติจูด')) }}
                </div>
                <div class="col-sm-2" >
                    {{ Form::text('bu_center_longitude',$businesscenter->bu_center_longitude,array('class'=>'form-control','placeholder'=>'ลองติจูด')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('bu_center_website', 'เว็บไซต์ :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-5" >
                    {{ Form::text('bu_center_website',$businesscenter->bu_center_website,array('class'=>'form-control','placeholder'=>'เว็บไซต์')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('bu_center_ctrname', 'ผู้ประสานงานประจำสาขา :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-5" >
                    {{ Form::text('bu_center_ctrname',$businesscenter->bu_center_ctrname,array('class'=>'form-control','placeholder'=>'ผู้ประสานงานประจำสาขา')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('bu_center_ctrphone', 'เบอร์ติดต่อ :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-5" >
                    {{ Form::text('bu_center_ctrphone',$businesscenter->bu_center_ctrphone,array('class'=>'form-control','placeholder'=>'เบอร์ติดต่อผู้ประสานงานประจำสาขา')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('bu_center_ctremail', 'อีเมล์ :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-5" >
                    {{ Form::text('bu_center_ctremail',$businesscenter->bu_center_ctremail,array('class'=>'form-control','placeholder'=>'อีเมล์ผู้ประสานงานประจำสาขา')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('bu_center_ctrline', 'Line ID :', array('class' => 'col-sm-2 control-label')) }}
                <div class="col-sm-5" >
                    {{ Form::text('bu_center_ctrline',$businesscenter->bu_center_ctrline,array('class'=>'form-control','placeholder'=>'ไอดีไลน์ผู้ประสานงานประจำสาขา')) }}
                </div>
            </div>

    <div class="form-group">
                    {{ Form::label('bu_center_status','สถานะใช้งาน :',array('class'=>'col-sm-2 control-label')) }}
                    <div class="radio">
 
                        <?php 
 
                        if($businesscenter->bu_center_status =="Enable"){
 
                            $valueEnable = true;
                            $valueDisable = false;
 
                        }
                        else{
 
                            $valueEnable = false;
                            $valueDisable = true;
                        }
 
                    ?>
                    
                    <label>
                         {{ Form::radio('bu_center_status',  'Enable', $valueEnable, array('class'=>'ace')) }}
                         <span class="lbl">&nbsp;&nbsp;ใช้งาน</span>
                    </label>
                    <label>
                         {{ Form::radio('bu_center_status', 'Disable', $valueDisable, array('class'=>'ace')) }}
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

@stop