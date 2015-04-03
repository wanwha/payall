<?php
/**
 * Description of Order
 *
 * @author Yamada Yoseigi
 */


class Order extends Eloquent {
    
        protected $table = 'de_order';
        protected $primaryKey = 'de_order_id';
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
        
        public function scopeSelectForDatalist($query) {
            return $query->select(
                    'de_order.de_order_id',
                    'de_order.de_order_code',
                    'de_order.de_order_dealid',
                    'de_order.de_order_buyerid',
                    'de_order.de_order_issuedate',
                    'de_order.de_order_qty',
                    'de_order.de_order_totalpa',
                    'de_deal.de_deal_id',
                    'de_deal.de_deal_title',
                    'mb_mem.mb_mem_id',
                    'mb_mem.mb_mem_code',
                    'mb_mem.mb_mem_fnameth',
                    'mb_mem.mb_mem_lnameth'
                );
        }
        
        
}
