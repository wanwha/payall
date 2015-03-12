<!doctype html>
<html lang="en">
<head>
    
<meta charset="utf-8" />  
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<title>Pay All</title>
<meta name="description" content="User Login page" />
<meta name="keywords" content="Pay All" />
<meta name="author" content="Yamada Yoseigi" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

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
{{ HTML::style('assets/css/ace/ace-rtl.css') }}

<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

<!--[if lte IE 8]>
    <script src="{{ URL::asset('assets/js/ace/html5shiv.js') }}"></script>
    <script src="{{ URL::asset('assets/js/ace/respond.js') }}"></script>
<![endif]-->

<!-- inline styles related to this page -->
@yield("header_script","<span style='background:red;'>MISSING HEADER SCRIPT</span>")

</head>
<body class="login-layout">
 
  <div class="main-container">
   <div class="main-content">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            @if( Session::has('success') )
                <div class="alert alert-block alert-success" style="margin-top: 30px">
                    <button type="button" class="close" data-dismiss="alert">
                            <i class="ace-icon fa fa-times"></i>
                    </button>
                    {{ Session::get('success') }}
                </div>
            @elseif(Session::has('danger'))
                <div class="alert alert-block alert-danger" style="margin-top: 30px">
                    <button type="button" class="close" data-dismiss="alert">
                            <i class="ace-icon fa fa-times"></i>
                    </button>
                    {{ Session::get('danger') }}
                </div>
            @endif
        </div>
     <div class="col-sm-10 col-sm-offset-1">
     <!-- page content goes here -->
     @yield("pagecontent",'<span style="background:red;">MISSING CONTENT</span>')
     </div><!-- /.col -->
    </div><!-- /.row -->
   </div><!-- /.main-content -->
   
   <!-- footer area -->
   

  </div><!-- /.main-container -->

    <!-- list of script files -->
    <!-- basic scripts -->

    <!--[if !IE]> -->
    <script type="text/javascript">
            window.jQuery || document.write("<script src='{{ URL::asset('assets/js/ace/jquery.js') }}'>"+"<"+"/script>");
    </script>
    <!-- <![endif]-->

    <!--[if IE]>
    <script type="text/javascript">
    </script>
     window.jQuery || document.write("<script src='{{ URL::asset('assets/js/ace/jquery1x.js') }}'>"+"<"+"/script>");
    <![endif]-->

    <script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='{{ URL::asset('assets/js/ace/jquery.mobile.custom.js') }}'>"+"<"+"/script>");
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
    
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        jQuery(function($) {
         $(document).on('click', '.toolbar a[data-target]', function(e) {
                e.preventDefault();
                var target = $(this).data('target');
                $('.widget-box.visible').removeClass('visible');//hide others
                $(target).addClass('visible');//show target
         });
        });

        //you don't need this, just used for changing background
        jQuery(function($) {
         $('#btn-login-dark').on('click', function(e) {
                $('body').attr('class', 'login-layout');
                $('#id-text2').attr('class', 'white');
                $('#id-company-text').attr('class', 'blue');

                e.preventDefault();
         });
         $('#btn-login-light').on('click', function(e) {
                $('body').attr('class', 'login-layout light-login');
                $('#id-text2').attr('class', 'grey');
                $('#id-company-text').attr('class', 'blue');

                e.preventDefault();
         });
         $('#btn-login-blur').on('click', function(e) {
                $('body').attr('class', 'login-layout blur-login');
                $('#id-text2').attr('class', 'white');
                $('#id-company-text').attr('class', 'light-blue');

                e.preventDefault();
         });

        });
    </script>
    <!-- page specific plugin scripts -->
    @yield("footer_script",'<span style="background:red;">MISSING FOOTER SCRIPT</span>')
     
</body>
</html>