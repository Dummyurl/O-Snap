<?php

class GlobalFunction extends CApplicationComponent {

    // generate random number
    public static function get_random_number() {
        return substr("abcdefghijklmnopqrstuvwxyz", mt_rand(0, 25), 1) . substr(md5(time()), 1);
    }
    
        public static function srt_replace($str){
     	return preg_replace('/[^A-Za-z0-9\.]/', '', mb_convert_encoding($str, 'UTF-8', 'HTML-ENTITIES'));
 	}
 	public static function getUserType($id){
		if($id=="1"){
			return "User";
		}else if($id=="2"){
			return "Business User";
		}else{
			return " - ";
		}
	}
	public static function getworkType($id){
		if($id=="1"){
			return "One-time Project";
		}elseif($id=="2"){
			return "Ongoing project";
		}elseif($id=="3"){
			return "i am not sure";
		}else{
			return "  ";
		}
	}
	public static function getPayBy($id){
		if($id=="1"){
			return "pay by the hour";
		}else if($id=="2"){
			return "fixed price";
		}else{
			return " - ";
		}
	}
	public static function HowLong($id){
		if($id=="1"){
			return "More than 6 month";
		}elseif($id=="2"){
			return "3 to 6 month";
		}else if($id=="3"){
			return "1 to 3 months";
		}else if($id=="4"){
			return "Less than 1 month";
		}else if($id=="5"){
			return "Less than 1 week";
		}else{
			return " - ";
		}
	}
	public static function getExpLevel($id){
		if($id=="1"){
			return "Entry level";
		}elseif($id=="2"){
			return "Intermediate";
		}elseif($id=="3"){
			return "expert";
		}else{
			return "  ";
		}
	}
	public static function getcommitment($id){
		if($id=="1"){
			return "More then 30 hrs/week";
		}elseif($id=="2"){
			return "Less than 30 hrs/week";
		}elseif($id=="3"){
			return " i don't know yet";
		}else{
			return "  ";
		}
	}
	public static function getStatus($id){
		if($id=="0"){
			return "Deactive";
		}elseif($id=="1"){
			return "Active";
		}else if($id=="2"){
			return "Running";
		}else if($id=="3"){
			return "Completed";
		}else if($id=="4"){
			return "Cancled";
		}else{
			return " - ";
		}
	}
	public static function getBusinessTypes($usinessTypes){
	    if(isset($usinessTypes) && $usinessTypes!=''){
			$row = BusinessTypes::model()->findByAttributes(array('id' => $usinessTypes));
			$final_data=$row['name'];
		}
	    return $final_data;
	}
	public static function getBusinessCategory($BusinessCategory){
	    if(isset($BusinessCategory) && $BusinessCategory!=''){
			$row = BusinessCategory::model()->findByAttributes(array('id' => $BusinessCategory));
			$final_data=$row['name'];
		}
	    return $final_data;
	}
}
?>