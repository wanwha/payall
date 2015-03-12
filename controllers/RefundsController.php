<?php

/**
 * Description of RefundsController
 *
 * @author Yamada Yoseigi
 */



class RefundsController extends BaseController {
    
    public function index(){
        $result = Refund::orderBy('mb_refund_id','ASC')
                ->join('mb_mem', 'mb_refund.mb_refund_memid', '=', 'mb_mem.mb_mem_id')
                ->selectJoinMem()
                ->where('mb_mem.mb_mem_type', '=', '2')
                ->get();
        return View::make('refunds.index')
                ->with('result',$result); 
    }
    
    
    public function create(){
        return View::make('refunds.create');
    }
    
    
    public function store(){
       
    }
    
    
    public function show($id){

        $result = Refund::orderBy('mb_refund_id','DESC')
                ->join('mb_mem', 'mb_refund.mb_refund_memid', '=', 'mb_mem.mb_mem_id')
                ->selectJoinMem()
                ->where('mb_refund.mb_refund_id', '=', $id)
                ->first();
        return View::make('refunds.show')
                ->with('refund',$result);
    }
    
    
    public function edit($id){
        return View::make('refunds.edit')
                ->with(array('id'=>$id,
                        'menuActive'=>'member',
                        'subMenuActive'=>'member_refund'
                    ));
    }
    
    
    public function update(){
        
    }
    
    
    public function destroy(){
        
    }
    
    
    public function allowrefunds() {
        
        $v = Refund::validate(Input::all());
        if ($v->passes()) {
            
            // Update Refund Confirm
            $RefID = Input::get('allow_Refunds_ID');
            $refund = Refund::find($RefID);
            $refund->mb_refund_status = Input::get('allow_Refunds_Status');
            $refund->mb_refund_appdate = EditFormat::format_DateTime2( Input::get('allow_Refunds_Date') );
            $refund->mb_refund_remark = Input::get('allow_Refunds_Remark');
            
            if($refund->save()){
                Session::flash('success', 'บันทึกการอนุมัติ รหัสรายการที่ '.$RefID.' เรียบร้อยแล้ว');
                return Redirect::to('refunds');
            }
            
        } else {
            return Redirect::back()
                    ->withInput()
                    ->withErrors( $v->messages() );
        }
        return Redirect::back()->with('error','เกิดข้อผิดพลาด');
    }


}
