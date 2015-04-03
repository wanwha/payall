@section('datalist')
<div id='datalist'>
    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th class="">รหัสรายการ</th>
                <th class="center">ชื่อดีล</th>
                <th class="center hidden-480">รหัสผู้ซื้อ</th>
                <th class="center hidden-480">ชื่อ - สกุล</th>
                <th class="center">จำนวน</th>
                <th class="center">ราคา/pa</th>
                <th class="center hidden-480">วันที่</th>
                <th class="center">จัดการ</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 1; ?>
            @foreach( $order as $key => $order )
            <tr>
                <td class="">{{ $order->de_order_code }}</td>
                <td class="">{{ $deal_title[$i-1] }}</td>
                <td class="center hidden-480">{{ HTML::Link('member/'.$order->mb_mem_id, $order->mb_mem_code) }}</td>
                <td class="center hidden-480">{{ $order->mb_mem_fnameth.'&nbsp;&nbsp;'.$order->mb_mem_lnameth }}</td>
                <td class="center">{{ $order->de_order_qty }}</td>
                <td class="center">{{ $order->de_order_totalpa }}</td>
                <td class="center hidden-480">{{ date("d/m/Y h:i:s", strtotime($order->de_order_issuedate)) }}</td>
                <td class="center">
                    <div class="hidden-sm hidden-xs action-buttons">
                        <a href="javascript:void(0);" class="grey" onclick="
                            showOrderDetail('{{ $order->de_order_id }}', '{{ $order->de_order_code }}');" 
                        ><i class="ace-icon fa fa-search-plus bigger-130"></i></a>
                    </div>

                    <div class="hidden-md hidden-lg">
                        <div class="inline pos-rel">
                            <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                <li>
                                    <a href="javascript:void(0);" class="grey tooltip-info" data-rel="tooltip" title="show" onclick="
                                    showOrderDetail('{{ $order->de_order_id }}', '{{ $order->de_order_code }}');" 
                                    ><i class="ace-icon fa fa-search-plus bigger-130"></i></a>
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
@show

