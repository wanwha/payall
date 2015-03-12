<?php
/**
 * Description of Subprovince
 *
 * @author Yamada Yoseigi
 */

class Subprovince extends Eloquent {
    
	protected $table = 'sys_subprovince';
        protected $primaryKey = 'sys_subprovince_id';
        public $timestamps = false;
        
        protected $guarded = array('*');

}
