@section('input_district')

        <div class="form-group">
            {{ Form::label('input_district','ตำบล/แขวง',array('class'=>'col-sm-2 control-label')) }}    
            <div class="col-sm-8">
                {{ Form::select('input_district',$list_district,null,array(
                    'id'=>'input_district',   
                    'class' => 'form-control'
                 )) }}            
            </div>
        </div>


@show