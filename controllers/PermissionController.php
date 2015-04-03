<?php

/**
 * Description of MemberController
 *
 * @author Yamada Yoseigi
 */

class PermissionController extends BaseController {
    
    
    public function index(){
        $permission = Group::orderBy('id', 'ASC')
                ->get();
        return View::make('permission.index')
                ->with('permission',$permission);
    }
    
    
    public function create(){
        return View::make('permission.create');
    }
    
    
    public function store(){
        $rules = array(
            'name' => 'required',
            'permission' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()) {
            return Redirect::to('permission/create')
                ->withErrors($validator);
        } else {
            $permission = new Group;
            $permission->name = Input::get('name');
            $permission->permissions = Input::get('permission');
            $permission->created_at = date('Y-m-d H:i:s');
            $permission->updated_at = date('Y-m-d H:i:s');
            $permission->save();

            Session::flash('message', 'บันทึกข้อมูลเรียบร้อยแล้ว');
            return Redirect::to('permission');
        }
    }
    
    
    public function show($id){
        $permission = Group::find($id);
        return View::make('permission.show')
            ->with('permission', $permission);
    }
    
    
    public function edit($id){
        $permission = Group::find($id);
        return View::make('permission.edit')->with('permission',$permission);
    }
    
    
    public function update($id){
        $rules = array(
            'name' => 'required',
            'permission' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::to('permission/' .$id. '/edit')
                ->withErrors($validator);
        } else {
            $permission = Group::find($id);
            $permission->name = Input::get('name');
            $permission->permissions = Input::get('permission');
            $permission->updated_at = date('Y-m-d H:i:s');
            $permission->save();

            Session::flash('message', 'แก้ไขข้อมูลสิทธิ์การใช้งานเรียบร้อยแล้ว');
            return Redirect::to('permission');
        }
    }
    
    
    public function destroy($id){
        $permission = Group::find($id);
        $permission->delete();

        Session::flash('message', 'ลบข้อมูลสิทธิ์การใช้งานเรียบร้อยแล้ว');
        return Redirect::to('permission');
    }
   
}