<?php
/**
 * Description of Lot
 *
 * @author Yamada Yoseigi
 */


class Lot extends Eloquent {
    
        protected $table = 'de_lot';
        protected $primaryKey = 'de_lot_id';
        public $timestamps = false;
        
        
        
        /*////////////////////// Validate Input Rules //////////////////////*/
        
        protected function validate($input) {
            $rules = array(
                'input_dealid'     => 'required|numeric',
                'input_qty'     => 'required|numeric',
            );
           $message = array(
                'input_dealid.required'     => 'เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง',
                'input_dealid.numeric'     => 'เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง',
                'input_qty.required' => 'กรุณากรอกจำนวน',
                'input_qty.numeric' => 'กรุณากรอกจำนวนเป็นตัวเลข',
            );  
            return Validator::make($input,$rules,$message);
        }
   

        
        /*////////////////////////////// Scope //////////////////////////////*/
        
        public function scopeSelectLotForDatalist($query) {
            return $query->select(
                    'de_lot_id',
                    'de_lot_qty',
                    'de_lot_bought',
                    'de_lot_used',
                    'de_lot_crebyid',
                    'de_lot_credate',
                    'de_lot_remark'
                );
        }

        
}
