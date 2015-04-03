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
    Route::resource("pa", ('PAController'));
    Route::post('withdrawpa', array(
        'uses' => 'PAController@withdrawpa'
    ));
    Route::resource("card", ('CardController'));
    Route::resource("cardsale", ('CardsaleController'));
    Route::resource("deal", ('DealController'));
    Route::post("deal/ajax_branch", ('DealController@getBranchOptions'));
    Route::post("deal/ajax_cate", ('DealController@getFormCate'));
    Route::post('deal/lot', array(
        'uses' => 'LotController@index'
    ));
    Route::resource("lot", ('LotController'));
    Route::resource("shop", ('ShopController'));
    Route::post("shop/selectsubprovid", ('ShopController@getFormSubprovid'));
    Route::post("shop/selectdistrict", ('ShopController@getFormDistrict'));
    Route::post("shop/ajax_subcate", ('ShopController@getFormSubcate'));
    Route::resource("upgrade", ('UpgradeController'));
    Route::resource("upgrade", ('UpgradeController'));
    Route::resource("permission", ('PermissionController'));
    Route::resource("cate", ('CateController'));
    Route::resource("subcate", ('SubcateController'));
    Route::resource("report_deal/bought", ('ReportDealBoughtControllerController'));
    Route::post("report_deal/bought/ajax_shop", ('ReportDealBoughtController@getSelectShop'));
    Route::post("report_deal/bought/ajax_deal", ('ReportDealBoughtController@getSelectDeal'));
    Route::post("report_deal/bought/ajax_select", ('ReportDealBoughtController@getDatalist'));
    Route::post("report_deal/bought/ajax_modal_table", ('ReportDealBoughtController@getModalTable'));
    
    
    Route::post('branch', array(
        'as' => 'branch.index',
        'uses' => 'BranchController@index'
    ));
    Route::post('branch/create', array(
        'uses' => 'BranchController@create'
    ));
    Route::post('branch/store', array(
        'uses' => 'BranchController@store'
    ));
    Route::post('branch/{id}/edit', array(
        'uses' => 'BranchController@edit'
    ));
    Route::put('branch/{id}', array(
        'as' => 'branch.update',
        'uses' => 'BranchController@update'
    ));
    Route::post('branch/{id}', array(
        'as' => 'branch.show',
        'uses' => 'BranchController@show'
    ));
    Route::delete('branch/{id}', array(
        'as' => 'branch.destroy',
        'uses' => 'BranchController@destroy'
    ));
    
});
