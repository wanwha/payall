<?php



class Cardsale extends Eloquent {

	 
	    protected $table = 'ca_sale';
        protected $primaryKey = 'ca_sale_id';
        public $timestamps = false;
        
        protected $guarded = array('*');


       
}
