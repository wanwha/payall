<?php

/**
 * Description of CardController
 *
 * @author Yamada Yoseigi
 */

class BranchController extends BaseController {
    
    
    public function index(){



       $shopcode = Input::get('shopcode');

       $branch = Branch::orderBy('sh_branch_updatedate','DESC')
               ->where('sh_branch_shopcode','=',$shopcode)
               ->get();

       /* $count = Branch::orderBy('sh_branch_updatedate','DESC')
                ->count();   */     

    
        return View::make('branch.index')
                   ->with('branch',$branch)
                   ->with('shopcode',$shopcode);
                  // ->with('count',$count);

             


    }
    
    
    public function create(){
        

       $shopcode = Input::get('shopcode');

       return View::make('branch.create')
                ->with('shopcode',$shopcode);



    }
    
    
    public function store(){

         $shopcode = Input::get('shopcode');

         $rules = array(


            'sh_branch_name'   => 'required', 
            'sh_branch_email'  => 'email',
           
            
        );
        
        $varidator = Validator::make(Input::all(),$rules);

        if ($varidator->fails()) {

            return View::make('branch.create')
                 ->with('shopcode',$shopcode)
                 ->withErrors($varidator);
                 
        } else {

          


            // Update the cate details
            
            $branch = new Branch;
            $branch->sh_branch_shopcode = $shopcode;
            $branch->sh_branch_name = Input::get('sh_branch_name');
            $branch->sh_branch_tel  = Input::get('sh_branch_tel');
            $branch->sh_branch_email = Input::get('sh_branch_email');
            $branch->sh_branch_latitude  = Input::get('sh_branch_latitude');
            $branch->sh_branch_longitude  = Input::get('sh_branch_longitude');

            if(Input::hasFile('sh_branch_mappic')){


            $picshop = Input::file('sh_branch_mappic')->getClientOriginalName();
            $branch->sh_branch_mappic =  $picshop;
            Input::file('sh_branch_mappic')->move('assets/image',Input::file('sh_branch_mappic')->getClientOriginalName());


            }
          

            $countcode = Branch::where('sh_branch_shopcode','=',$shopcode);

            $user = $countcode->count(); 
                                    
            if($user == '0' ) {

                      $branch->sh_branch_code  =   $shopcode.str_pad("1", 3 , "0", STR_PAD_LEFT);
                  
                    }

            else{

                  $subsubcode = Branch::orderBy('sh_branch_credate','DESC')
                                          ->where('sh_branch_shopcode','=',$shopcode)
                                          ->first();
                                         

                  $a = $subsubcode->sh_branch_code;        

                  $substr = substr($a,5);

                  $substr2 = $substr+1; 

                  $substr_pad =  str_pad($substr2, 3 , "0", STR_PAD_LEFT);

                  $branch->sh_branch_code  =   $shopcode.$substr_pad;
                         
               }



            $branch->sh_branch_credate = date('Y-m-d H:i:s');
            $branch->sh_branch_updatedate = date('Y-m-d H:i:s');




            $branch->save();


            
            
                 

               Session::flash('success', 'เพิ่มข้อมูลสาขาเรียบร้อยแล้ว');

               $branch = Branch::orderBy('sh_branch_updatedate','DESC')
                      ->where('sh_branch_shopcode','=',$shopcode)
                      ->get();

              return View::make('branch.index')
                      ->with('shopcode',$shopcode)
                      ->with('branch',$branch);


  
        }
       
    }
    
    
    public function show($id){

         $branch = Branch::find($id);

         $shopcode = Input::get('shopcode');

         return View::make('branch.show')
                ->with('branch',$branch)
                ->with('shopcode',$shopcode);


    }
    
    
    public function edit($id){

        $branch = Branch::find($id);

        $shopcode = Input::get('shopcode');

         return View::make('branch.edit')
                ->with('branch',$branch)
                ->with('shopcode',$shopcode);

    }
    
    
    public function update($id){

        $shopcode = Input::get('shopcode');

        $rules = array(


            'sh_branch_name'   => 'required', 
            'sh_branch_email'  => 'email',
           
            
        );
        
        $varidator = Validator::make(Input::all(),$rules);

        if ($varidator->fails()) {

            return View::make('branch.edit')
                 ->with('shopcode',$shopcode)
                 ->withErrors($varidator);
                 
        } else {

          


            // Update the cate details
            
             $branch = Branch::find($id);
            $branch->sh_branch_name = Input::get('sh_branch_name');
            $branch->sh_branch_tel  = Input::get('sh_branch_tel');
            $branch->sh_branch_email = Input::get('sh_branch_email');
            $branch->sh_branch_latitude  = Input::get('sh_branch_latitude');
            $branch->sh_branch_longitude  = Input::get('sh_branch_longitude');
            if(Input::hasFile('sh_branch_mappic')){

            $picshop = Input::file('sh_branch_mappic')->getClientOriginalName();
            $branch->sh_branch_mappic =  $picshop;
            Input::file('sh_branch_mappic')->move('assets/image',Input::file('sh_branch_mappic')->getClientOriginalName());

            }
            $branch->sh_branch_updatedate = date('Y-m-d H:i:s');
            $branch->save();

                                               
            Session::flash('success', 'แก้ไขข้อมูลสาขาเรียบร้อยแล้ว');

            $branch = Branch::orderBy('sh_branch_updatedate','DESC')
                      ->where('sh_branch_shopcode','=',$shopcode)
                      ->get();

                return View::make('branch.index')
                           ->with('shopcode',$shopcode)
                           ->with('branch',$branch);

            
        }
        
    }
    
    
    public function destroy($id){

        $shopcode = Input::get('shopcode');

         if($id=='delall'){
            $arrData = Input::get('hidden_chkBoxDel');
            if(!empty($arrData)){
                foreach (explode(',', $arrData) as $id ){ $this->delete($id); }
                Session::flash('message', 'ลบข้อมูลสาขาร้อยแล้ว');

                $branch = Branch::orderBy('sh_branch_updatedate','DESC')
                      ->where('sh_branch_shopcode','=',$shopcode)
                      ->get();

                return View::make('branch.index')
                           ->with('shopcode',$shopcode)
                           ->with('branch',$branch);
            }else{
                Session::flash('danger', 'ไม่พบข้อมูลสาขาที่ต้องการลบ');

                $branch = Branch::orderBy('sh_branch_updatedate','DESC')
                      ->where('sh_branch_shopcode','=',$shopcode)
                      ->get();

                return View::make('branch.index')
                           ->with('shopcode',$shopcode)
                           ->with('branch',$branch);
            }   
        }else{ 

            $this->delete($id);

            Session::flash('message', 'ลบข้อมูลสาขาเรียบร้อยแล้ว');

            $branch = Branch::orderBy('sh_branch_updatedate','DESC')
                      ->where('sh_branch_shopcode','=',$shopcode)
                      ->get();

                return View::make('branch.index')
                           ->with('shopcode',$shopcode)
                           ->with('branch',$branch);
        }

       
    }
    
    
    private function delete($id) {
        $branch = Branch::find($id);
        $branch->delete();
    }
        
    

   
}