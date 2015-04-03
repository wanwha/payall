@section("input_deal")
<div class="pull-right" style="margin-right:10px;">
    {{ Form::select('input_dealid', $list_deal, $focus_deal, array('id'=>'input_dealid', 'style'=>'width:200px;')) }}
</div>
@show
