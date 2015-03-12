<?php

class BusinessCenter extends Eloquent {

    protected $table = 'bu_center';
    protected $primaryKey = 'bu_center_id';
    public $timestamps = false;

    
    /*////////////////////////////// Scope //////////////////////////////*/
    public function scopeSelectJoinIndex($query) {
        return $query->select(
                'sys_province.sys_province_name', 
                'bu_center.bu_center_code', 
                'bu_center.bu_center_name', 
                'bu_center.bu_center_updatedate', 
                'bu_center.bu_center_status', 
                'bu_center.bu_center_id'
        );
    }
    
    public function scopeSelectJoinShow($query) {
        return $query->select(
                'sys_district.sys_district_name', 
                'sys_province.sys_province_name', 
                'sys_subprovince.sys_subprovince_name', 
                'bu_center.bu_center_code', 
                'bu_center.bu_center_name', 
                'bu_center.bu_center_detail', 
                'bu_center.bu_center_status', 
                'bu_center.bu_center_addr', 
                'bu_center.bu_center_postcode', 
                'bu_center.bu_center_tel', 
                'bu_center.bu_center_fax', 
                'bu_center.bu_center_email', 
                'bu_center.bu_center_latitude', 
                'bu_center.bu_center_longitude', 
                'bu_center.bu_center_website', 
                'bu_center.bu_center_ctrname', 
                'bu_center.bu_center_ctrphone', 
                'bu_center.bu_center_ctremail', 
                'bu_center.bu_center_ctrline', 
                'bu_center.bu_center_pic', 
                'bu_center.bu_center_mappic'
        );
    }

}
