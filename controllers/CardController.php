<?php

/**
 * Description of CardController
 *
 * @author Yamada Yoseigi
 */

class CardController extends BaseController {
    
    
    public function index(){
        $card = Card::orderBy('ca_card_credate', 'ASC')
                ->join('ca_set_status', 'ca_card.ca_card_status', '=', 'ca_set_status.ca_set_status_id')
                ->selectJoinSta()
                ->get();

        return View::make('card.index')
                ->with('card', $card);
    }
    
    
    public function create(){

    }
    
    
    public function store(){
       
    }
    
    
    public function show(){

    }
    
    
    public function edit(){

    }
    
    
    public function update(){
        
    }
    
    
    public function destroy(){
        
    }

   
}