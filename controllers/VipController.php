<?php

/**
 * Description of VipController
 *
 * @author Yamada Yoseigi
 */

class VipController extends BaseController {
    
    
    public function index(){
        $result = Mem::selectVipForDatalist()
                ->where('mb_mem.mb_mem_type', '=', '2')
                ->get();
        return View::make('vip.index')
                ->with('result',$result)
                ->with('count',count($result));
    }
    
    
    public function create(){

    }
    
    
    public function store(){
       
    }
    
    
    public function show($id){

        $list_prefix = SetPrefix::lists('mb_set_prefix_name','mb_set_prefix_id');
        if( empty($list_prefix[0])){ $list_prefix[0] = ''; }
        $list_gender = SetGender::lists('mb_set_gender_name','mb_set_gender_id');
        if( empty($list_gender[0])){ $list_gender[0] = ''; }
        $list_province = Province::lists('sys_province_name','sys_province_id');
        if( empty($list_province[0])){ $list_province[0] = ''; }
        $list_subprovince = Subprovince::lists('sys_subprovince_name','sys_subprovince_id');
        if( empty($list_subprovince[0])){ $list_subprovince[0] = ''; }
        $list_district = District::lists('sys_district_name','sys_district_id');
        if( empty($list_district[0])){ $list_district[0] = ''; }
        $list_bank = SetBank::lists('mb_set_bank_name','mb_set_bank_id');
        if( empty($list_bank[0])){ $list_bank[0] = ''; }
        
        $result = Mem::find($id);
        return View::make('vip.show')
                ->with('vip',$result)
                ->with('list_prefix',$list_prefix)
                ->with('list_gender',$list_gender)
                ->with('list_province',$list_province)
                ->with('list_subprovince',$list_subprovince)
                ->with('list_district',$list_district)
                ->with('list_bank',$list_bank); 
    }
    
    
    public function edit($id){
        $list_prefix = GetList::$list_prefix;
        $list_locate = GetList::$list_locate;
        $list_nation = GetList::$list_nation;
        $list_type = GetList::$list_type;
        $list_province = Province::lists('sys_province_name','sys_province_id');
        if( empty($list_province[0])){ $list_province[0] = ''; }
        $list_subprovince = Subprovince::lists('sys_subprovince_name','sys_subprovince_id');
        if( empty($list_subprovince[0])){ $list_subprovince[0] = ''; }
        $list_district = District::lists('sys_district_name','sys_district_id');
        if( empty($list_district[0])){ $list_district[0] = ''; }
        

        $vip = Mem::find($id);
        
        // Get CreateBy
        $create_info = User::select('first_name', 'last_name')->where('id', '=', $vip->de_deal_crebyid)->first();
        if(!empty($create_info)){
            $vip_crebyname = $create_info->first_name.'&nbsp;&nbsp;'.$create_info->last_name;
        }else{
            $vip_crebyname = '-';
        }
        
        // Get UpdateBy
        $update_info = User::select('first_name', 'last_name')->where('id', '=', $vip->de_deal_updatebyid)->first();
        if(!empty($update_info)){
            $vip_updatebyname = $update_info->first_name.'&nbsp;&nbsp;'.$update_info->last_name;
        }else{
            $vip_updatebyname = '-';
        }
       
        
        return View::make('vip.edit')
                ->with('vip',$vip)
                ->with('list_prefix',$list_prefix)
                ->with('list_locate',$list_locate)
                ->with('list_type',$list_type)
                ->with('list_nation',$list_nation)
                ->with('list_province',$list_province)
                ->with('list_subprovince',$list_subprovince)
                ->with('list_district',$list_district)
                ->with('vip_crebyname', $vip_crebyname )
                ->with('vip_updatebyname', $vip_updatebyname );
    }
    
    
    public function update($id){
        
        $v = Mem::validate(Input::all());
        if ($v->passes()) {

            $vip = Mem::find($id);
            $vip->mb_mem_prefix = Input::get('input_prefix');
            $vip->mb_mem_fnameth = Input::get('input_fnameth');
            $vip->mb_mem_lnameth = Input::get('input_lnameth');
            $vip->mb_mem_fnameen = Input::get('input_fnameen');
            $vip->mb_mem_lnameen = Input::get('input_lnameen');
            $vip->mb_mem_email = Input::get('input_email');
            $vip->mb_mem_phone = Input::get('input_phone');
            $vip->mb_mem_locateid = Input::get('input_locateid');
            $vip->mb_mem_addr = Input::get('input_addr');
            $vip->mb_mem_provid = Input::get('input_provid');
            $vip->mb_mem_subprovid = Input::get('input_subprovid');
            $vip->mb_mem_distid = Input::get('input_distid');
            $vip->mb_mem_postcode = Input::get('input_postcode');
            $vip->mb_mem_tel = Input::get('input_tel');
            $vip->mb_mem_stime = Input::get('input_stime');
            $vip->mb_mem_etime = Input::get('input_etime');
            $vip->save();

            if($vip->save()){
                Session::flash('success', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
                return Redirect::to('vip/'.$id);
            }
        
        } else {
            return Redirect::back()
                    ->withInput()
                    ->withErrors( $v->messages() );
        }
        return Redirect::back()->with('error','เกิดข้อผิดพลาด');
    }
    
    
    public function destroy($id){

        if($id=='delall'){
            $arrData = Input::get('hidden_chkBoxDel');
            if(!empty($arrData)){
                foreach (explode(',', $arrData) as $id ){ $this->delete($id); }
                Session::flash('message', 'ลบข้อมูลเรียบร้อยแล้ว');
                return Redirect::to('vip');
            }else{
                Session::flash('danger', 'ไม่พบข้อมูลที่ต้องการลบ');
                return Redirect::to('vip');
            }   
        }else{       
            $this->delete($id);
            Session::flash('message', 'ลบข้อมูลเรียบร้อยแล้ว');
            return Redirect::to('vip');
        }

    }
    
    private function delete ($id) {
        $vip = Mem::find($id);
        $vip->delete();
    }

   
}