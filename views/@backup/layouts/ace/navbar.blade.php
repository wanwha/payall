@section("navbar")
<!-- #section:basics/navbar.layout -->
<div id="navbar" class="navbar navbar-default">
    <script type="text/javascript">try{ace.settings.check('navbar' , 'fixed')}catch(e){}</script>

    <div class="navbar-container" id="navbar-container">
        
        <!-- #section:basics/sidebar.mobile.toggle -->
        <button type="button" id="menu-toggler" class="pull-left navbar-toggle menu-toggler" data-target="#sidebar">
                <span class="sr-only">Toggle sidebar</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
        </button>          
                    
        
        <div class="navbar-header pull-left">
            
            <!-- #section:basics/navbar.layout.brand -->
            <a href="#" class="navbar-brand"><small>Pay All</small></a>
            <!-- /section:basics/navbar.layout.brand -->
            
            
            <!-- #section:basics/navbar.toggle -->

            <!-- /section:basics/navbar.toggle -->
            
        </div>
        
        
        <!-- #section:basics/navbar.dropdown -->
        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <!-- #section:basics/navbar.user_menu -->
                <li class="light-blue">
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                {{ HTML::image('assets/images/ace/avatars/user.jpg','Picture Profile',array('class'=>'nav-user-photo')) }}
                                <span class="user-info">
                                        <small>Welcome,</small>
                                        {{ Session::get('thisUser')->first_name }}
                                </span>
                                <i class="ace-icon fa fa-caret-down"></i>
                        </a>

                        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">    
                            <li>{{ HTML::decode(link_to('profile','<i class="ace-icon fa fa-user"></i>Profile')) }}</li>
                            <li>{{ HTML::decode(link_to('#','<i class="ace-icon fa fa-cog"></i>Settings')) }}</li>
                            <li class="divider"></li>
                            <li>{{ HTML::decode(link_to('logout','<i class="ace-icon fa fa-power-off"></i>Logout')) }}</li>
                        </ul>

                </li><!-- /section:basics/navbar.user_menu -->
            </ul>
        </div><!-- /section:basics/navbar.dropdown -->
              
        
    </div><!-- /.navbar-container -->
</div><!-- /section:basics/navbar.layout -->
@show