@section('modal_table')
<div class="modal-body no-padding">
    <table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
        <thead>
            <tr>
                <th class="text-center">Serial No.</th>
                <th class="text-center">ราคาเต็ม</th>
                <th class="text-center">เข้าบริษัท</th>
                <th class="text-center">จ่ายลูกค้า</th>
                <th class="text-center">ส่วนลดลูกค้า</th>
                <th class="text-center">ราคาสุทธิ์</th>
                <th class="text-center">สถานะ</th>
            </tr>
        </thead>

        <tbody>
            @if(empty($order_detail))
                <tr>
                    <td colspan="7" style="height: 100px; vertical-align: middle; text-align: center;">No Data</td>
                </tr>
            @else
                <?php $i = 1; ?>
                @foreach( $order_detail as $key => $order_detail )
                <tr>
                    <td>{{ $order_detail->de_order_detail_serial }}</td>
                    <td class="text-right">{{ $order_detail->de_order_detail_fullpa }}</td>
                    <td class="text-right">{{ $order_detail->de_order_detail_company }}</td>
                    <td class="text-right">{{ $order_detail->de_order_detail_customer }}</td>
                    <td class="text-right">{{ $order_detail->de_order_detail_discount }}</td>
                    <td class="text-right">{{ $order_detail->de_order_detail_netpa }}</td>
                    <td class="text-center">{{ GetList::$list_statusOrder[$order_detail->de_order_detail_status] }}</td>
                </tr>
                <?php $i++; ?>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@show
