<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('test', function(){
    return View::make('test');
});
    

Route::get('/', function(){
	return View::make('hello');
});


//Auth
Route::get('backoffice', array(
        'as'=>'signin',
        'uses'=>'AuthController@signin'
    ));
Route::post('login', 'AuthController@login'); 
Route::post('register', 'AuthController@register');
Route::get('activate/{code}', 'AuthController@activate');
Route::any('lostpass', 'AuthController@lostpass');
Route::get('newpass/{code}', 'AuthController@newpass');
Route::post('newpass', 'AuthController@newpass');
 

Route::group(array( 'before'=>'sentry' ),function(){
    
    Route::get('home', function(){
        return View::make('home')->with(array('menuActive'=>'home','subMenuActive'=>''));
    });
    
    Route::get('logout', 'AuthController@logout');
    Route::get('profile', function() {
        return View::make('auth/profile')
                ->with(array(
                    'menuActive'=>'home',
                    'subMenuActive'=>''
                ));
    });   
    Route::any('changepass', 'AuthController@changepass');
    
    Route::resource("user", ('UserController'));
    Route::resource("refunds", ('RefundsController'));
    Route::post('allowrefund', array(
        'before' => 'csrf', 
        'uses' => 'RefundsController@allowrefunds'
    ));
    Route::resource("member", ('MemberController'));
    Route::resource("vip", ('VipController'));
    Route::resource("businesscenter", ('BusinessCenterController'));
    Route::resource("calendar", ('CalendarController'));
    Route::resource("card", ('CardController'));
    Route::resource("cardsale", ('CardsaleController'));
    Route::resource("deal", ('DealController'));
    Route::post("deal/ajax_branch", ('DealController@getBranchOptions'));
    Route::post("deal/ajax_cate", ('DealController@getFormCate'));
    Route::resource("pa", ('PAController'));
    Route::resource("shop", ('ShopController'));
    Route::resource("upgrade", ('UpgradeController'));
    Route::resource("permission", ('PermissionController'));
    Route::resource("cate", ('CateController'));
    Route::resource("subcate", ('SubcateController'));
    
    
});
