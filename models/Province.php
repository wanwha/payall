<?php
/**
 * Description of Province
 *
 * @author Yamada Yoseigi
 */

class Province extends Eloquent {
    
	protected $table = 'sys_province';
        protected $primaryKey = 'sys_province_id';
        public $timestamps = false;
        
        protected $guarded = array('*');

}
