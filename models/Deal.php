<?php
/**
 * Description of Deal
 *
 * @author Yamada Yoseigi
 */


class Deal extends Eloquent {
    
        protected $table = 'de_deal';
        protected $primaryKey = 'de_deal_id';
        public $timestamps = false;
        
        
        
        /*////////////////////// Validate Input Rules //////////////////////*/
        
        protected function validate($input) {
            $rules = array(
                'date-range-picker' => 'required',
                'input_price'       => 'numeric',
                'input_shopdis'     => 'numeric',
                'input_cusdis'      => 'numeric',
                'input_pa'          => 'numeric',
                'input_point'       => 'numeric',
            );
           $message = array(
                'date-range-picker.required' => 'กรุณาเลือกระยะเวลา',
                'input_price.numeric' => 'กรุณากรอก ราคาเต็ม เป็นตัวเลข',
                'input_shopdis.numeric' => 'กรุณากรอก ร้านค้าลด เป็นตัวเลข',
                'input_cusdis.numeric' => 'กรุณากรอก ส่วนลดลูกค้า เป็นตัวเลข',
                'input_pa.numeric' => 'กรุณากรอก PA เป็นตัวเลข',
                'input_point.numeric' => 'กรุณากรอก Point ทีได้ เป็นตัวเลข',
            );  
            return Validator::make($input,$rules,$message);
        }
   

        
        /*////////////////////////////// Scope //////////////////////////////*/
        
        public function scopeSelectDealForDatalist($query) {
            return $query->select(
                    'de_deal_id',
                    'de_deal_title',
                    'de_deal_typeid',
                    'de_deal_shopcode',
                    'de_deal_instock',
                    'de_deal_used',
                    'de_deal_bought',
                    'de_deal_pa',
                    'de_deal_sdate',
                    'de_deal_edate'
                );
        }
        
        
}
