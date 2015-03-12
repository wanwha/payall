@extends('layouts.ace.main')


@section('header_script')

<!-- header_script -->
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li><a href="{{ URL::to('cardsale') }}"><i class="fa fa-building-o fa-lg"></i>จัดการพินการ์ด</a></li>
    <li class="active">รายการจำหน่ายพินการ์ด</li>
</ul>
@stop


@section('pageheader')
<h1>รายการจำหน่ายพินการ์ด</h1>
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
        </div>
       <div>
           <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center" width="50"><label class="pos-rel"><input type="checkbox" class="ace" /><span class="lbl"></span></label></th>
                        <th class="center hidden-480" width="130">รหัสรายการ</th>
                        <th class="center" width="130">รหัสผู้ซื้อ</th>
                        <th class="center hidden-480">ชื่อผู้ซื้อ</th>          
                        <th class="center" width="130">วันที่ซื้อ</th>
                        <th class="center hidden-480" width="90">จำนวน</th>
                    </tr>
                </thead>

           
                <tbody>
                    @foreach( $cardsale as $key => $cardsale )
                    <tr>
                        <td class="center" width="50"><label class="pos-rel"><input type="checkbox" class="ace" /><span class="lbl"></span></label></td>
                        <td class="center">{{ HTML::link('cardsale/'.$cardsale->ca_sale_id,$cardsale->ca_sale_code) }}</td>  
                        <td class="center">{{ $cardsale->ca_sale_memcode}}</td>
                        <td>{{  GetList::$list_prefix[$cardsale->mb_mem_prefix].$cardsale->mb_mem_fnameth.' '.$cardsale->mb_mem_lnameth }}</td>
                        <td class="center hidden-480">{{ GetFormat::format_DateTime($cardsale->ca_sale_buydate) }}</td>
                        <td class="center" >{{ $cardsale->ca_sale_qty }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>    
    </div><!-- /col -->
</div><!-- /row -->
<!-- PAGE CONTENT ENDS -->                    
@stop


@section('footer_script')
{{ HTML::script('assets/js/ace/dataTables/jquery.dataTables.js') }}
{{ HTML::script('assets/js/ace/dataTables/jquery.dataTables.bootstrap.js') }}
{{ HTML::script('assets/js/ace/dataTables/extensions/TableTools/js/dataTables.tableTools.js') }}
{{ HTML::script('assets/js/ace/dataTables/extensions/ColVis/js/dataTables.colVis.js') }}
{{ HTML::script('assets/js/ace/jquery-ui.custom.js') }}
{{ HTML::script('assets/js/ace/bootbox.js') }}

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
                         null, null, null,null,
                        {"bSortable": false}
                    ],
                    "aaSorting": [ ],
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


@stop

