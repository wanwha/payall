<?php
/**
 * Description of Shop
 *
 * @author Yamada Yoseigi
 */



class SetGender extends Eloquent {
    protected $table = 'mb_set_gender';
    protected $primaryKey = 'mb_set_gender_id';
    public $timestamps = false;

    protected $fillable = array('mb_set_gender_id', 'mb_set_gender_name');
    protected $guarded = array(
        'mb_set_gender_id',
        'mb_set_gender_abbr',
        'mb_set_gender_remark',
        'mb_set_gender_status',
        'mb_set_gender_crebyid',
        'mb_set_gender_credate',
        'mb_set_gender_updatebyid',
        'mb_set_gender_updatedate'
        );
    
}