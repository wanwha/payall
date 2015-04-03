@section('input_scateid')
<div class="form-group" id="shop_branch">
    {{ Form::label('input_scateid','เลือกสาขา',array('class'=>'col-sm-2 control-label no-padding-top')) }}
    <div class="col-sm-8">
        {{ Form::select('input_scateid[]', $list_scate, null, array(
                    'id'=>'input_scateid', 
                    'multiple'=>'multiple', 
                    'size'=>'10',
                    'class' => 'form-control input_cateid'
        )) }}
    </div>
</div>
@show