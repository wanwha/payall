@extends('layouts.ace.main')


@section('header_script')
<!-- header_script -->
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li><a href="{{ URL::to('home') }}"><i class="fa fa-home fa-lg"></i>หน้าหลัก</a></li>
    <li class="active">ข้อมูลส่วนตัว</li>
</ul>
@stop


@section('pageheader')
<h1>ข้อมูลส่วนตัว</h1>
@stop


@section('pagecontent')
<!-- PAGE CONTENT BEGINS -->
<div class="row">
    <div class="col-xs-12">
        
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title">{{ Session::get('thisUser')->first_name }} {{ Session::get('thisUser')->last_name }}</h1>
                    </div>
                    <div class="panel-body">
                        <strong>ชื่อ : </strong>{{ Session::get('thisUser')->first_name }}<br />
                        <strong>นามสกุล : </strong>{{ Session::get('thisUser')->last_name }}<br />
                        <strong>อีเมล : </strong>{{ Session::get('thisUser')->email }}<br />
                        <strong>สร้างเมื่อ : </strong> {{ Session::get('thisUser')->created_at }}<br />
                        <strong>อัพเดตรเมื่อ : </strong> {{ Session::get('thisUser')->updated_at }}
                    </div>
                    <div class="panel-footer clearfix">
                        <div class="pull-right">
                            <h1 class="panel-title">
                                <a href="{{ URL::to('changepass') }}" class="btn btn-primary">Change Password</a>
                            </h1>
                        </div>
                    </div>
                </div><!-- end panel-->
            </div>
        </div>
        
        
    </div>
</div>
<!-- PAGE CONTENT ENDS --> 
@stop


@section('footer_script')
<!-- footer_script -->
@stop