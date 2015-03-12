<?php
/**
 * Description of Refund
 *
 * @author Yamada Yoseigi
 */


class Refund extends Eloquent {
    
        protected $table = 'mb_refund';
        protected $primaryKey = 'mb_refund_id';
        public $timestamps = false;
        
        protected $guarded = array('*');
        
        
        
        /*////////////////////// Validate Input Rules //////////////////////*/
        
        protected function validate($input) {
            $rules = array(
                'allow_Refunds_ID'     => 'required|numeric',
                'allow_Refunds_Status'   => 'required|numeric',
                'allow_Refunds_Date'      => 'required'
            );
           $message = array(
                'allow_Refunds_Status.required' => 'กรุณาเลือกสถานะการอนุมัติ',
                'allow_Refunds_Date.required' => 'กรุณาเลือกวันที่'
            );  
            return Validator::make($input,$rules,$message);
        }

      
        
        /*////////////////////////////// Scope //////////////////////////////*/
        
        public function scopeSelectJoinMem($query) {
            return $query->select(
                    'mb_refund.mb_refund_id', 
                    'mb_refund.mb_refund_memid',
                    'mb_refund.mb_refund_issuedate',
                    'mb_refund.mb_refund_status',
                    'mb_refund.mb_refund_remark',
                    'mb_refund.mb_refund_crebyid',
                    'mb_refund.mb_refund_credate',
                    'mb_refund.mb_refund_appbyid',
                    'mb_refund.mb_refund_appdate',
                    'mb_refund.mb_refund_cause',
                    'mb_mem.mb_mem_code', 
                    'mb_mem.mb_mem_prefix',
                    'mb_mem.mb_mem_fnameth', 
                    'mb_mem.mb_mem_lnameth'  
                );
        }

        
        /*///////////////////////// Table Relation /////////////////////////*/

        public function Mem() {
            return $this->belongsTo('Mem','mb_refund_memid');
        }
      
        
        
        
}
