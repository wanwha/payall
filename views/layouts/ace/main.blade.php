<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />  
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Pay All</title>
        <meta name="description" content="page description" />
        <meta name="keywords" content="night" />
        <meta name="author" content="Yamada Yoseigi" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        {{-- bootstrap --}}
        {{ HTML::style('assets/css/bootstrap/bootstrap.min.css') }}

        {{-- font-awesome --}}
        {{ HTML::style('assets/css/font-awesome/font-awesome.min.css') }}

        <!-- page specific plugin styles -->
        {{-- ace styles --}}
        {{ HTML::style('assets/css/ace/ace.css',array('class'=>'ace-main-stylesheet','id'=>'main-ace-style')) }}
        {{ HTML::style('assets/css/ace/ace-fonts.css') }}

        <!--[if lte IE 9]>
            <link rel="stylesheet" href="{{ URL::asset('assets/css/ace/ace-part2.css') }}" class="ace-main-stylesheet" />
        <![endif]-->

        <!--[if lte IE 9]>
            <link rel="stylesheet" href="{{ URL::asset('assets/css/ace/ace-ie.css') }}" />
        <![endif]-->

        <!-- inline styles related to this page -->

        <!-- ace settings handler -->
        {{ HTML::script('assets/js/ace/ace-extra.js') }}

        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
            <script src="{{ URL::asset('assets/js/ace/html5shiv.js') }}"></script>
            <script src="{{ URL::asset('assets/js/ace/respond.js') }}"></script>
        <![endif]-->

        <style>
            .fa-lg { 
                vertical-align: 0 !important;
                padding-right: 5px;
            }
        </style>

        @yield('header_script',"<span style='background:red;'>MISSING HEADER SCRIPT</span>")

</head>
<body class="no-skin">

    <!-- navbar goes here -->
    @include('layouts.ace.navbar')


    <div class="main-container" id="main-container">
        <script type="text/javascript">
            try {
                ace.settings.check('main-container', 'fixed')
            } catch (e) {
            }
        </script>

        <!-- sidebar:left goes here -->
        @include('layouts.ace.sidebar')

        <div class="main-content">
            <div class="main-content-inner">


                <!-- breadcrumbs goes here  -->
                <div class="breadcrumbs">
                    <script type="text/javascript">
                        try {
                            ace.settings.check('breadcrumbs', 'fixed')
                        } catch (e) {
                        }
                    </script>
                    @yield("breadcrumbs","<span style='background:red;'>MISSING PAGE BREADCRUMBS</span>")

                    <!-- #searchbox -->
                    <!--<div class="nav-search" id="nav-search">
                            <form class="form-search">
                                    <span class="input-icon">
                                            <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                                            <i class="ace-icon fa fa-search nav-search-icon"></i>
                                    </span>
                            </form>
                    </div>--><!-- /searchbox -->
                </div>


                <div class="page-content">

                    <!-- #settings.box -->
                    {{-- include('layouts.ace.settingbox') --}}
                    <!-- /settings.box -->


                    <!-- page header goes here if needed -->
                    <div class="page-header">
                        @yield("pageheader","<span style='background:red;'>MISSING PAGE HEADER</span>")
                    </div>

                    <div class="row">
                        <div class="col-xs-12">

                            <!-- page content goes here -->
                            @yield("pagecontent","<span style='background:red;'>MISSING CONTENT</span>")

                        </div><!-- /.col -->
                    </div><!-- /.row -->

                </div><!-- /.page-content -->
            </div><!-- /.main-content -->
        </div><!-- /.main-content-inner -->

        <!-- footer area -->
        @include("layouts.ace.footer")

    </div><!-- /.main-container -->


    <!-- list of script files -->


    <!-- basic scripts -->

    <!--[if !IE]> -->
    <script type="text/javascript">
        window.jQuery || document.write("<script src='{{ URL::asset('assets/js/ace/jquery.js') }}'>" + "<" + "/script>");
    </script>
    <!-- <![endif]-->

    <!--[if IE]>
    <script type="text/javascript">
    </script>
     window.jQuery || document.write("<script src='{{ URL::asset('assets/js/ace/jquery1x.js') }}'>"+"<"+"/script>");
    <![endif]-->

    <script type="text/javascript">
        if ('ontouchstart' in document.documentElement)
            document.write("<script src='{{ URL::asset('assets/js/ace/jquery.mobile.custom.js') }}'>" + "<" + "/script>");
    </script>
    {{ HTML::script('assets/js/ace/bootstrap.js') }}

    <!-- ace scripts -->
    {{ HTML::script('assets/js/ace/ace/elements.scroller.js') }}
    {{ HTML::script('assets/js/ace/ace/elements.colorpicker.js') }}
    {{ HTML::script('assets/js/ace/ace/elements.fileinput.js') }}
    {{ HTML::script('assets/js/ace/ace/elements.typeahead.js') }}
    {{ HTML::script('assets/js/ace/ace/elements.wysiwyg.js') }}
    {{ HTML::script('assets/js/ace/ace/elements.spinner.js') }}
    {{ HTML::script('assets/js/ace/ace/elements.treeview.js') }}
    {{ HTML::script('assets/js/ace/ace/elements.wizard.js') }}
    {{ HTML::script('assets/js/ace/ace/elements.aside.js') }}
    {{ HTML::script('assets/js/ace/ace/ace.js') }}
    {{ HTML::script('assets/js/ace/ace/ace.ajax-content.js') }}
    {{ HTML::script('assets/js/ace/ace/ace.touch-drag.js') }}
    {{ HTML::script('assets/js/ace/ace/ace.sidebar.js') }}
    {{ HTML::script('assets/js/ace/ace/ace.sidebar-scroll-1.js') }}
    {{ HTML::script('assets/js/ace/ace/ace.submenu-hover.js') }}
    {{ HTML::script('assets/js/ace/ace/ace.widget-box.js') }}
    {{ HTML::script('assets/js/ace/ace/ace.settings.js') }}
    {{ HTML::script('assets/js/ace/ace/ace.settings-rtl.js') }}
    {{ HTML::script('assets/js/ace/ace/ace.settings-skin.js') }}
    {{ HTML::script('assets/js/ace/ace/ace.widget-on-reload.js') }}
    {{ HTML::script('assets/js/ace/ace/ace.searchbox-autocomplete.js') }}

    <!-- page specific plugin scripts -->
    @yield("footer_script","<span style='background:red;'>MISSING FOOTER SCRIPT</span>")


</body>
</html>