@extends('layouts.ace.main')


@section('header_script')
{{ HTML::style('assets/css/ace/jquery-ui.custom.css') }}
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li><a href="{{ URL::to('pa') }}"><i class="menu-icon fa fa-credit-card fa-lg"></i>จัดการเครดิต</a></li>
    <li class="active">รายการถอนเครดิต</li>
</ul>
@stop


@section('pageheader')
<h1>รายการถอนเครดิต</h1>
@stop


@section('pagecontent')
<!-- PAGE CONTENT BEGINS -->
<div class="row">
    <div class="col-xs-12">
        
        @include('layouts.ace.message')

        {{ Form::open( array( 'url'=>'pa/delall', 'id'=>'form-del-delall') ) }}   
        {{ Form::hidden( '_method','DELETE' ) }}
        {{ Form::hidden('hidden_chkBoxDel', null, array('id'=>'hidden_chkBoxDel')) }}
        {{ Form::close() }}

        <div class="clearfix" style="margin-bottom:8px;">
            <a class="btn btn-sm btn-danger bootbox-confirm-delall" href="javascript:void(0)" >ลบรายการ</a>
            <a class="btn btn-sm btn-primary" href="#" style="margin-left:7px;">ส่งออกธนาคาร</a>
            <a class="btn btn-sm btn-primary" href="#" style="margin-left:7px;"><i class="ace-icon fa fa-print  align-top bigger-125"></i>พิมพ์รายการ</a>
            
        </div>

        <!-- div.dataTables_borderWrap -->
        <div>
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center" width="50"><label class="pos-rel"><input type="checkbox" class="ace" /><span class="lbl"></span></label></th>
                        <th class="hidden">ลำดับ</th>
                        <th class="text-center">รหัสรายการ</th>
                        <th class="text-center">รหัสสมาชิก</th>
                        <th class="text-center">ชื่อ - สกุล</th>
                        <th class="text-center">PA ถอน</th>
                        <th class="text-center">วันที่ขอถอน</th>
                        <th class="text-center">สถานะ</th>
                        <th class="text-center">จัดการ</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i=1; ?>
                    @foreach( $pa as $key => $value )
                    <tr>
                        <td class="text-center"><label class="pos-rel"><input id="{{ 'chkbox-'.$i }}" type="checkbox" class="ace dataTableChkbox" value="{{ $value->cr_withdraw_id }}" /><span class="lbl"></span></label></td>
                        <td class="hidden">{{ $i }}</td>
                        <td class="left">{{ $value->cr_withdraw_code }}</td>
                        <td class="text-center">{{ HTML::link('pa/'.$value->mb_mem_id ,$value->mb_mem_code) }}</td>
                        <td class="left">{{ $value->mb_mem_fnameth,' ', $value->mb_mem_lnameth }}</td>
                        <td class="text-right">{{  number_format($value->cr_withdraw_pa, 2, '.', '') }}</td>
                        <td class="text-center">{{ GetFormat::format_DateTime ($value->cr_withdraw_issuedate) }}</td>
                        <td class="text-center">{{ $value->cr_set_status_name }}</td>
                        <td class="text-center">
                            <div class="hidden-sm hidden-xs action-buttons text-center">
                                
                                @if($value->cr_withdraw_status == 2)
                                <a class="orange" href="javascript:void(0)" title="View" id="modalAllow" data-toggle="modal" data-target="#myModal" 
                                   onclick=" document.getElementById('cr_withdraw_pa').value='{{ number_format($value->cr_withdraw_pa, 2, '.', '') }}';
                                                document.getElementById('allow_Refunds_ID').value='{{ $value->cr_withdraw_id }}'; ">
                                    <i class="ace-icon fa fa-gavel bigger-120 bigger-130"></i>
                                </a>
                                @endif

                                @if($value->cr_withdraw_status == 5)
                                    <a class="green" href="#"><i class="ace-icon fa fa-print align-top bigger-125"></i></a>
                                @endif
                                
                            </div>

                            <div class="hidden-md hidden-lg">
                                <div class="inline pos-rel">
                                    
                                    @if($value->cr_withdraw_status == 2)
                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                        <li>
                                            
                                            <a href="javascript:void(0)" title="View" id="modalAllow" data-toggle="modal" data-target="#myModal" 
                                               onclick=" document.getElementById('cr_withdraw_pa').value='{{ number_format($value->cr_withdraw_pa, 2, '.', '') }}';
                                                            document.getElementById('allow_Refunds_ID').value='{{ $value->cr_withdraw_id }}'; ">
                                                <span class="orange">
                                                    <i class="ace-icon fa fa-gavel bigger-120"></i>
                                                </span>
                                            </a>
                                           
                                        </li>
                                    </ul>
                                    @endif

                                    @if($value->cr_withdraw_status == 5)
                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                        <li>
                                            <a class="green" href="#"><i class="ace-icon fa fa-print align-top bigger-125"></i></a>
                                        </li>
                                    </ul>
                                    @endif
                                    
                                </div>
                            </div>
                            
                        </td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="clearfix" style="margin-top:8px;">
            <a class="btn btn-sm btn-danger bootbox-confirm-delall" href="javascript:void(0)" >ลบรายการ</a>
            <a class="btn btn-sm btn-primary" href="#" style="margin-left:7px;">ส่งออกธนาคาร</a>
            <a class="btn btn-sm btn-primary" href="#" style="margin-left:7px;"><i class="ace-icon fa fa-print  align-top bigger-125"></i>พิมพ์รายการ</a>
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
        <h4 class="modal-title" id="myModalLabel">อนุมัติการถอน PA</h4>
        <!--# TITLE AREA -->
        
      </div>
      <div class="modal-body">
      {{ Form::open(array('url'=>'withdrawpa','class'=>'form-horizontal','role'=>'form')) }}
      {{ Form::hidden('allow_Refunds_ID', null, array('id'=>'allow_Refunds_ID')) }}
      {{ Form::hidden('allow', null, array('id'=>'allow')) }}
      {{ Form::hidden('notallow', null, array('id'=>'notallow')) }}
        <div class="form-group">
            {{ Form::label('cr_withdraw_pa', 'จำนวนถอน', array('class' =>'col-sm-2 control-label')) }}
            <div class="col-sm-8">
                {{ Form::text('cr_withdraw_pa', null, array('id'=>'cr_withdraw_pa', 'disabled' => 'disabled')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('cr_withdraw_cause', 'หมายเหตุ', array('class' =>'col-sm-2 control-label')) }}
            <div class="col-sm-8">
                {{ Form::textarea('cr_withdraw_cause', null, array('class'=>'form-control', 'rows'=>'3')) }}
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0)" onclick=" document.getElementById('allow').value='1'; ">
        {{ Form::submit('อนุมัติ', array('class'=>'btn btn-primary' )) }}
       </a>
       <a href="javascript:void(0)" onclick=" document.getElementById('notallow').value='2'; ">
        {{ Form::submit('ไม่อนุมัติ', array('class'=>'btn btn-danger')) }}
       </a>
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
{{ HTML::script('assets/js/ace/dataTables/jquery.dataTables.js') }}
{{ HTML::script('assets/js/ace/dataTables/jquery.dataTables.bootstrap.js') }}
{{ HTML::script('assets/js/ace/dataTables/extensions/TableTools/js/dataTables.tableTools.js') }}
{{ HTML::script('assets/js/ace/dataTables/extensions/ColVis/js/dataTables.colVis.js') }}
{{ HTML::script('assets/js/ace/bootbox.js') }}


<script type="text/javascript">
    jQuery(function ($) {
        
        $(".bootbox-confirm-delall").on(ace.click_event, function () {
                var arrRow = new Array();
                var countrow = {{ $count }};
                for(var rowno=1; rowno<=countrow; rowno++) { 

                    var chkBox = document.getElementById('chkbox-'+rowno);
                    if( chkBox !== null && chkBox.checked ){
                        arrRow.push(chkBox.value);
                    }
                }
                $('#hidden_chkBoxDel').val(arrRow);
            bootbox.confirm({
                message: "ต้องการลบข้อมูลรายการถอนเครดิตที่เลือกทั้งหมด ใช่หรือไม่?",
                buttons: {
                    confirm: {
                        label: "ลบ",
                        className: "btn-danger btn-sm",
                    },
                    cancel: {
                        label: "ยกเลิก",
                        className: "btn-sm",
                    }
                },
                callback: function (result) {
                    if (result)
                        $('#form-del-delall').submit();
                }
            }
            );
        });

    });
</script>


<script type="text/javascript">
    jQuery(function ($) {
        //initiate dataTables plugin
        var oTable1 =
                $('#dynamic-table')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .dataTable({
                    bAutoWidth: false,
                    "aoColumns": [
                        {"bSortable": false},
                        null, null, null, null, null, null, null,
                        {"bSortable": false}
                    ],
                    "aaSorting": [  ]
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
$('#modalAllow').on('shown.bs.modal', function () {
    $('#allow_Refunds_Remark').focus()
})
</script>



@stop

