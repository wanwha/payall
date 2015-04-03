<?php

/**
 * 
 * 
 *
 * @author Yamada Yoseigi
 */

class GetText {
    
    // expld_field() For List
    public static function expld_field($id, $field, $lang) {
        
        switch ($lang) {
            case 'TH': $langCode = 0; break;
            case 'US': $langCode = 1; break;
            case 'JP': $langCode = 2; break;
            case 'CN': $langCode = 3; break;
            default: $langCode = 0; break;
        }
        
        $count = count($field);
        
        for($i=0; $i<$count; $i++){   
            
            $arr = explode('|x|', $field[$i]); // Explode Text Filed
            
            if(!empty($arr[$langCode])){ // Check Text Field Emply
                $expldField[$i] = $arr[$langCode]; 
            }else{
                $expldField[$i] = '-';
            }

        }
        
        // Create New Array Field
        for($j=0; $j<$count; $j++){
            $newField[$id[$j]] = $expldField[$j];
        }
        
        if(!empty($newField)){
            return $newField;
        }else{
            return array();
        }
        
    }
    
    
    public static function expld_text($txet, $lang) {

        switch ($lang) {
            case 'TH': $langCode = 0; break;
            case 'US': $langCode = 1; break;
            case 'JP': $langCode = 2; break;
            case 'CN': $langCode = 3; break;
            default: $langCode = 0; break;
        }
        
        $arr = explode('|x|', $txet); // Explode Text

        if(!empty($arr[$langCode])){ // Check Text Emply
            $text = $arr[$langCode]; 
        }else{
            $text = '-';
        }

        return $text;
    }
    
    
    public static function text_empty($txt){
        if( empty($txt) ){
            $txt = '-';
            return $txt;
        }else{
            return $txt;
        }
    }


}