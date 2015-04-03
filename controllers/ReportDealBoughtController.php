<?php

/**
 * Description of ReportDealBoughtController
 *
 * @author Yamada Yoseigi
 */

class ReportDealBoughtController extends BaseController {
    
    
    public function index(){
        $order = Order::selectForDatalist()
            ->join('de_deal', 'de_order.de_order_dealid', '=', 'de_deal.de_deal_id')
            ->join('mb_mem', 'de_order.de_order_buyerid', '=', 'mb_mem.mb_mem_id')
            ->orderBy('de_order_issuedate','DESC')
            ->get();

        $deal_title = array();
                
        foreach( $order as $key => $v ){
            array_push($deal_title, GetText::expld_text($v->de_deal_title, 'TH') );
        }
        
        $shop = Shop::select('sh_shop_id', 'sh_shop_name')->get();
        $list_shop_id = array();
        $list_shop_name = array();
        foreach( $shop as $key => $shop ){
            array_push($list_shop_id, $shop->sh_shop_id);
            array_push($list_shop_name, $shop->sh_shop_name);
        }
        
        $deal = Deal::select('de_deal_id', 'de_deal_title')->get();
        $list_deal_id = array();
        $list_deal_title = array();
        foreach( $deal as $v ){
            array_push($list_deal_id, $v->de_deal_id);
            array_push($list_deal_title, $v->de_deal_title);
        }
        
        $list_shop = GetText::expld_field($list_shop_id, $list_shop_name, 'TH');
        $list_deal = GetText::expld_field($list_deal_id, $list_deal_title, 'TH');
        
        return View::make('report_deal.index')
            ->with('order', $order)
            ->with('deal_title', $deal_title)
            ->with('list_shop', [''=>'กรุณาเลือกร้านค้า']+$list_shop)
            ->with('focus_shop', NULL)
            ->with('list_deal', [''=>'กรุณาเลือกดีล/คูปอง']+$list_deal)
            ->with('focus_deal', NULL);
    }
    
    
    public function create(){

    }
    
    
    public function store(){
       
    }
    
    
    public function show(){

    }
    
    
    public function edit(){

    }
    
    
    public function update(){
        
    }
    
    
    public function destroy(){
        
    }
    

    public function getSelectShop() {
        if(Request::ajax()){

            $input_shopid = Input::get('shopid');
            
            
            //----- Change input_deal ------
            if(!empty($input_shopid)){
                
                // Find List_Deal (match Shop)
                $shop_code = Shop::select('sh_shop_code')
                    ->where('sh_shop_id', '=', $input_shopid)
                    ->first()->sh_shop_code;

                $deal = Deal::select('de_deal_id', 'de_deal_title')
                    ->where('de_deal_shopcode', '=', $shop_code)
                    ->get();

            }else{
                $deal = Deal::select('de_deal_id', 'de_deal_title')->get();
            }

            
            $list_deal_id = array();
            $list_deal_title = array();

            foreach( $deal as $v ){
                array_push($list_deal_id, $v->de_deal_id);
                array_push($list_deal_title, $v->de_deal_title);
            }
                
            $list_deal = GetText::expld_field($list_deal_id, $list_deal_title, 'TH');
            
            
            //----- Retune View -----
            return View::make('report_deal.ajax.input_deal')
                ->with('list_deal', [''=>'กรุณาเลือกดีล/คูปอง']+$list_deal)
                ->with('focus_deal', 0)
                ->render();
            
        }
    }
    
    
    public function getSelectDeal() {

        if(Request::ajax()){

            $input_dealid = Input::get('dealid');

            //----- Find List_Shop All -----
            $shop = Shop::select('sh_shop_id', 'sh_shop_name')->get();
            $list_shop_id = array();
            $list_shop_name = array();
            foreach( $shop as $v ){
                array_push($list_shop_id, $v->sh_shop_id);
                array_push($list_shop_name, $v->sh_shop_name);
            }

            $list_shop = GetText::expld_field($list_shop_id, $list_shop_name, 'TH');

                        
            //----- Focus_Shop -----
            if(!empty($input_dealid)){
                
                //Find de_deal_shopcode
                $deal_shopcode = Deal::select('de_deal_shopcode')
                    ->where('de_deal_id', '=', $input_dealid)
                    ->first()->de_deal_shopcode;

                // Find shop_id
                $shop_id = Shop::select('sh_shop_id')
                    ->join('de_deal', 'sh_shop.sh_shop_code','=', 'de_deal.de_deal_shopcode')
                    ->where('sh_shop_code', '=', $deal_shopcode)
                    ->first()->sh_shop_id;
                
            }else{
                $shop_id = '';          
            }
            
            
            //----- Retune View -----
            return View::make('report_deal.ajax.input_shop')
                ->with('list_shop', [''=>'กรุณาเลือกร้านค้า']+$list_shop)
                ->with('focus_shop', $shop_id)
                ->render();

        }
    }
    
    
    public function getDatalist() {
        if(Request::ajax()){
            
            $input_shopid = Input::get('shopid');
            $input_dealid = Input::get('dealid');
            
            if( !empty($input_shopid) && !empty($input_dealid) ) {
                
                $shop_code = Shop::select('sh_shop_code')
                    ->where('sh_shop_id', '=', $input_shopid)
                    ->first()->sh_shop_code;

                $order = Order::selectForDatalist()
                    ->join('de_deal', 'de_order.de_order_dealid', '=', 'de_deal.de_deal_id')
                    ->join('mb_mem', 'de_order.de_order_buyerid', '=', 'mb_mem.mb_mem_id')
                    ->where('de_deal.de_deal_shopcode', '=', $shop_code)
                    ->where('de_deal.de_deal_id', '=', $input_dealid)
                    ->orderBy('de_order_issuedate','DESC')
                    ->get();
                
            }else if( !empty($input_shopid) && empty($input_dealid) ) {
                
                $shop_code = Shop::select('sh_shop_code')
                    ->where('sh_shop_id', '=', $input_shopid)
                    ->first()->sh_shop_code;
                
                $order = Order::selectForDatalist()
                    ->join('de_deal', 'de_order.de_order_dealid', '=', 'de_deal.de_deal_id')
                    ->join('mb_mem', 'de_order.de_order_buyerid', '=', 'mb_mem.mb_mem_id')
                    ->where('de_deal.de_deal_shopcode', '=', $shop_code)
                    ->orderBy('de_order_issuedate','DESC')
                    ->get();
            
            }else if( empty($input_shopid) && !empty($input_dealid) ){
                
                $order = Order::selectForDatalist()
                    ->join('de_deal', 'de_order.de_order_dealid', '=', 'de_deal.de_deal_id')
                    ->join('mb_mem', 'de_order.de_order_buyerid', '=', 'mb_mem.mb_mem_id')
                    ->where('de_deal.de_deal_id', '=', $input_dealid)
                    ->orderBy('de_order_issuedate','DESC')
                    ->get();
                
            }else{
                
                $order = Order::selectForDatalist()
                    ->join('de_deal', 'de_order.de_order_dealid', '=', 'de_deal.de_deal_id')
                    ->join('mb_mem', 'de_order.de_order_buyerid', '=', 'mb_mem.mb_mem_id')
                    ->orderBy('de_order_issuedate','DESC')
                    ->get();
                
            }
            
            $deal_title = array();

            foreach( $order as $v ){
                array_push($deal_title, GetText::expld_text($v->de_deal_title, 'TH') );
            }

            return View::make('report_deal.ajax.datalist')
                ->with('order', $order)
                ->with('deal_title', $deal_title)
                ->render();
        }
    }

    
    public function getModalTable() {
        
        $order_id = Input::get('orderid');
        
        $order_detail = OrderDetail::selectForDatalistReportDeal()
                ->where('de_order_detail_orderid', '=', $order_id)
                ->get();
        
        return View::make('report_deal.ajax.modal_table')
            ->with('order_detail', $order_detail)
            ->render();
    }
    
    
}