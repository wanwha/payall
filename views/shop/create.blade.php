@extends('layouts.ace.main')


@section('header_script')

{{ HTML::style('assets/css/ace/bootstrap-duallistbox.css') }}
<!-- header_script -->
@stop


@section('breadcrumbs')

<ul class="breadcrumb">
    <li><a href="{{ URL::to('shop') }}"><i class="fa fa-shopping-cart fa-lg"></i>ร้านค้า</a></li>
    <li class="active">สร้างร้านค้า</li>
</ul>



@stop


@section('pageheader')

<h1>สร้างร้านค้า</h1>
@stop




@section('pagecontent')
<div class="row">
    <div class="col-xs-12">
        
        @include('layouts.ace.message')
        
        {{ Form::open(array('url'=>'shop','class'=>'form-horizontal','role'=>'form','files'=>true)) }}

            <div class="form-group">
                {{ Form::label('sh_shop_pic','รูปภาพ :',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-8">  
                    
                     {{ Form::file('sh_shop_pic',array('class'=>'form-control','placeholder'=>'แผนที่/รูปภาพ','id'=>'id-input-file-2' )) }} 
                                                   
                </div>
            </div>
            
 
            <div class="form-group">
                 {{ Form::label('sh_shop_typeid', 'ประเภทร้านค้า :', array('class' => 'col-sm-2 control-label')) }}
                
                     <div class="col-sm-2">
                        {{ Form::checkbox('sh_shop_typeid[]','ID1',false,array('class'=>'ace')) }}
                            <span class="lbl bigger-120"> ดีล/คูปอง</span>
                      </div>
                      <div class="col-sm-2">
                        {{ Form::checkbox('sh_shop_typeid[]','ID2',false,array('class'=>'ace','style'=>'margin-left:7px')) }}
                            <span class="lbl bigger-120"> เพลแครช</span>
                      </div>        
                      <div class="col-sm-2">
                        {{ Form::checkbox('sh_shop_typeid[]','ID3',false,array('class'=>'ace','style'=>'margin-left:7px' )) }}
                            <span class="lbl bigger-120"> Pay All</span> 
                         <span  style="color:#dd5a43;" ><b>*</b></span>                               
                      </div> 
             </div>  

            <div class="form-group">
                {{ Form::label('sh_shop_discount','ส่วนลด :',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-8">
                    {{ Form::text('sh_shop_discount',null,array('class'=>'form-control','placeholder'=>'ส่วนลด')) }}
                </div>
             
            </div>  


            <div class="form-group" id="title_thai">
                {{ Form::label('sh_shop_name','หัวร้านค้า (ไทย)',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::text('sh_shop_name', null, array('class'=>'form-control', 'id'=>'sh_shop_name')) }}
                </div>
                <div class="col-xs-6 col-sm-2">
                    {{ Form::select('selectLang_title', GetList::$list_lang, null, array('id'=>'selectLang_title', 'class'=>'form-control', 'style'=>'width:98%;')) }}
                </div>
            <div class="col-xs-6 col-sm-2">
                    <a href="javascript:void(0)" id="addTitle" class="btn btn-mini btn-inverse"><i class="fa fa-plus"></i><span style="margin-left:5px;">เพิ่มภาษา</span></a>
                </div>
            </div>
             
            <div class="form-group" id="title_eng">
                {{ Form::label('input_titleen','หัวร้านค้า (อังกฤษ)',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::text('input_titleen',null,array('class'=>'form-control', 'id'=>'input_titleen')) }}
                </div>
                <div class="col-xs-6 col-sm-2">
                    <a href="javascript:void(0)" id="delTitle_eng" class="btn btn-mini btn-light"><i class="fa fa-minus"></i><span style="margin-left:5px;">ลบ</span></a>
                </div>
            </div>
       

            <div class="form-group">
                 {{ Form::label('input_cateid', 'หมวดหมู่ :', array('class' => 'col-sm-2 control-label')) }}
                 <div class="col-sm-8">
                 {{ Form::select('input_cateid', $list_cate ,null, array('class'=>'form-control','id'=>'input_cateid')) }}
                 </div>
                 <span  style="color:#dd5a43;" ><b>*</b></span>
            </div>

               
                @include('shop.ajax.input_scateid')


            

            <div class="form-group" id="detail_TH">
                {{ Form::label('sh_shop_detail', 'รายละเอียด (ไทย)', array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::text('sh_shop_detail', null, array('class'=>'form-control', 'id'=>'sh_shop_detail', 'rows'=>'5' )) }}
                </div>
                <div class="col-xs-6 col-sm-2">
                    {{ Form::select('selectLang_detail', GetList::$list_lang, null, array('id'=>'selectLang_detail', 'class'=>'form-control', 'style'=>'width:98%;')) }}
                </div>
                <div class="col-xs-6 col-sm-2">
                    <a href="javascript:void(0)" id="addDetail" class="btn btn-mini btn-inverse"><i class="fa fa-plus"></i><span style="margin-left:5px;">เพิ่มภาษา</span></a>
                </div>
            </div>
             
            <div class="form-group" id="detail_eng">
                {{ Form::label('input_detailen','รายละเอียด (อังกฤษ)',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::text('input_detailen',null,array('class'=>'form-control', 'id'=>'input_detailen')) }}
                </div>
                <div class="col-xs-6 col-sm-2">
                    <a href="javascript:void(0)" id="delDetail_eng" class="btn btn-mini btn-light"><i class="fa fa-minus"></i><span style="margin-left:5px;">ลบ</span></a>
                </div>
            </div>

            <div class="form-group" id="title_thai">
                {{ Form::label('sh_shop_addr' ,'ชื่อร้านค้า (ไทย)',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::text('sh_shop_addr', null, array('class'=>'form-control', 'id'=>'sh_shop_addr')) }}
                </div>
                <div class="col-xs-6 col-sm-2">
                    {{ Form::select('selectLang_naneshop', GetList::$list_lang, null, array('id'=>'selectLang_naneshop', 'class'=>'form-control', 'style'=>'width:98%;')) }}
                </div>
            <div class="col-xs-6 col-sm-2">
                    <a href="javascript:void(0)" id="addNaneshop" class="btn btn-mini btn-inverse"><i class="fa fa-plus"></i><span style="margin-left:5px;">เพิ่มภาษา</span></a>
                </div>
            </div>
             
            <div class="form-group" id="Naneshop_eng">
                {{ Form::label('input_naneshopen','ชื่อร้านค้า (อังกฤษ)',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-4">
                    {{ Form::text('input_naneshopen',null,array('class'=>'form-control', 'id'=>'input_naneshopen')) }}
                </div>
                <div class="col-xs-6 col-sm-2">
                    <a href="javascript:void(0)" id="delNaneshop_eng" class="btn btn-mini btn-light"><i class="fa fa-minus"></i><span style="margin-left:5px;">ลบ</span></a>
                </div>
            </div>

            <div class="form-group">
            {{ Form::label('sh_shop_addr','ที่อยู่',array('class'=>'col-sm-2 control-label')) }}    
                <div class="col-sm-8">
                {{ Form::textarea('sh_shop_addr', null, array(
                    'class'=>'form-control',
                    'placeholder'=>'ที่อยู่',
                    'rows'=>'3px',
                )) }}
                </div>
            </div>

            <div class="form-group">
            {{ Form::label('input_provid', 'จำหวัด :', array('class' => 'col-sm-2 control-label')) }}
               <div class="col-sm-8">
                {{ Form::select('input_provid', $list_province , null ,array('class'=>'form-control','id'=>'input_provid')) }}
               
                </div>
            </div>

      

          @include('shop.ajax.input_subprovid')

          @include('shop.ajax.input_district')

             <div class="form-group">
                {{ Form::label('sh_shop_postcode','ไปรษณีย์ :',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-8">
                    {{ Form::text('sh_shop_postcode',null,array('class'=>'form-control','placeholder'=>'ไปรษณีย์')) }}
                </div>
                
            </div>

            <div class="form-group">
                {{ Form::label('sh_shop_tel','เบอร์ติดต่อ :',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-8">
                    {{ Form::text('sh_shop_tel',null,array('class'=>'form-control','placeholder'=>'เบอร์ติดต่อ ')) }}
                </div>
                
            </div>

            <div class="form-group">
                {{ Form::label('sh_shop_fax','แฟรกซ์ :',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-8">
                    {{ Form::text('sh_shop_fax',null,array('class'=>'form-control','placeholder'=>'แฟรกซ์')) }}
                </div>
              
            </div>

            <div class="form-group">
                {{ Form::label('sh_shop_email','อีเมล์ :',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-8">
                    {{ Form::text('sh_shop_email',null,array('class'=>'form-control','placeholder'=>'อีเมล์')) }}
                </div>
               
            </div>

            <div class="form-group">
                {{ Form::label('sh_shop_line','ไลน์ ไอดี :',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-8">
                    {{ Form::text('sh_shop_line',null,array('class'=>'form-control','placeholder'=>'ไลน์ ไอดี')) }}
                </div>
                 
            </div>

            <div class="form-group">
                {{ Form::label('sh_shop_website','เว็บไซต์ :',array('class'=>'col-sm-2 control-label')) }}
                <div class="col-sm-8">
                    {{ Form::text('sh_shop_website',null,array('class'=>'form-control','placeholder'=>'เว็บไซต์')) }}
                </div>
             
            </div>

<br>

            <div class="form-group">
                <div class="center">
                {{ Form::submit('บันทึก',array('class'=>'btn btn-info')) }}
                <a class="btn btn-deflaut" style="margin-left:7px" href="{{ URL::to('shop') }}">ยกเลิก</a>
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
    $('#input_detailen').val(null); 
    $('#detail_eng').hide(); 

    $('#input_naneshopen').val(null); 
    $('#Naneshop_eng').hide(); 

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


//ลายละเอียด
$('#addDetail').click(function(){
    if($('#selectLang_detail').val()==0){
        alert('โปรดเลือกภาษา');
    }else if($('#selectLang_detail').val()==1){
        alert('มีช่องกรอกรายละเอียดภาษาไทยอยู่แล้ว');
    }else if($('#selectLang_detail').val()==2){
         $('#detail_eng').show("slow");
    }    
});
$('#delDetail_eng').click(function(){
    $('#input_detailen').val(null); 
    $('#detail_eng').hide("slow");  
});


//ร้านค้า
$('#addNaneshop').click(function(){
    if($('#selectLang_naneshop').val()==0){
        alert('โปรดเลือกภาษา');
    }else if($('#selectLang_naneshop').val()==1){
        alert('มีช่องกรอกรายละเอียดภาษาไทยอยู่แล้ว');
    }else if($('#selectLang_naneshop').val()==2){
         $('#Naneshop_eng').show("slow");
    }    
});
$('#delNaneshop_eng').click(function(){
    $('#input_naneshopen').val(null); 
    $('#Naneshop_eng').hide("slow");  
});



 </script>


<script type="text/javascript">



    jQuery(function($) {
        var demo1 = $('select[name="input_scateid[]"]').bootstrapDualListbox({infoTextFiltered: '<span class="label label-purple label-lg">Filtered</span>'});
        var container1 = demo1.bootstrapDualListbox('getContainer');
        container1.find('.btn').addClass('btn-white btn-info btn-bold');
                   
    });


function selectSubcate() {
    $.ajax({
        type: 'POST',
        url: '{{ URL::to("shop/ajax_subcate") }}',
        cache: true,
        data : {input_cateid:$("#input_cateid").val()},
        beforeSend: function(){
            // Disable selectbox
            $('#input_scateid').prop('disabled', true);
            $('select[name="input_scateid[]_helper1"]').prop('disabled', true);
            $('select[name="input_scateid[]_helper2"]').prop('disabled', true);
        },
        success: function(data){
        
            $('select[name="input_scateid[]_helper1"]').empty();
            $('select[name="input_scateid[]_helper2"]').empty();
            $('#input_scateid').empty().html(data);
            
            $('select[name="input_scateid[]"]').bootstrapDualListbox('refresh');
            
            // Re-enable selectbox
            $('#input_scateid').prop('disabled', false);
            $('select[name="input_scateid[]_helper1"]').prop('disabled', false);
            $('select[name="input_scateid[]_helper2"]').prop('disabled', false);
            
            
        }
    });

    return false;

};


$("#input_cateid").change(function(){ selectSubcate(); });
$(document).ready(function(){ selectSubcate(); });


$(document).one('ajaxloadstart.page', function(e) {
    $('select[name="input_scateid[]"]').bootstrapDualListbox('destroy');
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




function selectSubprovid() {
    $.ajax({
        type: 'POST',
        url: '{{ URL::to("shop/selectsubprovid") }}',
        cache: true,
        data : {input_provid:$("#input_provid").val()}, 
        success: function(data){

            $('#input_subprovid').empty().html(data);

            
            
        }
    });
    return false;
};

function emptyDistrict() {
    $.ajax({
        type: 'POST',
        url: '{{ URL::to("shop/selectdistrict") }}',
        cache: true,
        data : {input_subprovid:"" },
        success: function(data){

            $('#input_district').empty().html(data);

            
            
        }
    });
    return false;
};

$("#input_provid").change(function(){ selectSubprovid(); });
$("#input_provid").change(function(){  emptyDistrict() });
$(document).ready(function(){ selectSubprovid(); });



function selectDistrict() {
    $.ajax({
        type: 'POST',
        url: '{{ URL::to("shop/selectdistrict") }}',
        cache: true,
        data : {input_subprovid:$("#input_subprovid").val()},    
        success: function(data){
            $('#input_district').empty().html(data);
              
        }
    });
    return false;
};

$("#input_subprovid").change(function(){ selectDistrict(); });
$(document).ready(function(){ selectDistrict(); });


</script>

<!-- footer_script -->
@stop