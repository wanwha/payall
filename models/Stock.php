<?php
/**
 * Description of Stock
 *
 * @author Yamada Yoseigi
 */


class Stock extends Eloquent {
    
        protected $table = 'de_stock';
        protected $primaryKey = 'de_stock_id';
        public $timestamps = false;
        
        
        
        /*////////////////////// Validate Input Rules //////////////////////*/
        
        protected function validate($input) {
            $rules = array(
                'input_prefix'     => 'numeric',
                'input_provid'     => 'numeric',
                'input_subprovid'     => 'numeric',
            );
           $message = array(
                'input_prefix.numeric' => 'Prefix เกิดข้อผิดพลาด',
                'input_provid.numeric' => 'Province เกิดข้อผิดพลาด',
            );  
            return Validator::make($input,$rules,$message);
        } 

        
}
