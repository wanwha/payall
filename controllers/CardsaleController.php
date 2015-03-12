<?php

/**
 * Description of CardController
 *
 * @author Yamada Yoseigi
 */

class CardsaleController extends BaseController {
    
    
    public function index(){

        $cardsale = Cardsale::orderBy('ca_sale_updatedate', 'DESC')
                    ->join('mb_mem', 'ca_sale.ca_sale_memcode', '=', 'mb_mem.mb_mem_code')
                    ->get();

        return View::make('cardsale.index')
                  ->with('cardsale',$cardsale);
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