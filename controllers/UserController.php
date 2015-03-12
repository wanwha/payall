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

        $count = User::orderBy('updated_at','DESC')
                ->count();

        $user = User::orderBy('updated_at', 'DESC')             
                ->join('users_groups', 'users.id', '=', 'users_groups.user_id')
                ->selectJoinUsergroup()
                ->get();

        $list_group = Group::lists('name','id');

        return View::make('user.index')
                ->with('user',$user)
               ->with('list_group',$list_group)
               ->with('count',$count);


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

        return View::make('user.create')->with('list_group',$list_group);


    }
    
    

    public function store(){
           
    try
    {

        $rules = array(

            'email' => 'required|email',
            'first_name'=>'required',
            'last_name' =>'required',
            'password'=>'required',

        );


        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()) {
            return Redirect::to('user/create')->withErrors($validator);

        } 
        else {
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

       Session::flash('message','สร้างผู้ใช้งานระบบใหม่เรียบร้อยแล้ว');

       return Redirect::to('user');
      }

   }
      catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
          return Redirect::to('user/create')->withErrors($validator);
        }
      catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
          return Redirect::to('user/create')->withErrors($validator);
        }
      catch (Cartalyst\Sentry\Users\UserExistsException $e)
        {
          return Redirect::to('user/create')->withErrors($validator);
        }
      catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
        {
           echo 'Group was not found.';
        }

   }
    
    
    
  
    
    
    public function edit($id){

        $user = User::find($id);
        $list_group = Group::lists('name','id');
        return View::make('user.edit')
        ->with(array(
                'user'=>$user,
                'list_group'=>$list_group
        ));
    }
    
    
    public function update($id){

      
    try
    {


        $rules = array(

            'first_name'=>'required',
            'last_name' =>'required',


        );


        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()) {
            return Redirect::to('user/'.$id.'/edit')->withErrors($validator);

        } 
        else {
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


         Session::flash('message','แก้ไขข้อมูลผู้ใช้งานระบบเรียบร้อยแล้ว');

         return Redirect::to('user');
      }

   }
      catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
          return Redirect::to('user/create')->withErrors($validator);
        }
      catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
          return Redirect::to('user/create')->withErrors($validator);
        }
      catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
        {
           echo 'Group was not found.';
        }
         
    }
    
    
    public function destroy($id){


        
        if($id=='delall'){
            $arrData = Input::get('hidden_chkBoxDel');
            if(!empty($arrData)){
                foreach (explode(',', $arrData) as $id ){ $this->delete($id); }
                Session::flash('message', 'ลบข้อมูลหมวดหมู่เรียบร้อยแล้ว');
                return Redirect::to('user');
            }else{
                Session::flash('message', 'ไม่พบข้อมูลมวดหมู่ที่ต้องการลบ');
                return Redirect::to('user');
            }   
        }else{ 

            $this->delete($id);
            Session::flash('message', 'ลบข้อมูลมวดหมู่เรียบร้อยแล้ว');
            return Redirect::to('user');
        }

       
    }
    
     private function delete ($id) {

        $user = User::find($id);
        $user->delete();


      }

    
}
