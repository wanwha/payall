@extends('layouts.ace.main')


@section('header_script')
<!-- header_script -->
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li>{{ HTML::decode(link_to('deal', '<i class="fa fa-file-text-o fa-lg"></i>รายงานดีล/คูปอง')) }}</li>
    <li class="active">ประวัติการใช้ดีล/คูปอง</li>
</ul>
@stop


@section('pageheader')
<h1>ประวัติการใช้ดีล/คูปอง</h1>
@stop


@section('pagecontent')

<!-- PAGE CONTENT BEGINS -->
<div class="row">
    <div class="col-xs-12">

        @include('layouts.ace.message')
        
        <div class="row">
            <div class="col-sm-12">
                
            </div>
        </div>
            
        <div class="clearfix"> 
            <div class="pull-right tableTools-container"></div>
            @include('report_deal.bought.ajax.input_deal')
            @include('report_deal.bought.ajax.input_shop')
        </div>
        
        @include('report_deal.bought.ajax.datalist')
        
        
        <a href="#modal-table" role="button" data-toggle="modal" id="btnModalTable" style="display: none;">Modal Table</a>
        <div id="modal-table" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header no-padding">
                        <div class="table-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                <span class="white">&times;</span>
                            </button>
                            <span class="table-header-title">Order Detail</span>
                        </div>
                    </div>
                    
                    @include('report_deal.bought.ajax.modal_table')
                    
                    <div class="modal-footer no-margin-top">
                
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
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

<script type="text/javascript">
    jQuery(function ($) {
        //initiate dataTables plugin
        var oTable1 =
                $('#dynamic-table')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .dataTable({
                    bAutoWidth: false,
                    "aoColumns": [
                        null, null, null, null, null, null, null,
                        {"bSortable": false}
                    ],
                    "aaSorting": [],
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

    /*
     * This's script for controll Select dropdown "Shop" and "Deal"
     */

    var input_shopid = $('#input_shopid');
    var input_dealid = $('#input_dealid');
    
    function selectShop() {
    $.ajax({
            type: 'POST',
            url: '{{ URL::to("report_deal/bought/ajax_shop") }}',
            cache: true,
            data : {
                shopid:input_shopid.val()
            },
            beforeSend: function(){
                // Disable selectbox
                input_shopid.prop('disabled', true);
                input_dealid.prop('disabled', true);
            },
            success: function(data){

                input_dealid.empty().html(data);

                // Re-enable selectbox
                input_shopid.prop('disabled', false);
                input_dealid.prop('disabled', false);

            }
        });
        return false;
    };

    function selectDeal() {
    $.ajax({
            type: 'POST',
            url: '{{ URL::to("report_deal/bought/ajax_deal") }}',
            cache: true,
            data : {
                dealid:input_dealid.val()
            },
            beforeSend: function(){
                // Disable selectbox
                input_shopid.prop('disabled', true);
                input_dealid.prop('disabled', true);
            },
            success: function(data){

                input_shopid.empty().html(data);

                // Re-enable selectbox
                input_shopid.prop('disabled', false);
                input_dealid.prop('disabled', false);

            }
        });
        return false;
    };
    
    function getDatalist() {
        $.ajax({
            type: 'POST',
            url: '{{ URL::to("report_deal/bought/ajax_select") }}',
            cache: true,
            data : {
                shopid:input_shopid.val(),
                dealid:input_dealid.val()
            },
            beforeSend: function(){
                // Disable selectbox
                input_shopid.prop('disabled', true);
                input_dealid.prop('disabled', true);
            },
            success: function(data){

                $('#datalist').empty().html(data);

                // Re-enable selectbox
                input_shopid.prop('disabled', false);
                input_dealid.prop('disabled', false);

                $('#dynamic-table')
                    .dataTable({
                        bAutoWidth: false,
                        "aoColumns": [
                            null, null, null, null, null, null, null,
                            {"bSortable": false}
                        ],
                        "aaSorting": []
                    })
                    .ajax.reload();

                eval(input_dealid);

            }
        });
        return false;
    };
        
    input_shopid.on('change', function(){ selectShop(); getDatalist(); });
    input_dealid.on('change', function(){ selectDeal(); getDatalist(); });

</script>

<script>
    
    /*
     * This's script for controll Button Show mini-datalist (Modal) 
     */
    
    var orderid;
    var ordercode;
    
    function showOrderDetail(orderid, ordercode) {
        $.ajax({
            type: 'POST',
            url: '{{ URL::to("report_deal/bought/ajax_modal_table") }}',
            cache: true,
            data : {
                orderid:orderid
            },
            beforeSend: function(){
                // Disable

            },
            success: function(data){
                var modal = $('#modal-table');
                modal.find('.table-header-title').text('Order : ' + ordercode);
                modal.find('.modal-body').empty().html(data);
                
                $('#btnModalTable').click();

                // Enable 
            }
        });
        //return false;

    }
    
</script>
@stop

