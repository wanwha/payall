<?php

/**
 * Description of VipController
 *
 * @author Yamada Yoseigi
 */

class CateController extends BaseController {


    
    
   public function index(){

       $count =Cate::orderBy('de_set_cate_updatedate','DESC')
                ->count();

        $cate = Cate::orderBy('de_set_cate_updatedate','DESC')->get();
        return View::make('cate.index')->with('cate',$cate)->with('count',$count);

    }
    
    
    public function create(){

        return View::make('cate.create');
    }
    
    
    public function store(){

         $rules = array(
            'de_set_cate_nameth'     => 'required',
            'de_set_cate_nameen'     => 'required',
            'de_set_cate_status'     => 'required',
            
        );
        
        $varidator = Validator::make(Input::all(),$rules);

        if ($varidator->fails()) {
            return Redirect::to('cate/create')->withErrors($varidator);
                 
        } else {
            
            // Update the cate details
            $cate = new Cate;

            $cate->de_set_cate_nameth   = Input::get('de_set_cate_nameth');
            $cate->de_set_cate_nameen   = Input::get('de_set_cate_nameen');
            $cate->de_set_cate_remark  = Input::get('de_set_cate_remark');
            $cate->de_set_cate_status  = Input::get('de_set_cate_status');
            $cate->de_set_cate_credate = date('Y-m-d H:i:s');
            $cate->de_set_cate_updatedate = date('Y-m-d H:i:s');
            $cate->save();

            Session::flash('success', 'เพิ่มข้อมูลหมวดหมู่เรียบร้อยแล้ว');
            return Redirect::to('cate');
            
        }
       
       
    }
    
    
    public function show($id){

        $cate = Cate::find($id);
        return View::make('cate.show')->with('cate',$cate);
    }
    
    
    public function edit($id){
        $cate = Cate::find($id);
        return View::make('cate.edit')->with('cate',$cate);
    }
    
    
    public function update($id){
        
        $rules = array(
            'de_set_cate_nameth'     => 'required',
            'de_set_cate_nameen'     => 'required',
            
        );
        
        $varidator = Validator::make(Input::all(),$rules);

        if ($varidator->fails()) {
            return Redirect::to('cate/'.$de_set_cate_id.'/edit')->withErrors($varidator);
                 
        } else {
            
            // Update the cate details
            $cate = Cate::find($id);
            $cate->de_set_cate_nameth   = Input::get('de_set_cate_nameth');
            $cate->de_set_cate_nameen   = Input::get('de_set_cate_nameen');
            $cate->de_set_cate_remark  = Input::get('de_set_cate_remark');
            $cate->de_set_cate_status  = Input::get('de_set_cate_status');
            $cate->de_set_cate_updatedate = date('Y-m-d H:i:s');
            $cate->save();

            Session::flash('success', 'แก้ไขข้อมูลหมวดหมู่เรียบร้อยแล้ว');
            return Redirect::to('cate/'.$cate->de_set_cate_id);
            
        }
         
    }
    
    
    public function destroy($id){

       if($id=='delall'){
            $arrData = Input::get('hidden_chkBoxDel');
            if(!empty($arrData)){
                foreach (explode(',', $arrData) as $id ){ $this->delete($id); }
                Session::flash('message', 'ลบข้อมูลหมวดหมู่เรียบร้อยแล้ว');
                return Redirect::to('cate');
            }else{
                Session::flash('message', 'ไม่พบข้อมูลมวดหมู่ที่ต้องการลบ');
                return Redirect::to('cate');
            }   
        }else{       
            $this->delete($id);
            Session::flash('message', 'ลบข้อมูลมวดหมู่เรียบร้อยแล้ว');
            return Redirect::to('cate');
        }

       
    }
    
     private function delete ($id) {
        $cate = Cate::find($id);
        $cate->delete();
      }

    
    
        


    
}
