@extends('layouts.ace.login')


@section('header_script')
<!-- header_script -->
@stop

@section('pagecontent')
<div class="error-container">
    <div class="well">
        <h1 class="grey lighter smaller">
            <span class="blue bigger-125">
                <i class="ace-icon fa fa-sitemap"></i>
                Page Error
            </span>
            <!--Page Not Found-->
        </h1>

        <hr />
        <h3 class="lighter smaller"><!--We looked everywhere but we couldn't find it!--></h3>

        <div>
            <div class="space"></div>
            <h4 class="smaller"><!--Try one of the following:--></h4>

            <!--<ul class="list-unstyled spaced inline bigger-110 margin-15">
                <li>
                    <i class="ace-icon fa fa-hand-o-right blue"></i>
                    Re-check the url for typos
                </li>

                <li>
                    <i class="ace-icon fa fa-hand-o-right blue"></i>
                    Read the faq
                </li>

                <li>
                    <i class="ace-icon fa fa-hand-o-right blue"></i>
                    Tell us about it
                </li>
            </ul>-->
        </div>

        <hr />
        <div class="space"></div>

        <div class="center">
            <a href="javascript:history.back()" class="btn btn-grey">
                <i class="ace-icon fa fa-arrow-left"></i>
                Go Back
            </a>
        </div>
    </div>
</div>
@stop


@section('footer_script')
<!-- footer_script -->
@stop