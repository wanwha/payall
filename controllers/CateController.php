<?php

/**
 * Description of CateController
 *
 * @author Yamada Yoseigi
 */

class CateController extends BaseController {

    
    public function index(){
        $cate = Cate::orderBy('de_set_cate_nameth','ASC')->get();
        return View::make('cate.index')
                ->with('cate',$cate)
                ->with('count',count($cate));
    }
    
    
    public function create(){
        return View::make('cate.create');
    }
    
    
    public function store(){

        $v = Deal::validate(Input::all());
        if ($v->passes()) {
            
            $cate = new Cate;
            $cate->de_set_cate_nameth   = Input::get('de_set_cate_nameth');
            $cate->de_set_cate_nameen   = Input::get('de_set_cate_nameen');
            $cate->de_set_cate_remark  = Input::get('de_set_cate_remark');
            $cate->de_set_cate_status  = Input::get('de_set_cate_status');
            $cate->de_set_cate_crebyid = Session::get('thisUser')->id;
            $cate->de_set_cate_credate = date('Y-m-d H:i:s');
            $cate->de_set_cate_updatebyid = Session::get('thisUser')->id;
            $cate->de_set_cate_updatedate = date('Y-m-d H:i:s');
            $cate->save();

            Session::flash('success', 'เพิ่มหมวดหมู่เรียบร้อยแล้ว');
            return Redirect::to('cate');
            
        } else {
            return Redirect::back()
                    ->withInput()
                    ->withErrors( $v->messages() );
        }
        return Redirect::back()->with('error','เกิดข้อผิดพลาด');
       
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
        
        $v = Deal::validate(Input::all());
        if ($v->passes()) {
            
            $cate = Cate::find($id);
            $cate->de_set_cate_nameth   = Input::get('de_set_cate_nameth');
            $cate->de_set_cate_nameen   = Input::get('de_set_cate_nameen');
            $cate->de_set_cate_remark  = Input::get('de_set_cate_remark');
            $cate->de_set_cate_status  = Input::get('de_set_cate_status');
            $cate->de_set_cate_updatedate = date('Y-m-d H:i:s');
            $cate->save();

            Session::flash('success', 'แก้ไขหมวดหมู่เรียบร้อยแล้ว');
            return Redirect::to('cate/'.$cate->de_set_cate_id);
            
        } else {
            return Redirect::to('cate/'.$de_set_cate_id.'/edit')
                    ->withInput()
                    ->withErrors( $v->messages() );
        }
         
    }
    
    
    public function destroy($id){

       if($id=='delall'){
            $arrData = Input::get('hidden_chkBoxDel');
            if(!empty($arrData)){
                foreach (explode(',', $arrData) as $id ){ $this->delete($id); }
                Session::flash('message', 'ลบหมวดหมู่เรียบร้อยแล้ว');
                return Redirect::to('cate');
            }else{
                Session::flash('danger', 'ไม่พบหมวดหมู่ที่ต้องการลบ');
                return Redirect::to('cate');
            }   
        }else{       
            $this->delete($id);
            Session::flash('message', 'ลบหมวดหมู่เรียบร้อยแล้ว');
            return Redirect::to('cate');
        }

    }
    
    
    private function delete ($id) {
        $cate = Cate::find($id);
        $cate->delete();
    }

    
}
