<?php


class Cate extends Eloquent {

	 
	protected $table = 'de_set_cate';
        protected $primaryKey = 'de_set_cate_id';
        public $timestamps = false;
        
        protected $guarded = array('*');

}
