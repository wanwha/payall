<?php
/**
 * Description of Shop
 *
 * @author Yamada Yoseigi
 */



class Shop extends Eloquent {
    
        protected $table = 'sh_shop';
        protected $primaryKey = 'sh_shop_id';
        public $timestamps = false;

        protected $guarded = array('*');

        
}