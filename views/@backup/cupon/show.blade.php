@extends('layouts.ace.main')


@section('header_script')
<!-- header_script -->
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li><a href="{{ URL::to('user') }}">ผู้ใช้งานระบบ</a></li>
    <li class="active">ข้อมูลผู้ใช้งาน</li>
</ul>
@stop


@section('pageheader')
<h1>ข้อมูลผู้ใช้งาน</h1>
@stop


@section('pagecontent')
<div class="row">
    <div class="col-sm-offset-1 col-sm-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title">{{ $user->first_name }} {{ $user->last_name }}</h1>
            </div>
            <div class="panel-body">
                <strong>ชื่อ : </strong>{{ $user->first_name }}<br />
                <strong>นามสกุล : </strong>{{ $user->last_name }}<br />
                <strong>อีเมล : </strong>{{ $user->email }}<br />
                <strong>สร้างเมื่อ : </strong>{{ $user->created_at }}<br />
                <strong>อัพเดตรเมื่อ : </strong>{{ $user->updated_at }}
            </div>
            <div class="panel-footer clearfix">
                <div class="pull-right">
                    <h1 class="panel-title">
                        <a href="{{ URL::to('user/'.$user->id.'/edit') }}" class="btn btn-primary">แก้ไขข้อมูล</a>
                    </h1>
                </div>
            </div>
        </div><!-- end panel-->
    </div>
</div>

@stop


@section('footer_script')
<!-- footer_script -->
@stop