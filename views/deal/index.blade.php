@extends('layouts.ace.main')


@section('header_script')
{{ HTML::style('assets/css/ace/jquery-ui.custom.css') }}
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li>{{ HTML::decode(link_to('deal', '<i class="fa fa-barcode fa-lg"></i>จัดการดีล/คูปอง')) }}</li>
    <li class="active">รายการดีล/คูปอง</li>
</ul>
@stop


@section('pageheader')
<h1>รายการดีล/คูปอง</h1>
@stop


@section('pagecontent')


{{ Form::open() }}
{{ Form::hidden('hidden_rowid', null, array('id'=>'hidden_rowid')) }}
{{ Form::hidden('hidden_rowtitle', null, array('id'=>'hidden_rowtitle')) }}
{{ Form::close() }}

{{ Form::open( array( 'url'=>'deal/delall', 'id'=>'form-del-delall') ) }}   
    {{ Form::hidden( '_method','DELETE' ) }}
    {{ Form::hidden('hidden_chkBoxDel', null, array('id'=>'hidden_chkBoxDel')) }}
{{ Form::close() }}

{{ Form::open( array( 'url'=>'deal/lot', 'id'=>'form-lot') ) }}
{{ Form::hidden('hidden_dealid', null, array('id'=>'hidden_dealid')) }}
{{ Form::close() }}

<!-- PAGE CONTENT BEGINS -->
<div class="row">
    <div class="col-xs-12">

        @include('layouts.ace.message')

        <div class="clearfix">
            {{ HTML::link('deal/create', 'สร้างใหม่', array('class'=>'pull-left btn btn-sm btn-primary')) }}
            <a class="pull-left btn btn-sm btn-danger bootbox-confirm-delall" href="javascript:void(0)" style="margin-left: 7px;">ลบรายการ</a>
            <div class="pull-right tableTools-container"></div>
        </div>

        <!-- div.dataTables_borderWrap -->
        <div>
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center"><label class="pos-rel"><input type="checkbox" class="ace" /><span class="lbl"></span></label></th>
                        <th class="center hidden-480">ลำดับ</th>
                        <th class="center">ชื่อดีล</th>
                        <th class="center hidden-480">ประเภท</th>
                        <th class="center">ร้านค้า</th>
                        <th class="center">ยังไม่จำหน่าย</th>
                        <th class="center">จำนวนซื้อ</th>
                        <th class="center">จำนวนใช้</th>
                        <th class="center">ระยะเวลา</th>
                        <th class="center">จัดการ</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1; ?>
                    @foreach( $deal as $deal )
                    <tr>
                        <td class="center"><label class="pos-rel"><input id="{{ 'chkbox-'.$i }}" type="checkbox" class="ace dataTableChkbox" value="{{ $deal->de_deal_id }}" /><span class="lbl"></span></label></td>
                        <td class="center hidden-480">{{ $i }}</td>
                        <td class="">{{ HTML::Link('deal/'.$deal->de_deal_id, $deal_title[$i-1]) }}</td>
                        <td class="center hidden-480">{{ $deal_type[$i-1] }}</td>
                        <td class="center">{{ $deal_shopname[$i-1] }}</td>
                        <td class="center">{{ $deal->de_deal_instock }}</td>
                        <td class="center">{{ $deal->de_deal_bought }}</td>
                        <td class="center">{{ $deal->de_deal_used }}</td>
                        <td class="center">{{ $deal_sedate[$i-1] }}</td>
                        <td class="center">
                            <div class="hidden-sm hidden-xs action-buttons">   

                                <a href='javascript:void(0)' class="blue" onclick="
                                    document.getElementById('hidden_dealid').value='{{ $deal->de_deal_id }}';
                                    document.getElementById('form-lot').submit();
                                "><i class="ace-icon fa fa-plus bigger-130"></i></a>
                                {{ HTML::decode(link_to('deal/'.$deal->de_deal_id.'/edit','<i class="ace-icon fa fa-pencil bigger-130"></i>',array('class'=>'green'))) }}
                                <a href='javascript:void(0)' class="red bootbox-confirm" onclick="
                                    document.getElementById('hidden_rowid').value='{{ $deal->de_deal_id }}';
                                    document.getElementById('hidden_rowtitle').value='{{ $deal_title[$i-1] }}';
                                "><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
                                {{ Form::open( array( 'url'=>'deal/'.$deal->de_deal_id, 'id'=>'form-del-'.$deal->de_deal_id ) )}}
                                {{ Form::hidden( '_method','DELETE' ) }}
                                {{ Form::close() }}
                                
                            </div>

                            <div class="hidden-md hidden-lg">
                                <div class="inline pos-rel">
                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                        <li>{{ HTML::decode(link_to('deal/'.$deal->de_deal_id.'/edit', '<span class="green"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i></span>', array('class'=>'tooltip-success','data-rel'=>'tooltip','title'=>'Edit'))) }}</li>
                                        <li>
                                            <a href='javascript:void(0)' class="red bootbox-confirm tooltip-error" data-rel="tooltip" title="Delete" onclick="
                                                document.getElementById('hidden_rowid').value='{{ $deal->de_deal_id }}';
                                                document.getElementById('hidden_rowtitle').value='{{ $deal_title[$i-1] }}';
                                            "><span class="red"><i class="ace-icon fa fa-trash-o bigger-120"></i></span></a>
                                        </li>
                                    </ul>
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
            {{ HTML::link('deal/create', 'สร้างใหม่', array('class'=>'pull-left btn btn-sm btn-primary')) }}
            <a class="pull-left btn btn-sm btn-danger bootbox-confirm-delall" href="javascript:void(0)" style='margin-left: 7px;' >ลบรายการ</a>
        </div>


    </div><!-- /col -->
</div><!-- /row -->
<!-- PAGE CONTENT ENDS -->                    
@stop


@section('footer_script')
<!--[if lte IE 8]>
<script src="{{ asset('assets/js/ace/excanvas.js') }}"></script>
<![endif]-->
{{ HTML::script('assets/js/ace/jquery-ui.custom.js') }}
{{ HTML::script('assets/js/ace/bootbox.js') }}
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
                        {"bSortable": false},
                        null, null, null, null, null, null, null, null,
                        {"bSortable": false}
                    ],
                    "aaSorting": [[0, 'DESC']],
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
                if (th_checked) {
                    tableTools_obj.fnSelect(row);
                    $('.dataTableChkbox').attr( 'checked', true );
                } else {
                    tableTools_obj.fnDeselect(row);
                    $('.dataTableChkbox').removeAttr('checked');
                }
            });
        });

        //select/deselect a row when the checkbox is checked/unchecked
        $('#dynamic-table').on('click', 'td input[type=checkbox]', function () {
            var row = $(this).closest('tr').get(0);
            if (!this.checked) {
                tableTools_obj.fnSelect(row);
                this.setAttribute("checked", "checked");
                this.checked = true;
            } else {
                tableTools_obj.fnDeselect($(this).closest('tr').get(0));
                this.removeAttribute("checked");
                this.checked = false;
            }
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

    });
</script>

<script type="text/javascript">
    jQuery(function ($) {

        $(".bootbox-confirm").on(ace.click_event, function () {
            row_id = $('#hidden_rowid').val();
            row_code = $('#hidden_rowtitle').val();
            bootbox.confirm({
                message: "ต้องการลบ ดีล/คูปอง ชื่อ "+row_code+" ใช่หรือไม่?",
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
                        $('#form-del-'+row_id).submit();
                }
            }
            );
        });

    });
</script>

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
                message: "ต้องการลบ ดีล/คูปอง ที่เลือกทั้งหมด ใช่หรือไม่?",
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
@stop

