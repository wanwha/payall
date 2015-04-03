<?php

/**
 * 
 * 
 *
 * @author Yamada Yoseigi
 */


class GetList {
    
    public static $list_lang = array(
        '0' => 'เลือกภาษา',
        '1' => 'ไทย',
        '2' => 'อังกฤษ'
    );

    // Mem    
    public static $list_nation = array(
        '0' => '',
        '1' => 'ไทย',
        '2' => 'ต่างชาติ'
    );
    
    public static $list_prefix = array(
        '0' => '',
        '1' => 'นาย',
        '2' => 'นาง',
        '3' => 'นางสาว'
    );
    
    public static $list_type = array(
        '0' => '',
        '1' => 'สมาชิกทั่วไป',
        '2' => 'วีไอพี'
    );

    public static $list_locate = array(
        '0' => '',
        '1' => 'บ้าน',
        '2' => 'ที่ทำงาน'
    );
    
    public static $list_statususers = array(
        'Enable' => 'ใช้งาน',
        'Disable' => 'ไม่ใช้งาน'
    );
    
    // Shop
    public static $list_Shoptype = array(
        '1' => 'ดีล/คูปอง',
        '2' => 'เพลแครช',
        '3' => 'Pay All',
        '1,2,3' => 'ดีล/คูปอง,เพลแครช,Pay All',
        '1,2'     => 'ดีล/คูปอง,เพลแครช',
        '1,3'     => 'ดีล/คูปอง,Pay All',
        '2,3'     => 'เพลแครช,Pay All'
    );
    
    // Deal
    public static $list_dealtype = array(
        '1' => 'เงินสด',
        '2' => 'ส่วนลด',
        '3' => 'บริการ'
    );
    
    // Refund
    public static $list_remark = array(
        '0' => 'โปรดเลือกเหตุผล',
        '1' => 'ไม่มีเวลาทำ',
        '2' => 'ไม่พึงพอใจการให้บริการ',
        '3' => 'ไม่มีเงิน'
    );

    public static $list_status = array(
        '0' => '',
        '1' => 'รออนุมัติ',
        '2' => 'อนุมัติแล้ว',
        '3' => 'ไม่อนุมัติ'
    );
    
    // Report Deal
    public static $list_statusOrder = array(
        '1' => 'ใช้แล้ว',
        '2' => 'ยังไม่ใช้'
    );
    
}