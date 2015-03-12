@extends('layouts.ace.main')


@section('header_script')
{{ HTML::style('assets/css/ace/jquery-ui.custom.css') }}
{{ HTML::style('assets/css/ace/jquery.gritter.css') }}
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li>{{ HTML::decode(link_to('vip', '<i class="fa fa-users fa-lg"></i>จัดการสมาชิก')) }}</li>
    <li class="active">รายละเอียดสมาชิกวีไอพี</li>
</ul>
@stop


@section('pageheader')
<h1>รายละเอียดสมาชิกวีไอพี</h1>
@stop


@section('pagecontent')
<div class="row">
    <div class="col-xs-12">
        
        
        <div class="row" style="padding-bottom:20px;">
            <span class="btn btn-app btn-sm btn-success pull-right" style="width: initial; margin-left:7px; margin-right:10px; padding-left: 20px; padding-right: 20px; cursor: default;">
                    <span class="line-height-1 smaller-90"> Cash </span><br />
                    <span class="line-height-1 bigger-170"> {{ $vip->mb_mem_pacash }} </span>
            </span>
            <span class="btn btn-app btn-sm btn-grey pull-right" style="width: initial; margin-left:7px; padding-left: 20px; padding-right: 20px; cursor: default;">
                    <span class="line-height-1 smaller-90"> Credit </span><br />
                    <span class="line-height-1 bigger-170"> {{ $vip->mb_mem_pacredit }} </span>
            </span>
            <span class="btn btn-app btn-sm btn-yellow pull-right" style="width: initial; margin-left:7px; padding-left: 20px; padding-right: 20px; cursor: default;">
                    <span class="line-height-1 smaller-90"> Point </span><br />
                    <span class="line-height-1 bigger-170"> {{ $vip->mb_mem_point }} </span>
            </span>
        </div>

        
        <!-- #section:elements.tab -->
        <div class="tabbable">
            <ul class="nav nav-tabs padding-16" id="myTab">
                <li class="active">{{ HTML::decode(link_to('#tab_profile', 'ข้อมูลส่วนตัว', array('data-toggle'=>'tab'))) }}</li>
                <li>{{ HTML::decode(link_to('#tab_addr', 'ที่อยู่ / สถานที่ติดต่อ', array('data-toggle'=>'tab'))) }}</li>
                <li>{{ HTML::decode(link_to('#tab_bank', 'ธนาคาร', array('data-toggle'=>'tab'))) }}</li>
                <li>{{ HTML::decode(link_to('#tab_hismem', 'ประวัติสมาชิก', array('data-toggle'=>'tab'))) }}</li>
            </ul>

            <div class="tab-content">
                
                <div id="tab_profile" class="tab-pane fade in active">
                    <div class="row" style="margin-top: 5px; margin-bottom: 15px;">
                        <div class=" col-xs-offset-3 col-xs-6 col-sm-offset-5 col-sm-2">
                            <img id="avatar" class="editable img-responsive editable-click editable-empty" alt="User Profile" src="{{ asset('assets/images/ace/avatars/profile-pic.jpg') }}" width="100%" />
                        </div>
                    </div>    
                    <div class="profile-user-info profile-user-info-striped" style="margin-top:10px;">
                        <div class="profile-info-row">
                                <div class="profile-info-name"> หมายเลขประจำตัว : </div>
                                <div class="profile-info-value">{{ $vip->mb_mem_code }}</div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> สัญชาติ : </div>
                                <div class="profile-info-value">{{ Mem::$list_nation[$vip->mb_mem_nationalityid] }}</div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> หมายเลขประชาชน : </div>
                                <div class="profile-info-value">{{ $vip->mb_mem_citid }}</div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> คำนำหน้า : </div>
                                <div class="profile-info-value">{{ Mem::$list_prefix[$vip->mb_mem_prefix] }}</div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> ชื่อ : </div>
                                <div class="profile-info-value">{{ $vip->mb_mem_fnameth }}</div>
                                <div class="profile-info-name"> สกุล : </div>
                                <div class="profile-info-value">{{ $vip->mb_mem_lnameth }}</div>  
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> ชื่อ (ภาาษอังกฤษ) : </div>
                                <div class="profile-info-value">{{ $vip->mb_mem_fnameen }}</div>
                                <div class="profile-info-name"> สกุล (ภาษาอังกฤษ) : </div>
                                <div class="profile-info-value">{{ $vip->mb_mem_lnameen }}</div>  
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> อีเมล : </div>
                                <div class="profile-info-value">{{ $vip->mb_mem_email }}</div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> รหัสผ่าน : </div>
                                <div class="profile-info-value">{{ $vip->mb_mem_password }}&nbsp;&nbsp;&nbsp;{{ Form::checkbox('agree', null, true, array('class'=>'ace input-lg')) }}<span class="lbl bigger-120"></span></div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> เบอร์โทรศัพท์ : </div>
                                <div class="profile-info-value">{{ $vip->mb_mem_phone }}</div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> ว/ด/ป เกิด : </div>
                                <div class="profile-info-value">{{ EditFormat::format_DateTime($vip->mb_mem_dateofbirth) }} อายุ : xxปี </div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> วันที่เปิดสมาชิก : </div>
                                <div class="profile-info-value">{{ EditFormat::format_DateTime($vip->mb_mem_sdate) }} ถึง {{ EditFormat::format_DateTime($vip->mb_mem_edate) }}</div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> ตำแหน่ง : </div>
                                <div class="profile-info-value">{{ $vip->mb_mem_posid }}</div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> สถานะ : </div>
                                <div class="profile-info-value">{{ Mem::$list_type[$vip->mb_mem_type]}}</div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> รหัสอุปกรณ์ : </div>
                                <div class="profile-info-value">{{ $vip->mb_mem_device }}</div>
                                <div class="profile-info-value hidden-480"></div>
                                <div class="profile-info-value hidden-480"></div>
                        </div>
                    </div>    
                </div>

                <div id="tab_addr" class="tab-pane fade">
                    <div class="profile-user-info profile-user-info-striped" style="margin-top:10px;">
                        <div class="profile-info-row">
                                <div class="profile-info-name"> สถานที่ : </div>
                                <div class="profile-info-value">{{ Mem::$list_locate[$vip->mb_mem_locateid] }}</div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> เลขที่ : </div>
                                <div class="profile-info-value">{{ $vip->mb_mem_addr }}</div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> จังหวัด : </div>
                                <div class="profile-info-value">{{ $list_province[$vip->mb_mem_provid] }}</div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> อำเภอ/เขต : </div>
                                <div class="profile-info-value">{{ $list_subprovince[$vip->mb_mem_subprovid] }}</div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> ตำบล/แขวง : </div>
                                <div class="profile-info-value">{{ $list_district[$vip->mb_mem_distid] }}</div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> ไปรษณีย์ : </div>
                                <div class="profile-info-value">{{ $vip->mb_mem_postcode }}</div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> เบอร์โทรศัพท์ที่ทำงาน : </div>
                                <div class="profile-info-value">{{ $vip->mb_mem_tel }}</div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> เวลาที่สะดวกในการติดต่อกลับ : </div>
                                <div class="profile-info-value"> 16:00 ถึง 20:00 </div>
                        </div>
                    </div>    
                </div>
                
                <div id="tab_bank" class="tab-pane fade">
<div class="profile-user-info profile-user-info-striped" style="margin-top:10px;">
                        <div class="profile-info-row">
                                <div class="profile-info-name"> ธนาคาร : </div>
                                <div class="profile-info-value">{{ $vip->mb_mem_bankid }}</div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> ชื่อบัญชี : </div>
                                <div class="profile-info-value">{{ $vip->mb_mem_accname }}</div>
                        </div>
                        <div class="profile-info-row">
                                <div class="profile-info-name"> เลขบัญชี : </div>
                                <div class="profile-info-value">{{ $vip->mb_mem_accno }}</div>
                        </div>
                    </div>    
                </div>
                
                <div id="tab_hismem" class="tab-pane fade">
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center hidden-480">ลำดับ</th>
                                <th class="hidden-480">เลขที่อ้างอิง</th>
                                <th>รหัส</th>
                                <th class="center hidden-480">ราคา</th>
                                <th class="center hidden-480">วันที่เริ่ม</th>
                                <th class="center">วันหมดอายุ</th>
                                <th class="center">สถานะ</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td class="center hidden-480">2</td>
                                <td class="hidden-480">3283847041</td>
                                <td>g675g334h</td>
                                <td class="center hidden-480">3500</td>
                                <td class="center hidden-480">01 ม.ค. 2557</td>
                                <td class="center">01 ม.ค. 2558</td>
                                <td class="center">ไม่ใช้งาน</td>
                            </tr>
                            <tr>
                                <td class="center hidden-480">1</td>
                                <td class="hidden-480">4293814001</td>
                                <td>a235c389b</td>
                                <td class="center hidden-480">3500</td>
                                <td class="center hidden-480">01 ม.ค. 2558</td>
                                <td class="center">01 ม.ค. 2559</td>
                                <td class="center">ใช้งาน</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
        <!-- /section:elements.tab -->

        <div class="row">
            <div class="col-xs-12 center">
                {{ HTML::link('vip','ย้อนกลับ',array('class'=>'btn btn-info btn-lg','style'=>'margin:20px;')) }}
            </div>
        </div>
        
        
    </div>
</div>

@stop


@section('footer_script')
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
                null, null, null, null, null, null
            ],
            "aaSorting": [],
        });
</script>
@stop