@section('input_branch')
<div class="form-group" id="shop_branch">
    {{ Form::label('input_branchid','เลือกสาขา',array('class'=>'col-sm-2 control-label no-padding-top')) }}
    <div class="col-sm-8">
        {{ Form::select('input_branchid[]', $list_branch, null, array(
                    'id'=>'input_branchid', 
                    'multiple'=>'multiple', 
                    'size'=>'10',
                    'class' => 'form-control input_branchid'
        )) }}
    </div>
</div>
@show