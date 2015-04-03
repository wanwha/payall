<?php

/**
 * Description of PAController
 *
 * @author Yamada Yoseigi
 */

class PAController extends BaseController {
    
    
    public function index(){
        $pa = Withdraw::orderBy('cr_withdraw_issuedate', 'ASC')
                ->join('mb_mem', 'cr_withdraw.cr_withdraw_memid', '=', 'mb_mem.mb_mem_id')
                ->join('cr_set_status', 'cr_withdraw.cr_withdraw_status', '=', 'cr_set_status.cr_set_status_id')
                ->selectJoinIndex()
                ->get();
        return View::make('pa.index')
                ->with('pa',$pa)
                ->with('count',count($pa));
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
    
    
    public function destroy($id){
        if($id=='delall'){
                    $arrData = Input::get('hidden_chkBoxDel');
                    if(!empty($arrData)){
                        foreach (explode(',', $arrData) as $id ){ $this->delete($id); }
                        Session::flash('message', 'ลบข้อมูลการถอนเครดิตเรียบร้อยแล้ว');
                        return Redirect::to('pa');
                    }else{
                        Session::flash('message', 'ไม่พบข้อมูลที่ต้องการลบ');
                        return Redirect::to('pa');
                    }   
        }

    }

    
    private function delete ($id) {
            $pa = Withdraw::find($id);
            $pa->delete();
    }

    
    public function withdrawpa() {
        
        $rules = array(
            'cr_withdraw_cause' => 'alphanum'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {
            
            $chackallow = Input::get('allow');

            if($chackallow==1) {
                // Update Refund Confirm
                $RefID = Input::get('allow_Refunds_ID');
                $allow = Withdraw::find($RefID);
                $allow->cr_withdraw_approvetype = Input::get('allow');
            
                if($allow->save()){
                    Session::flash('success', 'บันทึกการอนุมัติ รหัสรายการที่ '.$RefID.' เรียบร้อยแล้ว');
                    return Redirect::to('pa');
                }
            } if($chackallow!=1) {
                // Update Refund Confirm
                $RefID = Input::get('allow_Refunds_ID');
                $notallow = Withdraw::find($RefID);
                $notallow->cr_withdraw_approvetype = Input::get('notallow');
                $notallow->cr_withdraw_cause = Input::get('cr_withdraw_cause');
            
                if($notallow->save()){
                    Session::flash('success', 'บันทึกการไม่อนุมัติ รหัสรายการที่ '.$RefID.' เรียบร้อยแล้ว');
                    return Redirect::to('pa');
                }
            }
            
        } else {
            return Redirect::back()
                    ->withInput()
                    ->withErrors( $validator->messages() );
        }
        return Redirect::back()->with('error','เกิดข้อผิดพลาด');
    }

   
}