<?php
/**
 * Description of DealController
 *
 * @author Yamada Yoseigi
 */

class DealController extends BaseController {
    
    
    public function index(){            
        $deal = Deal::selectDealForDatalist()
                ->orderBy('de_deal_id','DESC')
                ->get();
        
        
        $count = count($deal);
        return View::make('deal.index')
                ->with('deal', $deal)
                ->with('count', $count); 
    }
    
    
    public function create(){
        return View::make('deal.create')
                ->with('list_dealtype', GetList::$list_dealtype)
                ->with('list_shop', GetText::expld_field( Shop::lists('sh_shop_id') ,Shop::lists('sh_shop_name'), 'thai' ) )
                ->with('list_branch', GetText::expld_field( Branch::lists('sh_branch_id'), Branch::lists('sh_branch_name'), 'thai' ))
                ->with('catenameth', null )
                ->with('scatenameth', null );
    }
    

    public function store(){
        
        $v = Deal::validate(Input::all());
        if ($v->passes()) {
            
            //Get Shop_code
            $shop_code = Shop::get_code_by_id( Input::get('input_shopid') );
                    
            // Get Title
            $titleth = GetText::text_empty( Input::get('input_titleth') );
            $titleen = GetText::text_empty( Input::get('input_titleen') ); 
            $title = $titleth.'|x|'.$titleen;
            
            // Get Detail
            $detailth = GetText::text_empty( Input::get('input_detailth') );
            $detailen = GetText::text_empty( Input::get('input_detailen') );
            $detail = $detailth.'|x|'.$detailen;
            
            // Get sdate & edate
            $sdate_edate = explode(' - ', Input::get('date-range-picker') );
            $sdate = GetFormat::format_DateTime3($sdate_edate[0]);
            $edate = GetFormat::format_DateTime3($sdate_edate[1]);
            
            // Get Branch_Code
            $arr_branch_id = Input::get('input_branchid');
            $count_arr_branch_id  = count($arr_branch_id);
            for($i=0; $i<$count_arr_branch_id; $i++){
                $branch_code = Branch::where('sh_branch_id', '=', $arr_branch_id[$i])->select('sh_branch_code')->first(); 
                $arr_branch_code[$i] = $branch_code->sh_branch_code;
            }
            $branch_code = implode(",",$arr_branch_code);
            
            $deal = new deal;
            $deal->de_deal_typeid = Input::get('input_typeid');
            $deal->de_deal_shopcode = $shop_code;
            $deal->de_deal_title = $title;
            $deal->de_deal_detail = $detail;
            $deal->de_deal_price = Input::get('input_price');
            $deal->de_deal_shopdis = Input::get('input_shopdis');
            $deal->de_deal_cusdis = Input::get('input_cusdis');
            $deal->de_deal_pa = Input::get('input_pa');
            $deal->de_deal_point = Input::get('input_point');
            $deal->de_deal_sdate = $sdate;
            $deal->de_deal_edate = $edate;
            $deal->de_deal_branchcode = $branch_code;
            $deal->de_deal_crebyid = Session::get('thisUser')->id;
            $deal->de_deal_credate = date('Y-m-d H:i:s');
            $deal->de_deal_updatebyid = Session::get('thisUser')->id;
            $deal->de_deal_updatedate = date('Y-m-d H:i:s');
            $deal->save();

            if($deal->save()){
                Session::flash('success', 'เพิ่มข้อมูลเรียบร้อยแล้ว');
                return Redirect::to('deal');
            }
        
        } else {
            return Redirect::back()
                    ->withInput()
                    ->withErrors( $v->messages() );
        }
        return Redirect::back()->with('error','เกิดข้อผิดพลาด');       

    }
    
    
    public function show($id){
        
        $deal = Deal::find($id);
        
        // Get Cate & SubCate
        $cate_id = Shop::get_cateid_by_code($deal->de_deal_shopcode);
        $scate_id = Shop::get_scateid_by_code($deal->de_deal_shopcode);
        $catenameth = Cate::select('de_set_cate_nameth')->where('de_set_cate_id', '=', $cate_id)->first();
        $scatenameth = Subcate::select('de_set_scate_nameth')->where('de_set_scate_id', '=', $scate_id)->first();

        // Get Branch_id
        $arr_branch_code = explode(',', $deal->de_deal_branchcode);
        $count_arr_branch_code  = count($arr_branch_code);
        for($i=0; $i<$count_arr_branch_code; $i++){
            $branch_name = Branch::where('sh_branch_code', '=', $arr_branch_code[$i])->select('sh_branch_name')->first(); 
            $arr_branch_name[$i] = GetText::expld_text($branch_name->sh_branch_name, 'thai');
        }
        $branch_nameth = implode(", ",$arr_branch_name);
        
        return View::make('deal.show')
            ->with('deal',$deal)
            ->with('branch_nameth', GetText::expld_field( Branch::lists('sh_branch_id'), Branch::lists('sh_branch_name'), 'thai' ))
            ->with('catenameth', $catenameth->de_set_cate_nameth )
            ->with('scatenameth', $scatenameth->de_set_scate_nameth )
            ->with('branch_nameth', $branch_nameth);
    }
    
    
    public function edit($id){
        
        $deal = Deal::find($id);
        
        // Get Cate & SubCate
        $cate_id = Shop::get_cateid_by_code($deal->de_deal_shopcode);
        $scate_id = Shop::get_scateid_by_code($deal->de_deal_shopcode);
        $catenameth = Cate::select('de_set_cate_nameth')->where('de_set_cate_id', '=', $cate_id)->first();
        $scatenameth = Subcate::select('de_set_scate_nameth')->where('de_set_scate_id', '=', $scate_id)->first();

        // Get Branch_id
        $arr_branch_code = explode(',', $deal->de_deal_branchcode);
        $count_arr_branch_code  = count($arr_branch_code);
        for($i=0; $i<$count_arr_branch_code; $i++){
            $branch_id = Branch::where('sh_branch_code', '=', $arr_branch_code[$i])->select('sh_branch_id')->first(); 
            $arr_branch_id[$i] = $branch_id->sh_branch_id;
        }

        return View::make('deal.edit')
                ->with('deal',$deal)
                ->with('list_dealtype', GetList::$list_dealtype)
                ->with('list_shop', GetText::expld_field( Shop::lists('sh_shop_id') ,Shop::lists('sh_shop_name'), 'thai' ) )
                ->with('list_branch', GetText::expld_field( Branch::lists('sh_branch_id'), Branch::lists('sh_branch_name'), 'thai' ))
                ->with('catenameth', $catenameth->de_set_cate_nameth )
                ->with('scatenameth', $scatenameth->de_set_scate_nameth )
                ->with('arr_branch_id', $arr_branch_id);
        
    }
    
    
    public function update($id){
        
        $v = Deal::validate(Input::all());
        if ($v->passes()) {

            //Get Shop_code
            $shop_code = Shop::get_code_by_id( Input::get('input_shopid') );  
            
            // Get Title
            $titleth = GetText::text_empty( Input::get('input_titleth') );
            $titleen = GetText::text_empty( Input::get('input_titleen') ); 
            $title = $titleth.'|x|'.$titleen;
            
            // Get Detail
            $detailth = GetText::text_empty( Input::get('input_detailth') );
            $detailen = GetText::text_empty( Input::get('input_detailen') );
            $detail = $detailth.'|x|'.$detailen;
            
            // Get sdate & edate
            $sdate_edate = explode(' - ', Input::get('date-range-picker') );
            $sdate = GetFormat::format_DateTime3($sdate_edate[0]);
            $edate = GetFormat::format_DateTime3($sdate_edate[1]);
            
            // Get Branch_Code
            $arr_branch_id = Input::get('input_branchid');
            $count_arr_branch_id  = count($arr_branch_id);
            for($i=0; $i<$count_arr_branch_id; $i++){
                $branch_code = Branch::where('sh_branch_id', '=', $arr_branch_id[$i])->select('sh_branch_code')->first(); 
                $arr_branch_code[$i] = $branch_code->sh_branch_code;
            }
            $branch_code = implode(",",$arr_branch_code);
            
            $deal = Deal::find($id);
            $deal->de_deal_typeid = Input::get('input_typeid');
            $deal->de_deal_shopcode = $shop_code;
            $deal->de_deal_title = $title;
            $deal->de_deal_detail = $detail;
            $deal->de_deal_price = Input::get('input_price');
            $deal->de_deal_shopdis = Input::get('input_shopdis');
            $deal->de_deal_cusdis = Input::get('input_cusdis');
            $deal->de_deal_pa = Input::get('input_pa');
            $deal->de_deal_point = Input::get('input_point');
            $deal->de_deal_sdate = $sdate;
            $deal->de_deal_edate = $edate;
            $deal->de_deal_branchcode = $branch_code;
            $deal->de_deal_updatebyid = Session::get('thisUser')->id;
            $deal->de_deal_updatedate = date('Y-m-d H:i:s');
            $deal->save();

            if($deal->save()){
                Session::flash('success', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
                return Redirect::to('deal');
            }
        
        } else {
            return Redirect::back()
                    ->withInput()
                    ->withErrors( $v->messages() );
        }
        return Redirect::back()->with('error','เกิดข้อผิดพลาด');   
        
    }
    
    
    public function destroy($id){

        if($id=='delall'){
            $arrData = Input::get('hidden_chkBoxDel');
            if(!empty($arrData)){
                foreach (explode(',', $arrData) as $id ){ $this->delete($id); }
                Session::flash('message', 'ลบข้อมูลเรียบร้อยแล้ว');
                return Redirect::to('deal');
            }else{
                Session::flash('message', 'ไม่พบข้อมูลที่ต้องการลบ');
                return Redirect::to('deal');
            }   
        }else{       
            $this->delete($id);
            Session::flash('message', 'ลบข้อมูลเรียบร้อยแล้ว');
            return Redirect::to('deal');
        }

    }
    
    private function delete ($id) {
        $deal = Deal::find($id);
        $deal->delete();
    }

    
    public function getBranchOptions(){

        if(Request::ajax()){
            $id = Input::get('input_shopid');
            
            $shop = Shop::select('sh_shop_code','sh_shop_cateid','sh_shop_scateid')->where('sh_shop_id','=',$id)->first();
            $branchid = Branch::where('sh_branch_shopcode', '=', $shop->sh_shop_code)->lists('sh_branch_id');
            $branchname = Branch::where('sh_branch_shopcode', '=', $shop->sh_shop_code)->lists('sh_branch_name');
                    
            return View::make('deal.ajax.input_branch')
                    ->with('list_branch', GetText::expld_field( $branchid, $branchname, 'thai' ))
                    ->render();
        }
        $this->create() ;
        
    }
    
    
    public function getFormCate(){

        if(Request::ajax()){
            $id = Input::get('input_shopid');
            
            $catenameth = Cate::get_nameth_by_id( Shop::get_cateid_by_id($id) );
            $scatenameth = Subcate::get_nameth_by_id( Shop::get_scateid_by_id($id) );
                    
            return View::make('deal.ajax.input_cate')
                    ->with('catenameth', $catenameth )
                    ->with('scatenameth', $scatenameth )
                    ->render();
        }
        $this->create() ;
        
    }
    
    
    
    
}