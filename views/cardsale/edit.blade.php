@extends('layouts.ace.main')


@section('header_script')
<!-- header_script -->
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li><a href="{{ URL::to('cate') }}"><i class="fa  fa-gear fa-lg"></i>ตั้งค่า</a></li>
    <li class="active">แก้ไขข้อมูลหมวดหมู่</li>
</ul>
@stop


@section('pageheader')
<h1>แก้ไขข้อมูลหมวดหมู่</h1>
@stop


@section('pagecontent')
<div class="row">
    <div class="col-xs-12">

        <!-- if there are creation error, they will show here -->
        {{ Form::model($cate,array('route'=>array('cate.update',$cate->de_set_cate_id),'method'=>'PUT','class'=>'form-horizontal')) }}

            @if($errors->all())
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8 alert alert-danger">
                    {{ HTML::ul($errors->all()) }}
                </div>
            </div>
            @endif
        
            <div class="form-group">
                {{ Form::label('de_set_cate_nameth','ชื่อหมวดหมู่ภาษาไทย',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-8">
                    {{ Form::text('de_set_cate_nameth',$cate->de_set_cate_nameth,array('class'=>'form-control','placeholder'=>'ชื่อหมวดหมู่ภาษาไทย','required')) }}
                </div>
                <span  style="color:#dd5a43;" ><b>*</b></span>
            </div>

            <div class="form-group">
                {{ Form::label('de_set_cate_nameen','ชื่อหมวดหมู่ภาษาอังกฤษ',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-8">
                    {{ Form::text('de_set_cate_nameen',$cate->de_set_cate_nameen,array('class'=>'form-control','placeholder'=>'ชื่อหมวดหมู่ภาษาอังกฤษ','required')) }}
                </div>
                <span  style="color:#dd5a43;" ><b>*</b></span>
            </div>
            <div class="form-group">
                {{ Form::label('de_set_cate_remark','หมายเหตุ',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-8">
                    {{ Form::textarea('de_set_cate_remark',$cate->de_set_cate_remark,array('class'=>'form-control','placeholder'=>'หมายเหตุ')) }}
                </div>
            </div>
             <div class="form-group">
                {{ Form::label('de_set_cate_status','สถานะ',array('class'=>'col-sm-2 control-label')) }}
                 <div class="radio">

                    <?php 

                     if($cate->de_set_cate_status =="Enable"){

                        $valueEnable = true;
                        $valueDisable = false;

                     }
                     else{

                       $valueEnable = false;
                       $valueDisable = true;
                     }

                    ?>
                   
                    <label>
                         {{ Form::radio('de_set_cate_status',  'Enable', $valueEnable, array('class'=>'ace')) }}
                         <span class="lbl">&nbsp;&nbsp;ใช้งาน</span>
                    </label>
                    <label>
                         {{ Form::radio('de_set_cate_status', 'Disable', $valueDisable, array('class'=>'ace')) }}
                         <span class="lbl">&nbsp;&nbsp;ไม่ใช้งาน</span>
                    </label>
                </div>
            </div>
        
          

            <div class="form-group">
                <div class="center">
                {{ Form::submit('บันทึก',array('class'=>'btn btn-success')) }}
                <a class="btn btn-info" style="margin-left:7px" href="{{ URL::to('cate') }}">ย้อนกลับ</a>
                </div>
            </div>
            
        {{ Form::close() }}
    </div>
</div>
@stop


@section('footer_script')
<!-- footer_script -->
@stop