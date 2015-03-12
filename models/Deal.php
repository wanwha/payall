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
   

        
        /*////////////////////////////// Scope //////////////////////////////*/
        
        public function scopeSelectDealForDatalist($query) {
            return $query->select(
                    'de_deal_id', 
                    'de_deal_title', 
                    'de_deal_typeid', 
                    'de_deal_shopcode', 
                    'de_deal_pa', 
                    'de_deal_total', 
                    'de_deal_sdate', 
                    'de_deal_edate'
                );
        }
        

        
        
        /*///////////////////////// Table Relation /////////////////////////*/


      
        
        
        
}
