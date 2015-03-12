<?php
/**
 * use to format string and etc.
 *
 * @author Yamada Yoseigi
 */


class GetFormat  {
    
        // YYYY-MM-DD H:i:s To DD/MM/YYYY 
        public static function format_DateTime($DateTime) {
            $DateTimeArr = explode(" ",$DateTime);
            $Date = $DateTimeArr[0];
            $DateArr = explode("-",$Date);
            return $DateArr[2]."/".$DateArr[1]."/".$DateArr[0];
        }
        
        // DD-MM-YYYY To YYYY-MM-DD H:i:s
        public static function format_DateTime2($Date) {
            $DateArr = explode("-",$Date);
            $SetDate = date_create($DateArr[2]."-".$DateArr[1]."-".$DateArr[0]);
            $NewDate = date_format($SetDate,"Y-m-d H:i:s");
            return $NewDate;
        }
        
        // MM/DD/YYYY To YYYY-MM-DD H:i:s
        public static function format_DateTime3($Date) {
            $DateArr = explode("/",$Date);
            $SetDate = date_create($DateArr[1]."-".$DateArr[0]."-".$DateArr[2]);
            $NewDate = date_format($SetDate,"Y-m-d H:i:s");
            return $NewDate;
        }
        
        // (YYYY-MM-DD H:i:s, YYYY-MM-DD H:i:s) to (MM-DD-YYYY, MM-DD-YYYY)
        public static function format_DateRang1($sdate, $edate) {
            $sdate_temp = subStr($sdate, 0, 10);
            $edate_temp = subStr($edate, 0, 10);
            $arr_sdate = explode('-', $sdate_temp);
            $arr_edate = explode('-', $edate_temp);
            $dateRang = $arr_sdate[1].'/'.$arr_sdate[2].'/'.$arr_sdate[0].' - '.$arr_edate[1].'/'.$arr_edate[2].'/'.$arr_edate[0];
            return $dateRang;
        }
}