@extends('layouts.ace.main')


@section('header_script')


@stop


@section('breadcrumbs')
<ul class="breadcrumb">
     <li><a href="{{ URL::to('shop') }}"><i class="fa fa-shopping-cart fa-lg"></i>จัดการร้านค้า</a></li>
     <li><a href='javascript:void(0)' onclick=" document.getElementById('shopcode').value='{{ $shopcode }}';document.getElementById('fshopcode').submit();">จัดการสาขา</a></li>
    <li class="active">รายละเอียดข้อมูลสาขา</li>
</ul>
@stop


@section('pageheader')
<h1>รายละเอียดข้อมูลสาขา</h1>
@stop


@section('pagecontent')
{{ Form::open( array( 'url'=>'branch', 'name'=>'fshopcode','id'=>'fshopcode') ) }}   
{{ Form::hidden('shopcode', null, array('id'=>'shopcode')) }}
{{ Form::close() }}

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
        
        <div class="col-sm-offset-2 col-sm-8 alert alert-sccess hidden-480">
                <div class="profile-info-name center"> รูปร้านค้า : </div>
                <div class="profile-info-row">     
                    <img src="/../payall/assets/image/{{ $branch->sh_branch_pic }}" style="width:604px;height:328px">
                </div>
            </div>  
        
        <div class="profile-user-info profile-user-info-striped" style="margin-top:10px;">
   
            <div class="profile-info-row">
                    <div class="profile-info-name"> ชื่อสาขา: </div>
                    <div class="profile-info-value">{{ GetText::expld_text($branch->sh_branch_name, 'thai') }}</div>
            </div>
             <div class="profile-info-row">
                    <div class="profile-info-name"> เบอร์ติดต่อ : </div>
                    <div class="profile-info-value">{{ $branch->sh_branch_tel  }}</div>
            </div>
            <div class="profile-info-row">
                    <div class="profile-info-name"> อีเมล์ : </div>
                    <div class="profile-info-value">{{ $branch->sh_branch_email  }}</div>
            </div>
             <div class="profile-info-row">
                    <div class="profile-info-name"> แผนที่/พิกัด : </div>
                    <div class="profile-info-value">{{ $branch->sh_branch_latitude.'-'.$branch->sh_branch_longitude }}</div>
            </div>
    
           
           
         
            
        </div>

        <div class="row">
            <div class="col-xs-12 center">
                <a href='javascript:void(0)' style="margin:20px" class="btn btn-info" 
                onclick=" document.getElementById('shopcode').value='{{ $shopcode }}';document.getElementById('fshopcode').submit();">ย้อนกลับ</a>
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


@stop