@section("input_shop")
<div class="pull-right" style="margin-right:10px;">
    {{ Form::select('input_shopid', $list_shop, $focus_shop, array('id'=>'input_shopid', 'style'=>'width:200px;')) }}
</div>
@show
