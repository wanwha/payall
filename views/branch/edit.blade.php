@extends('layouts.ace.main')


@section('header_script')

{{ HTML::style('assets/css/ace/bootstrap-duallistbox.css') }}
<!-- header_script -->
@stop


@section('breadcrumbs')

<ul class="breadcrumb">
    <li><a href="{{ URL::to('shop') }}"><i class="fa fa-shopping-cart fa-lg"></i>จัดการร้านค้า</a></li>
    <li><a href='javascript:void(0)' onclick=" document.getElementById('shopcode').value='{{ $shopcode }}';document.getElementById('fshopcode').submit();">จัดการสาขา</a></li>
    <li class="active">แก้ไขข้อมูลสาขา</li>
</ul>



@stop


@section('pageheader')

<h1>แก้ไขข้อมูลสาขา</h1>
@stop




@section('pagecontent')

{{ Form::open( array( 'url'=>'branch', 'name'=>'fshopcode','id'=>'fshopcode') ) }}   
{{ Form::hidden('shopcode', null, array('id'=>'shopcode')) }}
{{ Form::close() }}

<div class="row">
    <div class="col-xs-12">

        {{ Form::model($branch,array('route'=>array('branch.update',$branch->sh_branch_id),'method'=>'PUT','class'=>'form-horizontal')) }}
        {{ Form::hidden('shopcode', $shopcode , array('id'=>'braedit')) }}
                    
            @if($errors->all())
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8 alert alert-danger">
                    {{ HTML::ul($errors->all()) }}
                </div>
            </div>
            @endif

             
           <br>

            <div class="form-group" id="title_thai">
                {{ Form::label('sh_branch_name','หัวสาขา (ไทย)',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::text('sh_branch_name', GetText::expld_text($branch->sh_branch_name, 'thai'), array('class'=>'form-control', 'id'=>'sh_branch_name')) }}
                </div>
                <div class="col-xs-6 col-sm-2">
                    {{ Form::select('selectLang_title', GetList::$list_lang, null, array('id'=>'selectLang_title', 'class'=>'form-control', 'style'=>'width:98%;')) }}
                </div>
            <div class="col-xs-6 col-sm-2">
                    <a href="javascript:void(0)" id="addTitle" class="btn btn-mini btn-inverse"><i class="fa fa-plus"></i><span style="margin-left:5px;">เพิ่มภาษา</span></a>
                </div>
            </div>
             
            <div class="form-group" id="title_eng">
                {{ Form::label('input_titleen','หัวสาขา (อังกฤษ)',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::text('input_titleen',null,array('class'=>'form-control', 'id'=>'input_titleen')) }}
                </div>
                <div class="col-xs-6 col-sm-2">
                    <a href="javascript:void(0)" id="delTitle_eng" class="btn btn-mini btn-light"><i class="fa fa-minus"></i><span style="margin-left:5px;">ลบ</span></a>
                </div>
            </div>




            <div class="form-group">
                {{ Form::label('sh_branch_tel','เบอร์ติดต่อ :',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-8">
                    {{ Form::text('sh_branch_tel',$branch->sh_branch_tel,array('class'=>'form-control','placeholder'=>'เบอร์ติดต่อ')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('sh_branch_email','อีเมล์ :',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-8">
                    {{ Form::email('sh_branch_email',$branch->sh_branch_email,array('class'=>'form-control','placeholder'=>'อีเมล์')) }}
                </div>           
            </div>

            <div class="form-group">
                {{ Form::label('map','แผนที่/พิกัด :',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-2">
                    {{ Form::text('sh_branch_latitude',$branch->sh_branch_latitude,array('class'=>'form-control','placeholder'=>'แผนที่/พิกัด')) }}
                </div>
                <div class="col-sm-2">
                    {{ Form::text('sh_branch_longitude',$branch->sh_branch_longitude,array('class'=>'form-control','placeholder'=>'แผนที่/พิกัด')) }}
                </div>          
            </div>
            
            <div class="form-group">
                {{ Form::label('sh_branch_mappic','แผนที่/รูปภาพ :',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-8">  
                    
                     {{ Form::file('sh_branch_mappic',array('class'=>'form-control','placeholder'=>'แผนที่/รูปภาพ','id'=>'id-input-file-2' )) }} 
                                                   
                </div>
            </div>
            <br>

            <div class="form-group">
                <div class="center">
                {{ Form::submit('บันทึก',array('class'=>'btn btn-success')) }}
                <a href='javascript:void(0)' style="margin-left:7px" class="btn btn-info" 
                onclick=" document.getElementById('shopcode').value='{{ $shopcode }}';document.getElementById('fshopcode').submit();">ย้อนกลับ</a>
                </div>
                </div>
            </div>
            
         {{ Form::close() }}
    </div>
</div>



@stop


@section('footer_script')

{{ HTML::script('assets/js/ace/jquery.bootstrap-duallistbox.js') }}




<script type="text/javascript">
     jQuery(document).ready(function(){ 
    $('#input_titleen').val(null); 
    $('#title_eng').hide(); 
            });
 
//Title
$('#addTitle').click(function(){
    if($('#selectLang_title').val()==0){
        alert('โปรดเลือกภาษา');
    }else if($('#selectLang_title').val()==1){
        alert('มีช่องกรอกหัวข้อภาษาไทยอยู่แล้ว');
    }else if($('#selectLang_title').val()==2){
         $('#title_eng').show("slow");
    }    
});
$('#delTitle_eng').click(function(){
    $('#input_titleen').val(null); 
    $('#title_eng').hide("slow"); 
});



 </script>

 <script type="text/javascript">

    jQuery(function($){
         var demo1 = $('select[name="sh_shop_scateid"]').bootstrapDualListbox({infoTextFiltered: '<span class="label label-purple label-lg">Filtered</span>'});
                var container1 = demo1.bootstrapDualListbox('getContainer');
                container1.find('.btn').addClass('btn-white btn-info btn-bold');
            
                /**var setRatingColors = function() {
                    $(this).find('.star-on-png,.star-half-png').addClass('orange2').removeClass('grey');
                    $(this).find('.star-off-png').removeClass('orange2').addClass('grey');
                }*/
                $('.rating').raty({
                    'cancel' : true,
                    'half': true,
                    'starType' : 'i'
                    /**,
                    
                    'click': function() {
                        setRatingColors.call(this);
                    },
                    'mouseover': function() {
                        setRatingColors.call(this);
                    },
                    'mouseout': function() {
                        setRatingColors.call(this);
                    }*/
                })//.find('i:not(.star-raty)').addClass('grey');
                
           
                
                //in ajax mode, remove remaining elements before leaving page
                $(document).one('ajaxloadstart.page', function(e) {
                    $('[class*=select2]').remove();
                    $('select[name="sh_shop_scateid"]').bootstrapDualListbox('destroy');
                    $('.rating').raty('destroy');
                    $('.multiselect').multiselect('destroy');
                });
            
            });




             $('#id-input-file-1 , #id-input-file-2').ace_file_input({
                    no_file:'No File ...',
                    btn_choose:'Choose',
                    btn_change:'Change',
                    droppable:false,
                    onchange:null,
                    thumbnail:false //| true | large
                    //whitelist:'gif|png|jpg|jpeg'
                    //blacklist:'exe|php'
                    //onchange:''
                    //
                });

</script>


<!-- footer_script -->
@stop