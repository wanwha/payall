<?php

/**
 * Description of LotController
 *
 * @author Yamada Yoseigi
 */

class LotController extends BaseController {
            
    public function index(){

        if(!empty(Input::get('hidden_dealid'))){
            Session::put('deal_id', Input::get('hidden_dealid'));
        }
        
        if(Session::has('deal_id')){
            
            $deal_id = Session::get('deal_id');
            $lot = Lot::selectLotForDatalist()
                    ->where('de_lot_dealid','=',$deal_id)
                    ->orderBy('de_lot_credate', 'DESC')
                    ->get();

            $lot_count_bought = array();
            $lot_count_used = array();
            $lot_crebydate = array();
            $lot_crebyname = array();
                    
            foreach ( $lot as $key => $v ){

                $count_status2 = Stock::where('de_stock_lotid', '=', $v->de_lot_id)
                        ->where('de_stock_status', '=', 2)
                        ->count();
                $count_status3 = Stock::where('de_stock_lotid', '=', $v->de_lot_id)
                        ->where('de_stock_status', '=', 3)
                        ->count();

                $user = Sentry::findUserById($v->de_lot_crebyid);
                $user_name = $user->first_name.'&nbsp;&nbsp;'.$user->last_name;
    
                array_push($lot_count_bought, $count_status2);
                array_push($lot_count_used, $count_status3);
                array_push($lot_crebydate, GetFormat::format_DateTime($v->de_lot_credate));
                array_push($lot_crebyname, $user_name);
     
           }
                    
            return View::make('deal.lot.index')
                ->with('lot', $lot)
                ->with('lot_count_bought', $lot_count_bought)
                ->with('lot_count_used', $lot_count_used)
                ->with('lot_crebydate', $lot_crebydate)
                ->with('lot_crebyname', $lot_crebyname);
            
        }else{
            Redirect::to('deal');
        }

    }
    
    
    public function create(){

    }
    
    
    public function store(){
        $v = Lot::validate(Input::all());
        if ($v->passes()) {
            
            /** ########## Step 1 : Add Lot ########## **/
            $lot = new Lot;
            $lot->de_lot_dealid = Input::get('input_dealid');
            $lot->de_lot_qty = Input::get('input_qty');
            $lot->de_lot_instock = Input::get('input_qty');
            $lot->de_lot_bought = '0';
            $lot->de_lot_used = '0';
            $lot->de_lot_remark = Input::get('input_remark');
            $lot->de_lot_crebyid = Session::get('thisUser')->id;
            $lot->de_lot_credate = date('Y-m-d H:i:s');
            $lot->de_lot_updatebyid = Session::get('thisUser')->id;
            $lot->de_lot_updatedate = date('Y-m-d H:i:s');
            $lot->save();
            
            /** ########## Step 2 : Create Stock by Lot Order ########## **/
            
            // Get Last id Stock for gencode
            $stock_serial = Stock::select('de_stock_serial')->orderBy('de_stock_serial', 'DESC')->first();
            if(!empty($stock_serial)){
                $last_stock_serial = $stock_serial->de_stock_serial;
            }else{
                $last_stock_serial = 10000;
            }  
                    
            for($i=1; $i<=$lot->de_lot_qty; $i++) {
                $stock = new Stock;
                $stock->de_stock_serial = $last_stock_serial + $i;
                $stock->de_stock_status = '1';
                $stock->de_stock_dealid = Input::get('input_dealid');
                $stock->de_stock_lotid = $lot->de_lot_id;
                $stock->de_stock_buyerid = NULL;
                $stock->de_stock_boughtdate = NULL;
                $stock->de_stock_userid = NULL;
                $stock->de_stock_activatedate = NULL;
                $stock->de_stock_branchcode = NULL;
                $stock->save();
            }
            
            /** ########## Step 3 : Update Deal ########## **/
            $deal = Deal::find(Input::get('input_dealid'));
            $deal->de_deal_instock = Stock::where('de_stock_dealid', '=', Input::get('input_dealid'))->where('de_stock_status', '=', '1')->count();
            $deal->de_deal_updatebyid = Session::get('thisUser')->id;
            $deal->de_deal_updatedate = date('Y-m-d H:i:s');
            $deal->save();
            
            if($lot->save()){
                Session::flash('success', 'เพิ่มสต๊อกเรียบร้อยแล้ว');
                return Redirect::to('lot');
            }
        
        } else {
            return Redirect::to('lot')
                    ->withInput()
                    ->withErrors( $v->messages() );
        }
        return Redirect::to('lot')->with('error','เกิดข้อผิดพลาด');    
    }
    
    
    public function show(){

    }
    
    
    public function edit(){

    }
    
    
    public function update(){
        
    }
    
    
    public function destroy(){
        
    }

   
}