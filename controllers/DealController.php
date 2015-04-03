<?php
/**
 * Description of DealController
 *
 * @author Yamada Yoseigi
 */

class DealController extends BaseController {
    
    
    public function index(){            
        $deal = Deal::selectDealForDatalist()
                ->orderBy('de_deal_updatedate','DESC')
                ->get();
        
        $deal_title = array();
        $deal_type = array();
        $deal_shopname = array();
        $deal_sedate = array();
                    
        foreach( $deal as $key => $v ){
            
            $shop_name = Shop::select('sh_shop_name')->where('sh_shop_code', '=', $v->de_deal_shopcode)->first()->sh_shop_name;
            
            array_push($deal_title, GetText::expld_text($v->de_deal_title, 'TH'));
            array_push($deal_type, GetList::$list_dealtype[$v->de_deal_typeid]);
            array_push($deal_shopname, GetText::expld_text($shop_name, 'TH'));
            array_push($deal_sedate, GetFormat::format_DateTime($v->de_deal_sdate).' - '.GetFormat::format_DateTime($v->de_deal_edate));  

        }
            
        return View::make('deal.index')
                ->with('deal', $deal)
                ->with('count', count($deal))
                ->with('deal_title', $deal_title)
                ->with('deal_type', $deal_type)
                ->with('deal_shopname', $deal_shopname)
                ->with('deal_sedate', $deal_sedate); 
    }
    
    
    public function create(){
        return View::make('deal.create')
                ->with('list_dealtype', GetList::$list_dealtype)
                ->with('list_shop', GetText::expld_field( Shop::lists('sh_shop_id') ,Shop::lists('sh_shop_name'), 'TH' ) )
                ->with('list_branch', GetText::expld_field( Branch::lists('sh_branch_id'), Branch::lists('sh_branch_name'), 'TH' ))
                ->with('cate_nameth', null )
                ->with('scate_nameth', null );
    }
    

    public function store(){
        
        $v = Deal::validate(Input::all());
        if($v->passes()){
            
            //Get Shop_code
            $shop_code = Shop::select('sh_shop_code')->where('sh_shop_id', '=', Input::get('input_shopid'))->first()->sh_shop_code;
                    
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
                $arr_branch_code[$i] = Branch::select('sh_branch_code')->where('sh_branch_id', '=', $arr_branch_id[$i])->select('sh_branch_code')->first()->sh_branch_code; 
            }
            $branch_code = implode(",", $arr_branch_code);
            
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
            }else{
                return Redirect::back()->withInput()->with('error','System Error : ไม่สามารถบันทึกข้อมูลได้'); 
            }
        
        }else{
            return Redirect::back()->withInput()->withErrors( $v->messages() );
        }
        
        return Redirect::back()->with('error','System Error : เกิดข้อผิดพลาด');       

    }
    
    
    public function show($id){
        
        $deal = Deal::find($id);
        $shop = Shop::select('sh_shop_name', 'sh_shop_cateid', 'sh_shop_scateid')->where('sh_shop_code', '=', $deal->de_deal_shopcode)->first();
        
        // Get Cate & SubCate
        $cate_nameth = Cate::select('de_set_cate_nameth')->where('de_set_cate_id', '=', $shop->sh_shop_cateid)->first()->de_set_cate_nameth;
        $scate_nameth = Subcate::select('de_set_scate_nameth')->where('de_set_scate_id', '=', $shop->sh_shop_scateid)->first()->de_set_scate_nameth;

        // Get Branch_id
        $arr_branch_code = explode(',', $deal->de_deal_branchcode);
        $count_arr_branch_code  = count($arr_branch_code);
        for($i=0; $i<$count_arr_branch_code; $i++){
            $branch_name = Branch::select('sh_branch_name')->where('sh_branch_code', '=', $arr_branch_code[$i])->first()->sh_branch_name; 
            $arr_branch_name[$i] = GetText::expld_text($branch_name, 'TH');
        }
        $branch_nameth = implode(", ",$arr_branch_name);
        
        // Get CreateBy
        $create_info = User::select('first_name', 'last_name')->where('id', '=', $deal->de_deal_crebyid)->first();
        if(!empty($create_info)){
            $deal_crebyname = $create_info->first_name.'&nbsp;&nbsp;'.$create_info->last_name;
        }else{
            $deal_crebyname = '-';
        }
        
        // Get UpdateBy
        $update_info = User::select('first_name', 'last_name')->where('id', '=', $deal->de_deal_updatebyid)->first();
        if(!empty($update_info)){
            $deal_updatebyname = $update_info->first_name.'&nbsp;&nbsp;'.$update_info->last_name;
        }else{
            $deal_updatebyname = '-';
        }
        
                
        return View::make('deal.show')
            ->with('deal',$deal)
            ->with('deal_titleth', GetText::expld_text($deal->de_deal_title, 'TH'))
            ->with('deal_titleen', GetText::expld_text($deal->de_deal_title, 'US'))
            ->with('deal_detailth', GetText::expld_text($deal->de_deal_detail, 'TH'))
            ->with('deal_detailen', GetText::expld_text($deal->de_deal_detail, 'US'))
            ->with('deal_type', GetList::$list_dealtype[$deal->de_deal_typeid])
            ->with('branch_nameth', $branch_nameth)
            ->with('shop_nameth', GetText::expld_text($shop->sh_shop_name, 'TH'))
            ->with('cate_nameth', $cate_nameth )
            ->with('scate_nameth', $scate_nameth )
            ->with('deal_sedate', GetFormat::format_DateTime($deal->de_deal_sdate).' - '.GetFormat::format_DateTime($deal->de_deal_edate))
            ->with('deal_crebyname', $deal_crebyname)
            ->with('deal_updatebyname', $deal_updatebyname);
    }
    
    
    public function edit($id){
        
        $deal = Deal::find($id);
        $shop = Shop::select('sh_shop_id', 'sh_shop_cateid', 'sh_shop_scateid')
                ->where('sh_shop_code', '=', $deal->de_deal_shopcode)
                ->first();

        // Get Cate & SubCate
        $cate_nameth = Cate::select('de_set_cate_nameth')->where('de_set_cate_id', '=', $shop->sh_shop_cateid)->first()->de_set_cate_nameth;
        $scate_nameth = Subcate::select('de_set_scate_nameth')->where('de_set_scate_id', '=', $shop->sh_shop_scateid)->first()->de_set_scate_nameth;

        // Get Branch_id
        $arr_branch_code = explode(',', $deal->de_deal_branchcode);
        $count_arr_branch_code  = count($arr_branch_code);
        for($i=0; $i<$count_arr_branch_code; $i++){
            $arr_branch_id[$i] = Branch::select('sh_branch_id')->where('sh_branch_code', '=', $arr_branch_code[$i])->select('sh_branch_id')->first()->sh_branch_id;
        }

        return View::make('deal.edit')
                ->with('deal', $deal)
                ->with('shop_id', $shop->sh_shop_id)
                ->with('list_dealtype', GetList::$list_dealtype)
                ->with('list_shop', GetText::expld_field( Shop::lists('sh_shop_id') ,Shop::lists('sh_shop_name'), 'TH' ) )
                ->with('list_branch', GetText::expld_field( Branch::lists('sh_branch_id'), Branch::lists('sh_branch_name'), 'TH' ))
                ->with('cate_nameth', $cate_nameth)
                ->with('scate_nameth', $scate_nameth)
                ->with('arr_branch_id', $arr_branch_id);
        
    }
    
    
    public function update($id){
        
        $v = Deal::validate(Input::all());
        if($v->passes()){

            // Get Shop_code
            $shop_code = Shop::where('sh_shop_id', '=', Input::get('input_shopid'))->first()->sh_shop_code;
            
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
                $arr_branch_code[$i] = Branch::select('sh_branch_code')->where('sh_branch_id', '=', $arr_branch_id[$i])->select('sh_branch_code')->first()->sh_branch_code; 
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
            }else{
                return Redirect::back()->with('error','System Error : ไม่สามารถบันทึกข้อมูลได้'); 
            }
        
        }else{
            return Redirect::back()->withInput()->withErrors( $v->messages() );
        }
        
        return Redirect::back()->with('error','System Error : เกิดข้อผิดพลาด');
        
    }
    
    
    public function destroy($id){

        if($id=='delall'){
            $arrData = Input::get('hidden_chkBoxDel');
            if(!empty($arrData)){
                foreach (explode(',', $arrData) as $id ){ $this->delete($id); }
                Session::flash('message', 'ลบข้อมูลเรียบร้อยแล้ว');
                return Redirect::to('deal');
            }else{
                Session::flash('danger', 'ไม่พบข้อมูลที่ต้องการลบ');
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
            $shop_code = Shop::select('sh_shop_code')->where('sh_shop_id' ,'=', Input::get('input_shopid'))->first()->sh_shop_code;
            $list_branch_id = Branch::where('sh_branch_shopcode', '=', $shop_code)->lists('sh_branch_id');
            $list_branch_name = Branch::where('sh_branch_shopcode', '=', $shop_code)->lists('sh_branch_name');
                    
            return View::make('deal.ajax.input_branch')
                    ->with('list_branch', GetText::expld_field($list_branch_id, $list_branch_name, 'TH'))
                    ->render();
        }
        
    }
    
    
    public function getFormCate(){

        if(Request::ajax()){
            $shop = Shop::select('sh_shop_cateid', 'sh_shop_scateid')->where('sh_shop_id', '=', Input::get('input_shopid'))->first();
            $cate_nameth = Cate::select('de_set_cate_nameth')->where('de_set_cate_id', '=', $shop->sh_shop_cateid )->first()->de_set_cate_nameth;
            $scate_nameth = Subcate::select('de_set_scate_nameth')->where('de_set_scate_id', '=', $shop->sh_shop_scateid )->first()->de_set_scate_nameth;
                    
            return View::make('deal.ajax.input_cate')
                    ->with('cate_nameth', $cate_nameth )
                    ->with('scate_nameth', $scate_nameth )
                    ->render();
        }
        
    }
    
    
    
    
}