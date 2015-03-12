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
        
        
    public static function get_nameth_by_code($code) {
        $shop = Shop::where('sh_shop_code', '=', $code)->select('sh_shop_name')->first();
        $shop_nameth = GetText::expld_text($shop->sh_shop_name, 'thai');
        return $shop_nameth;
    }
    
    public static function get_id_by_code($code) {
        $shop = Shop::where('sh_shop_code', '=', $code)->select('sh_shop_id')->first();
        $shop_id = $shop->sh_shop_id;
        return $shop_id;
    }
    
    public static function get_code_by_id($id) {
        $shop = Shop::where('sh_shop_id', '=', $id)->select('sh_shop_code')->first();
        $shop_code = $shop->sh_shop_code;
        return $shop_code;
    }
    
    public static function get_cateid_by_id($id) {
        $shop = Shop::where('sh_shop_id', '=', $id)->select('sh_shop_cateid')->first();
        $shop_cateid = $shop->sh_shop_cateid;
        return $shop_cateid;
    }
    
    public static function get_cateid_by_code($code) {
        $shop = Shop::where('sh_shop_code', '=', $code)->select('sh_shop_cateid')->first();
        $shop_cateid = $shop->sh_shop_cateid;
        return $shop_cateid;
    }
    
    public static function get_scateid_by_id($id) {
        $shop = Shop::where('sh_shop_id', '=', $id)->select('sh_shop_scateid')->first();
        $shop_scateid = $shop->sh_shop_scateid;
        return $shop_scateid;
    }
    
    
    public static function get_scateid_by_code($code) {
        $shop = Shop::where('sh_shop_code', '=', $code)->select('sh_shop_scateid')->first();
        $shop_scateid = $shop->sh_shop_scateid;
        return $shop_scateid;
    }
    
    
}