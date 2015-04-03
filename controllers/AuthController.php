<?php

/**
 * use to User authentication 
 * Sign Up ,Activate Code ,Sign In, Sign Out, Forget Password, Change Password
 *
 * @author Yamada Yoseigi
 */

class AuthController extends BaseController {
    
    public function signin() {
    // Check Status Login
        if( Sentry::check() ){
            return View::make('home');
        }else{
            return View::make('auth.login');
        }
    }
    
    public function register() {
        try {
		// Let's register a user.
		$user = Sentry::register(array(
			'email'    => Input::get('email'),
			'password' => Input::get('passwd'),
                        'first_name' => Input::get('firstname'),
                        'last_name' => Input::get('lastname'),
		));

		// Let's get the activation code
		$activationCode = $user->getActivationCode();
                Mail::send('auth/activate', array('code'=>$activationCode), function($message){
                    $message->to(Input::get('email'))->subject('กรุณายืนยันตัวเอง');
                });

                Session::flash('success','กรุณาตรวจสอบอีเมลของท่าน');
                return View::make('auth/login');
	} catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
		echo 'Login field is required.';
	} catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
		echo 'Password field is required.';
	} catch (Cartalyst\Sentry\Users\UserExistsException $e) {
		echo 'User with this login already exists.';
	}
    }
    
    public function activate($code) {
        try {
		$user = Sentry::findUserByActivationCode($code);

		// Attempt to activate the user
		if ($user->attemptActivation($code)) {
                    Session::flash('success','การยืนยันตัวสมบูรณ์ คุณสามารถเข้าสู่ระบบได้เลย');
                    return View::make('auth/login');
		} else {
                    Session::flash('danger','การยืนยันตัวสมบูรณ์ คุณสามารถเข้าสู่ระบบได้เลย');
                    return View::make('auth/login');
		}
	} catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
		echo 'User was not found.';
	} catch (Cartalyst\Sentry\Users\UserAlreadyActivatedException $e) {
		echo 'User is already activated.';
	}
    }
    
    
    public function login() {

        try {
                $credentials = Input::only('email','password');

                // Try to authenticate the user
                $user = Sentry::authenticate($credentials, false);
                Session::put('thisUser',$user);

                Session::forget('danger');
                Session::flash('success','ยินดีต้อนรับ');
                return View::make('home');
                
        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
                return Redirect::to('backoffice')->with('danger','username หรือ email ผิดพลาด');
        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
                return Redirect::to('backoffice')->with('danger','ไม่ได้ใส่รหัสผ่าน');
        } catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
                return Redirect::to('backoffice')->with('danger','รหัสผ่านผิด');
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
                return Redirect::to('backoffice')->with('danger','ไม่พบผู้ใช้งาน');
        } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
                return Redirect::to('backoffice')->with('danger','ไม่ได้ยืนยันตัวเอง');
          
            // The following is only required if throttle is enabled
        } catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e){
                return Redirect::to('backoffice')->with('danger','User is suspended.');
        } catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
                return Redirect::to('backoffice')->with('danger','User is banned.');
        }

    }
    
    
    public function logout() {
        Sentry::logout();
        Session::clear();
        Session::flash('danger','คุณได้ออกจากระบบแล้ว');
        return View::make('auth/login');
    }
    
     public function changepass() {
         if(Request::isMethod('post')){
             $user = Sentry::findUserById(Sentry::getUser()->id);
             if($user->checkPassword(Input::get('oldpass'))){
                 $user->password = Input::get('newpass');
                 $user->save();
                 Session::flash('success','การเปลี่ยนแปลงรหัสสำเร็จ');
                 return Redirect::to('home');
             }else{
                 Session::flash('danger','รหัสเก่าไม่ตรงกัน');
                 return Redirect::back();
             }
         }
         return View::make('auth/changepass');
     }
     
     public function lostpass() {
        if(Request::isMethod('post')){
            
            try {
                    // Find the user using the user email address
                    $user = Sentry::findUserByLogin(Input::get('email'));

                    // Get the password reset code
                    $resetCode = $user->getResetPasswordCode();

                    // Now you can send this code to your user via email for example.
                    Mail::send('auth/resetpass', array('code'=>$resetCode), function($message){ 
                        $message->to(Input::get('email'))->subject('กรุณาเปลี่ยนรหัสผ่าน');
                    });
                    Session::flash('success','รหัสผ่านถูกส่งไปยังอีเมลของท่านแล้ว');
                    return View::make('auth/login');
            } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
                    Session::flash('danger','ไม่มีอีเมลนี้');
                    return View::make('auth/lostpass');
            }
            
        }else{
            return View::make('auth/lostpass');
        }
     }

     
    public function newpass() {
        if(Request::isMethod('post')){
            
            try {
                
                $user = Sentry::getUserProvider()->findByResetPasswordCode(Input::get('code'));

                // Check if the reset password code is valid
                if ($user->checkResetPasswordCode(Input::get('code'))) {
                        // Attempt to reset the user password
                        if ($user->attemptResetPassword(Input::get('code'), Input::get('newpass'))) {
                                $user->password = Input::get('newpass');
                                $user->save();
                                Session::flash('success','การเปลี่ยนรหัสผ่านสำเร็จ');
                                return View::make('auth/login');
                        } else {
                                Session::flash('danger','การเปลี่ยนรหัสผ่านไม่สำเร็จ');
                                return View::make('auth/newpass');
                        }
                } else {
                        Session::flash('danger','รหัสที่ใช้ในการตรวจสอบไม่ถูกต้อง');
                        return View::make('auth/newpass');
                }
                
            } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
                    Session::flash('danger','ไม่มีชื่อผู้ใช้งานนี้');
                    return View::make('auth/newpass');
            }
            
        }
        return View::make('auth/newpass');
     }
     
     
     
     
}
