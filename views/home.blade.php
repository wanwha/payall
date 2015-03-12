@extends('layouts.ace.main')


@section('header_script')
<!-- header_script -->
@stop


@section('pageheader')
<h1>หน้าหลัก</h1>
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li><a href="{{ URL::to('home') }}"><i class="fa fa-home fa-lg"></i>หน้าหลัก</a></li>
</ul>
@stop


@section('pagecontent')
<!-- PAGE CONTENT BEGINS -->
<div class="left">
    this is Dashboard ... 
</div>
<!-- PAGE CONTENT ENDS -->
@stop


@section('footer_script')
<!-- footer_script -->
@stop

                
