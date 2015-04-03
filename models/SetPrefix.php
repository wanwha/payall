<?php
/**
 * Description of Shop
 *
 * @author Yamada Yoseigi
 */



class SetPrefix extends Eloquent {
    protected $table = 'mb_set_prefix';
    protected $primaryKey = 'mb_set_prefix_id';
    public $timestamps = false;

    protected $fillable = array('mb_set_prefix_id', 'mb_set_prefix_name');
    protected $guarded = array(
        'mb_set_prefix_id',
        'mb_set_prefix_remark',
        'mb_set_prefix_status',
        'mb_set_prefix_crebyid',
        'mb_set_prefix_credate',
        'mb_set_prefix_updatebyid',
        'mb_set_prefix_updatedate'
        );
    
}