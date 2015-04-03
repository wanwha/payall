@extends('layouts.ace.main')


@section('header_script')
{{ HTML::style('assets/css/ace/jquery-ui.custom.css') }}
{{ HTML::style('assets/css/ace/jquery.gritter.css') }}

@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li><a href="{{ URL::to('shop') }}"><i class="fa fa-shopping-cart fa-lg"></i>จัดการร้านค้า</a></li>
    <li class="active">รายละเอียดร้านค้า</li>
</ul>
@stop


@section('pageheader')
<h1>รายละเอียดร้านค้า</h1>
@stop


@section('pagecontent')
<div class="row">
    <div class="col-xs-12">
        
        @include('layouts.ace.message')

         <div class="tabbable">
            <ul class="nav nav-tabs padding-16" id="myTab">
                <li class="active">{{ HTML::decode(link_to('#tab_profile', 'ข้อมูลร้านค้า', array('data-toggle'=>'tab'))) }}</li>
                <li>{{ HTML::decode(link_to('#tab_addr', 'ข้อมูลสาขา', array('data-toggle'=>'tab'))) }}</li>
            </ul>

            <div class="tab-content">
                
                <div id="tab_profile" class="tab-pane fade in active">
                    <div class="row" style="margin-top: 5px; margin-bottom: 15px;">
                        <div class=" col-xs-offset-3 col-xs-6 col-sm-offset-5 col-sm-2">
                            <img id="avatar" class="editable img-responsive editable-click editable-empty" alt="Shop Profile" src="/../payall/assets/image/{{ $shop->sh_shop_pic }}" width="100%" />
                        </div>
                    </div>    
                    <div class="profile-user-info profile-user-info-striped" style="margin-top:10px;">
                        <div class="profile-info-row">
                                <div class="profile-info-name"> ประเภทร้านค้า  : </div>
                                <div class="profile-info-value">{{ GetList::$list_Shoptype[$shop->sh_shop_typeid ] }}</div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> รหัสร้านค้า : </div>
                                <div class="profile-info-value">{{ $shop->sh_shop_code }}</div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> ชื่อร้านค้า  : </div>
                                <div class="profile-info-value">{{ GetText::expld_text($shop->sh_shop_name, 'thai')  }}</div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> หมวดหมู่ : </div>
                                <div class="profile-info-value">{{ $shop->de_set_cate_nameth }}</div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> หมวดหมู่ย่อย : </div>
                                <div class="profile-info-value">{{ $shop->de_set_scate_nameth }}</div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> รายละเอียด  : </div>
                                <div class="profile-info-value">{{ GetText::expld_text($shop->sh_shop_detail, 'thai')   }}</div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> ที่อยู่ : </div>
                                <div class="profile-info-value">{{ GetText::expld_text($shop->sh_shop_addr , 'thai')  }}</div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> จังหวัด  : </div>
                                <div class="profile-info-value">{{ $shop->sys_province_name }}</div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> อำเภอ : </div>
                                <div class="profile-info-value">{{ $shop->sh_shop_subprovid }}</div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> ตำบล : </div>
                                <div class="profile-info-value">{{ $shop->sys_district_name }}</div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> เเบอร์ติดต่อ : </div>
                                <div class="profile-info-value">{{ $shop->sh_shop_tel }}</div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> แฟลกซ์  : </div>
                                <div class="profile-info-value">{{ $shop->sh_shop_fax }}</div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                         <div class="profile-info-row">
                                <div class="profile-info-name"> อีเมล์ : </div>
                                <div class="profile-info-value">{{ $shop->sh_shop_email }}</div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                         <div class="profile-info-row">
                                <div class="profile-info-name"> ไลน์ ไอดี  : </div>
                                <div class="profile-info-value">{{ $shop->sh_shop_line }}</div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                         <div class="profile-info-row">
                                <div class="profile-info-name"> เว็บไซต์ : </div>
                                <div class="profile-info-value">{{ $shop->sh_shop_email }}</div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                    </div>    
                </div>

                <div id="tab_addr" class="tab-pane fade">
                   <div class="profile-user-info profile-user-info-striped" style="margin-top:10px;">
                     <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center hidden-480">รหัสร้านค้า</th>
                                <th class="hidden-480">รหัสสาขา</th>
                                <th>ชื่อสาขา</th>
                                <th class="center hidden-480">เบอร์ติดต่อ</th>
                                <th class="center hidden-480">อีเมล์</th>
                            </tr>
                        </thead>

                        <tbody>
                          @foreach( $branch as $key => $branch )
                            <tr>
                                <td class="center hidden-480">{{ $branch->sh_branch_shopcode }}</td>
                                <td class="hidden-480">{{ $branch->sh_branch_code }}</td>
                                <td>{{ $branch->sh_branch_name }}</td>
                                <td class="center hidden-480">{{ $branch->sh_branch_tel }}</td>
                                <td class="center hidden-480">{{ $branch->sh_branch_email }}</td>
                            </tr>   
                           @endforeach                   
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
             

        <div class="row">
            <div class="col-xs-12 center">
                {{ HTML::link('shop', 'ย้อนกลับ', array('class'=>'btn btn-warning btn-lg','style'=>'margin:20px;')) }}
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
{{ HTML::script('assets/js/ace/dataTables/jquery.dataTables.js') }}
{{ HTML::script('assets/js/ace/dataTables/jquery.dataTables.bootstrap.js') }}

<script type="text/javascript">
    //initiate dataTables plugin
    var oTable1 =
        $('#dynamic-table')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .dataTable({
            bAutoWidth: false,
            "aoColumns": [
                null, null, null, null, 
            ],
            "aaSorting": [],
        });
</script>


@stop