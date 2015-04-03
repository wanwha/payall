<?php

/**
 * Description of ShopController
 *
 * @author Yamada Yoseigi
 */

class ShopController extends BaseController {
    
    
    public function index(){

        $shop = Shop::orderBy('sh_shop_updatedate', 'DESC')             
                ->join('de_set_cate', 'sh_shop.sh_shop_cateid', '=', 'de_set_cate.de_set_cate_id')
                ->join('de_set_scate', 'sh_shop.sh_shop_scateid', '=', 'de_set_scate.de_set_scate_id') 
                ->get();
        
        $shopcode = Shop::lists('sh_shop_code');

        $i=1;
        foreach ($shopcode as $key => $code){
            $count_branch[$i] = Branch::where('sh_branch_shopcode','=', $code)->count();
            $i++;
        }

        $list_cate = Cate::lists('de_set_cate_nameth','de_set_cate_id');
        $list_subcate = Subcate::lists('de_set_scate_nameth','de_set_scate_id');
     
        return View::make('shop.index')
               ->with('shop', $shop)
               ->with('list_cate', $list_cate )
               ->with('count', count($shop))
               ->with('count_branch', $count_branch)               
               ->with('list_subcate', $list_subcate);
            
    }
    
    
    public function create(){

        return View::make('shop.create')
            ->with('list_cate', Cate::lists('de_set_cate_nameth','de_set_cate_id'))
            ->with('list_scate', Subcate::lists('de_set_scate_nameth','de_set_scate_id'))
            ->with('list_province', [''=>'กรุณาเลือก จังหวัด...']+Province::lists('sys_province_name', 'sys_province_provinceid'))
            ->with('list_subprovid', [''=>'กรุณาเลือก อำเภอ/เขต...'])
            ->with('list_district', [''=>'กรุณาเลือก ตำบล/แขวง...']);

    }
    

    public function store(){


        $rules = array(
            'sh_shop_typeid'    => 'required',
            'sh_shop_name'      => 'required',
            'input_cateid'      => 'required',
            'input_scateid'     => 'required',
            'sh_shop_email'     => 'email',
            'sh_shop_discount'  => 'numeric',
        );
        
        $varidator = Validator::make(Input::all(),$rules);

        if ($varidator->fails()) {
            return Redirect::to('shop/create')->withErrors($varidator);
                 
        } else {

            $shop = new Shop; 
            $shop->sh_shop_typeid  = implode(",", Input::get('sh_shop_typeid'));
            $shop->sh_shop_name  = Input::get('sh_shop_name');
            $shop->sh_shop_cateid  = Input::get('input_cateid');
            $shop->sh_shop_scateid  = implode(",", Input::get('input_scateid'));
            $shop->sh_shop_scateid   = Input::get('sh_shop_scateid');
            $shop->sh_shop_detail  = Input::get('sh_shop_detail');
            $shop->sh_shop_addr = Input::get('sh_shop_addr');
            $shop->sh_shop_disid = Input::get('input_district');
            $shop->sh_shop_subprovid = Input::get('input_subprovid');
            $shop->sh_shop_provid = Input::get('input_provid');
            $shop->sh_shop_postcode = Input::get('sh_shop_postcode');
            $shop->sh_shop_tel = Input::get('sh_shop_tel');
            $shop->sh_shop_fax = Input::get('sh_shop_fax');
            $shop->sh_shop_email = Input::get('sh_shop_email');
            $shop->sh_shop_line = Input::get('sh_shop_line');
            $shop->sh_shop_website = Input::get('sh_shop_website');
            $shop->sh_shop_discount = Input::get('sh_shop_discount');
            $shop->sh_shop_credate = date('Y-m-d H:i:s');
            $shop->sh_shop_updatedate = date('Y-m-d H:i:s');

            if(Input::hasFile('sh_shop_pic')){

                $picshop = Input::file('sh_shop_pic')->getClientOriginalName();
                $branch->sh_branch_mappic =  $picshop;
                Input::file('sh_shop_pic')->move('assets/image', Input::file('sh_shop_pic')->getClientOriginalName());

            }

            $shop->save();
            

            $addshopcode = Shop::find($shop->sh_shop_id);
            $addshopcode->sh_shop_code = str_pad($shop->sh_shop_id, 5 , "0", STR_PAD_LEFT);
            $addshopcode->save();

            Session::flash('success', 'เพิ่มร้านค้าเรียบร้อยแล้ว');
            return Redirect::to('shop');

        }
       
    }
    
    
    public function show($id){

         $shop = Shop::find($id)  
                ->join('de_set_cate', 'sh_shop.sh_shop_cateid', '=', 'de_set_cate.de_set_cate_id')
                ->join('de_set_scate', 'sh_shop.sh_shop_scateid', '=', 'de_set_scate.de_set_scate_id')            
                ->where('sh_shop.sh_shop_id','=',$id)
                ->first();

        $branch = Branch::orderBy('sh_branch_updatedate','DESC')
                ->where('sh_branch_shopcode', '=', $shop->sh_shop_code)
                ->get();

        return View::make('shop.show')
            ->with('shop', $shop)
            ->with('branch', $branch);
        
    }
    
    
    public function edit($id){

        $shop = Shop::find($id);    

        return View::make('shop.edit')
           ->with('shop',$shop)
           ->with('list_cate', Cate::lists('de_set_cate_nameth','de_set_cate_id'))
           ->with('list_scate', Subcate::lists('de_set_scate_nameth','de_set_scate_id'))
           ->with('list_province', [''=>'กรุณาเลือก จังหวัด...']+Province::lists('sys_province_name', 'sys_province_provinceid'))
           ->with('list_subprovid', [''=>'กรุณาเลือก อำเภอ/เขต...'])
           ->with('list_district', [''=>'กรุณาเลือก ตำบล/แขวง...']);

    }
    
    
    public function update($id){


        $rules = array(
            'sh_shop_typeid'   => 'required',
            'sh_shop_name'     => 'required',
            'sh_shop_cateid'   => 'required',
            'sh_shop_scateid'  => 'required',
            'sh_shop_email'    => 'email',           
        );
        
        $varidator = Validator::make(Input::all(), $rules);

        if ($varidator->fails()) {
            
            return Redirect::to('shop/'.$id.'/edit')->withErrors($varidator);
                 
        } else {
            
            // Update the cate details
            $shop = Shop::find($id);

            $shop->sh_shop_typeid  = implode(",", Input::get('sh_shop_typeid'));

            $shop->sh_shop_name  = Input::get('sh_shop_name');
            $shop->sh_shop_cateid  = Input::get('input_cateid');
            $shop->sh_shop_scateid = implode(",", Input::get('input_scateid'));
            $shop->sh_shop_detail  = Input::get('sh_shop_detail');
            $shop->sh_shop_addr = Input::get('sh_shop_addr');
            $shop->sh_shop_disid = Input::get('input_district');
            $shop->sh_shop_subprovid = Input::get('input_subprovid');
            $shop->sh_shop_provid = Input::get('input_provid');
            $shop->sh_shop_postcode = Input::get('sh_shop_postcode');
            $shop->sh_shop_tel = Input::get('sh_shop_tel');
            $shop->sh_shop_fax = Input::get('sh_shop_fax');
            $shop->sh_shop_email = Input::get('sh_shop_email');
            $shop->sh_shop_line = Input::get('sh_shop_line');
            $shop->sh_shop_website = Input::get('sh_shop_website');

            if(Input::hasFile('sh_shop_pic')){

                $picshop = Input::file('sh_shop_pic')->getClientOriginalName();
                $branch->sh_branch_mappic = $picshop;
                Input::file('sh_shop_pic')->move('assets/image', Input::file('sh_shop_pic')->getClientOriginalName());

            }

            $shop->sh_shop_updatedate = date('Y-m-d H:i:s');
            $shop->save();

            Session::flash('success', 'แก้ไขร้านค้าเรียบร้อยแล้ว');
            return Redirect::to('shop');
        }
        
    }
    
    
    public function destroy($id){

        if($id=='delall'){
            $arrData = Input::get('hidden_chkBoxDel');
            if(!empty($arrData)){
                foreach (explode(',', $arrData) as $id ){ $this->delete($id); }
                Session::flash('message', 'ลบร้านค้าเรียบร้อยแล้ว');
                return Redirect::to('shop');
            }else{
                Session::flash('danger', 'ไม่พบร้านค้าที่ต้องการลบ');
                return Redirect::to('shop');
            }   
        }else{ 
            $this->delete($id);
            Session::flash('message', 'ลบร้านค้าเรียบร้อยแล้ว');
            return Redirect::to('shop');
        }
 
    }

    
    private function delete ($id) {
        $shop = Shop::find($id);
        $shop->delete();
    }


    public function getFormSubcate(){

        if(Request::ajax()){
            $id = Input::get('input_cateid');
            $list_scate = Subcate::where('de_set_scate_cateid', '=', $id)->lists('de_set_scate_nameth','de_set_scate_id');                
            return View::make('shop.ajax.input_scateid')
                    ->with('list_scate', $list_scate)
                    ->render();
        }
        
    }
    
    
    public function getFormSubprovid() {

        if (Request::ajax()) {

            $input_provid = Input::get('input_provid');
            $subprovince = [''=>'กรุณาเลือก อำเภอ/เขต...']+Subprovince::where('sys_subprovince_provinceid', '=', $input_provid)
                           ->lists('sys_subprovince_name','sys_subprovince_subid');
             
            return View::make('shop.ajax.input_subprovid')
                ->with('list_subprovid', $subprovince)
                ->render();
        }

    }

    
    public function getFormDistrict() {

        if (Request::ajax()) {

            $input_subprovid = Input::get('input_subprovid');
            $district = [''=>'กรุณาเลือก ตำบล/แขวง...']+District::where('sys_district_subprovinceid', '=', $input_subprovid)
                           ->lists('sys_district_name','sys_district_districtid');
       
            return View::make('shop.ajax.input_district')
                ->with('list_district', $district)
                ->render();
        }

    }
    
    
}

   
