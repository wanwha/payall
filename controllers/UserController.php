<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author User
 */
class UserController extends BaseController {
    
    
    public function index(){
        
        $user = User::orderBy('updated_at', 'DESC')             
                ->join('users_groups', 'users.id', '=', 'users_groups.user_id')
                ->selectJoinUsergroup()
                ->get();
        
        $count = count($user);
        $list_group = Group::lists('name','id');

        return View::make('user.index')
                ->with('user', $user)
                ->with('count', $count)
                ->with('list_group', $list_group);

    }

      public function show($id){

        $user = User::orderBy('id','DESC')
              ->join('users_groups', 'users.id', '=', 'users_groups.user_id')
              ->selectJoinUsergroup()
              ->where('users.id','=',$id)
              ->first();

        $list_group = Group::lists('name','id');
        return View::make('user.show')->with('user', $user)->with('list_group',$list_group);
          
    }
    
    
    public function create(){

        $list_group = Group::lists('name','id');
        return View::make('user.create')->with('list_group', $list_group);

    }
    
    
    public function store(){
           
        try {

            $rules = array(
                'email'         => 'required|email',
                'first_name'    => 'required',
                'last_name'     => 'required',
                'password'      => 'required',
            );
           $message = array(
                'email.required'        => 'กรุณากรอกอีเมล',
                'email.email'           => 'รูปแบบอีเมลไม่ถูกต้อง',
                'first_name.required'   => 'กรุณากรอกชื่อ',
                'last_name.required'    => 'กรุณากรอกนามสกุล',
                'password.required'    => 'กรุณากรอกรหัสผ่าน',
            );

            $v = Validator::make( Input::all() ,$rules, $message);
            
            if ( $v->fails()  ) {

                return Redirect::to('user/create')->withErrors( $v->messages() );
                
            } else {
                
                // Create the user
                $user = Sentry::register(array(
                    'email' => Input::get('email'),
                    'first_name' => Input::get('first_name'),
                    'last_name'  => Input::get('last_name'),
                    'password'  => Input::get('password'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ));

                // Find the group using the group id
                $adminGroup = Sentry::findGroupById(Input::get('id'));

                // Assign the group to the user
                $user->addGroup($adminGroup);

                $activationCode = $user->getActivationCode();

                Mail::send('auth.activate', array('code'=>$activationCode),function($message){
                    $message->to(Input::get('email'))->subject('Activate your account');
                });

                Session::flash('success', 'สร้างผู้ใช้งานระบบใหม่เรียบร้อยแล้ว');
                return Redirect::to('user');
 
            }
        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
              return Redirect::to('user/create')->withErrors( $v->messages() );
        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
              return Redirect::to('user/create')->withErrors( $v->messages() );
        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
              return Redirect::to('user/create')->withErrors( $v->messages() );
        }catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e) {
               echo 'Group was not found.';
        }

    }

   
    public function edit($id){

        $user = Sentry::findUserById($id);
        $list_group = Group::lists('name', 'id');
        return View::make('user.edit')
            ->with(array(
                    'user'=>$user,
                    'list_group'=>$list_group
                ));
    }
    
    
    public function update($id){

        try {

            $rules = array(
                'first_name'    => 'required',
                'last_name'     => 'required',
            );
            $message = array(
                'first_name.required'   => 'กรุณากรอกชื่อ',
                'last_name.required'    => 'กรุณากรอกนามสกุล',
            );  

            $v = Validator::make( Input::all() ,$rules, $message);

            if ( $v->fails() ) {
                return Redirect::to('user/'.$id.'/edit')->withErrors( $v->messages() );
            } else {
                // reate the user
                $user = Sentry::findUserById($id);
                $user->first_name = Input::get('first_name');
                $user->last_name  = Input::get('last_name');
                $user->updated_at = date('Y-m-d H:i:s');
                $user->save();

                // Find the group using the group id
                $adminGroup = Sentry::findGroupById(Input::get('id'));

                // Assign the group to the user
                $user->addGroup($adminGroup);

                Session::flash('success','แก้ไขข้อมูลผู้ใช้งานระบบเรียบร้อยแล้ว');
                return Redirect::to('user');
            }

        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
              return Redirect::to('user/create')->withErrors($validator);
        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
              return Redirect::to('user/create')->withErrors($validator);
        } catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e) {
               echo 'Group was not found.';
        }
         
    }
    
    
    public function destroy($id){

        if ($id=='delall'){
            $arrData = Input::get('hidden_chkBoxDel');
            if(!empty($arrData)){
                foreach (explode(',', $arrData) as $id ){ $this->delete($id); }
                Session::flash('message', 'ลบข้อมูลผู้ใช้งานระบบเรียบร้อยแล้ว');
                return Redirect::to('user');
            }else{
                Session::flash('danger', 'ไม่พบข้อมูลผู้ใช้งานระบบที่ต้องการลบ');
                return Redirect::to('user');
            }   
        } else{ 

            $this->delete($id);
            Session::flash('message', 'ลบข้อผู้ใช้งานระบบรียบร้อยแล้ว');
            return Redirect::to('user');
        }

    }
    
    private function delete ($id) {
        $user = User::find($id);
        $user->delete();
    }

    
}
