<?php

/**
 * Description of SubcateController
 *
 * @author Yamada Yoseigi
 */

class SubcateController extends BaseController {
    
    
    public function index(){
        $subcate = Subcate::orderBy('de_set_scate_nameth', 'ASC')
                ->join('de_set_cate', 'de_set_scate.de_set_scate_cateid', '=', 'de_set_cate.de_set_cate_id')
                ->get();
        return View::make('subcate.index')
                ->with('subcate',$subcate)
                ->with('count',count($subcate));
    }
    
    
    public function create(){
        $list_cate = Cate::lists('de_set_cate_nameth', 'de_set_cate_id');
        return View::make('subcate.create')
            ->with('list_cate', $list_cate);
    }
    
    
    public function store(){
        $rules = array(
            'de_set_scate_nameth' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()) {
            return Redirect::to('subcate/create')
                ->withErrors($validator);
        } else {
            $subcate = new Subcate;
            $subcate->de_set_scate_cateid = Input::get('de_set_scate_cateid');
            $subcate->de_set_scate_nameth = Input::get('de_set_scate_nameth');
            $subcate->de_set_scate_nameen = Input::get('de_set_scate_nameen');
            $subcate->de_set_scate_remark = Input::get('de_set_scate_remark');
            $subcate->de_set_scate_status = Input::get('de_set_scate_status');
            $subcate->de_set_scate_credate = date('Y-m-d H:i:s');
            $subcate->de_set_scate_updatedate = date('Y-m-d H:i:s');
            $subcate->save();

            Session::flash('message', 'บันทึกหมวดหมู่ย่อยเรียบร้อยแล้ว');
            return Redirect::to('subcate');
        }
    }
    
    
    public function show($id){
        $subcate = Subcate::orderBy('de_set_scate_id','DESC')
                ->selectJoinCate()
                ->join('de_set_cate', 'de_set_scate.de_set_scate_cateid', '=', 'de_set_cate.de_set_cate_id')
                ->where('de_set_scate.de_set_scate_id','=',$id)
                ->first();
        return View::make('subcate.show')
            ->with('subcate', $subcate);
    }
    
    
    public function edit($id){
        $subcate = Subcate::find($id);
        $list_cate = Cate::lists('de_set_cate_nameth','de_set_cate_id');
        return View::make('subcate.edit')
        ->with(array(
                'subcate'=>$subcate,
                'list_cate'=>$list_cate
            ));
    }
    
    
    public function update($id){
        $rules = array(
            'de_set_scate_nameth' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::to('subcate/' .$id. '/edit')
                ->withErrors($validator);
        } else {
            $subcate = Subcate::find($id);
            $subcate->de_set_scate_cateid = Input::get('de_set_scate_cateid');
            $subcate->de_set_scate_nameth = Input::get('de_set_scate_nameth');
            $subcate->de_set_scate_nameen = Input::get('de_set_scate_nameen');
            $subcate->de_set_scate_remark = Input::get('de_set_scate_remark');
            $subcate->de_set_scate_status = Input::get('de_set_scate_status');
            $subcate->save();

            Session::flash('message', 'แก้ไขหมวดหมู่ย่อยเรียบร้อยแล้ว');
            return Redirect::to('subcate/'.$id );
        }
    }
    
    
    public function destroy($id){
        
        if($id=='delall'){
            
            $arrData = Input::get('hidden_chkBoxDel');
            if(!empty($arrData)){
                foreach (explode(',', $arrData) as $id ){ $this->delete($id); }
                Session::flash('message', 'ลบหมวดหมู่ย่อยเรียบร้อยแล้ว');
                return Redirect::to('subcate');
            }else{
                Session::flash('danger', 'ไม่พบหมวดหมู่ย่อยที่ต้องการลบ');
                return Redirect::to('subcate');
            }  
            
        }else{       
            $this->delete($id);
            Session::flash('message', 'ลบหมวดหมู่ย่อยเรียบร้อยแล้ว');
            return Redirect::to('subcate');
        }

    }

    private function delete ($id) {
            $subcate = Subcate::find($id);
            $subcate->delete();
    }

        
}


    
    