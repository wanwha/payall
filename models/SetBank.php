<?php
/**
 * Description of Shop
 *
 * @author Yamada Yoseigi
 */



class SetBank extends Eloquent {
    protected $table = 'mb_set_bank';
    protected $primaryKey = 'mb_set_bank_id';
    public $timestamps = false;

    protected $fillable = array('mb_set_bank_id', 'mb_set_bank_name');
    protected $guarded = array(
        'mb_set_bank_id',
        'mb_set_bank_abbr',
        'mb_set_bank_remark',
        'mb_set_bank_status',
        'mb_set_bank_crebyid',
        'mb_set_bank_credate',
        'mb_set_bank_updatebyid',
        'mb_set_bank_updatedate'
        );
    
}