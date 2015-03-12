<?php

class Card extends Eloquent {

    protected $table = 'ca_card';
    protected $primaryKey = 'ca_card_id';
    public $timestamps = false;

    
    /*////////////////////////////// Scope //////////////////////////////*/
    public function scopeSelectJoinSta($query) {
        return $query->select(
                'ca_set_status.ca_set_status_name', 
                'ca_card.ca_card_serial', 
                'ca_card.ca_card_code', 
                'ca_card.ca_card_credate', 
                'ca_card.ca_card_saledate', 
                'ca_card.ca_card_activedate'
        );
    }

    
}
    
?>