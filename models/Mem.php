<?php
/**
 * Description of Member
 *
 * @author Yamada Yoseigi
 */

class Mem extends Eloquent {
    
	protected $table = 'mb_mem';
        protected $primaryKey = 'mb_mem_id';
        protected $softDelete = true;
        public $timestamps = false;
        
        protected $guarded = array('*');
        
        
        /*////////////////////// Validate Input Rules //////////////////////*/
        
        protected function validate($input) {
            $rules = array(
                'input_prefix'     => 'numeric',
                'input_provid'     => 'numeric',
                'input_subprovid'     => 'numeric',
                'input_distid'     => 'numeric',
                'input_postcode'     => 'numeric',
                'input_email' => 'email'
            );
           $message = array(
                'input_prefix.numeric' => 'Prefix เกิดข้อผิดพลาด',
                'input_provid.numeric' => 'Province เกิดข้อผิดพลาด',
                'input_subprovid.numeric' => 'Subprovince เกิดข้อผิดพลาด',
                'input_distid.numeric' => 'District เกิดข้อผิดพลาด',
                'input_postcode.numeric' => 'Postcode เกิดข้อผิดพลาด',
                'input_email' => 'รูปแบบอีเมลไม่ถูกต้อง'
            );  
            return Validator::make($input,$rules,$message);
        }

        
        /*////////////////////////////// Scope //////////////////////////////*/
        
        public function scopeSelectMemForDatalist($query) {
            return $query->select(
                    'mb_mem.mb_mem_id',
                    'mb_mem.mb_mem_code',
                    'mb_mem.mb_mem_prefix',
                    'mb_mem.mb_mem_fnameth', 
                    'mb_mem.mb_mem_lnameth',
                    'mb_mem.mb_mem_email',
                    'mb_mem.mb_mem_phone',
                    'mb_mem.mb_mem_status',
                    'mb_mem.mb_mem_type'
                );
        }
      
        
        public function scopeSelectVipForDatalist($query) {
            return $query->select(
                    'mb_mem.mb_mem_id',
                    'mb_mem.mb_mem_code',
                    'mb_mem.mb_mem_prefix',
                    'mb_mem.mb_mem_fnameth', 
                    'mb_mem.mb_mem_lnameth',
                    'mb_mem.mb_mem_email',
                    'mb_mem.mb_mem_sdate',
                    'mb_mem.mb_mem_type'
                );
        }
        
        /*///////////////////////// Table Relation /////////////////////////*/
        public function Refund() {
            return $this->hasMany('Refund');
        }
        
        
        
        
}
