<?php
/**
 * Description of District
 *
 * @author Yamada Yoseigi
 */

class District extends Eloquent {
    
	protected $table = 'sys_district';
        protected $primaryKey = 'sys_district_id';
        public $timestamps = false;
        
        protected $guarded = array('*');

}
