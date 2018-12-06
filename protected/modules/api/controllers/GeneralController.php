<?php
date_default_timezone_set('UTC');
class GeneralController extends ApiController{
	// This function used for Object to Array convert.
	public function objectToArray(&$object){
		$array=array();
		foreach($object as $member=>$data)
		{
			$array[$member]=$data;
		}
		return $array;
	}
	public function getCurrentDateTime(){
		$connection=Yii::app()->db;
		$sql = 'select NOW() as date';
		$dataReader=$connection->createCommand($sql)->query();
		$date   = $dataReader->read();
		$date   = date('Y-m-d',strtotime($date['date']));
		return  $date;
	}
	public function random_string($length) {
		$key = '';
		$keys = array_merge(range(0, 9));
		for ($i = 0; $i < $length; $i++) {
			$key .= $keys[array_rand($keys)];
		}
		return $key;
	}
	public function UserIs_Varify($UserId){
		$result = User::model()->find("id ='".$UserId."'");
		if(!empty($result)){
			if($result['is_active'] == '1'){
				$valid = '1';
			}else{
				$valid = '0';
			}
		}else{
			$valid = '0';
		}
		return $valid;
	}
	public function EmailExist($emailId){
		
		$result = User::model()->find("email ='".$emailId."'");
		if($result){
			$valid = '1';
		}else{
			$valid = '0';
		}
		return $valid;
	}

	public function PhoneExist($phone){
		$result = User::model()->find("phone ='".$phone."'");
		if($result){
			$valid = '1';
		}else{
			$valid = '0';
		}
		return $valid;
	}
	public function OsnapExist($osnap_id){
		$result = User::model()->find(" osnap_id ='".$osnap_id."'");
		
		if($result){
			$valid = '1';
		}else{
			$valid = '0';
		}
		return $valid;
	}
	public function GetNotification($key,$lang){
		$result = MultiLanguage::model()->find("noti_key ='".$key."'");
		if($result){
			if($lang==1)
			{
				return $result->attributes['noti_eng'];
			}
			else
			{
				return $result->attributes['noti_other'];
			}
		}else{
			return "Message not found";
		}
	}
	
	function crypto_rand_secure($min, $max)
	{
	    $range = $max - $min;
	    if ($range < 1) return $min; // not so random...
	    $log = ceil(log($range, 2));
	    $bytes = (int) ($log / 8) + 1; // length in bytes
	    $bits = (int) $log + 1; // length in bits
	    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
	    do {
	        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
	        $rnd = $rnd & $filter; // discard irrelevant bits
	    } while ($rnd > $range);
	    return $min + $rnd;
	}


	function getToken($length)
	{
	    $token = "";
	    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
	    $codeAlphabet.= "0123456789";
	    $max = strlen($codeAlphabet); // edited

	    for ($i=0; $i < $length; $i++) {
	        $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
	    }

	    return $token;
	}

	public function distance($lat1, $lon1, $lat2, $lon2, $unit){
			$theta = $lon1 - $lon2;
			$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
			$dist = acos($dist);
			$dist = rad2deg($dist);
			$miles = $dist * 60 * 1.1515;
			$unit = strtoupper($unit);
			if($unit == "K"){
				return ($miles * 1.609344);
			}else if($unit == "N") {
				return ($miles * 0.8684);
			}else{
			return $miles;
			}
	}
	function time_diffrent($datetime, $full = false) {
	    $now = new DateTime;
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);
	    $diff->w = floor($diff->d / 7);
	    $string = array(
	        'y' => 'year',
	        'm' => 'month',
	        'd' => 'day',
	        'h' => 'hour',
	        'i' => 'min',
	        's' => 'second',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	        } else {
	            unset($string[$k]);
	        }

	    }
	    if (!$full) $string = array_slice($string, 0, 1);
	    return $string ? implode(', ', $string) . '' : 'just now';
	}

	 /**
     * @Method		  :	POST
     * @Params		  : usertype,username,password
     * @author        : Dharmesh	
     * @created		  :	July 27 2017
     * @Modified by	  :
     * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment		  : Get Business category
     * */
     
	public function actionGetBusinessCategory(){
		$res = array();
		$response=array();
		$apiData = json_decode(file_get_contents('php://input'),TRUE);
		if(!isset($apiData['data']['lang_type']) ||  empty($apiData['data']['lang_type'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passlang",1);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		$lang = $apiData['data']['lang_type'];
		if(!isset($apiData['data']['id']) ||  empty($apiData['data']['id'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passuserid",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(!isset($apiData['data']['token']) ||  empty($apiData['data']['token'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passtoken",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{
			
			$checkUserTokenData = User::model()->find("id='".$apiData['data']['id']."' AND token = '".$apiData['data']['token']."'");
		if($checkUserTokenData){
			
			$lang = $apiData['data']['lang_type'];
            $page_number = (isset($apiData['data']['page']) && $apiData['data']['page'] != '') ? $apiData['data']['page'] : '';
            $limit = (isset($apiData['data']['limit']) && $apiData['data']['limit'] != '') ? $apiData['data']['limit'] : 10;
            if (isset($apiData['data']['page']) && $apiData['data']['page'] == 1) {
                $offset = 0;
            } else {
                if (isset($apiData['data']['page']) && $apiData['data']['page'] != '1') {
                    $offset = ($page_number * $limit) - $limit;
                } else {
                    $offset = 0;
                }
            }
            $temp = " LIMIT $offset,$limit";
            $temp = "";
            // End Pagination
            if( (!isset($apiData['data']['page']) && $apiData['data']['page'] == '') && (!isset($apiData['data']['limit']) && $apiData['data']['limit'] == '') )
            {
				$temp="";
			}
            $connection = Yii::app()->db;
            
            $sql = "SELECT * from business_category where status=1 " . $temp;
				
	
            $command = Yii::app()->db->createCommand($sql);
            $eventslist = $command->queryAll();
            //echo $this->GetLang($lang);
            if (!empty($eventslist)) {
                $response['status'] = "1";
                $response['message'] = $this->GetNotification("businesscategorylist",$lang);
                foreach ($eventslist as $key => $value) {
                    $dcid = $value['id'];
                    $response['data'][$key]['id'] = $dcid;
                    //echo 'ac_name'.$this->GetLang($lang);
                    $response['data'][$key]['name'] = $value['name']."";
                    $response['data'][$key]['status'] = $value['status'];                        
                }
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            } else {
                $response['status'] = "1";
                $response['data'] = array();
                $response['message'] = $this->GetNotification("notfound",$lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
				
			
		}
		else
		{
			$response['status'] = "2";
			$response['message'] = $this->GetNotification("tokenexpired",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}

		}

 	}

	/**
     * @Method		  :	POST
     * @Params		  : usertype,username,password
     * @author        : Dharmesh	
     * @created		  :	July 27 2017
     * @Modified by	  :
     * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment		  : Get Business Types
     * */
     
	public function actionGetBusinessTypes(){
		$res = array();
		$response=array();
		$apiData = json_decode(file_get_contents('php://input'),TRUE);
		if(!isset($apiData['data']['lang_type']) ||  empty($apiData['data']['lang_type'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passlang",1);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		$lang = $apiData['data']['lang_type'];
		if(!isset($apiData['data']['id']) ||  empty($apiData['data']['id'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passuserid",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(!isset($apiData['data']['token']) ||  empty($apiData['data']['token'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passtoken",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{
			
			$checkUserTokenData = User::model()->find("id='".$apiData['data']['id']."' AND token = '".$apiData['data']['token']."'");
		if($checkUserTokenData){
			
			$lang = $apiData['data']['lang_type'];
            $page_number = (isset($apiData['data']['page']) && $apiData['data']['page'] != '') ? $apiData['data']['page'] : '';
            $limit = (isset($apiData['data']['limit']) && $apiData['data']['limit'] != '') ? $apiData['data']['limit'] : 10;
            if (isset($apiData['data']['page']) && $apiData['data']['page'] == 1) {
                $offset = 0;
            } else {
                if (isset($apiData['data']['page']) && $apiData['data']['page'] != '1') {
                    $offset = ($page_number * $limit) - $limit;
                } else {
                    $offset = 0;
                }
            }
            $temp = " LIMIT $offset,$limit";
            // End Pagination
            if( (!isset($apiData['data']['page']) && $apiData['data']['page'] == '') && (!isset($apiData['data']['limit']) && $apiData['data']['limit'] == '') )
            {
				$temp="";
			}
            $connection = Yii::app()->db;
            
            $sql = "SELECT * from business_types where status=1 " . $temp;
				
	
            $command = Yii::app()->db->createCommand($sql);
            $eventslist = $command->queryAll();
            //echo $this->GetLang($lang);
            if (!empty($eventslist)) {
                $response['status'] = "1";
                $response['message'] = $this->GetNotification("businesstypeslist",$lang);
                foreach ($eventslist as $key => $value) {
                    $dcid = $value['id'];
                    $response['data'][$key]['id'] = $dcid;
                    //echo 'ac_name'.$this->GetLang($lang);
                    $response['data'][$key]['name'] = $value['name']."";
                    $response['data'][$key]['status'] = $value['status'];                        
                }
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            } else {
                $response['status'] = "1";
                $response['data'] = array();
                $response['message'] = $this->GetNotification("notfound",$lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
				
			
		}
		else
		{
			$response['status'] = "2";
			$response['message'] = $this->GetNotification("tokenexpired",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}

		}

 	}

	
	/**
     * @Method		  :	POST
     * @Params		  : usertype,username,password
     * @author        : Dharmesh	
     * @created		  :	Aug 01 2017
     * @Modified by	  :
     * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment		  : Get category
     * */
     
	public function actionGetCategory(){
		$res = array();
		$response=array();
		$apiData = json_decode(file_get_contents('php://input'),TRUE);
		if(!isset($apiData['data']['lang_type']) ||  empty($apiData['data']['lang_type'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passlang",1);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		$lang = $apiData['data']['lang_type'];
		if(!isset($apiData['data']['id']) ||  empty($apiData['data']['id'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passuserid",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(!isset($apiData['data']['token']) ||  empty($apiData['data']['token'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passtoken",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{
			
			$checkUserTokenData = User::model()->find("id='".$apiData['data']['id']."' AND token = '".$apiData['data']['token']."'");
		if($checkUserTokenData){
			
			$lang = $apiData['data']['lang_type'];
            $page_number = (isset($apiData['data']['page']) && $apiData['data']['page'] != '') ? $apiData['data']['page'] : '';
            $limit = (isset($apiData['data']['limit']) && $apiData['data']['limit'] != '') ? $apiData['data']['limit'] : 10;
            if (isset($apiData['data']['page']) && $apiData['data']['page'] == 1) {
                $offset = 0;
            } else {
                if (isset($apiData['data']['page']) && $apiData['data']['page'] != '1') {
                    $offset = ($page_number * $limit) - $limit;
                } else {
                    $offset = 0;
                }
            }
            $temp = " LIMIT $offset,$limit";
            // End Pagination
            if( (!isset($apiData['data']['page']) && $apiData['data']['page'] == '') && (!isset($apiData['data']['limit']) && $apiData['data']['limit'] == '') )
            {
				$temp="";
			}
            $connection = Yii::app()->db;
            
            $sql = "SELECT * from category where parent=0 and is_active=1 " . $temp;
				
	
            $command = Yii::app()->db->createCommand($sql);
            $categorylist = $command->queryAll();
            //echo $this->GetLang($lang);
            if (!empty($categorylist)) {
                $response['status'] = "1";
                $response['message'] = $this->GetNotification("categorylist",$lang);
                foreach ($categorylist as $key => $value) {
                    $dcid = $value['id'];
                    $response['data'][$key]['category_id'] = $dcid;
                    //echo 'ac_name'.$this->GetLang($lang);
                    $response['data'][$key]['title'] = $value['title']."";
                    $response['data'][$key]['image'] = $value['image'];                        
                }
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            } else {
                $response['status'] = "1";
                $response['data'] = array();
                $response['message'] = $this->GetNotification("notfound",$lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
				
			
		}
		else
		{
			$response['status'] = "2";
			$response['message'] = $this->GetNotification("tokenexpired",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}

		}

 	}
 	
	
	/**
     * @Method		  :	POST
     * @Params		  : usertype,username,password
     * @author        : Dharmesh	
     * @created		  :	Aug 01 2017
     * @Modified by	  :
     * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment		  : Get category
     * */
     
	public function actionGetSubCategory(){
		$res = array();
		$response=array();
		$apiData = json_decode(file_get_contents('php://input'),TRUE);
		if(!isset($apiData['data']['lang_type']) ||  empty($apiData['data']['lang_type'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passlang",1);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		$lang = $apiData['data']['lang_type'];
		if(!isset($apiData['data']['id']) ||  empty($apiData['data']['id'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passuserid",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(!isset($apiData['data']['token']) ||  empty($apiData['data']['token'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passtoken",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(!isset($apiData['data']['category_id']) ||  empty($apiData['data']['category_id'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passcategoryid",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		else{
			
			$checkUserTokenData = User::model()->find("id='".$apiData['data']['id']."' AND token = '".$apiData['data']['token']."'");
		if($checkUserTokenData){
			
			$lang = $apiData['data']['lang_type'];
            $page_number = (isset($apiData['data']['page']) && $apiData['data']['page'] != '') ? $apiData['data']['page'] : '';
            $limit = (isset($apiData['data']['limit']) && $apiData['data']['limit'] != '') ? $apiData['data']['limit'] : 10;
            if (isset($apiData['data']['page']) && $apiData['data']['page'] == 1) {
                $offset = 0;
            } else {
                if (isset($apiData['data']['page']) && $apiData['data']['page'] != '1') {
                    $offset = ($page_number * $limit) - $limit;
                } else {
                    $offset = 0;
                }
            }
            $temp = " LIMIT $offset,$limit";
            // End Pagination
            if( (!isset($apiData['data']['page']) && $apiData['data']['page'] == '') && (!isset($apiData['data']['limit']) && $apiData['data']['limit'] == '') )
            {
				$temp="";
			}
            $connection = Yii::app()->db;
            
            $sql = "SELECT * from category where parent=".$apiData['data']['category_id']." and is_active=1 " . $temp;
				
	
            $command = Yii::app()->db->createCommand($sql);
            $categorylist = $command->queryAll();
            //echo $this->GetLang($lang);
            if (!empty($categorylist)) {
                $response['status'] = "1";
                $response['message'] = $this->GetNotification("categorylist",$lang);
                foreach ($categorylist as $key => $value) {
                    $dcid = $value['id'];
                    $response['data'][$key]['subcategory_id'] = $dcid;
                    //echo 'ac_name'.$this->GetLang($lang);
                    $response['data'][$key]['title'] = $value['title']."";
                    $response['data'][$key]['image'] = $value['image'];                        
                }
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            } else {
                $response['status'] = "1";
                $response['data'] = array();
                $response['message'] = $this->GetNotification("notfound",$lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
				
			
		}
		else
		{
			$response['status'] = "2";
			$response['message'] = $this->GetNotification("tokenexpired",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}

		}

 	}


 	/**
     * @Method		  :	POST
     * @Params		  : usertype,username,password
     * @author        : Dharmesh	
     * @created		  :	Aug 28 2017
     * @Modified by	  :
     * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment		  : Get Education
     * */
     
	public function actionGetEducation(){
		$res = array();
		$response=array();
		$apiData = json_decode(file_get_contents('php://input'),TRUE);
		if(!isset($apiData['data']['lang_type']) ||  empty($apiData['data']['lang_type'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passlang",1);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		$lang = $apiData['data']['lang_type'];
		if(!isset($apiData['data']['id']) ||  empty($apiData['data']['id'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passuserid",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(!isset($apiData['data']['token']) ||  empty($apiData['data']['token'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passtoken",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{
			
			$checkUserTokenData = User::model()->find("id='".$apiData['data']['id']."' AND token = '".$apiData['data']['token']."'");
		if($checkUserTokenData){
			
			$lang = $apiData['data']['lang_type'];
            $page_number = (isset($apiData['data']['page']) && $apiData['data']['page'] != '') ? $apiData['data']['page'] : '';
            $limit = (isset($apiData['data']['limit']) && $apiData['data']['limit'] != '') ? $apiData['data']['limit'] : 10;
            if (isset($apiData['data']['page']) && $apiData['data']['page'] == 1) {
                $offset = 0;
            } else {
                if (isset($apiData['data']['page']) && $apiData['data']['page'] != '1') {
                    $offset = ($page_number * $limit) - $limit;
                } else {
                    $offset = 0;
                }
            }
            $temp = " LIMIT $offset,$limit";
            // End Pagination
            if( (!isset($apiData['data']['page']) && $apiData['data']['page'] == '') && (!isset($apiData['data']['limit']) && $apiData['data']['limit'] == '') )
            {
				$temp="";
			}
            $connection = Yii::app()->db;
            
            $sql = "SELECT * from education where has_child!=-1 and is_active=1 " . $temp;
				
	
            $command = Yii::app()->db->createCommand($sql);
            $educationlist = $command->queryAll();
            //echo $this->GetLang($lang);
            if (!empty($educationlist)) {
                $response['status'] = "1";
                $response['message'] = $this->GetNotification("educationlist",$lang);
                foreach ($educationlist as $key => $value) {
                    $education_id = $value['education_id'];
                    $response['data'][$key]['education_id'] = $education_id;
                    //echo 'ac_name'.$this->GetLang($lang);
                    $response['data'][$key]['education'] = $value['education']."";
                    $response['data'][$key]['has_child'] = $value['has_child'];                        
                }
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            } else {
                $response['status'] = "1";
                $response['data'] = array();
                $response['message'] = $this->GetNotification("notfound",$lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
				
			
		}
		else
		{
			$response['status'] = "2";
			$response['message'] = $this->GetNotification("tokenexpired",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}

		}

 	}
 	
	
	/**
     * @Method		  :	POST
     * @Params		  : usertype,username,password
     * @author        : Dharmesh	
     * @created		  :	Aug 28 2017
     * @Modified by	  :
     * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment		  : Get Sub Education
     * */
     
	public function actionGetSubEducation(){
		$res = array();
		$response=array();
		$apiData = json_decode(file_get_contents('php://input'),TRUE);
		if(!isset($apiData['data']['lang_type']) ||  empty($apiData['data']['lang_type'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passlang",1);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		$lang = $apiData['data']['lang_type'];
		if(!isset($apiData['data']['id']) ||  empty($apiData['data']['id'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passuserid",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(!isset($apiData['data']['token']) ||  empty($apiData['data']['token'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passtoken",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		else{
			
			$checkUserTokenData = User::model()->find("id='".$apiData['data']['id']."' AND token = '".$apiData['data']['token']."'");
		if($checkUserTokenData){
			
			$lang = $apiData['data']['lang_type'];
            $page_number = (isset($apiData['data']['page']) && $apiData['data']['page'] != '') ? $apiData['data']['page'] : '';
            $limit = (isset($apiData['data']['limit']) && $apiData['data']['limit'] != '') ? $apiData['data']['limit'] : 10;
            if (isset($apiData['data']['page']) && $apiData['data']['page'] == 1) {
                $offset = 0;
            } else {
                if (isset($apiData['data']['page']) && $apiData['data']['page'] != '1') {
                    $offset = ($page_number * $limit) - $limit;
                } else {
                    $offset = 0;
                }
            }
            $temp = " LIMIT $offset,$limit";
            // End Pagination
            if( (!isset($apiData['data']['page']) && $apiData['data']['page'] == '') && (!isset($apiData['data']['limit']) && $apiData['data']['limit'] == '') )
            {
				$temp="";
			}
            $connection = Yii::app()->db;
            
            $sql = "SELECT * from education where has_child=-1 and is_active=1 " . $temp;
				
	
            $command = Yii::app()->db->createCommand($sql);
            $educationlist = $command->queryAll();
            //echo $this->GetLang($lang);
            if (!empty($educationlist)) {
                $response['status'] = "1";
                $response['message'] = $this->GetNotification("educationlist",$lang);
                foreach ($educationlist as $key => $value) {
                    $education_id = $value['education_id'];
                    $response['data'][$key]['child_id'] = $education_id;
                    //echo 'ac_name'.$this->GetLang($lang);
                    $response['data'][$key]['education'] = $value['education']."";
                    $response['data'][$key]['has_child'] = $value['has_child'];                        
                }
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            } else {
                $response['status'] = "1";
                $response['data'] = array();
                $response['message'] = $this->GetNotification("notfound",$lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
				
			
		}
		else
		{
			$response['status'] = "2";
			$response['message'] = $this->GetNotification("tokenexpired",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}

		}

 	}
 	
	


}

