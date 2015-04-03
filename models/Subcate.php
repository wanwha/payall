<?php

/**
 * Description of Subcate
 *
 * @author Yamada Yoseigi
 */

class Subcate extends Eloquent {
    
	protected $table = 'de_set_scate';
	protected $primaryKey = 'de_set_scate_id';
	public $timestamps = false;

        
        /*////////////////////// Validate Input Rules //////////////////////*/
        
        protected function validate($input) {
            $rules = array(
                'de_set_cate_nameth'     => 'required',
                'de_set_cate_nameen'     => 'required',
                'de_set_cate_status'     => 'required',
            );
           $message = array(
                'de_set_cate_nameth.required' => 'กรุณากรอกชื่อหมวดหมู่ภาษาไทย',
                'de_set_cate_nameen.required' => 'กรุณากรอกชื่อหมวดหมู่ภาษาอังกฤษ',
                'de_set_cate_status.required' => 'กรุณาเลือกสถานะ',
            );  
            return Validator::make($input,$rules,$message);
        }
        
        
        /*////////////////////////////// Scope //////////////////////////////*/
        
	public function scopeSelectJoinCate($query) {
            return $query->select(
                    'de_set_cate.de_set_cate_nameth',
                    'de_set_scate.de_set_scate_nameth',
                    'de_set_scate.de_set_scate_nameen',
                    'de_set_scate.de_set_scate_remark',
                    'de_set_scate.de_set_scate_status'
                );
        }
        
	
}