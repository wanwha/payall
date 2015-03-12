<?php


class Cate extends Eloquent {

	protected $table = 'de_set_cate';
        protected $primaryKey = 'de_set_cate_id';
        public $timestamps = false;
        
        protected $guarded = array('*');
        
        public static function get_nameth_by_id($id){
            $cate = Cate::where('de_set_cate_id', '=', $id)->select('de_set_cate_nameth')->first();
            $cate_nameth = $cate->de_set_cate_nameth;
            return $cate_nameth;
        }

}
