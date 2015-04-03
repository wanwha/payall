@section('input_subprovid')

        <div class="form-group">
            {{ Form::label('input_subprovid','อำเภอ/เขต',array('class'=>'col-sm-2 control-label')) }}    
            <div class="col-sm-8">
                {{ Form::select('input_subprovid', $list_subprovid ,null,array(
                    'id'=>'input_subprovid',   
                    'class' => 'form-control'
                 )) }}
                
            </div>
        </div>

        


@show