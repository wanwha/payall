@extends('layouts.ace.main')


@section('header_script')
{{ HTML::style('assets/css/ace/jquery-ui.custom.css') }}
@stop


@section('breadcrumbs')
<ul class="breadcrumb">
    <li>{{ HTML::decode(link_to('deal', '<i class="fa fa-barcode fa-lg"></i>จัดการดีล/คูปอง')) }}</li>
    <li>{{ HTML::decode(link_to('deal', 'รายการดีล/คูปอง')) }}</li>
    <li class="active">รายการล๊อท</li>
</ul>
@stop


@section('pageheader')
<h1>รายการล๊อท</h1>
@stop


@section('pagecontent')

{{ Form::open() }}
{{ Form::hidden('hidden_rowid', null, array('id'=>'hidden_rowid')) }}
{{ Form::hidden('hidden_rowtitle', null, array('id'=>'hidden_rowtitle')) }}
{{ Form::close() }}

{{ Form::open( array( 'url'=>'lot/delall', 'id'=>'form-del-delall') ) }}   
    {{ Form::hidden( '_method','DELETE' ) }}
    {{ Form::hidden('hidden_chkBoxDel', null, array('id'=>'hidden_chkBoxDel')) }}
{{ Form::close() }}

<!-- PAGE CONTENT BEGINS -->
<div class="row">
    <div class="col-xs-12">

        @include('layouts.ace.message')

        <div class="clearfix">
            {{ HTML::link('javascript:void(0)', 'เพิ่มสต๊อก', array(
                    'class'=>'pull-left btn btn-sm btn-primary',
                    'title'=>'เพิ่มสต๊อก',
                    'id'=>'modalRefunds',
                    'data-toggle'=>'modal',
                    'data-target'=>'#myModal' 
            )) }}
            {{ HTML::link('deal', 'ย้อนกลับ', array('class'=>'pull-left btn btn-sm btn-warning','style'=>'margin-left:7px')) }}
            <div class="pull-right tableTools-container"></div>
        </div>

        <!-- div.dataTables_borderWrap -->
        <div>
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center hidden-480">จำนวนที่เพิ่ม</th>
                        <th class="center">จำนวนที่ซื้อแล้ว</th>
                        <th class="center hidden-480">จำนวนใช้แล้ว</th>
                        <th class="center hidden-480">วันที่เพิ่ม</th>
                        <th class="center">เพิ่มโดย</th>
                        <th class="center">หมายเหตุ</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1; ?>
                    @foreach( $lot as $lot )
                    <tr>
                        <td class="center hidden-480">{{ $lot->de_lot_qty }}</td>
                        <td class="center">{{ $lot_count_bought[$i-1] }}</td>
                        <td class="center hidden-480">{{ $lot_count_used[$i-1] }}</td>
                        <td class="center hidden-480">{{ $lot_crebydate[$i-1] }}</td>
                        <td class="center">{{ $lot_crebyname[$i-1] }}</td>
                        <td class="center">{{ $lot->de_lot_remark }}</td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>    


        <div class="clearfix" style="margin-top:8px;">
            {{ HTML::link('javascript:void(0)', 'เพิ่มสต๊อก', array(
                    'class'=>'pull-left btn btn-sm btn-primary',
                    'title'=>'เพิ่มสต๊อก',
                    'id'=>'modalRefunds',
                    'data-toggle'=>'modal',
                    'data-target'=>'#myModal' 
            )) }}
            {{ HTML::link('deal', 'ย้อนกลับ', array('class'=>'pull-left btn btn-sm btn-warning','style'=>'margin-left:7px')) }}
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
        <h4 class="modal-title" id="myModalLabel">เพิ่มสต๊อก</h4>
        <!--# TITLE AREA -->
        
      </div>
      <div class="modal-body">
      {{ Form::open(array('url'=>'lot','class'=>'form-horizontal','role'=>'form')) }}
      {{ Form::hidden('input_dealid', Session::get('deal_id'), array('id'=>'input_dealid')) }}
        <!--# CONTENT AREA -->
        <div class="row">
            <div class="col-xs-12">

                <div class="form-group">
                    {{ Form::label('input_qty','จำนวน',array('class'=>'col-sm-2 control-label')) }} 
                    <div class="col-sm-8">
                        {{ Form::text('input_qty') }}
                    </div>
                </div>
                
                <div class="form-group">
                    {{ Form::label('input_remark','หมายเหตุ',array('class'=>'col-sm-2 control-label','row'=>'5')) }}  
                    <div class="col-sm-8">
                        {{ Form::textarea('input_remark') }}
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
                        null, null, null, null, null,
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

@stop

