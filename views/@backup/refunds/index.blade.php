@extends('layouts.ace.main')


@section('header_script')
{{ HTML::style('assets/css/ace/jquery-ui.custom.css') }}
{{ HTML::style('assets/css/ace/datepicker.css') }}
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li>{{ HTML::decode(link_to('refunds', '<i class="fa fa-users fa-lg"></i>จัดการสมาชิก')) }}</li>
    <li class="active">ขอคืนเงิน</li>
</ul>
@stop


@section('pageheader')
<h1>ขอคืนเงิน</h1>
@stop


@section('pagecontent')
<!-- PAGE CONTENT BEGINS -->
<div class="row">
    <div class="col-xs-12">

        <div class="table-header">
            @if( Session::has('message') )
            <div class="alert alert-block alert-info">
                <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                </button>
                <i class="ace-icon fa fa-check green"></i>
                {{ Session::get('message') }}
            </div>
            @endif
            
            @if($errors->all())
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8 alert alert-danger">
                    {{ HTML::ul($errors->all()) }}
                </div>
            </div>
            @endif
        </div>

        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>

        <!-- div.dataTables_borderWrap -->
        <div>
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">รหัสรายการ</th>
                        <th class="center hidden-480">รหัส</th>
                        <th class="center hidden-480">ชื่อ-สกุล</th>
                        <th class="center hidden-480">วันที่สมัคร</th>
                        <th class="center">วันที่ขอคืน</th>
                        <th class="center">สถานะ</th>
                        <th class="center">จัดการ</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach( $result as $key => $refund )
                    <tr>
                        <td class="center">{{ $refund->mb_refund_id }}</td>
                        <td class="center hidden-480">{{ HTML::link('refunds/'.$refund->mb_refund_id,$refund->mb_mem_code) }}</td>
                        <td class="hidden-480">{{ HTML::link('refunds/'.$refund->mb_refund_id, Mem::$list_prefix[$refund->mb_mem_prefix].$refund->mb_mem_fnameth.' '.$refund->mb_mem_lnameth ) }}</td>
                        <td class="center hidden-480">{{ EditFormat::format_DateTime($refund->mb_refund_credate) }}</td>
                        <td class="center">{{ EditFormat::format_DateTime($refund->mb_refund_issuedate) }}</td>
                        <td class="center">{{ Refund::$list_status[$refund->mb_refund_status] }}</td>
                        <td class="center">
                            <div class="hidden-sm hidden-xs action-buttons center">
                                
                                @if($refund->mb_refund_status == 1)
                                <a class="orange" href="javascript:void(0)" title="View" id="modalRefunds" data-toggle="modal" data-target="#myModal" 
                                   onclick=" document.getElementById('allow_Refunds_ID').value='{{ $refund->mb_refund_id }}' ">
                                    <i class="ace-icon fa fa-gavel bigger-120 bigger-130"></i>
                                </a>
                                @endif
                                
                            </div>

                            <div class="hidden-md hidden-lg">
                                <div class="inline pos-rel">
                                    
                                    @if($refund->mb_refund_status == 1)
                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                        <li>
                                            
                                            <a href="javascript:void(0)" title="View" id="modalRefunds" data-toggle="modal" data-target="#myModal" 
                                               onclick=" document.getElementById('allow_Refunds_ID').value='{{ $refund->mb_refund_id }}' ">
                                                <span class="orange">
                                                    <i class="ace-icon fa fa-gavel bigger-120"></i>
                                                </span>
                                            </a>
                                           
                                        </li>
                                    </ul>
                                    @endif
                                    
                                </div>
                            </div>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>    


    </div><!-- /col -->
</div><!-- /row -->



<!--# Modal Allow Refunds -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
        <!--# TITLE AREA -->
        <h4 class="modal-title" id="myModalLabel">อนุมัติการขอคืนเงิน</h4>
        <!--# TITLE AREA -->
        
      </div>
      <div class="modal-body">
      {{ Form::open(array('url'=>'allowrefund','class'=>'form-horizontal','role'=>'form')) }}
      {{ Form::hidden('allow_Refunds_ID', null, array('id'=>'allow_Refunds_ID')) }}
        <!--# CONTENT AREA -->
        <div class="row">
            <div class="col-xs-12">

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <label class="line-height-1 blue">
                            {{ Form::radio('allow_Refunds_Status', 2, false, ['class' => 'ace']) }}
                            <span class="lbl"> อนุมัติ</span>&nbsp;&nbsp;&nbsp;
                        </label>
                        <label class="line-height-1 blue">
                            {{ Form::radio('allow_Refunds_Status', 3, false, ['class' => 'ace']) }}
                            <span class="lbl"> ไม่อนุมัติ</span>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('allow_Refunds_Date','เมื่อวันที่',array('class'=>'col-sm-2 control-label')) }} 
                    <div class="col-sm-8">
                        <div class="input-group">
                            {{ Form::input('text','allow_Refunds_Date',null,array('class'=>'form-control date-picker','data-date-format'=>'dd-mm-yyyy','placeholder'=>'dd-mm-yyyy')) }}
                            <span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    {{ Form::label('allow_Refunds_Remark','หมายเหตุ',array('class'=>'col-sm-2 control-label')) }}  
                    <div class="col-sm-8">
                        <div class="input-group" style="width:100%">
                            {{ Form::select('allow_Refunds_Remark', Refund::$list_remark , null, array('class'=>'form-control', 'style'=>'width:inherit;')
                             ) }}
                        </div>
                    </div>
                </div>  

            </div>
        </div>
        <!--/ CONTENT AREA -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        {{ Form::submit('บันทึก', array('class'=>'btn btn-primary')) }}
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
<!--/ Modal Allow Refunds -->



<!-- PAGE CONTENT ENDS -->                    
@stop


@section('footer_script')
<!--[if lte IE 8]>
  <script src="{{ asset('assets/js/ace/excanvas.js') }}"></script>
<![endif]-->
{{ HTML::script('assets/js/ace/jquery-ui.custom.js') }}
{{ HTML::script('assets/js/ace/date-time/bootstrap-datepicker.js') }}
{{ HTML::script('assets/js/ace/dataTables/jquery.dataTables.js') }}
{{ HTML::script('assets/js/ace/dataTables/jquery.dataTables.bootstrap.js') }}
{{ HTML::script('assets/js/ace/dataTables/extensions/TableTools/js/dataTables.tableTools.js') }}
{{ HTML::script('assets/js/ace/dataTables/extensions/ColVis/js/dataTables.colVis.js') }}


<script type="text/javascript">
    jQuery(function ($) {
        //initiate dataTables plugin
        var oTable1 =
                $('#dynamic-table')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .dataTable({
                    bAutoWidth: false,
                    "aoColumns": [
                        null, null, null, null, null, null, 
                        {"bSortable": false}
                    ],
                    "aaSorting": [ [0,'ASC'] ],
                });


        //TableTools settings
        TableTools.classes.container = "btn-group btn-overlap";
        TableTools.classes.print = {
            "body": "DTTT_Print",
            "info": "tableTools-alert gritter-item-wrapper gritter-info gritter-center white",
            "message": "tableTools-print-navbar"
        }

        //initiate TableTools extension
        var tableTools_obj = new $.fn.dataTable.TableTools(oTable1, {
            "sSwfPath": "{{ asset('assets/js/ace/dataTables/extensions/TableTools/swf/copy_csv_xls_pdf.swf') }}", //in Ace demo ../assets will be replaced by correct assets path

            "sRowSelector": "td:not(:last-child)",
            "sRowSelect": "multi",
            "fnRowSelected": function (row) {
                //check checkbox when row is selected
                try {
                    $(row).find('input[type=checkbox]').get(0).checked = true
                }
                catch (e) {
                }
            },
            "fnRowDeselected": function (row) {
                //uncheck checkbox
                try {
                    $(row).find('input[type=checkbox]').get(0).checked = false
                }
                catch (e) {
                }
            },
            "sSelectedClass": "success",
            "aButtons": [
                {
                    "sExtends": "print",
                    "sToolTip": "Print view",
                    "sButtonClass": "btn btn-white btn-primary  btn-bold",
                    "sButtonText": "<i class='fa fa-print bigger-110 grey'></i>",
                    "sMessage": "<div class='navbar navbar-default'><div class='navbar-header pull-left'><a class='navbar-brand' href='#'><small>Optional Navbar &amp; Text</small></a></div></div>",
                    "sInfo": "<h3 class='no-margin-top'>Print view</h3>\
                                                  <p>Please use your browser's print function to\
                                                  print this table.\
                                                  <br />Press <b>escape</b> when finished.</p>",
                }
            ]
        });
        //we put a container before our table and append TableTools element to it
        $(tableTools_obj.fnContainer()).appendTo($('.tableTools-container'));

        //also add tooltips to table tools buttons
        //addding tooltips directly to "A" buttons results in buttons disappearing (weired! don't know why!)
        //so we add tooltips to the "DIV" child after it becomes inserted
        //flash objects inside table tools buttons are inserted with some delay (100ms) (for some reason)
        setTimeout(function () {
            $(tableTools_obj.fnContainer()).find('a.DTTT_button').each(function () {
                var div = $(this).find('> div');
                if (div.length > 0)
                    div.tooltip({container: 'body'});
                else
                    $(this).tooltip({container: 'body'});
            });
        }, 200);



        //ColVis extension
        var colvis = new $.fn.dataTable.ColVis(oTable1, {
            "buttonText": "<i class='fa fa-search'></i>",
            "aiExclude": [0, 6],
            "bShowAll": true,
            //"bRestore": true,
            "sAlign": "right",
            "fnLabel": function (i, title, th) {
                return $(th).text();//remove icons, etc
            }

        });

        //style it
        $(colvis.button()).addClass('btn-group').find('button').addClass('btn btn-white btn-info btn-bold')

        //and append it to our table tools btn-group, also add tooltip
        $(colvis.button())
                .prependTo('.tableTools-container .btn-group')
                .attr('title', 'Show/hide columns').tooltip({container: 'body'});

        //and make the list, buttons and checkboxed Ace-like
        $(colvis.dom.collection)
                .addClass('dropdown-menu dropdown-light dropdown-caret dropdown-caret-right')
                .find('li').wrapInner('<a href="javascript:void(0)" />') //'A' tag is required for better styling
                .find('input[type=checkbox]').addClass('ace').next().addClass('lbl padding-8');



        /////////////////////////////////
        //table checkboxes
        $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

        //select/deselect all rows according to table header checkbox
        $('#dynamic-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function () {
            var th_checked = this.checked;//checkbox inside "TH" table header

            $(this).closest('table').find('tbody > tr').each(function () {
                var row = this;
                if (th_checked)
                    tableTools_obj.fnSelect(row);
                else
                    tableTools_obj.fnDeselect(row);
            });
        });

        //select/deselect a row when the checkbox is checked/unchecked
        $('#dynamic-table').on('click', 'td input[type=checkbox]', function () {
            var row = $(this).closest('tr').get(0);
            if (!this.checked)
                tableTools_obj.fnSelect(row);
            else
                tableTools_obj.fnDeselect($(this).closest('tr').get(0));
        });




        $(document).on('click', '#dynamic-table .dropdown-toggle', function (e) {
            e.stopImmediatePropagation();
            e.stopPropagation();
            e.preventDefault();
        });


        //And for the first simple table, which doesn't have TableTools or dataTables
        //select/deselect all rows according to table header checkbox
        var active_class = 'active';
        $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function () {
            var th_checked = this.checked;//checkbox inside "TH" table header

            $(this).closest('table').find('tbody > tr').each(function () {
                var row = this;
                if (th_checked)
                    $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
                else
                    $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
            });
        });

        //select/deselect a row when the checkbox is checked/unchecked
        $('#simple-table').on('click', 'td input[type=checkbox]', function () {
            var $row = $(this).closest('tr');
            if (this.checked)
                $row.addClass(active_class);
            else
                $row.removeClass(active_class);
        });



        /********************************/
        //add tooltip for small view action buttons in dropdown menu
        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});

        //tooltip placement on right or left
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('table')
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            //var w2 = $source.width();

            if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2))
                return 'right';
            return 'left';
        }

    })
</script>


<script type="text/javascript">
    jQuery(function($) {

            //datepicker plugin
            //link
            $('.date-picker').datepicker({
                    autoclose: true,
                    todayHighlight: true
            })
            //show datepicker when clicking on the icon
            .next().on(ace.click_event, function(){
                    $(this).prev().focus();
            });

    });
</script>

<script type="text/javascript">
$('#modalRefunds').on('shown.bs.modal', function () {
    $('#allow_Refunds_Remark').focus()
})
</script>
@stop

