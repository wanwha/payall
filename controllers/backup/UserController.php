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
        $user = Sentry::findAllUsers();
        return View::make('user.index')->with('user',$user);
    }
    
    
    public function create(){
        return View::make('user.create')
                ->with(array('user',$user));
    }
    
    
    public function store(){
       
        $rules = array(
            'email'         => 'required|email',
            'first_name'    => 'required',
            'last_name'     => 'required',
            'password'      => 'required'
        );
        
        $validator = Validator::make(Input::all(), $rules);
        
        if($validator->fails()) {
            return Redirect::to('user/create')
                    ->withErrors($validator);
        } else {
            
            try
            {
                // Create the user
                $user = Sentry::createUser(array(

                    'email'         => Input::get('email'),
                    'first_name'    => Input::get('first_name'),
                    'last_name'     => Input::get('last_name'),
                    'password'      => Input::get('password'),
                    'activated'     => FALSE,
                    'permissions'   => array(
                        'user.create' => 1,
                        'user.delete' => 1,
                        'user.view'   => 1,
                        'user.update' => 1,
                    ),
                ));

                // Let's get the activation code
                $activationCode = $user->getActivationCode();
                Mail::send('auth/activate', array('code'=>$activationCode), function($message){
                    $message->to(Input::get('email'))->subject('กรุณายืนยันตัวเอง');
                });

                Session::flash('success','เพิ่มผู้ใช้งานแล้ว กรุณาตรวจสอบอีเมลของผู้ใช้งาน');
                return View::make('mod_user')
                        ->with(array('user',$user));

            }
            catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
            {
                echo 'Login field is required.';
            }
            catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
            {
                echo 'Password field is required.';
            }
            catch (Cartalyst\Sentry\Users\UserExistsException $e)
            {
                echo 'User with this login already exists.';
            }
            catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
            {
                echo 'Group was not found.';
            }
     
        }
    }
    
    
    public function show($id){
        $user = Users::find($id);
        return View::make('user.show')->with('user',$user);
    }
    
    
    public function edit($id){
        $user = Users::find($id);
        return View::make('user.edit')->with('user',$user);
    }
    
    
    public function update($id){
        
        $rules = array(
            'first_name'     => 'required',
            'last_name'      => 'required', 
        );
        
        $varidator = Validator::make(Input::all(),$rules);

        if ($varidator->fails()) {
            return Redirect::to('user/'.$id.'/edit')
                    ->withErrors($varidator)
                    ->withInput(Input::except('password'));
        } else {
            
            // Update the user details
            $user = Users::find($id);
            $user->first_name   = Input::get('first_name');
            $user->last_name    = Input::get('last_name');
            $user->updated_at    = Input::get('updated_at');
            $user->save();

            Session::flash('success', 'แก้ไขข้อมูลผู้ใช้เรียบร้อยแล้ว');
            return Redirect::to('user/'.$user->id);
            
        }
         
    }
    
    
    public function destroy($id){
        
        $user = Users::find($id);
        $user->delete();
        
        Session::flash('message', 'ลบข้อมูลผู้ใช้เรียบร้อยแล้ว');
        return Redirect::to('user');
        
    }

    
}
