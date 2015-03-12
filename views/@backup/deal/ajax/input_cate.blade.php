@section('input_cate')
    <div class="form-group" id="shop_cate">
        {{ Form::label('input_cateid', 'หมวดหมู่', array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-4">
            {{ Form::text('input_cateid', $catename, array(
                        'id'=>'input_cateid',
                        'class'=>'form-control',
                        'disabled'=>'disabled',
                        'readonly'
            )) }}
        </div>
    </div>

    <div class="form-group" id="shop_scate">
        {{ Form::label('input_scateid', 'หมวดหมู่ย่อย', array('class'=>'col-sm-2 control-label')) }}
        <div class="col-sm-4">
            {{ Form::text('input_scateid', $scatename, array(
                        'id'=>'input_scateid',
                        'class'=>'form-control',
                        'disabled'=>'disabled',
                        'readonly'
            )) }}
        </div>
    </div>
@show