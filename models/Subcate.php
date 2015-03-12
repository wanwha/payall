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
        
        public static function get_nameth_by_id($id){
            $scate = Subcate::where('de_set_scate_id', '=', $id)->select('de_set_scate_nameth')->first();
            $scate_nameth = $scate->de_set_scate_nameth;
            return $scate_nameth;
        }
	
}