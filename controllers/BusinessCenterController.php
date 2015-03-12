<?php

/**
 * Description of BusinessCenterController
 *
 * @author Yamada Yoseigi
 */

class BusinessCenterController extends BaseController {
    
    
    public function index(){
        $businesscenter = BusinessCenter::orderBy('bu_center_updatedate', 'ASC')
                ->join('sys_province', 'bu_center.bu_center_provid', '=', 'sys_province.sys_province_id')
                ->selectJoinIndex()
                ->get();
        return View::make('businesscenter.index')
                ->with('businesscenter',$businesscenter)
                ->with('count',count($businesscenter));
    }
    
    
    public function create(){
        $list_dis = District::lists('sys_district_name','sys_district_id');
        $list_pro = Province::lists('sys_province_name','sys_province_id');
        $list_subpro = Subprovince::lists('sys_subprovince_name','sys_subprovince_id');
        return View::make('businesscenter.create')
            ->with(array(
                'list_dis'=>$list_dis,
                'list_pro'=>$list_pro,
                'list_subpro'=>$list_subpro
            ));
    }
    
    
    public function store(){
        $rules = array(
            'bu_center_name' => 'required|max:255',
            'bu_center_postcode' => 'numeric',
            'bu_center_email' => 'email',
            'bu_center_ctremail' => 'email',
            'bu_center_website' => 'max:255',
            'bu_center_ctrphone' => 'max:50',
            'bu_center_ctremail' => 'max:100',
            'bu_center_ctrline' => 'max:50',
            
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()) {
            return Redirect::to('businesscenter/create')
                ->withErrors($validator);
        } else {

            $businesscenter = new BusinessCenter;
            $businesscenter->bu_center_name = Input::get('bu_center_name');
            $businesscenter->bu_center_detail = Input::get('bu_center_detail');
            $businesscenter->bu_center_addr = Input::get('bu_center_addr');
            $businesscenter->bu_center_disid = Input::get('bu_center_disid');
            $businesscenter->bu_center_subprovid = Input::get('bu_center_subprovid');
            $businesscenter->bu_center_provid = Input::get('bu_center_provid');
            $businesscenter->bu_center_postcode = Input::get('bu_center_postcode');
            $businesscenter->bu_center_tel = Input::get('bu_center_tel');
            $businesscenter->bu_center_fax = Input::get('bu_center_fax');
            $businesscenter->bu_center_email = Input::get('bu_center_email');
            $businesscenter->bu_center_latitude = Input::get('bu_center_latitude');
            $businesscenter->bu_center_longitude = Input::get('bu_center_longitude');
            $businesscenter->bu_center_website = Input::get('bu_center_website');
            $businesscenter->bu_center_ctrname = Input::get('bu_center_ctrname');
            $businesscenter->bu_center_ctrphone = Input::get('bu_center_ctrphone');
            $businesscenter->bu_center_ctremail = Input::get('bu_center_ctremail');
            $businesscenter->bu_center_ctrline = Input::get('bu_center_ctrline');
            $businesscenter->bu_center_crebyid = Session::get('thisUser')->id;
            $businesscenter->bu_center_updatebyid = Session::get('thisUser')->id;
            $businesscenter->bu_center_credate = date('Y-m-d H:i:s');
            $businesscenter->bu_center_updatedate = date('Y-m-d H:i:s');
            $businesscenter->bu_center_status = Input::get('bu_center_status');
             if(Input::hasFile('bu_center_pic'))
                {
                    $imagepic = Input::file('bu_center_pic');
                    $pic = $imagepic->getClientOriginalName();
                    $businesscenter->bu_center_pic  =   $pic;
                    $imagepic->move('assets/images', $pic);
                }
            if (Input::hasFile('bu_center_mappic')) 
                {
                        $imagemappic = Input::file('bu_center_mappic');
                        $mappic = $imagemappic->getClientOriginalName();
                        $businesscenter->bu_center_mappic  =   $mappic;
                        $imagemappic->move('assets/images', $mappic);
                }    
            $businesscenter->save();

            $bucenter = BusinessCenter::find($businesscenter->bu_center_id);
            $bucenter->bu_center_code  =   str_pad($businesscenter->bu_center_id, 5 , "0", STR_PAD_LEFT);
            $bucenter->save();

            Session::flash('message', 'บันทึกข้อมูลสาขาเรียบร้อยแล้ว');
            return Redirect::to('businesscenter');
        }
    }
    
    
    public function show($id){
        $businesscenter = BusinessCenter::orderBy('bu_center_id','ASC')
                ->join('sys_district', 'bu_center.bu_center_disid', '=', 'sys_district.sys_district_id')
                ->join('sys_province', 'bu_center.bu_center_provid', '=', 'sys_province.sys_province_id')
                ->join('sys_subprovince', 'bu_center.bu_center_subprovid', '=', 'sys_subprovince.sys_subprovince_id')
                ->selectJoinShow()
                ->where('bu_center.bu_center_id','=',$id)
                ->first();
        return View::make('businesscenter.show')
            ->with('businesscenter', $businesscenter);
    }
    
    
    public function edit($id){
        $businesscenter = BusinessCenter::find($id);
        $list_dis = District::lists('sys_district_name','sys_district_id');
        $list_pro = Province::lists('sys_province_name','sys_province_id');
        $list_subpro = Subprovince::lists('sys_subprovince_name','sys_subprovince_id');
        return View::make('businesscenter.edit')
        ->with(array(
                'businesscenter'=>$businesscenter,
                'list_dis'=>$list_dis,
                'list_pro'=>$list_pro,
                'list_subpro'=>$list_subpro
                ));
    }
    
    
    public function update($id){
        $rules = array(
             'bu_center_name' => 'required|max:255',
            'bu_center_postcode' => 'numeric',
            'bu_center_email' => 'email',
            'bu_center_ctremail' => 'email',
            'bu_center_website' => 'max:255',
            'bu_center_ctrphone' => 'max:50',
            'bu_center_ctremail' => 'max:100',
            'bu_center_ctrline' => 'max:50'
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::to('businesscenter/' .$id. '/edit')
                ->withErrors($validator);
        } else {
            $businesscenter = BusinessCenter::find($id);
            $businesscenter->bu_center_name = Input::get('bu_center_name');
            $businesscenter->bu_center_detail = Input::get('bu_center_detail');
            $businesscenter->bu_center_addr = Input::get('bu_center_addr');
            $businesscenter->bu_center_disid = Input::get('bu_center_disid');
            $businesscenter->bu_center_subprovid = Input::get('bu_center_subprovid');
            $businesscenter->bu_center_provid = Input::get('bu_center_provid');
            $businesscenter->bu_center_postcode = Input::get('bu_center_postcode');
            $businesscenter->bu_center_tel = Input::get('bu_center_tel');
            $businesscenter->bu_center_fax = Input::get('bu_center_fax');
            $businesscenter->bu_center_email = Input::get('bu_center_email');
            $businesscenter->bu_center_latitude = Input::get('bu_center_latitude');
            $businesscenter->bu_center_longitude = Input::get('bu_center_longitude');
            $businesscenter->bu_center_website = Input::get('bu_center_website');
            $businesscenter->bu_center_ctrname = Input::get('bu_center_ctrname');
            $businesscenter->bu_center_ctrphone = Input::get('bu_center_ctrphone');
            $businesscenter->bu_center_ctremail = Input::get('bu_center_ctremail');
            $businesscenter->bu_center_ctrline = Input::get('bu_center_ctrline');
            $businesscenter->bu_center_crebyid = Session::get('thisUser')->id;
            $businesscenter->bu_center_updatebyid = Session::get('thisUser')->id;
            $businesscenter->bu_center_credate = date('Y-m-d H:i:s');
            $businesscenter->bu_center_updatedate = date('Y-m-d H:i:s');
            $businesscenter->bu_center_status = Input::get('bu_center_status');
            $businesscenter->save();

            Session::flash('message', 'แก้ไขข้อมูลสาขาเรียบร้อยแล้ว');
            return Redirect::to('businesscenter/'.$id );
        }
    }
    
    
    public function destroy($id){
         if($id=='delall'){
                    $arrData = Input::get('hidden_chkBoxDel');
                    if(!empty($arrData)){
                        foreach (explode(',', $arrData) as $id ){ $this->delete($id); }
                        Session::flash('message', 'ลบข้อมูลสาขาเรียบร้อยแล้ว');
                        return Redirect::to('businesscenter');
                    }else{
                        Session::flash('message', 'ไม่พบข้อมูลที่ต้องการลบ');
                        return Redirect::to('businesscenter');
                    }   
                    }else{       
                        $this->delete($id);
                        Session::flash('message', 'ลบข้อมูลสาขาเรียบร้อยแล้ว');
                        return Redirect::to('businesscenter');
                    }

    }

            private function delete ($id) {
                    $businesscenter = BusinessCenter::find($id);
                    $businesscenter->delete();
            }
    

   
}