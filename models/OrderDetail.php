<?php
/**
 * Description of OrderDetail
 *
 * @author Yamada Yoseigi
 */


class OrderDetail extends Eloquent {
    
        protected $table = 'de_order_detail';
        protected $primaryKey = 'de_order_detail_id';
        public $timestamps = false;
        
        
        
        /*////////////////////// Validate Input Rules //////////////////////*/
        
        protected function validate($input) {
            $rules = array(

            );
           $message = array(

            );  
            return Validator::make($input,$rules,$message);
        }
   

        
        /*////////////////////////////// Scope //////////////////////////////*/
        
        public function scopeSelectForDatalistReportDeal($query) {
            return $query->select(
                    'de_order_detail_serial',
                    'de_order_detail_fullpa',
                    'de_order_detail_company',
                    'de_order_detail_customer',
                    'de_order_detail_discount',
                    'de_order_detail_netpa',
                    'de_order_detail_status'
                );
        }
        
        
}
