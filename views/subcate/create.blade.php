@extends('layouts.ace.main')


@section('header_script')
<!-- header_script -->
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li><a href="{{ URL::to('subcate') }}"><i class="fa fa-cog fa-lg"></i>ตั้งค่า</a></li>
    <li class="active">สร้างหมวดหมู่ย่อย</li>
</ul>
@stop

@section('pageheader')
<h1>สร้างหมวดหมู่ย่อย</h1>
@stop

@section('pagecontent')
<div class="row">
    <div class="col-xs-12">
        
        @include('layouts.ace.message')
        
        {{ Form::open(array('url'=>'subcate','class'=>'form-horizontal','role'=>'form')) }}

        	<div class="form-group">
		{{ Form::label('de_set_scate_cateid', 'หมวดหมู่ :', array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-8" >
                        
			{{ Form::select('de_set_scate_cateid', $list_cate, null,array('class'=>'form-control')) }}
		
                    </div>
	</div>

	<div class="form-group">
		{{ Form::label('de_set_scate_nameth', 'ชื่อหมวดหมู่ภาษาไทย :', array('class' =>'col-sm-2 control-label')) }}
		<div class="col-sm-8">
			{{ Form::text('de_set_scate_nameth',null,array('class'=>'form-control','placeholder'=>'ชื่อหมวดหมู่ภาษาไทย','required')) }}
                    </div>
                    <span style="color:#dd5a43"><b>*</b></span>
	</div>

	<div class="form-group">
		{{ Form::label('de_set_scate_nameen', 'ชื่อหมวดหมู่ภาษาอังกฤษ :', array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-8">
			{{ Form::text('de_set_scate_nameen',null,array('class'=>'form-control','placeholder'=>'ชื่อหมวดหมู่ภาษาอังกฤษ','required')) }}
		</div>
                    <span style="color:#dd5a43"><b>*</b></span>
	</div>

	<div class="form-group">
		{{ Form::label('de_set_scate_remark', 'หมายเหตุ :', array('class' => 'col-sm-2 control-label')) }}
		<div class="col-sm-8">
			{{ Form::textarea('de_set_scate_remark',null,array('class'=>'form-control')) }}
		</div>
	</div>

	<div class="form-group">
                	{{ Form::label('de_set_scate_status','สถานะใช้งาน :',array('class'=>'col-sm-2 control-label')) }}
                 	<div class="radio col-sm-8 ">
                 		<label>
                        		{{ Form::radio('de_set_scate_status', 'Enable', false, array('class'=>'ace')) }}
                        		<span class="lbl">&nbsp;&nbsp;ใช้งาน</span>
                    		</label>&nbsp;&nbsp;&nbsp;
                    		<label>
                        		{{ Form::radio('de_set_scate_status', 'Disable',  true, array('class'=>'ace') ) }}
                        		<span class="lbl">&nbsp;&nbsp;ไม่ใช้งาน</span>
                    		</label>
                    	</div>
          </div>

          <div class="form-group">
            <div class="center">
		{{ Form::submit('บันทึก' ,array('class'=>'btn btn-success')) }}

                    <a class="btn btn-info" href="{{ URL::to('subcate') }}" style="margin-left:7px">ยกเลิก</a>
                </div>
        </div>
        {{ Form::close() }}
        
    </div>
</div>

@stop

@section('footer_script')

@stop