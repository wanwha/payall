<?php

/**
 * Description of Cate
 *
 * @author Yamada Yoseigi
 */

class Cate extends Eloquent {

	protected $table = 'de_set_cate';
        protected $primaryKey = 'de_set_cate_id';
        public $timestamps = false;
        
        protected $guarded = array('*');
        
        
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

        
}
