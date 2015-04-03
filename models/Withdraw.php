<?php


class Withdraw extends Eloquent {
	protected $table = 'cr_withdraw';
	protected $primaryKey = 'cr_withdraw_id';
	public $timestamps = false;

	 public function scopeSelectJoinIndex($query) {
            return $query->select(
                    'cr_withdraw.cr_withdraw_id',
            	'cr_withdraw.cr_withdraw_code',
                    'cr_withdraw.cr_withdraw_pa',
                    'cr_withdraw.cr_withdraw_issuedate',
                    'cr_withdraw.cr_withdraw_status',

            	'mb_mem.mb_mem_code',
            	'mb_mem.mb_mem_fnameth',
            	'mb_mem.mb_mem_lnameth',
                    'mb_mem.mb_mem_id',

                    'cr_set_status.cr_set_status_name'
                );
        }
	
}