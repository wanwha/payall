<?php


class Subcate extends Eloquent {
	protected $table = 'de_set_scate';
	protected $primaryKey = 'de_set_scate_id';
	public $timestamps = false;

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