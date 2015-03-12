@section("sidebar")

<!-- #section:basics/sidebar.horizontal -->
<div id="sidebar" class="sidebar responsive">
    <script type="text/javascript">
        try {
            ace.settings.check('sidebar', 'fixed')
        } catch (e) {
        }
    </script>

    <ul class="nav nav-list">
        
        <li class="{{ Request::is('login')?'active open':'' }}{{ Request::is('home')?'active open':'' }}">
            {{ HTML::decode(link_to('home', '<i class="menu-icon fa fa-home"></i><span class="menu-text"> หน้าหลัก </span>' )) }}</li>
        <li class="{{ Request::is('member*')?'active open':'' }}{{ Request::is('vip*')?'active open':'' }}{{ Request::is('refunds*')?'active open':'' }}">
            {{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-users"></i><span class="menu-text"> จัดการสมาชิก </span><b class="arrow fa fa-angle-down"></b>', array('class'=>'dropdown-toggle') )) }}     
            <ul class="submenu">
                <li class="{{ Request::is('member*')?'active':'' }}">{{ HTML::decode(link_to('member', '<i class="menu-icon fa fa-caret-right"></i>สมาชิกทั่วไป')) }}</li>
                <li class="{{ Request::is('vip*')?'active':'' }}">{{ HTML::decode(link_to('vip', '<i class="menu-icon fa fa-caret-right"></i>สมาชิกวีไอพี')) }}</li>
                <li class="">{{ HTML::decode(link_to('http://54.255.191.254/developerAZ/treantjsmaster/examples/custom-colored/index.php?treesearch=B000000001', '<i class="menu-icon fa fa-caret-right"></i>โครงสร้างสมาชิก', array('target'=>'blank'))) }}</li>
                <li class="">{{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-caret-right"></i>เลื่อนตำแหน่ง')) }}</li>
                <li class="{{ Request::is('refunds*')?'active':'' }}">{{ HTML::decode(link_to('refunds', '<i class="menu-icon fa fa-caret-right"></i>ขอคืนเงิน')) }}</li>
                <li class="">{{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-caret-right"></i>ต่ออายุสมาชิก')) }}</li>
            </ul>  
        </li>
        <li class="">
            {{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-money"></i><span class="menu-text"> จัดการรายได้ </span><b class="arrow fa fa-angle-down"></b>', array('class'=>'dropdown-toggle') )) }}     
            <ul class="submenu">
                <li class="">{{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-caret-right"></i>รายได้รายวัน')) }}</li>
                <li class="">{{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-caret-right"></i>รายได้รายเดือน')) }}</li>
                <li class="">{{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-caret-right"></i>รายได้ค่าตำแหน่ง')) }}</li>
                <li class="">{{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-caret-right"></i>โอนเงิน PA')) }}</li>
            </ul>  
        </li>
        <li class="">
            {{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-credit-card"></i><span class="menu-text"> จัดการเครดิต </span><b class="arrow fa fa-angle-down"></b>', array('class'=>'dropdown-toggle') )) }}     
            <ul class="submenu">
                <li class="">{{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-caret-right"></i>ฝากเครดิต')) }}</li>
                <li class="">{{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-caret-right"></i>ถอนเครดิต')) }}</li>
            </ul>  
        </li>
        <li class="{{ Request::is('card*')?'active open':'' }}">
            {{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-ticket"></i><span class="menu-text"> จัดการพินการ์ด </span><b class="arrow fa fa-angle-down"></b>', array('class'=>'dropdown-toggle') )) }}     
            <ul class="submenu">
                <li class="">{{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-caret-right"></i>สร้างพินการ์ด')) }}</li>
                <li class="{{ Request::is('card*')?'active':'' }}">{{ HTML::decode(link_to('card', '<i class="menu-icon fa fa-caret-right"></i>รายการพินการ์ด')) }}</li>
                <li class="">{{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-caret-right"></i>รายการขาย')) }}</li>
            </ul>  
        </li>
        <li class="{{ Request::is('deal*')?'active open':'' }}">
            {{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-barcode"></i><span class="menu-text"> จัดการดีล/คูปอง </span><b class="arrow fa fa-angle-down"></b>', array('class'=>'dropdown-toggle') )) }}
            <ul class="submenu">
                <li class="{{ Request::is('deal*')?'active':'' }}">{{ HTML::decode(link_to('deal', '<i class="menu-icon fa fa-caret-right"></i>ดีล/คูปอง')) }}</li>
            </ul> 
        </li>
        <li class="{{ Request::is('shop*')?'active open':'' }}{{ Request::is('branch*')?'active open':'' }}">
            {{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-shopping-cart"></i><span class="menu-text"> จัดการร้านค้า </span><b class="arrow fa fa-angle-down"></b>', array('class'=>'dropdown-toggle') )) }}
            <ul class="submenu">
                <li class="{{ Request::is('shop*')?'active':'' }}{{ Request::is('branch*')?'active':'' }}">{{ HTML::decode(link_to('shop', '<i class="menu-icon fa fa-caret-right"></i>ร้านค้า')) }}</li>
            </ul>
        </li>
        <li class="{{ Request::is('businesscenter*')?'active open':'' }}">
            {{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-building-o"></i><span class="menu-text"> จัดการศูนย์ธุรกิจ </span><b class="arrow fa fa-angle-down"></b>', array('class'=>'dropdown-toggle') )) }}
            <ul class="submenu">
                <li class="{{ Request::is('businesscenter*')?'active':'' }}">{{ HTML::decode(link_to('businesscenter', '<i class="menu-icon fa fa-caret-right"></i>ศูนย์ธุรกิจ')) }}</li>
            </ul>
        </li>
        <li class="">
            {{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-file-text-o"></i><span class="menu-text"> รายงาน </span><b class="arrow fa fa-angle-down"></b>', array('class'=>'dropdown-toggle') )) }}     
            <ul class="submenu">
                <li class="">{{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-caret-right"></i>รายงานสมาชิก')) }}</li>
                <li class="">{{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-caret-right"></i>รายงานเครดิต')) }}</li>
                <li class="">{{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-caret-right"></i>รายงานพินการ์ด')) }}</li>
                <li class="">{{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-caret-right"></i>รายงานดีล/คูปอง')) }}</li>
                <li class="">{{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-caret-right"></i>รายงานร้านค้า')) }}</li>
                <li class="">{{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-caret-right"></i>รายงานสาขา')) }}</li>
            </ul>  
        </li>
        <li class="{{ Request::is('cate*')?'active open':'' }}{{ Request::is('subcate*')?'active open':'' }}">
            {{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-gear"></i><span class="menu-text"> ตั้งค่า </span><b class="arrow fa fa-angle-down"></b>', array('class'=>'dropdown-toggle') )) }}     
            <ul class="submenu">
                <li class="">{{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-caret-right"></i>ตั้งค่าข้อมูลธนาคาร')) }}</li>
                <li class="{{ Request::is('cate*')?'active':'' }}">{{ HTML::decode(link_to('cate', '<i class="menu-icon fa fa-caret-right"></i>ตั้งค่า Category')) }}</li>
                <li class="{{ Request::is('subcate*')?'active':'' }}">{{ HTML::decode(link_to('subcate', '<i class="menu-icon fa fa-caret-right"></i>ตั้งค่า Sub Category')) }}</li>
            </ul>  
        </li>
        <li class="{{ Request::is('user*')?'active open':'' }}{{ Request::is('permission*')?'active open':'' }}">
            {{ HTML::decode(link_to('#', '<i class="menu-icon fa fa-sitemap"></i><span class="menu-text"> โครงสร้างระบบ </span><b class="arrow fa fa-angle-down"></b>', array('class'=>'dropdown-toggle') )) }}     
            <ul class="submenu">
                <li class="{{ Request::is('user*')?'active':'' }}">{{ HTML::decode(link_to('user', '<i class="menu-icon fa fa-caret-right"></i>ผู้ใช้งานระบบ')) }}</li>
                <li class="{{ Request::is('permission*')?'active':'' }}">{{ HTML::decode(link_to('permission', '<i class="menu-icon fa fa-caret-right"></i>สิทธิ์การใช้งานระบบ')) }}</li>
            </ul>  
        </li>

    </ul><!-- /.nav-list -->

    <!-- #section:basics/sidebar.layout.minimize -->
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>

    <!-- /section:basics/sidebar.layout.minimize -->
    <script type="text/javascript">
        try {
            ace.settings.check('sidebar', 'collapsed')
        } catch (e) {
        }
    </script>
</div>
<!-- /section:basics/sidebar.horizontal -->
@show