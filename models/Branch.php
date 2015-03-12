<?php
/**
 * Description of Branch
 *
 * @author Yamada Yoseigi
 */



class Branch extends Eloquent {
	protected $table = 'sh_branch';
	protected $primaryKey = 'sh_branch_id';
	public $timestamps = false;
        
         protected $guarded = array('*');
	
}