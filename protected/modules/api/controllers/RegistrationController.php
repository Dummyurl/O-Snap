<?php

date_default_timezone_set('UTC');

require_once("stripe/init.php");
class RegistrationController extends ApiController {

    // This function used for Object to Array convert.
    public function objectToArray(&$object) {
        $array = array();
        foreach ($object as $member => $data) {
            $array[$member] = $data;
        }
        return $array;
    }

    public function getCurrentDateTime() {
        $connection = Yii::app()->db;
        $sql = 'select NOW() as date';
        $dataReader = $connection->createCommand($sql)->query();
        $date = $dataReader->read();
        $date = date('Y-m-d', strtotime($date['date']));
        return $date;
    }

    public function random_string($length) {
        $key = '';
        $keys = array_merge(range(0, 9));
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        return $key;
    }

    public function UserIs_Varify($UserId) {
        $result = User::model()->find("id ='" . $UserId . "'");
        if (!empty($result)) {
            if ($result['is_active'] == '1') {
                $valid = '1';
            } else {
                $valid = '0';
            }
        } else {
            $valid = '0';
        }
        return $valid;
    }

    public function EmailExist($emailId) {

        $result = User::model()->find("email ='" . $emailId . "'");
        if ($result) {
            $valid = '1';
        } else {
            $valid = '0';
        }
        return $valid;
    }

    public function UsernameExist($username) {

        $result = User::model()->find("username ='" . $username . "'");
        if ($result) {
            $valid = '1';
        } else {
            $valid = '0';
        }
        return $valid;
    }

    public function PhoneExist($phone) {
        $result = User::model()->find("phone ='" . $phone . "'");
        if ($result) {
            $valid = '1';
        } else {
            $valid = '0';
        }
        return $valid;
    }
    public function CheckBid($post_id,$user_id) {
        $result = PostBid::model()->find(" post_id =" . $post_id . " and bid_by=" . $user_id);

        if ($result) {
            $valid = '1';
        } else {
            $valid = '0';
        }
        return $valid;
    }


    public function OsnapExist($osnap_id) {
        $result = User::model()->find(" osnap_id ='" . $osnap_id . "'");

        if ($result) {
            $valid = '1';
        } else {
            $valid = '0';
        }
        return $valid;
    }

    public function BusinessOsnapExist($osnap_id, $user_id) {
        if ($user_id != "") {
            $result = User::model()->find(" business_osnap_id ='" . $osnap_id . "' and id!=" . $user_id);
        } else {
            $result = User::model()->find(" business_osnap_id ='" . $osnap_id . "'");
        }


        if ($result) {
            $valid = '1';
        } else {
            $valid = '0';
        }
        return $valid;
    }

    public function GetNotification($key, $lang) {
        $result = MultiLanguage::model()->find("noti_key ='" . $key . "'");
        if ($result) {
            if ($lang == 1) {
                return $result->attributes['noti_eng'];
            } else {
                return $result->attributes['noti_other'];
            }
        } else {
            return "Message not found";
        }
    }

    public function GetBusinessCategoryName($id){
        // Check Email exists or not query
        $result = BusinessCategory::model()->find("id ='".$id."'");
        return $result->attributes['name']."";
        //return $valid;
    }
    public function GetCategoryName($id){
        // Check Email exists or not query
        $result = Category::model()->find("id ='".$id."'");
        return $result->attributes['title']."";
        //return $valid;
    }
    public function GetSubCategoryName($id){
        // Check Email exists or not query
        $result = Category::model()->find("id ='".$id."'");
        return $result->attributes['title']."";
        //return $valid;
    }

    public function GetEducationName($id){
        // Check Email exists or not query
        $result = Education::model()->find("education_id ='".$id."'");
        return $result->attributes['education']."";
        //return $valid;
    }

    public function GetExpLevelText($id){
        
        if($id==1)
        {
            return "Entry level";
        }
        if($id==2)
        {
            return "Intermediate";
        }
        if($id==3)
        {
            return "Expert";
        }
    }


    public function GetWorkTypeText($id){
        
        if($id==1)
        {
            return "One time Project";
        }
        if($id==2)
        {
            return "Ongoing project";
        }
        if($id==3)
        {
            return "I am not sure";
        }
    }



    public function GetPayByText($id){
        
        if($id==1)
        {
            return "Pay by the hour";
        }
        if($id==2)
        {
            return "Fixed price";
        }
        
    }

  

     public function GetHowLongText($id){
        
        if($id==1)
        {
            return "More than 6 month";
        }
        if($id==2)
        {
            return "3 to 6 month";
        }
        if($id==3)
        {
            return "1 to 3 months";
        }
        if($id==4)
        {
            return "Less than 1 month";
        }
        if($id==5)
        {
            return "Less than 1 week";
        }

    }





    public function GetCommitmentText($id){
        
        if($id==1)
        {
            return "More then 30 hrs/week";
        }
        if($id==2)
        {
            return "Less than 30 hrs/week";
        }
        if($id==3)
        {
            return "I don't know yet";
        }
    }

     



    public function Isfvrtuser($UserId,$fvrtuser_id) {
        $result = Favouriteuser::model()->find("user_id='".$UserId."' AND fvrtuser_id = '".$fvrtuser_id."'");
        if (!empty($result)) {           
                $valid = '1';            
        } else {
            $valid = '0';
        }
        return $valid;
    }
    public function Isfvrtpost($UserId,$post_id) {
        $result = Postlike::model()->find("user_id='".$UserId."' AND post_id = '".$post_id."'");
        if (!empty($result)) {           
                $valid = '1';            
        } else {
            $valid = '0';
        }
        return $valid;
    }

    public function IsContactuser($UserId,$contact_user_id) {
        $result = UserContact::model()->find("user_id='".$UserId."' AND contact_user_id = '".$contact_user_id."'");
        if (!empty($result)) {           
                $valid = '1';            
        } else {
            $valid = '0';
        }
        return $valid;
    }


    function crypto_rand_secure($min, $max) {
        $range = $max - $min;
        if ($range < 1)
            return $min; // not so random...
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

    function getToken($length) {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max - 1)];
        }

        return $token;
    }

    public function distance($lat1, $lon1, $lat2, $lon2, $unit="M") {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
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
        if (!$full)
            $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . '' : 'just now';
    }

    function day_remaining($datetime) {
        if($datetime=="0000-00-00 00:00:00" || empty($datetime))
        {
            return "0";
        }
        $date1=date('Y-m-d H:i:s');
        $date2=$datetime;
        
          $date1_ts = strtotime($date1);
          $date2_ts = strtotime($date2);
          $diff = $date2_ts - $date1_ts;
          return round($diff / 86400)."";
        
    }


/*

    public function checkUserCompleteStep($user_id)
    {               

                    $business_step = 0;
                    $experience_step = 0;
                    $skill_step = 0;
                    $agreement_step = 0;
                    $payment_step = 0;
                    



                    $checkDataList =  User::model()->find("id = '" . $user_id . "' ");
                    if ($checkDataList) {
                        $userID = $checkDataList['id'];


                         if ($checkDataList->business_name == "" || $checkDataList->business_type == "" || $checkDataList->business_category == "" || $checkDataList->business_osnap_id == "" || $checkDataList->business_owner == "" /*|| $checkDataList->business_image == "") {
                            
                            $business_step = 0;
                        } else {
                            
                            $business_step = 1;
                        }

                        $connection = Yii::app()->db;
                        $sql1 = "SELECT * from user_experience where user_id=" . $checkDataList->id;
                        $command1 = Yii::app()->db->createCommand($sql1);
                        $explist = $command1->queryAll();
                       if (!empty($explist)) {
                        
                            $experience_step = 1;
                        } else {
                            $experience_step = 0;
                        }


                        $connection = Yii::app()->db;
                        $sql2 = "SELECT * from user_skill where user_id=" . $checkDataList->id;
                        $command2 = Yii::app()->db->createCommand($sql2);
                        $skilllist = $command2->queryAll();
                        if (!empty($skilllist)) {
                            
                            $skill_step = 1;
                        } else {
                            $skill_step = 0;
                        }


                        if ($checkDataList->is_agree == "0") {
                            $agreement_step = 0;
                        } else {
                            $agreement_step = 1;
                        }
                        $payment_step = 1;

                        

                        if($business_step == 1 && $experience_step == 1 && $skill_step == 1 && $agreement_step == 1 && $payment_step == 1 )
                        {
                            retun "1";
                        }
                        else
                        {
                            retun "0";
                        }
                    } else {
                        retun "0";
                    }
                
    }
*/
    /**
     * @Method        : POST
     * @Params        :
     * @author        : Dharmesh
     * @created       : July 25 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : User Registration.
     * */
    public function actionUserRegistration() {
        $res = array();
        $response = array();
        $getUserData = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        //print_r($apiData);
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['first_name']) || empty($apiData['data']['first_name'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passfirstname", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['last_name']) || empty($apiData['data']['last_name'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlastname", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['birth_date']) || empty($apiData['data']['birth_date'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passbirthdate", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['country_code']) || empty($apiData['data']['country_code'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passcountrycode", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['phone']) || empty($apiData['data']['phone'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passphone", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['email']) || empty($apiData['data']['email'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passemail", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['username']) || empty($apiData['data']['username'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passusername", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['password']) || empty($apiData['data']['password'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpassword", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['osnap_id']) || empty($apiData['data']['osnap_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passosnapid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['address']) || empty($apiData['data']['address'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passaddress", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['latitude']) || empty($apiData['data']['latitude'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlatitude", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['longtitude']) || empty($apiData['data']['longtitude'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlongtitude", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['city']) || empty($apiData['data']['city'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passcity", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['state']) || empty($apiData['data']['state'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passstate", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['country']) || empty($apiData['data']['country'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passcountry", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        /*if (!isset($apiData['data']['post_code']) || empty($apiData['data']['post_code'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpostcode", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }*/
        //echo "ddd";
        if (!isset($apiData['data']['user_type']) || empty($apiData['data']['user_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passusertype", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
       /* if (!isset($apiData['data']['security_code']) || empty($apiData['data']['security_code'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passsecuritycode", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }*/
        if (!isset($apiData['data']['device_type']) || empty($apiData['data']['device_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passdevicetype", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        //echo "ddd";
        if (!isset($apiData['data']['device_token']) || empty($apiData['data']['device_token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passdevicetoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }

        //facebook login

        if ((isset($apiData['data']['auth_provider']) && $apiData['data']['auth_provider'] == 'facebook')) {

            if (!isset($apiData['data']['auth_id']) || empty($apiData['data']['auth_id'])) {
                $response['status'] = "0";
                $response['message'] = $this->GetNotification("passauthid", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            } else {
                $checkDataList = User::model()->find("auth_id = '" . $apiData['data']['auth_id'] . "' and auth_provider= '" . $apiData['data']['auth_provider'] . "'");
                if (!empty($checkDataList)) {
                    if ($checkDataList->is_active == 1) {
                        $userID = $checkDataList->id;
                        $activation_code = $this->random_string(6);
                        //$apiData['data']['token'] = $this->getToken(120);
                        $userUpdateData = $this->loadModel($userID, 'User');
                        $userUpdateData->device_type = $apiData['data']['device_type'] . '';
                        $userUpdateData->device_token = $apiData['data']['device_token'] . '';
                        $userUpdateData->token = $this->getToken(120);
                        $userUpdateData->save(false);
                        $response['status'] = "1";
                        $response['message'] = $this->GetNotification("loginsuccess", $lang);

                        $response['data']['id'] = $userUpdateData->attributes['id'] . '';
                        $response['data']['first_name'] = $userUpdateData->attributes['first_name'] . '';
                        $response['data']['last_name'] = $userUpdateData->attributes['last_name'] . '';
                        $response['data']['licenceno'] = $userUpdateData->attributes['licenceno'] . '';
                        $response['data']['licenceverify'] = $userUpdateData->attributes['licenceverify'] . '';
                        $response['data']['phoneverify'] = 1;
                        $response['data']['emailverify'] = 1;
                        $response['data']['state'] = $userUpdateData->attributes['state'] . '';
                        $response['data']['country'] = $userUpdateData->attributes['country'] . '';
                        $response['data']['city'] = $userUpdateData->attributes['city'] . '';
                        $response['data']['work'] = $userUpdateData->attributes['work'] . '';
                        $response['data']['language'] = $userUpdateData->attributes['language'] . '';
                        $response['data']['email'] = $userUpdateData->attributes['email'] . '';
                        $response['data']['phone'] = $userUpdateData->attributes['phone'] . '';
                        $response['data']['country_code'] = $userUpdateData->attributes['country_code'] . '';
                        $response['data']['profile_image'] = $userUpdateData->attributes['profile_image'] . '';
                        $response['data']['token'] = $userUpdateData->attributes['token'] . '';
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['status'] = "3";
                        $response['message'] = $this->GetNotification("plzactive", $lang);
                        $checkDataList = User::model()->find("auth_id = '" . $apiData['data']['auth_id'] . "' and auth_provider= '" . $apiData['data']['auth_provider'] . "'");
                        $response['data']['phone'] = $checkDataList->phone;
                        $response['data']['country_code'] = $checkDataList->country_code;
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    if (!isset($apiData['data']['country_code']) || empty($apiData['data']['country_code'])) {
                        $response['status'] = "4";
                        $response['message'] = $this->GetNotification("passccode", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }

                    if (!isset($apiData['data']['phone']) || empty($apiData['data']['phone'])) {
                        $response['status'] = "4";
                        $response['message'] = $this->GetNotification("passphone", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }

                    $checkuserEmailId = $this->EmailExist(strtolower($apiData['data']['email']));
                    $checkphone = $this->PhoneExist(strtolower($apiData['data']['phone']));
                    //|| $checkphone == '1'
                    if ($checkuserEmailId == '1' ) {
                       /* if ($checkuserEmailId == 1) {
                            $response['status'] = "0";
                            $response['message'] = $this->GetNotification("emailexist", $lang);
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode($response);
                            exit();
                        }*/
                      /*  if ($checkphone == 1) {
                            $response['status'] = "0";
                            $response['message'] = $this->GetNotification("phonealrdy", $lang);
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode($response);
                            exit();
                        }*/
                    }

                    $activation_code = $this->random_string(6);
                    $apiData['data']['token'] = $this->getToken(120);
                    $userRegistration = User::userRegistration($apiData, $activation_code, 1);
                    if ($userRegistration == "00") {
                        $response['status'] = "0";
                        $response['message'] = $this->GetNotification("noisnotvalid", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }
                    if ($userRegistration != "0") {
                        $email = $userRegistration->attributes['email'];
                        $pin = $userRegistration->attributes['activation_code'];
                        $uid = $userRegistration->attributes['id'];
                        /* if($userRegistration->attributes['user_type'] != 1){ */
                        //$send_mail = User::sendWelcomeMail($email,$pin,$uid);
                        /* } */
                        // Code - Registration successfully response
                        $response['status'] = "1";
                        $response['message'] = $this->GetNotification("registersuccess", $lang);
                        $response['data']['id'] = $userRegistration->attributes['id'] . '';
                        $response['data']['first_name'] = $userRegistration->attributes['first_name'] . '';
                        $response['data']['last_name'] = $userRegistration->attributes['last_name'] . '';
                        $response['data']['licenceno'] = $userRegistration->attributes['licenceno'] . '';
                        $response['data']['licenceverify'] = $userRegistration->attributes['licenceverify'] . '';

                        $response['data']['phoneverify'] = 1;
                        $response['data']['emailverify'] = 1;


                        $response['data']['state'] = $userRegistration->attributes['state'] . '';
                        $response['data']['country'] = $userRegistration->attributes['country'] . '';
                        $response['data']['city'] = $userRegistration->attributes['city'] . '';
                        $response['data']['work'] = $userRegistration->attributes['work'] . '';
                        $response['data']['language'] = $userRegistration->attributes['language'] . '';
                        $response['data']['email'] = $userRegistration->attributes['email'] . '';
                        $response['data']['phone'] = $userRegistration->attributes['phone'] . '';
                        $response['data']['profile_image'] = $userRegistration->attributes['profile_image'] . '';
                        $response['data']['token'] = $userRegistration->attributes['token'] . '';
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    } else {
                        // Code - Registration fail due to any reason response
                        $response['status'] = "0";
                        $response['message'] = $this->GetNotification("registerfail", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }
                }
            }
        }else {
            if (!isset($apiData['data']['password']) && empty($apiData['data']['password'])) {

                $response['status'] = "0";
                $response['message'] = $this->GetNotification("passpassword", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            } else {

                // Email id/username already exists or not code

               // $checkuserEmailId = $this->EmailExist($apiData['data']['email']);

              //  $checkphone = $this->PhoneExist($apiData['data']['phone']);

                $checkosnap = $this->OsnapExist($apiData['data']['osnap_id']);

                $checkusername = $this->UsernameExist($apiData['data']['username']);
                //$checkuserEmailId == '1' ||
                if (  $checkosnap == '1' || $checkusername == '1') {
                   /* if ($checkuserEmailId == 1) {
                        $response['status'] = "0";
                        $response['message'] = $this->GetNotification("emailexist", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }*/
                   /* if ($checkphone == 1) {
                        $response['status'] = "0";
                        $response['message'] = $this->GetNotification("phoneexist", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }*/

                    if ($checkosnap == 1) {
                        $response['status'] = "0";
                        $response['message'] = $this->GetNotification("onsapexist", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }
                    if ($checkusername == 1) {
                        $response['status'] = "0";
                        $response['message'] = $this->GetNotification("usernameexist", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }
                } else {

                    $subscribeArray = array();
                   

                  //  echo "dd";



                    $activation_code = $this->random_string(6);
                    $userRegistration = new User();

                    if (isset($apiData['data']['image']) && !empty($apiData['data']['image'])) {
                        $userRegistration->image = $apiData['data']['image'];
                    }
                    $userRegistration->first_name = $apiData['data']['first_name'];
                    $userRegistration->last_name = $apiData['data']['last_name'];
                    $userRegistration->birth_date = $apiData['data']['birth_date'];
                    $userRegistration->country_code = $apiData['data']['country_code'];
                    $userRegistration->phone = $apiData['data']['phone'];
                   // $userRegistration->security_code = $apiData['data']['security_code'];
                    $userRegistration->email = $apiData['data']['email'];
                    $userRegistration->username = $apiData['data']['username'];
                    $userRegistration->password = md5($apiData['data']['password']);
                    $userRegistration->osnap_id = $apiData['data']['osnap_id'];
                    $userRegistration->post_code = $apiData['data']['post_code']."";

                    $userRegistration->address = $apiData['data']['address'];
                    $userRegistration->latitude = $apiData['data']['latitude'];
                    $userRegistration->longtitude = $apiData['data']['longtitude'];
                    $userRegistration->city = $apiData['data']['city'];
                    $userRegistration->state = $apiData['data']['state'];
                    $userRegistration->country = $apiData['data']['country'];


                    $userRegistration->user_type = $apiData['data']['user_type'];
                    $userRegistration->device_type = $apiData['data']['device_type'];
                    $userRegistration->device_token = $apiData['data']['device_token'];
                    $userRegistration->is_active = 0;
                    $userRegistration->activation_code = $activation_code;

                    $userRegistration->created_at = date('Y-m-d H:i:s');


                    /* if ($userRegistration == "00") {
                      $response['status'] = "0";
                      $response['message'] = $this->GetNotification("noisnotvalid",$lang);
                      header('Content-Type: application/json; charset=utf-8');
                      echo json_encode($response);
                      exit();
                      } */
                    if ($userRegistration->save(false)) {

                        $userID = $userRegistration->attributes['id'];

                       
                       


                        $email = $apiData['data']['email'];
                        $name = $apiData['data']['first_name'] . " " . $apiData['data']['last_name'];
                        $p = User::RegisterVerificationMail($email, $name, $activation_code);

                        $response['status'] = "3";
                        $response['message'] = $this->GetNotification("registersuccess", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    } else {
                        // Code - Registration fail due to any reason response
                        $response['status'] = "0";
                        $response['message'] = $this->GetNotification("registerfail", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }
                }
            }
        }
    }

    /**
     * @Method        : POST
     * @Params        : usertype,username,password
     * @author        : Vijay   
     * @created       : July 27 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Edit User Detail
     * */
    public function actionSubscribeUser() {
        $res = array();
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {

            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
                    if ( (isset($apiData['data']['card_id']) && !empty($apiData['data']['card_id']) ) && (isset($apiData['data']['is_free_trial']) && !empty($apiData['data']['is_free_trial']) ) )
                    {
                        $response['status'] = "0";
                        $response['message'] = $this->GetNotification("pleasecheckanyoption", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }

                   
                    if (isset($apiData['data']['card_id']) && !empty($apiData['data']['card_id'])) {
                       
                        $carddetails = Usercard::model()->find("card_id ='" . $apiData['data']['card_id'] . "'");
                        $UsercardArray = array();
                        $UsercardArray['cardtoken'] = $customer->id;
                        $UsercardArray['cardnumber'] = $customer->sources->data[0]->last4;
                        $UsercardArray['is_default'] = "1"; 
                        $UsercardArray['brand'] = $customer->sources->data[0]->brand;
                        $UsercardArray['created_at'] = date("Y-m-d H:i:s");
                        
                        try
                        {
                            $developing  = "sk_test_tUe7byxtLFAZAfKm4JdRqSe9";
                            \Stripe\Stripe::setApiKey($developing);
                            $charge = \Stripe\Charge::create([
                                            "amount" => 1 * 100,
                                            "currency" => "USD",
                                            "customer" => $carddetails->cardtoken,
                                            "description" => "Charges for osnap subscription"
                            ]);

                            $userID = $apiData['data']['id'];
                            $userUpdateData = $this->loadModel($userID, 'User');
                           
                            $userUpdateData->is_agree = 1;
                            $userUpdateData->is_subscribe = 1;
                            $userUpdateData->is_recurring = 1;  
                            

                            $current_date = date('Y-m-d H:i:s');

                            $today_datetime = $current_date;
                            $current_date = strtotime($current_date);                           
                            $expire_date = strtotime("+1 year", $current_date);
                            $expire_date = date('Y-m-d H:i:s', $expire_date);

                            $userUpdateData->expiration_datetime = $expire_date;



                            $UserSubscriptionLogData = new UserSubscriptionLog();
                            $UserSubscriptionLogData->user_id = $userID;
                            $UserSubscriptionLogData->start_date = $today_datetime;
                            $UserSubscriptionLogData->end_date = $expire_date;
                            $UserSubscriptionLogData->is_free_trial = "0";
                            $UserSubscriptionLogData->payment_info = json_encode($charge);
                            $UserSubscriptionLogData->created_at = $today_datetime;
                            $UserSubscriptionLogData->save(false);

                            $userUpdateData->save(false);

                            $response['status'] = "1";
                            $response['message'] = $this->GetNotification("subscribeSuccess", $lang);
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode($response);
                            exit();


                        }
                        catch (Exception $e) 
                        {
                             $response['status'] = "0";
                             $response['message'] = $this->GetNotification("failedtochargecard", $lang);
                             $response['data'] = $e->getMessage();
                             header('Content-Type: application/json; charset=utf-8');
                             echo json_encode($response);
                             exit();
                         }

                    }
                    if(isset($apiData['data']['is_free_trial']) && !empty($apiData['data']['is_free_trial']))
                    {
                     
                        $userID = $apiData['data']['id'];
                        $userUpdateData = $this->loadModel($userID, 'User');
                        $userUpdateData->is_agree = 1;
                        $userUpdateData->is_subscribe = 0;
                        $userUpdateData->is_recurring = 0;
                        $current_date = date('Y-m-d H:i:s');
                        $today_datetime = $current_date;
                        $current_date = strtotime($current_date);                           
                        $expire_date = strtotime("+3 month", $current_date);
                        $expire_date = date('Y-m-d H:i:s', $expire_date);
                        $userUpdateData->expiration_datetime = $expire_date;
                        $userUpdateData->save(false);


                        $UserSubscriptionLogData = new UserSubscriptionLog();
                        $UserSubscriptionLogData->user_id = $userID;
                        $UserSubscriptionLogData->start_date = $today_datetime;
                        $UserSubscriptionLogData->end_date = $expire_date;
                        $UserSubscriptionLogData->is_free_trial = "1";
                        $UserSubscriptionLogData->created_at = $today_datetime;
                        $UserSubscriptionLogData->save(false);

                        $response['status'] = "1";
                        $response['message'] = $this->GetNotification("subscribeSuccess", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();

                    }

            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    /**
     * @Method        : POST
     * @Params        : 
     * @author        : Dharmesh
     * @created       : July 25 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Resend user account verification code.
     * */
    public function actionResendUserVerificationCode() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $proData['data']['lang_type'];
        /* if(!isset($apiData['data']['phone']) || empty($apiData['data']['phone'])){
          $response['status'] = "0";
          $response['message'] = $this->GetNotification("passphone",$lang);
          header('Content-Type: application/json; charset=utf-8');
          echo json_encode($response);
          exit();
          }
          if(!isset($apiData['data']['country_code']) || empty($apiData['data']['country_code'])){
          $response['status'] = "0";
          $response['message'] = $this->GetNotification("passccode",$lang);
          header('Content-Type: application/json; charset=utf-8');
          echo json_encode($response);
          exit();
          } */
        if (!isset($apiData['data']['email']) || empty($apiData['data']['email'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passemail", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkData = User::model()->find("email ='" . $apiData['data']['email'] . "'");
            //print_r($checkData);
            if (!empty($checkData)) {

                $userID = $checkData['id'];
                $userUpdateData = $this->loadModel($userID, 'User');
                $activation_code = $this->random_string(6);
                $userUpdateData->is_active = 0;
                $userUpdateData->activation_code = $activation_code;
                $userUpdateData->save(false);

                $email = $userUpdateData->attributes['email'];
                $name = $userUpdateData->attributes['first_name'] . " " . $userUpdateData->attributes['last_name'];

                $p = User::RegisterVerificationMail($email, $name, $activation_code);

                $response['status'] = '1';
                $response['message'] = $this->GetNotification("resendsuccess", $type);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
                /*
                  $type = $apiData['data']['lang_type'];

                  $msg = $this->GetNotification("geoverification",$type). $activation_code;


                  //  $msg = 'Your Wave verify code is ' . $activation_code;

                  curl_setopt($ch, CURLOPT_URL, Yii::app()->request->hostInfo . Yii::app()->baseUrl . "/sms.php");
                  curl_setopt($ch, CURLOPT_POST, 1);
                  curl_setopt($ch, CURLOPT_POSTFIELDS, "phone=$phone&msg=$msg");

                  // in real life you should use something like:
                  // curl_setopt($ch, CURLOPT_POSTFIELDS,
                  //          http_build_query(array('postvar1' => 'value1')));
                  // receive server response ...
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                  $server_output = curl_exec($ch);

                  curl_close($ch);
                  //echo $server_output;
                  if ($server_output == "1") {
                  $userUpdateData->is_active = 0;
                  $userUpdateData->activation_code = $activation_code;
                  $userUpdateData->save(false);
                  $response['status'] = '1';

                  $response['message'] = $this->GetNotification("resendsuccess",$type);
                  header('Content-Type: application/json; charset=utf-8');
                  echo json_encode($response);
                  exit();
                  } else {
                  $response['status'] = '0';
                  $response['message'] = $this->GetNotification("resendfail",$type);
                  header('Content-Type: application/json; charset=utf-8');
                  echo json_encode($response);
                  exit();
                  } */
            } else {
                $response['status'] = "0";
                $response['message'] = $this->GetNotification("usernotexist", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    /**
     * @Method        : POST
     * @Params        : usertype,username,password
     * @author        : Dharmesh
     * @created       : July 25 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : verify user.
     * */
    public function actionVerifyUser() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['email']) || empty($apiData['data']['email'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passemail", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
         if (!isset($apiData['data']['username']) || empty($apiData['data']['username'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passusername", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        /* if(!isset($apiData['data']['phone']) || empty($apiData['data']['phone'])){
          $response['status'] = "0";
          $response['message'] = $this->GetNotification("passphone",$lang);
          header('Content-Type: application/json; charset=utf-8');
          echo json_encode($response);
          exit();
          }
          if(!isset($apiData['data']['country_code']) || empty($apiData['data']['country_code'])){
          $response['status'] = "0";
          $response['message'] = $this->GetNotification("passccode",$lang);
          header('Content-Type: application/json; charset=utf-8');
          echo json_encode($response);
          exit();
          } */
        if (!isset($apiData['data']['device_type']) || empty($apiData['data']['device_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passdevicetype", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['device_token']) || empty($apiData['data']['device_token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passdevicetoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['activation_code']) || empty($apiData['data']['activation_code'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passactivationcode", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkData = User::model()->find("email ='" . $apiData['data']['email'] . "' and username='". $apiData['data']['username'] ."'");
            //print_r($checkData);
            if (!empty($checkData)) {
                $activation_code = $checkData['activation_code'];
                $_activation_code = $apiData['data']['activation_code'];
                if ($activation_code == $_activation_code) {
                    $userID = $checkData['id'];

                    $userRegistration = $this->loadModel($userID, 'User');
                    $userRegistration->is_active = '1';
                    $userRegistration->device_type = $apiData['data']['device_type'];
                    $userRegistration->device_token = $apiData['data']['device_token'];
                    //echo "dd";
                    //echo $this->getToken(64);
                    $userRegistration->token = $this->getToken(120);

                    if ($userRegistration->save(false)) {
                        $response['status'] = "1";
                        $response['message'] = $this->GetNotification("activationsuccess", $lang);

                        $response['data']['id'] = $userRegistration->attributes['id'] . '';
                        $response['data']['first_name'] = $userRegistration->attributes['first_name'] . '';
                        $response['data']['last_name'] = $userRegistration->attributes['last_name'] . '';
                        $response['data']['user_type'] = $userRegistration->attributes['user_type'] . '';
                        $response['data']['time_ago'] = $this->time_diffrent($userRegistration->attributes['created_at']);

                        $response['data']['business_name'] = $userRegistration->attributes['business_name'] . "";

                        $is_security_code_exist = "0";     
                        if($userRegistration->attributes['security_code']!="" && $userRegistration->attributes['security_code']!=0 )
                        {
                            $is_security_code_exist = "1";     
                        }
                        $response['data']['security_code_exist'] = $is_security_code_exist . "";



                        $response['data']['business_type_id'] = $userRegistration->attributes['business_type'] . "";
                        $response['data']['business_type'] = GlobalFunction::getBusinessTypes($userRegistration->attributes['business_type']) . "";

                        $response['data']['business_category'] = $userRegistration->attributes['business_category'] . "";
                        $response['data']['business_category_name'] =  $this->GetBusinessCategoryName($userRegistration->attributes['business_category']);
                        $response['data']['business_osnap_id'] = $userRegistration->attributes['business_osnap_id'] . "";

                        $response['data']['business_esta_month'] = $userRegistration->attributes['business_esta_month'] . "";

                        $response['data']['business_esta_year'] = $userRegistration->attributes['business_esta_year'] . "";


                        $response['data']['business_owner'] = $userRegistration->attributes['business_owner'] . "";
                        $response['data']['business_notes'] = $userRegistration->attributes['business_notes'] . "";
                        
                        $response['data']['exp_level'] = $userRegistration->attributes['exp_level'] . "";
                        $response['data']['business_image'] = $userRegistration->attributes['business_image'] . "";

                        if ($userRegistration->attributes['business_name'] == "" || $userRegistration->attributes['business_type'] == "" || $userRegistration->attributes['business_category'] == "" || $userRegistration->attributes['business_osnap_id'] == "" ||  $userRegistration->attributes['business_owner'] == "" /*|| $userRegistration->attributes['business_image'] == ""*/) {
                            $response['data']['business_step'] = 0;
                        } else {
                            $response['data']['business_step'] = 1;
                        }

                        if($userRegistration->attributes['stripe_user_id']=="")
                        {
                            $response['data']['stripe_step'] = 0;
                        }
                        else
                        {
                            $response['data']['stripe_step'] = 1;
                        }

                        $connection = Yii::app()->db;
                        $sql1 = "SELECT * from user_experience where user_id=" . $userRegistration->attributes['id'];
                        $command1 = Yii::app()->db->createCommand($sql1);
                        $explist = $command1->queryAll();
                       if (!empty($explist)) {
                        $exparray = array();
                        $professional_experience = "";
                        $education = "";
                        foreach ($explist as $key => $value) {
                            $temp = array();
                            $exid = $value['id'];
                            $temp['id'] = $exid;
                            $professional_experience = $value['professional_experience'] . "";
                            $education_id = $value['education_id'] ;
                            $child1 = $value['child1'] ;
                            $child2 = $value['child2'] ;
                            $child1value = $value['child1value'] ;
                            $child2value = $value['child2value'] ;
                            $temp['company_name'] = $value['company_name'] . "";
                            $temp['from_month'] = $value['from_month'];
                            $temp['from_year'] = $value['from_year'];
                            $temp['to_month'] = $value['to_month'];
                            $temp['to_year'] = $value['to_year'];
                            $temp['is_current'] = $value['is_current'];
                            $exparray[] = $temp;
                        }
                        $response['data']['user_exp'] = $exparray;
                        $response['data']['professional_experience'] = $professional_experience;
                        $response['data']['education_id'] = $education_id;
                        $response['data']['education_id_name'] = $this->GetEducationName($education_id);
                        $response['data']['child1'] = $child1;
                        $response['data']['child1_name'] = $this->GetEducationName($child1);
                        $response['data']['child2'] = $child2;
                        $response['data']['child2_name'] = $this->GetEducationName($child2);
                        $response['data']['child1value'] = $child1value;
                        $response['data']['child2value'] = $child2value;
                        $response['data']['experience_step'] = 1;
                    } else {
                        $response['data']['user_exp'] = [];
                        $response['data']['professional_experience'] = "";
                        $response['data']['education_id'] = "";
                        $response['data']['education_id_name'] = "";
                        $response['data']['child1'] = "";
                        $response['data']['child1_name'] = "";
                        $response['data']['child2'] = "";
                        $response['data']['child2_name'] = "";
                        $response['data']['child1value'] = "";
                        $response['data']['child2value'] = "";
                        $response['data']['experience_step'] = 0;
                    }


                        $connection = Yii::app()->db;
                        $sql2 = "SELECT * from user_skill where user_id=" . $userRegistration->attributes['id'];
                        $command2 = Yii::app()->db->createCommand($sql2);
                        $skilllist = $command2->queryAll();
                        if (!empty($skilllist)) {
                            $skillarray = array();
                            foreach ($skilllist as $key => $value) {
                                $temp = array();
                                $skillid = $value['id'];
                                $temp['id'] = $skillid;
                                $temp['service_name'] = $value['service_name'] . "";
                                $temp['category_id'] = $value['category_id'];
                                $temp['subcategory_id'] = $value['subcategory_id'];

                                $temp['category_name'] = $this->GetCategoryName($value['category_id']);
                                $temp['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);

                                $temp['price'] = $value['price'];
                                $temp['price_type'] = $value['price_type'];
                                $temp['start_time'] = $value['start_time'];
                                $temp['end_time'] = $value['end_time'];
                                $temp['description'] = $value['description'];
                                $temp['service_photo'] = ( (!empty($value['service_photo']) && $value['service_photo']!="null" ) ?  json_decode($value['service_photo']) : [] );
                                $skillarray[] = $temp;
                            }
                            $response['data']['user_skill'] = $skillarray;
                            $response['data']['skill_step'] = 1;
                        } else {
                            $response['data']['user_skill'] = [];
                            $response['data']['skill_step'] = 0;
                        }


                        $response['data']['birth_date'] = $userRegistration->attributes['birth_date'] . '';
                        $response['data']['country_code'] = $userRegistration->attributes['country_code'] . '';

                        $response['data']['phone'] = $userRegistration->attributes['phone'] . '';
                        $response['data']['email'] = $userRegistration->attributes['email'] . '';
                        $response['data']['username'] = $userRegistration->attributes['username'] . '';
                        $response['data']['osnap_id'] = $userRegistration->attributes['osnap_id'] . '';
                        $response['data']['image'] = $userRegistration->attributes['image'] . '';

                        $response['data']['post_code'] = $userRegistration->attributes['post_code'] . '';

                        $response['data']['address'] = $userRegistration->attributes['address'] . '';
                        $response['data']['latitude'] = $userRegistration->attributes['latitude'] . '';
                        $response['data']['longtitude'] = $userRegistration->attributes['longtitude'] . '';
                        $response['data']['city'] = $userRegistration->attributes['city'] . '';
                        $response['data']['state'] = $userRegistration->attributes['state'] . '';
                        $response['data']['country'] = $userRegistration->attributes['country'] . '';


                        $response['data']['device_type'] = $userRegistration->attributes['device_type'] . '';
                        $response['data']['device_token'] = $userRegistration->attributes['device_token'] . '';
                        $response['data']['is_agree'] = $userRegistration->attributes['is_agree'] . '';

                        if ($userRegistration->attributes['is_agree'] == "0") {
                            $response['data']['agreement_step'] = 0;
                        } else {
                            $response['data']['agreement_step'] = 1;
                        }
                        $response['data']['payment_step'] = 1;


                        $sql6 = "SELECT * from `user_review` where user_id = " . $userRegistration->attributes['id'] . " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];


                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }
                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data']['ratearray'] = $ratearray;
                        $response['data']['avgrate'] = round($avg,2)."";

                        $sql8 = "SELECT * from `user_licenses` where user_id = " .$userRegistration->attributes['id'];
                        $command8 = Yii::app()->db->createCommand($sql8);
                        $licensesdata = $command8->queryAll();
                        $licensesarray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($licensesdata)) {
                            $gaarray = array();
                            foreach ($licensesdata as $key7 => $val7) {
                                
                                    $temparray = array();

                                    $temparray['name'] = $val7['name'];
                                    $temparray['month'] = $val7['month'];
                                    $temparray['year'] = $val7['year'];
                                    $temparray['ul_id'] = $val7['ul_id'];
                                    
                                    $licensesarray[] = $temparray;
                            }
                           
                        }
                        $response['data']['licensesarray'] = $licensesarray;

                        $response['data']['token'] = $userRegistration->attributes['token'] . '';

                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['status'] = "0";
                        $response['message'] = $this->GetNotification("activationfail", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("correctvercode", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "0";
                $response['message'] = $this->GetNotification("usernotexist", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    /**

     * @Method        : POST
     * @Params        : usertype,username,password
     * @author        : Dharmesh
     * @created       : July 25 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Check Login.
     * */
    public function actionCheckLogin() {
        $res = array();
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        // Complusory Field Validation Code
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        /* if(!isset($apiData['data']['email']) || empty($apiData['data']['email'])){
          $response['status'] = "0";
          $response['message'] = $this->GetNotification("passemail",$lang);
          header('Content-Type: application/json; charset=utf-8');
          echo json_encode($response);
          exit();
          } */
        /* if(!isset($apiData['data']['osnap_id']) || empty($apiData['data']['osnap_id'])){
          $response['status'] = "0";
          $response['message'] = $this->GetNotification("passosnapid",$lang);
          header('Content-Type: application/json; charset=utf-8');
          echo json_encode($response);
          exit();
          } */
        if (!isset($apiData['data']['username']) || empty($apiData['data']['username'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passusername", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['password']) || empty($apiData['data']['password'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpassword", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['device_type']) || empty($apiData['data']['device_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passdevicetype", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['device_token']) || empty($apiData['data']['device_token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passdevicetoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {

            // Code - Login user email exists or not
            $checkEmailExist = User::model()->find("username = '" . $apiData['data']['username'] . "'  AND password = '" . md5($apiData['data']['password']) . "' ");
            if ($checkEmailExist) {
                // Code - Login user email verified or not
                $_checkEmailExist = User::model()->find("username = '" . $apiData['data']['username'] . "' AND is_active='1' ");
                if ($_checkEmailExist) {
                    // Code - Check email and Password match or not
                    $checkDataList = User::model()->find("username = '" . $apiData['data']['username'] . "' AND password = '" . md5($apiData['data']['password']) . "'");
                    if ($checkDataList) {
                        $userID = $checkDataList['id'];

                        


                        $userUpdateData = $this->loadModel($userID, 'User');
                        //print_r($userUpdateData);
                        $userUpdateData->device_type = $apiData['data']['device_type'];
                        $userUpdateData->device_token = $apiData['data']['device_token'];


                        //echo "dd";
                        //echo $this->getToken(64);
                        $userUpdateData->token = $this->getToken(120);
                        $userUpdateData->save(false);
                        $checkDataList = User::model()->find("username = '" . $apiData['data']['username'] . "' AND password = '" . md5($apiData['data']['password']) . "'");

                        $response['status'] = "1";
                        $response['message'] = $this->GetNotification("loginsuccess", $lang);


                        $response['data']['id'] = ($checkDataList->id) ? $checkDataList->id : '';
                        $response['data']['token'] = ($checkDataList->token) ? $checkDataList->token : '';
                        $response['data']['first_name'] = $checkDataList->first_name . "";


                        $response['data']['last_name'] = $checkDataList->last_name . "";
                        $response['data']['user_type'] = $checkDataList->user_type . "";
                        $response['data']['time_ago'] = $this->time_diffrent($checkDataList->created_at);

                        $response['data']['is_subscribe'] = $checkDataList->is_subscribe . "";
                        $response['data']['is_recurring'] = $checkDataList->is_recurring . "";
                        $response['data']['expiration_datetime'] = $checkDataList->expiration_datetime . "";
                        $response['data']['day_remaining'] = $this->day_remaining($checkDataList->expiration_datetime);



                        

                        $is_security_code_exist = "0"; 
                        if( $checkDataList->security_code!="" && $checkDataList->security_code!=0 )
                        {
                            $is_security_code_exist = "1";     
                        }
                        $response['data']['security_code_exist'] = $is_security_code_exist . "";

                        $response['data']['business_name'] = $checkDataList->business_name . "";
                        $response['data']['business_type_id'] = $checkDataList->business_type . "";
                        $response['data']['business_type'] = GlobalFunction::getBusinessTypes($checkDataList->business_type) . "";                              
                        $response['data']['business_category'] = $checkDataList->business_category . "";
                        $response['data']['business_category_name'] =  $this->GetBusinessCategoryName($checkDataList->business_category );
                        $response['data']['business_osnap_id'] = $checkDataList->business_osnap_id . "";

                        $response['data']['business_esta_month'] = $checkDataList->business_esta_month . "";
                        $response['data']['business_esta_year'] = $checkDataList->business_esta_year . "";


                        $response['data']['business_owner'] = $checkDataList->business_owner . "";
                        $response['data']['business_notes'] = $checkDataList->business_notes . "";
                        
                        $response['data']['exp_level'] = $checkDataList->exp_level . "";
                        $response['data']['business_image'] = $checkDataList->business_image . "";


                         if ($checkDataList->business_name == "" || $checkDataList->business_type == "" || $checkDataList->business_category == "" || $checkDataList->business_osnap_id == "" || $checkDataList->business_owner == "" /*|| $checkDataList->business_image == ""*/) {
                            
                            $response['data']['business_step'] = 0;
                        } else {
                            
                            $response['data']['business_step'] = 1;
                        }

                        if($checkDataList->stripe_user_id=="")
                        {
                            $response['data']['stripe_step'] = 0;
                        }
                        else
                        {
                            $response['data']['stripe_step'] = 1;
                        }



                        $connection = Yii::app()->db;
                        $sql1 = "SELECT * from user_experience where user_id=" . $checkDataList->id;
                        $command1 = Yii::app()->db->createCommand($sql1);
                        $explist = $command1->queryAll();
                       if (!empty($explist)) {
                        $exparray = array();
                        $professional_experience = "";
                        $education = "";
                        foreach ($explist as $key => $value) {
                            $temp = array();
                            $exid = $value['id'];
                            $temp['id'] = $exid;
                            $professional_experience = $value['professional_experience'] . "";
                            $education_id = $value['education_id'] ;
                            $child1 = $value['child1'] ;
                            $child2 = $value['child2'] ;
                            $child1value = $value['child1value'] ;
                            $child2value = $value['child2value'] ;
                            $temp['company_name'] = $value['company_name'] . "";
                            $temp['from_month'] = $value['from_month'];
                            $temp['from_year'] = $value['from_year'];
                            $temp['to_month'] = $value['to_month'];
                            $temp['to_year'] = $value['to_year'];
                            $temp['is_current'] = $value['is_current'];
                            $exparray[] = $temp;
                        }
                        $response['data']['user_exp'] = $exparray;
                        $response['data']['professional_experience'] = $professional_experience;
                        $response['data']['education_id'] = $education_id;
                        $response['data']['education_id_name'] = $this->GetEducationName($education_id);
                        $response['data']['child1'] = $child1;
                        $response['data']['child1_name'] = $this->GetEducationName($child1);
                        $response['data']['child2'] = $child2;
                        $response['data']['child2_name'] = $this->GetEducationName($child2);
                        $response['data']['child1value'] = $child1value;
                        $response['data']['child2value'] = $child2value;
                        $response['data']['experience_step'] = 1;
                    } else {
                        $response['data']['user_exp'] = [];
                        $response['data']['professional_experience'] = "";
                        $response['data']['education_id'] = "";
                        $response['data']['education_id_name'] = "";
                        $response['data']['child1'] = "";
                        $response['data']['child1_name'] = "";
                        $response['data']['child2'] = "";
                        $response['data']['child2_name'] = "";
                        $response['data']['child1value'] = "";
                        $response['data']['child2value'] = "";
                        $response['data']['experience_step'] = 0;
                    }


                        $connection = Yii::app()->db;
                        $sql2 = "SELECT * from user_skill where user_id=" . $checkDataList->id;
                        $command2 = Yii::app()->db->createCommand($sql2);
                        $skilllist = $command2->queryAll();
                        if (!empty($skilllist)) {
                            $skillarray = array();
                            foreach ($skilllist as $key => $value) {
                                $temp = array();
                                $skillid = $value['id'];
                                $temp['id'] = $skillid;
                                $temp['service_name'] = $value['service_name'] . "";
                                $temp['category_id'] = $value['category_id'];
                                $temp['subcategory_id'] = $value['subcategory_id'];

                                $temp['category_name'] = $this->GetCategoryName($value['category_id']);
                                $temp['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);

                                $temp['price'] = $value['price'];
                                $temp['price_type'] = $value['price_type'];
                                $temp['start_time'] = $value['start_time'];
                                $temp['end_time'] = $value['end_time'];
                                $temp['description'] = $value['description'];
                                $temp['service_photo'] = ( (!empty($value['service_photo']) && $value['service_photo']!="null" ) ?  json_decode($value['service_photo']) : [] );
                                $skillarray[] = $temp;
                            }
                            $response['data']['user_skill'] = $skillarray;
                            $response['data']['skill_step'] = 1;
                        } else {
                            $response['data']['user_skill'] = [];
                            $response['data']['skill_step'] = 0;
                        }


                        $response['data']['birth_date'] = $checkDataList->birth_date . "";
                        $response['data']['country_code'] = $checkDataList->country_code . "";
                        $response['data']['phone'] = $checkDataList->phone . "";
                        $response['data']['email'] = $checkDataList->email . "";
                        $response['data']['username'] = $checkDataList->username . "";
                        $response['data']['osnap_id'] = $checkDataList->osnap_id . "";
                        $response['data']['image'] = $checkDataList->image . "";
                        $response['data']['post_code'] = $checkDataList->post_code . "";

                        $response['data']['address'] = $checkDataList->address . "";
                        $response['data']['latitude'] = $checkDataList->latitude . "";
                        $response['data']['longtitude'] = $checkDataList->longtitude . "";
                        $response['data']['city'] = $checkDataList->city . "";
                        $response['data']['state'] = $checkDataList->state . "";
                        $response['data']['country'] = $checkDataList->country . "";



                        $response['data']['device_type'] = $checkDataList->device_type . "";
                        $response['data']['device_token'] = $checkDataList->device_token . "";
                        $response['data']['is_agree'] = $checkDataList->is_agree . "";

                        if ($checkDataList->is_agree == "0") {
                            $response['data']['agreement_step'] = 0;
                        } else {
                            $response['data']['agreement_step'] = 1;
                        }
                        $response['data']['payment_step'] = 1;

                        $sql6 = "SELECT * from `user_review` where user_id = " . $checkDataList['id']. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];
                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }



                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data']['ratearray'] = $ratearray;
                        $response['data']['avgrate'] = round($avg,2)."";

                        $sql8 = "SELECT * from `user_licenses` where user_id = " . $checkDataList['id'];
                        $command8 = Yii::app()->db->createCommand($sql8);
                        $licensesdata = $command8->queryAll();
                        $licensesarray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($licensesdata)) {
                            $gaarray = array();
                            foreach ($licensesdata as $key7 => $val7) {
                                
                                    $temparray = array();
                                    $temparray['name'] = $val7['name'];
                                    $temparray['month'] = $val7['month'];
                                    $temparray['year'] = $val7['year'];
                                    $temparray['ul_id'] = $val7['ul_id'];
                                    $licensesarray[] = $temparray;
                            }
                           
                        }
                        $response['data']['licensesarray'] = $licensesarray;

                         // multiple location
                        $results = Usercard::model()->findAll("user_id ='".$checkDataList['id']."'");            
                        $multiarray = array();
                        if(!empty($results)){
                            $is_multi = 1;
                            foreach($results as $k => $v){
                                $subarray = array();
                                $subarray['card_id'] = $v->card_id;
                                $subarray['cardnumber'] = $v->cardnumber; 
                                $subarray['exp_month'] = $v->exp_month; 
                                $subarray['exp_year'] = $v->exp_year; 
                                $subarray['is_default'] = $v->is_default;
                                $subarray['brand'] = $v->brand;
                                $multiarray[] = $subarray;
                            }
                        }else{
                            $multiarray = [];
                        }
                        
                        
                        $response['data']['cards'] = $multiarray;


                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    } else {
                        // 'message' Message for invalid email id and password
                        $response['status'] = "0";
                        $response['message'] = $this->GetNotification("loginfail", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $checkDataList = User::model()->find("username = '".$apiData['data']['username']."'");
                    $response['status'] = "3";
                    $response['message'] = $this->GetNotification("plzactive", $lang);
                     $response['data']['email'] = $checkDataList->email;
                   /*   $response['data']['country_code'] =  $checkDataList->country_code; */
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                // Error Message for email does not exists
                $response['status'] = "0";
                $response['message'] = $this->GetNotification("loginfail", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    /**

     * @Method        : POST
     * @Params        : email
     * @author        : Dharmesh
     * @created       : July 25 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Forgot Password.
     * */
    public function actionForgotPassword() {
        $res = array();
        $response = array();
        $new_pass = $this->random_string(6);  // Generated 5 characters password
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        // Complusory Field Validation Code
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['email_or_username']) || empty($apiData['data']['email_or_username'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("email_or_username", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            // Forgot Password and send email for varification code
            $checkEmail = User::model()->find("email='" . $apiData['data']['email_or_username'] . "'");
            //p($checkEmail);           
            if ($checkEmail) {
                if ($checkEmail['is_active'] == 1) {
                    $userID = $checkEmail['id'];
                    $response['status'] = '1';
                    $response['message'] = $this->GetNotification("enter4digitpin", $lang);
                    $response['data']['user_id'] = $userID;
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();


                    // Verify code updated
                    //$userID = $checkEmail['id'];
                    //$username=$checkEmail['first_name']." ".$checkEmail['first_name'];
                    //$updateVerified = $this->loadModel($userID, 'User');
                    //$updateVerified->forget_pass_code = $new_pass;
                    /*  if($updateVerified->save(false)){
                      $response['status']='1';
                      $response['message'] = $this->GetNotification("vcodesent",$lang);
                      //$this->sendForgotPasswordMail($checkEmail['email'],$new_pass,$username);
                      header('Content-Type: application/json; charset=utf-8');
                      echo json_encode($response);
                      exit();
                      }else{
                      // Error Message for verify code update
                      $response['status']='0';
                      $response['message']= $this->GetNotification("vcodeupfail",$lang);
                      header('Content-Type: application/json; charset=utf-8');
                      echo json_encode($response);
                      exit();
                      } */
                } else {
                    // Error Message for verify code update
                    $response['status'] = '3';
                    $response['message'] = $this->GetNotification("plzactive", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {

                $checkEmail = User::model()->find("username='" . $apiData['data']['email_or_username'] . "'");
                //p($checkEmail);
                if ($checkEmail) {
                    if ($checkEmail['is_active'] == 1) {
                        $userID = $checkEmail['id'];
                        $response['status'] = '1';
                        $response['message'] = $this->GetNotification("enter4digitpin", $lang);
                        $response['data']['user_id'] = $userID;
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    } else {
                        // Error Message for verify code update
                        $response['status'] = '3';
                        $response['message'] = $this->GetNotification("plzactive", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    // Error Message for email does not exists
                    $response['status'] = '0';
                    $response['message'] = $this->GetNotification("usernotexist", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            }
        }
    }

    /**

     * @Method        : POST
     * @Params        : email
     * @author        : Dharmesh
     * @created       : Aug 10 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Recover Account.
     * */
    public function actionRecoverAccount() {
        $res = array();
        $response = array();
        $new_pass = $this->random_string(6);  // Generated 5 characters password
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        // Complusory Field Validation Code
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['email_or_phone']) || empty($apiData['data']['email_or_phone'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passemailorphone", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            // Forgot Password and send email for varification code
            $checkEmail = User::model()->find("email='" . $apiData['data']['email_or_phone'] . "'");
            //p($checkEmail);           
            if ($checkEmail) {
                if ($checkEmail['is_active'] == 1) {
                    $userID = $checkEmail['id'];
                    $response['status'] = '1';
                    $response['message'] = $this->GetNotification("enter4digitpin", $lang);
                    $response['data']['user_id'] = $userID;
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();


                    // Verify code updated
                    //$userID = $checkEmail['id'];
                    //$username=$checkEmail['first_name']." ".$checkEmail['first_name'];
                    //$updateVerified = $this->loadModel($userID, 'User');
                    //$updateVerified->forget_pass_code = $new_pass;
                    /*  if($updateVerified->save(false)){
                      $response['status']='1';
                      $response['message'] = $this->GetNotification("vcodesent",$lang);
                      //$this->sendForgotPasswordMail($checkEmail['email'],$new_pass,$username);
                      header('Content-Type: application/json; charset=utf-8');
                      echo json_encode($response);
                      exit();
                      }else{
                      // Error Message for verify code update
                      $response['status']='0';
                      $response['message']= $this->GetNotification("vcodeupfail",$lang);
                      header('Content-Type: application/json; charset=utf-8');
                      echo json_encode($response);
                      exit();
                      } */
                } else {
                    // Error Message for verify code update
                    $response['status'] = '3';
                    $response['message'] = $this->GetNotification("plzactive", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {

                $checkEmail = User::model()->find("phone='" . $apiData['data']['email_or_phone'] . "'");
                //p($checkEmail);           
                if ($checkEmail) {
                    if ($checkEmail['is_active'] == 1) {

                        $userID = $checkEmail['id'];
                        $response['status'] = '1';
                        $response['message'] = $this->GetNotification("enter4digitpin", $lang);
                        $response['data']['user_id'] = $userID;
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    } else {
                        // Error Message for verify code update
                        $response['status'] = '3';
                        $response['message'] = $this->GetNotification("plzactive", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    // Error Message for email does not exists
                    $response['status'] = '0';
                    $response['message'] = $this->GetNotification("usernotexist", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            }
        }
    }

    /**

     * @Method        : POST
     * @Params        : email
     * @author        : Dharmesh
     * @created       : Aug 10 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Check 4 digit pin.
     * */
    public function actionCheck4DigitPin() {
        $res = array();
        $response = array();
        $new_pass = $this->random_string(6);  // Generated 5 characters password
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        // Complusory Field Validation Code
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['user_id']) || empty($apiData['data']['user_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['security_code']) || empty($apiData['data']['security_code'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passsecuritycode", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            // Forgot Password and send email for varification code
            $checkEmail = User::model()->find("id='" . $apiData['data']['user_id'] . "' and security_code=" . $apiData['data']['security_code']);
            //p($checkEmail);           
            if ($checkEmail) {
                $response['status'] = '1';
                $response['message'] = $this->GetNotification("enterdob", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            } else {

                $response['status'] = '4';
                $response['message'] = $this->GetNotification("entervalidpin", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    /**

     * @Method        : POST
     * @Params        : email
     * @author        : Dharmesh
     * @created       : Aug 10 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : RA Check 4 digit pin.
     * */
    public function actionRACheck4DigitPin() {
        $res = array();
        $response = array();
        $new_pass = $this->random_string(6);  // Generated 5 characters password
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        // Complusory Field Validation Code
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['user_id']) || empty($apiData['data']['user_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['security_code']) || empty($apiData['data']['security_code'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passsecuritycode", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            // Forgot Password and send email for varification code
            $checkEmail = User::model()->find("id='" . $apiData['data']['user_id'] . "' and security_code=" . $apiData['data']['security_code']);
            //p($checkEmail);           
            if ($checkEmail) {
                $response['status'] = '1';
                $osnap_id = $checkEmail['osnap_id'];
                $response['data']['osnap_id'] = $osnap_id;
                $response['data']['username'] = $checkEmail['username'];
                $response['message'] = $this->GetNotification("successrecover", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            } else {

                $response['status'] = '0';
                $response['message'] = $this->GetNotification("entervalidpin", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    /**

     * @Method        : POST
     * @Params        : email
     * @author        : Dharmesh
     * @created       : Aug 10 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Check dob.
     * */
    public function actionCheckDob() {
        $res = array();
        $response = array();
        $new_pass = $this->random_string(6);  // Generated 5 characters password
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        // Complusory Field Validation Code
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['user_id']) || empty($apiData['data']['user_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['birth_date']) || empty($apiData['data']['birth_date'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passbirthdate", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            // Forgot Password and send email for varification code
            $checkEmail = User::model()->find("id='" . $apiData['data']['user_id'] . "' and birth_date='" . $apiData['data']['birth_date'] . "'");
            //p($checkEmail);           
            if ($checkEmail) {
                $response['status'] = '1';
                $response['message'] = $this->GetNotification("successforgot", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            } else {

                $response['status'] = '0';
                $response['message'] = $this->GetNotification("entervaliddob", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    /**

     * @Method        : POST
     * @Params        : email
     * @author        : Dharmesh
     * @created       : Aug 10 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Check dob.
     * */
    public function actionRACheckDob() {
        $res = array();
        $response = array();
        $new_pass = $this->random_string(6);  // Generated 5 characters password
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        // Complusory Field Validation Code
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['user_id']) || empty($apiData['data']['user_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['birth_date']) || empty($apiData['data']['birth_date'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passbirthdate", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            // Forgot Password and send email for varification code
            $checkEmail = User::model()->find("id='" . $apiData['data']['user_id'] . "' and birth_date='" . $apiData['data']['birth_date'] . "'");
            //p($checkEmail);           
            if ($checkEmail) {
                $response['status'] = '1';
                $response['message'] = $this->GetNotification("successrecover", $lang);

                $osnap_id = $checkEmail['osnap_id'];
                $response['data']['osnap_id'] = $osnap_id;
                $response['data']['username'] = $checkEmail['username'];
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            } else {

                $response['status'] = '0';
                $response['message'] = $this->GetNotification("entervaliddob", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    // This function use to send verification code email to user
    function sendForgotPasswordMail($email, $newpassword, $username) {
        $to = $email;
        $subject = "Osnap App Forgot Password Request Unique Code";
        $message = '<html>
                    <body>
                        <div>Hi ' . $username . ',</div>
                        <br/>
                        <div>Please enter the following verification code to reset your password.</div>
                        <br/>
                        <div>Unique Code : ' . $newpassword . '</div>
                        <br/>
                        <div>Thank You,</div>
                        <div>Osnap Team.</div>
                    </body>
                    </html>';
        $headers = 'From: Osnap<noreply@Osnap.com>' . "\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        mail($to, $subject, $message, $headers);
    }

    /**

     * @Method        : POST
     * @Params        : email, verify_code
     * @author        : Dharmesh
     * @created       : July 25 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Check Code.
     * */
    public function actionCheckVerificationCode() {
        $res = array();
        $response = array();
        $checkuniqueCode = json_decode(file_get_contents('php://input'), TRUE);
        // Complusory Field Validation Code
        if (!isset($checkuniqueCode['data']['lang_type']) || empty($checkuniqueCode['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $checkuniqueCode['data']['lang_type'];

        if (!isset($checkuniqueCode['data']['email']) || empty($checkuniqueCode['data']['email'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passemail", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }

        /* if(!isset($checkuniqueCode['data']['phone']) || empty($checkuniqueCode['data']['phone'])){
          $response['status'] = "0";
          $response['message'] = $this->GetNotification("passphone",$lang);
          header('Content-Type: application/json; charset=utf-8');
          echo json_encode($response);
          exit();
          }
          if(!isset($checkuniqueCode['data']['country_code']) || empty($checkuniqueCode['data']['country_code'])){
          $response['status'] = "0";
          $response['message'] = $this->GetNotification("passccode",$lang);
          header('Content-Type: application/json; charset=utf-8');
          echo json_encode($response);
          exit();
          }
         */
        if (!isset($checkuniqueCode['data']['verify_code']) && $checkuniqueCode['data']['verify_code'] == '') {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passvercode", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            // Code - Check Verify code is present or not
            $checkCode = User::model()->find("email='" . strtolower($checkuniqueCode['data']['email']) . "'AND `forget_pass_code` = '" . $checkuniqueCode['data']['verify_code'] . "'");
            if ($checkCode) {
                $id = $checkCode['id'];
                $res_verify = $this->UserIs_Varify($id);
                if ($res_verify == '1') {
                    $response['status'] = '1';
                    $response['message'] = $this->GetNotification("versuccess", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = '0';
                    $response['message'] = $this->GetNotification("veraccount", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                // Error Message for verify code does not match
                $response['status'] = '0';
                $response['message'] = $this->GetNotification("entcrvercode", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    /**
     * @Method        : POST
     * @Params        : email, newpassword, confirmpassword
     * @author        : Dharmesh
     * @created       : July 25 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Password Update.
     * */
    public function actionUpdatePassword() {
        $res = array();
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        // Complusory Field Validation Code
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['user_id']) || empty($apiData['data']['user_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        /*if (!isset($apiData['data']['birth_date']) || empty($apiData['data']['birth_date'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passbirthdate", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }*/
        if (!isset($apiData['data']['security_code']) || empty($apiData['data']['security_code'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passsecuritycode", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        /* if(!isset($apiData['data']['phone']) || empty($apiData['data']['phone'])){
          $response['status'] = "0";
          $response['message'] = $this->GetNotification("passphone",$lang);
          header('Content-Type: application/json; charset=utf-8');
          echo json_encode($response);
          exit();
          }
          if(!isset($apiData['data']['country_code']) || empty($apiData['data']['country_code'])){
          $response['status'] = "0";
          $response['message'] = $this->GetNotification("passccode",$lang);
          header('Content-Type: application/json; charset=utf-8');
          echo json_encode($response);
          exit();
          } */
        if (!isset($apiData['data']['newpassword']) || empty($apiData['data']['newpassword'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passnewpass", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            // Code - for update new password

            $checkCode = User::model()->find("id='" . $apiData['data']['user_id'] . "' AND  security_code=" . $apiData['data']['security_code']);

            if (isset($apiData['data']['birth_date']) ) {
                if(empty($apiData['data']['birth_date']))
                {
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("passbirthdate", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
                $checkCode = User::model()->find("id='" . $apiData['data']['user_id'] . "' AND  ( `birth_date` = '" . $apiData['data']['birth_date'] . "' OR security_code=" . $apiData['data']['security_code'].")");
            }


           
           
            //var_dump($checkCode);
            if ($checkCode) {
                $userID = $checkCode['id'];
                $updatePassword = $this->loadModel($userID, 'User');
                $updatePassword->password = md5($apiData['data']['newpassword']);
                $updatePassword->forget_pass_code = '';
                if ($updatePassword->save(false)) {
                    // Code - New Password updated and send password to mail
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("passwordupdate", $lang);
                    //$this->sendForgotPasswordResetEmail($updatePassword['email'],$updatePassword['username'],$apiData['data']['newpassword']);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    // Error Message for password update
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("passupfail", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                // Error Message for email does not exists
                $response['status'] = '0';
                $response['message'] = $this->GetNotification("somethingwrong", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    // This function use to new password update

    function sendForgotPasswordResetEmail($email, $username, $newpassword) {
        // Send Email For New Password
        $to = $email;
        $subject = "victrips App Updated Password";
        $txt = "Dear $username,\r\n\n";
        $txt .= "Your Password has been successfully updated.\r\n\n";
        $txt .= "Email :: $email \r\n";
        $txt .= "New Password :: $newpassword";
        $headers = "noreply@victrips.com";
        mail($to, $subject, $txt, "From: $headers");
    }

    /**
     * @Method        : POST
     * @Params        : id, oldpassword, newpassword
     * @author        : Dharmesh
     * @created       : July 25 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Password Update.
     * */
    public function actionChangePassword() {
        $res = array();
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        // Complusory Field Validation Code
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) || empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['oldpassword']) || empty($apiData['data']['oldpassword'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passoldpass", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['newpassword']) || empty($apiData['data']['newpassword'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passnewpass", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) || empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $_checkUserData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($_checkUserData) {
                $checkUserData = User::model()->find("id='" . strtolower($apiData['data']['id']) . "' AND password = '" . md5($apiData['data']['oldpassword']) . "'");
                if ($checkUserData) {
                    $userID = $checkUserData['id'];
                    $updatePassword = $this->loadModel($userID, 'User');
                    $updatePassword->password = md5($apiData['data']['newpassword']);
                    if ($updatePassword->save(false)) {
                        // Code - New Password updated and send password to mail
                        $response['status'] = "1";
                        $response['message'] = $this->GetNotification("uppasssuccess", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    } else {
                        // Error Message for password update
                        $response['status'] = "0";
                        $response['message'] = $this->GetNotification("uppassfail", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    // Error message both password does not match
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("enteroldpass", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    /**

     * @Method        : POST
     * @Params        : id
     * @author        : Dharmesh
     * @created       : July 25 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : User Detail
     * */
    public function actionLogout() {
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) || empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) || empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserData) {
                $userID = $apiData['data']['id'];
                $updateUser = $this->loadModel($userID, 'User');
                $updateUser->device_token = '';
                $updateUser->device_type = '';
                $updateUser->token = '';
                if ($updateUser->save(false)) {

                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("logoutsuccess", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    // Error Message for password update
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("logoutfail", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    /**

     * @Method        : POST
     * @Params        : id, promo_code
     * @author        : Dharmesh
     * @created       : July 25 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : User Detail
     * */
    public function actionUserDetail() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        // Complusory Field Validation Code
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) || empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['other_id']) || empty($apiData['data']['other_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passotheruserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) || empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $userId = $apiData['data']['other_id'];
            $checkDataList = User::model()->find("id ='" . $userId . "'");
            $user_ver = $this->UserIs_Varify($userId);
            if ($user_ver == '1') {
                $checkUserData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
                if ($checkUserData) {
                    if (!empty($checkDataList)) {
                        //User personal detail
                        $response['status'] = "1";
                        $response['message'] = $this->GetNotification("getUser", $lang);

                        $response['data']['id'] = ($checkDataList->id) ? $checkDataList->id : '';
                        //$response['data']['token'] = ($checkDataList->token) ? $checkDataList->token : '';
                        $response['data']['first_name'] = $checkDataList->first_name . "";
                        $response['data']['last_name'] = $checkDataList->last_name . "";
                        $response['data']['user_type'] = $checkDataList->user_type . "";

                        $response['data']['is_subscribe'] = $checkDataList->is_subscribe . "";
                        $response['data']['is_recurring'] = $checkDataList->is_recurring . "";
                        $response['data']['expiration_datetime'] = $checkDataList->expiration_datetime . "";
                        $response['data']['day_remaining'] = $this->day_remaining($checkDataList->expiration_datetime);



                        $response['data']['time_ago'] = $this->time_diffrent($checkDataList->created_at);
                        $is_security_code_exist = "0"; 
                        if( $checkDataList->security_code !="" && $checkDataList->security_code!=0 )
                        {
                            $is_security_code_exist = "1";     
                        }
                        $response['data']['security_code_exist'] = $is_security_code_exist . "";
                        $response['data']['business_name'] = $checkDataList->business_name . "";
                        $response['data']['business_type_id'] = $checkDataList->business_type . "";
                        $response['data']['business_type'] = GlobalFunction::getBusinessTypes($checkDataList->business_type) . "";                      
                        $response['data']['business_category'] =  $checkDataList->business_category. "";
                        $response['data']['business_osnap_id'] = $checkDataList->business_osnap_id . "";
                        $response['data']['business_osnap_id'] = $checkDataList->business_osnap_id . "";

                        $response['data']['business_esta_month'] = $checkDataList->business_esta_month . "";
                        $response['data']['business_esta_year'] = $checkDataList->business_esta_year . "";


                        $response['data']['business_owner'] = $checkDataList->business_owner . "";
                        $response['data']['business_notes'] = $checkDataList->business_notes . "";
                        $response['data']['business_category_name'] =  $this->GetBusinessCategoryName($checkDataList->business_category );
                        
                        $response['data']['exp_level'] = $checkDataList->exp_level . "";
                        $response['data']['business_image'] = $checkDataList->business_image . "";


                        if($checkDataList->user_type=="1")
                        {
                        		$totalmyprojectawarded = "0";
                        	    $totalsql = "SELECT count(*) as totalmyprojectawarded FROM `post_bid` WHERE  offer_by = '" . $userId . "' and status=4";
                        
		                        $totalcommand = Yii::app()->db->createCommand($totalsql);
		                        $totalDatas = $totalcommand->queryAll();
		                        foreach ($totalDatas as $totalcount) {
		                            $totalmyprojectawarded = $totalcount['totalmyprojectawarded'];
		                        }
		                        $response['data']['total_project'] = $totalmyprojectawarded;
                        }

                        if($checkDataList->user_type=="2")
                        {
                        		$totalprojectcompleted = "0";
                        	    $totalsql = "SELECT count(*) as totalprojectcompleted FROM `post_bid` WHERE  bid_by = '" . $userId . "' and status=4";
                        
		                        $totalcommand = Yii::app()->db->createCommand($totalsql);
		                        $totalDatas = $totalcommand->queryAll();
		                        foreach ($totalDatas as $totalcount) {
		                            $totalprojectcompleted = $totalcount['totalprojectcompleted'];
		                        }
		                        $response['data']['total_project'] = $totalprojectcompleted;
                        }
                        




                        if ($checkDataList->business_name == "" || $checkDataList->business_type == "" || $checkDataList->business_category == "" || $checkDataList->business_osnap_id == "" || $checkDataList->business_owner == "" /*|| $checkDataList->business_image == ""*/) {
                            $response['data']['business_step'] = 0;
                        } else {
                            $response['data']['business_step'] = 1;
                        }

                        if($checkDataList->stripe_user_id=="")
                        {
                            $response['data']['stripe_step'] = 0;
                        }
                        else
                        {
                            $response['data']['stripe_step'] = 1;
                        }



                        $connection = Yii::app()->db;
                        $sql1 = "SELECT * from user_experience where user_id=" . $checkDataList->id;
                        $command1 = Yii::app()->db->createCommand($sql1);
                        $explist = $command1->queryAll();
                       if (!empty($explist)) {
                        $exparray = array();
                        $professional_experience = "";
                        $education = "";
                        foreach ($explist as $key => $value) {
                            $temp = array();
                            $exid = $value['id'];
                            $temp['id'] = $exid;
                            $professional_experience = $value['professional_experience'] . "";
                            $education_id = $value['education_id'] ;
                            $child1 = $value['child1'] ;
                            $child2 = $value['child2'] ;
                            $child1value = $value['child1value'] ;
                            $child2value = $value['child2value'] ;
                            $temp['company_name'] = $value['company_name'] . "";
                            $temp['from_month'] = $value['from_month'];
                            $temp['from_year'] = $value['from_year'];
                            $temp['to_month'] = $value['to_month'];
                            $temp['to_year'] = $value['to_year'];
                            $temp['is_current'] = $value['is_current'];
                            $exparray[] = $temp;
                        }
                        $response['data']['user_exp'] = $exparray;
                        $response['data']['professional_experience'] = $professional_experience;
                        $response['data']['education_id'] = $education_id;
                        $response['data']['education_id_name'] = $this->GetEducationName($education_id);
                        $response['data']['child1'] = $child1;
                        $response['data']['child1_name'] = $this->GetEducationName($child1);
                        $response['data']['child2'] = $child2;
                        $response['data']['child2_name'] = $this->GetEducationName($child2);
                        $response['data']['child1value'] = $child1value;
                        $response['data']['child2value'] = $child2value;
                        $response['data']['experience_step'] = 1;
                    } else {
                        $response['data']['user_exp'] = [];
                        $response['data']['professional_experience'] = "";
                        $response['data']['education_id'] = "";
                        $response['data']['education_id_name'] = "";
                        $response['data']['child1'] = "";
                        $response['data']['child1_name'] = "";
                        $response['data']['child2'] = "";
                        $response['data']['child2_name'] = "";
                        $response['data']['child1value'] = "";
                        $response['data']['child2value'] = "";
                        $response['data']['experience_step'] = 0;
                    }


                        $connection = Yii::app()->db;
                        $sql2 = "SELECT * from user_skill where user_id=" . $checkDataList->id;
                        $command2 = Yii::app()->db->createCommand($sql2);
                        $skilllist = $command2->queryAll();
                        if (!empty($skilllist)) {
                            $skillarray = array();
                            foreach ($skilllist as $key => $value) {
                                $temp = array();
                                $skillid = $value['id'];
                                $temp['id'] = $skillid;
                                $temp['service_name'] = $value['service_name'] . "";
                                $temp['category_id'] = $value['category_id'];
                                $temp['subcategory_id'] = $value['subcategory_id'];

                                $temp['category_name'] = $this->GetCategoryName($value['category_id']);
                                $temp['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);

                                $temp['price'] = $value['price'];
                                $temp['price_type'] = $value['price_type'];
                                $temp['start_time'] = $value['start_time'];
                                $temp['end_time'] = $value['end_time'];
                                $temp['description'] = $value['description'];
                                $temp['service_photo'] = ( (!empty($value['service_photo']) && $value['service_photo']!="null" ) ?  json_decode($value['service_photo']) : [] );
                                $skillarray[] = $temp;
                            }
                            $response['data']['user_skill'] = $skillarray;
                            $response['data']['skill_step'] = 1;
                        } else {
                            $response['data']['user_skill'] = [];
                            $response['data']['skill_step'] = 0;
                        }


                        $response['data']['birth_date'] = $checkDataList->birth_date . "";
                        $response['data']['country_code'] = $checkDataList->country_code . "";
                        $response['data']['phone'] = $checkDataList->phone . "";
                        $response['data']['email'] = $checkDataList->email . "";
                        $response['data']['username'] = $checkDataList->username . "";
                        $response['data']['osnap_id'] = $checkDataList->osnap_id . "";
                        $response['data']['image'] = $checkDataList->image . "";
                        $response['data']['post_code'] = $checkDataList->post_code . "";

                        $response['data']['address'] = $checkDataList->address . "";
                        $response['data']['latitude'] = $checkDataList->latitude . "";
                        $response['data']['longtitude'] = $checkDataList->longtitude . "";
                        $response['data']['city'] = $checkDataList->city . "";
                        $response['data']['state'] = $checkDataList->state . "";
                        $response['data']['country'] = $checkDataList->country . "";


                        $response['data']['device_type'] = $checkDataList->device_type . "";
                        $response['data']['device_token'] = $checkDataList->device_token . "";
                        $response['data']['is_agree'] = $checkDataList->is_agree . "";

                        if ($checkDataList->is_agree == "0") {
                            $response['data']['agreement_step'] = 0;
                        } else {
                            $response['data']['agreement_step'] = 1;
                        }
                        $response['data']['payment_step'] = 1;

                        $sql6 = "SELECT * from `user_review` where user_id = " . $checkDataList->id. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];

                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }
                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data']['ratearray'] = $ratearray;
                        $response['data']['avgrate'] = round($avg,2)."";

                        $sql8 = "SELECT * from `user_licenses` where user_id = " . $checkDataList->id;
                        $command8 = Yii::app()->db->createCommand($sql8);
                        $licensesdata = $command8->queryAll();
                        $licensesarray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($licensesdata)) {
                            $gaarray = array();
                            foreach ($licensesdata as $key7 => $val7) {
                                
                                    $temparray = array();
                                    $temparray['name'] = $val7['name'];
                                    $temparray['month'] = $val7['month'];
                                    $temparray['year'] = $val7['year'];
                                    $temparray['ul_id'] = $val7['ul_id'];
                                    $licensesarray[] = $temparray;
                            }
                           
                        }
                        $response['data']['licensesarray'] = $licensesarray;

                        $userexp = array();

                        $connection = Yii::app()->db;

                        $sql1 = "SELECT * from user_experience where user_id=" . $checkDataList->id;


                        $command1 = Yii::app()->db->createCommand($sql1);
                        $explist = $command1->queryAll();
                       if (!empty($explist)) {
                        $exparray = array();
                        $professional_experience = "";
                        $education = "";
                        foreach ($explist as $key => $value) {
                            $temp = array();
                            $exid = $value['id'];
                            $temp['id'] = $exid;
                            $professional_experience = $value['professional_experience'] . "";
                            $education_id = $value['education_id'] ;
                            $child1 = $value['child1'] ;
                            $child2 = $value['child2'] ;
                            $child1value = $value['child1value'] ;
                            $child2value = $value['child2value'] ;
                            $temp['company_name'] = $value['company_name'] . "";
                            $temp['from_month'] = $value['from_month'];
                            $temp['from_year'] = $value['from_year'];
                            $temp['to_month'] = $value['to_month'];
                            $temp['to_year'] = $value['to_year'];
                            $temp['is_current'] = $value['is_current'];
                            $exparray[] = $temp;
                        }
                        $response['data']['user_exp'] = $exparray;
                        $response['data']['professional_experience'] = $professional_experience;
                        $response['data']['education_id'] = $education_id;
                        $response['data']['education_id_name'] = $this->GetEducationName($education_id);
                        $response['data']['child1'] = $child1;
                        $response['data']['child1_name'] = $this->GetEducationName($child1);
                        $response['data']['child2'] = $child2;
                        $response['data']['child2_name'] = $this->GetEducationName($child2);
                        $response['data']['child1value'] = $child1value;
                        $response['data']['child2value'] = $child2value;
                        $response['data']['experience_step'] = 1;
                    } else {
                        $response['data']['user_exp'] = [];
                        $response['data']['professional_experience'] = "";
                        $response['data']['education_id'] = "";
                        $response['data']['education_id_name'] = "";
                        $response['data']['child1'] = "";
                        $response['data']['child1_name'] = "";
                        $response['data']['child2'] = "";
                        $response['data']['child2_name'] = "";
                        $response['data']['child1value'] = "";
                        $response['data']['child2value'] = "";
                        $response['data']['experience_step'] = 0;
                    }
                        $response['data']['is_favourite'] =  $this->Isfvrtuser($apiData['data']['id'],$checkDataList->id);
                        $response['data']['is_contact'] =  $this->IsContactuser($apiData['data']['id'],$checkDataList->id);
                        // multiple location
                        $results = Usercard::model()->findAll("user_id ='".$checkDataList->id."'");            
                        $multiarray = array();
                        if(!empty($results)){
                            $is_multi = 1;
                            foreach($results as $k => $v){
                                $subarray = array();
                                $subarray['card_id'] = $v->card_id;
                                $subarray['cardnumber'] = $v->cardnumber; 
                                $subarray['exp_month'] = $v->exp_month; 
                                $subarray['exp_year'] = $v->exp_year; 
                                $subarray['is_default'] = $v->is_default;
                                $subarray['brand'] = $v->brand;
                                $multiarray[] = $subarray;
                            }
                        }else{
                            $multiarray = [];
                        }
            
            
                        $response['data']['cards'] = $multiarray;
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    } else {
                        $response['status'] = "0";
                        $response['message'] = $this->GetNotification("usernotexist", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['status'] = "2";
                    $response['message'] = $this->GetNotification("tokenexpired", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "3";
                $response['message'] = $this->GetNotification("veraccount", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    /**
     * @Method        : POST
     * @Params        : usertype,username,password
     * @author        : Vijay   
     * @created       : July 27 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : CMS page
     * */
    public function actionCmspage() {
        $res = array();
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);

        // Complusory Field Validation Code

        if (empty($apiData['data']['page']) && !isset($apiData['data']['page'])) {
            //  print_r($_POST);
            $response['status'] = "0";
            $response['message'] = "Please pass the page name";
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }

        $connection = Yii::app()->db;
        $page = $apiData['data']['page'];
        $sql = "SELECT * from cms_pages WHERE is_active=1 and  page_name='$page'";
        $command = Yii::app()->db->createCommand($sql);
        $pages = $command->queryAll();
        if (!empty($pages)) {
            foreach ($pages as $p) {
                if ($p['is_active'] == 1) {

                    $response['data']['page_name'] = ($p['page_name']) ? $p['page_name'] : '';
                    $response['data']['page_title'] = ($p['page_title']) ? $p['page_title'] : '';
                    $response['data']['page_description'] = ($p['page_description']) ? $p['page_description'] : '';
                    $response['data']['image'] = ($p['image']) ? Yii::app()->request->hostInfo . Yii::app()->baseUrl . '/upload/' . $p['image'] : '';
                    //$pageAlls[]=$res;
                }
            }
            $response['status'] = "1";
            $response['message'] = $this->GetNotification("successlist", $lang);
            //$response['data'] = $pageAlls;
        } else {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("recordnotfound", $lang);
        }


        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response);
        exit();
    }

    /**
     * @Method        : POST
     * @Params        : usertype,username,password
     * @author        : Vijay   
     * @created       : July 27 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Edit User Detail
     * */
    public function actionEditUser() {
        $res = array();
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {

            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
                $checkData = User::model()->find("id ='" . $apiData['data']['id'] . "'");
                if (!empty($checkData)) {
                    $userID = $apiData['data']['id'];

                    $userRegistration = $this->loadModel($userID, 'User');

                    if (isset($apiData['data']['is_agree']) && !empty($apiData['data']['is_agree'])) {
                        $userRegistration->is_agree = $apiData['data']['is_agree'];
                    }
                    if (isset($apiData['data']['is_recurring']) ) {
                        $userRegistration->is_recurring = $apiData['data']['is_recurring'];
                    }

                    
                    if (isset($apiData['data']['first_name']) && !empty($apiData['data']['first_name'])) {
                        $userRegistration->first_name = $apiData['data']['first_name'];
                    }
                    if (isset($apiData['data']['last_name']) && !empty($apiData['data']['last_name'])) {
                        $userRegistration->last_name = $apiData['data']['last_name'];
                    }
                    if (isset($apiData['data']['birth_date']) && !empty($apiData['data']['birth_date'])) {
                        $userRegistration->birth_date = $apiData['data']['birth_date'];
                    }
                    if (isset($apiData['data']['country_code']) && !empty($apiData['data']['country_code'])) {
                        $userRegistration->country_code = $apiData['data']['country_code'];
                        $userRegistration->phone = $apiData['data']['phone'];
                    }
                    if (isset($apiData['data']['post_code']) && !empty($apiData['data']['post_code'])) {
                        $userRegistration->post_code = $apiData['data']['post_code'];
                    }
                    if (isset($apiData['data']['security_code']) && !empty($apiData['data']['security_code'])) {
                        $userRegistration->security_code = $apiData['data']['security_code'];
                    }

                    // $userRegistration->security_code = $apiData['data']['security_code'];


                    if (isset($apiData['data']['address']) && !empty($apiData['data']['address'])) {
                        $userRegistration->latitude = $apiData['data']['address'];
                    }
                    if (isset($apiData['data']['latitude']) && !empty($apiData['data']['latitude'])) {
                        $userRegistration->latitude = $apiData['data']['latitude'];
                    }
                    if (isset($apiData['data']['longtitude']) && !empty($apiData['data']['longtitude'])) {
                        $userRegistration->longtitude = $apiData['data']['longtitude'];
                    }
                    if (isset($apiData['data']['city']) && !empty($apiData['data']['city'])) {
                        $userRegistration->city = $apiData['data']['city'];
                    }
                    if (isset($apiData['data']['state']) && !empty($apiData['data']['state'])) {
                        $userRegistration->state = $apiData['data']['state'];
                    }
                    if (isset($apiData['data']['country']) && !empty($apiData['data']['country'])) {
                        $userRegistration->country = $apiData['data']['country'];
                    }


                    if (isset($apiData['data']['image']) && !empty($apiData['data']['image'])) {
                        $userRegistration->image = $apiData['data']['image'];
                    }

                    if ($userRegistration->save(false)) {
                        // Code - New Password updated and send password to mail
                        $response['status'] = "1";
                        $response['message'] = $this->GetNotification("profileupdatesuccess", $lang);
                        $response['data']['id'] = $userRegistration->attributes['id'] . "";
                        $response['data']['first_name'] = $userRegistration->attributes['first_name'] . "";
                        $response['data']['last_name'] = $userRegistration->attributes['last_name'] . "";
                        $response['data']['user_type'] = $userRegistration->attributes['user_type'] . "";

                        $response['data']['is_subscribe'] = $userRegistration->attributes['is_subscribe'] . "";
                        $response['data']['is_recurring'] = $userRegistration->attributes['is_recurring'] . "";
                        $response['data']['expiration_datetime'] = $userRegistration->attributes['expiration_datetime'] . "";
                        $response['data']['day_remaining'] = $this->day_remaining($userRegistration->attributes['expiration_datetime']);


                        $response['data']['time_ago'] = $this->time_diffrent($userRegistration->attributes['created_at']);
                        $is_security_code_exist = "0"; 
                        if( $userRegistration->attributes['security_code'] !="" && $userRegistration->attributes['security_code']!=0 )
                        {
                            $is_security_code_exist = "1";     
                        }
                        $response['data']['security_code_exist'] = $is_security_code_exist . "";

                        $response['data']['business_name'] = $userRegistration->attributes['business_name'] . "";



                        $response['data']['business_type_id'] = $userRegistration->attributes['business_type'] . "";
                        $response['data']['business_type'] = GlobalFunction::getBusinessTypes($userRegistration->attributes['business_type']) . "";
                        $response['data']['business_category'] = $userRegistration->attributes['business_category'] . "";

                        $response['data']['business_category_name'] =  $this->GetBusinessCategoryName($userRegistration->attributes['business_category']);

                        $response['data']['business_osnap_id'] = $userRegistration->attributes['business_osnap_id'] . "";

                        $response['data']['business_esta_month'] = $userRegistration->attributes['business_esta_month'] . "";
                        $response['data']['business_esta_year'] = $userRegistration->attributes['business_esta_year'] . "";

                        $response['data']['business_owner'] = $userRegistration->attributes['business_owner'] . "";
                        $response['data']['business_notes'] = $userRegistration->attributes['business_notes'] . "";
                        
                        $response['data']['exp_level'] = $userRegistration->attributes['exp_level'] . "";
                        $response['data']['business_image'] = $userRegistration->attributes['business_image'] . "";


                        if ($userRegistration->attributes['business_name'] == "" || $userRegistration->attributes['business_type'] == "" || $userRegistration->attributes['business_category'] == "" || $userRegistration->attributes['business_osnap_id'] == "" || $userRegistration->attributes['business_owner'] == "" /*|| $userRegistration->attributes['business_image'] == ""*/) {
                            $response['data']['business_step'] = 0;
                        } else {
                            $response['data']['business_step'] = 1;
                        }

                        if($userRegistration->attributes['stripe_user_id']=="")
                        {
                            $response['data']['stripe_step'] = 0;
                        }
                        else
                        {
                            $response['data']['stripe_step'] = 1;
                        }


                        $connection = Yii::app()->db;
                        $sql1 = "SELECT * from user_experience where user_id=" . $userRegistration->attributes['id'];
                        $command1 = Yii::app()->db->createCommand($sql1);
                        $explist = $command1->queryAll();
                      if (!empty($explist)) {
                        $exparray = array();
                        $professional_experience = "";
                        $education = "";
                        foreach ($explist as $key => $value) {
                            $temp = array();
                            $exid = $value['id'];
                            $temp['id'] = $exid;
                            $professional_experience = $value['professional_experience'] . "";
                            $education_id = $value['education_id'] ;
                            $child1 = $value['child1'] ;
                            $child2 = $value['child2'] ;
                            $child1value = $value['child1value'] ;
                            $child2value = $value['child2value'] ;
                            $temp['company_name'] = $value['company_name'] . "";
                            $temp['from_month'] = $value['from_month'];
                            $temp['from_year'] = $value['from_year'];
                            $temp['to_month'] = $value['to_month'];
                            $temp['to_year'] = $value['to_year'];
                            $temp['is_current'] = $value['is_current'];
                            $exparray[] = $temp;
                        }
                        $response['data']['user_exp'] = $exparray;
                        $response['data']['professional_experience'] = $professional_experience;
                        $response['data']['education_id'] = $education_id;
                        $response['data']['education_id_name'] = $this->GetEducationName($education_id);
                        $response['data']['child1'] = $child1;
                        $response['data']['child1_name'] = $this->GetEducationName($child1);
                        $response['data']['child2'] = $child2;
                        $response['data']['child2_name'] = $this->GetEducationName($child2);
                        $response['data']['child1value'] = $child1value;
                        $response['data']['child2value'] = $child2value;
                        $response['data']['experience_step'] = 1;
                    } else {
                        $response['data']['user_exp'] = [];
                        $response['data']['professional_experience'] = "";
                        $response['data']['education_id'] = "";
                        $response['data']['education_id_name'] = "";
                        $response['data']['child1'] = "";
                        $response['data']['child1_name'] = "";
                        $response['data']['child2'] = "";
                        $response['data']['child2_name'] = "";
                        $response['data']['child1value'] = "";
                        $response['data']['child2value'] = "";
                        $response['data']['experience_step'] = 0;
                    }


                        $connection = Yii::app()->db;
                        $sql2 = "SELECT * from user_skill where user_id=" . $userRegistration->attributes['id'];
                        $command2 = Yii::app()->db->createCommand($sql2);
                        $skilllist = $command2->queryAll();
                        if (!empty($skilllist)) {
                            $skillarray = array();
                            foreach ($skilllist as $key => $value) {
                                $temp = array();
                                $skillid = $value['id'];
                                $temp['id'] = $skillid;
                                $temp['service_name'] = $value['service_name'] . "";
                                $temp['category_id'] = $value['category_id'];
                                $temp['subcategory_id'] = $value['subcategory_id'];
                                $temp['category_name'] = $this->GetCategoryName($value['category_id']);
                                $temp['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);
                                $temp['price'] = $value['price'];
                                $temp['price_type'] = $value['price_type'];
                                $temp['start_time'] = $value['start_time'];
                                $temp['end_time'] = $value['end_time'];
                                $temp['description'] = $value['description'];


                                $temp['service_photo'] = ( (!empty($value['service_photo']) && $value['service_photo']!="null" ) ?  json_decode($value['service_photo']) : [] );
                                $skillarray[] = $temp;
                            }
                            $response['data']['user_skill'] = $skillarray;
                            $response['data']['skill_step'] = 1;
                        } else {
                            $response['data']['user_skill'] = [];
                            $response['data']['skill_step'] = 0;
                        }

                        $response['data']['birth_date'] = $userRegistration->attributes['birth_date'] . "";
                        $response['data']['country_code'] = $userRegistration->attributes['country_code'] . "";
                        $response['data']['phone'] = $userRegistration->attributes['phone'] . "";
                        $response['data']['email'] = $userRegistration->attributes['email'] . "";
                        $response['data']['username'] = $userRegistration->attributes['username'] . "";
                        $response['data']['osnap_id'] = $userRegistration->attributes['osnap_id'] . "";
                        $response['data']['image'] = $userRegistration->attributes['image'] . "";
                        $response['data']['post_code'] = $userRegistration->attributes['post_code'] . "";

                        $response['data']['address'] = $userRegistration->attributes['address'] . '';
                        $response['data']['latitude'] = $userRegistration->attributes['latitude'] . '';
                        $response['data']['longtitude'] = $userRegistration->attributes['longtitude'] . '';
                        $response['data']['city'] = $userRegistration->attributes['city'] . '';
                        $response['data']['state'] = $userRegistration->attributes['state'] . '';
                        $response['data']['country'] = $userRegistration->attributes['country'] . '';


                        $response['data']['device_type'] = $userRegistration->attributes['device_type'] . "";
                        $response['data']['device_token'] = $userRegistration->attributes['device_token'] . "";
                        $response['data']['is_agree'] = $userRegistration->attributes['is_agree'] . "";
                        if ($userRegistration->attributes['is_agree'] == "0") {
                            $response['data']['agreement_step'] = 0;
                        } else {
                            $response['data']['agreement_step'] = 1;
                        }
                        $response['data']['payment_step'] = 1;


                        $sql6 = "SELECT * from `user_review` where user_id = " . $userRegistration->attributes['id']. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];

                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }
                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data']['ratearray'] = $ratearray;
                        $response['data']['avgrate'] = round($avg,2)."";

                        $sql8 = "SELECT * from `user_licenses` where user_id = " .$userRegistration->attributes['id'];
                        $command8 = Yii::app()->db->createCommand($sql8);
                        $licensesdata = $command8->queryAll();
                        $licensesarray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($licensesdata)) {
                            $gaarray = array();
                            foreach ($licensesdata as $key7 => $val7) {
                                
                                    $temparray = array();
                                    $temparray['name'] = $val7['name'];
                                    $temparray['month'] = $val7['month'];
                                    $temparray['year'] = $val7['year'];
                                    $temparray['ul_id'] = $val7['ul_id'];
                                    $licensesarray[] = $temparray;
                            }
                           
                        }
                        $response['data']['licensesarray'] = $licensesarray;



                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    } else {
                        // Error Message for password update
                        $response['status'] = "0";
                        $response['message'] = $this->GetNotification("updatefail", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("usernotexist", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    /**
     * @Method        : POST
     * @Params        : usertype,username,password
     * @author        : Vijay   
     * @created       : Aug 01 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Add Business details
     * */
    public function actionAddUpdateBusinessDetails() {
        $res = array();
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['business_name']) && empty($apiData['data']['business_name'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passbn", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['business_type']) && empty($apiData['data']['business_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passbt", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['business_category']) && empty($apiData['data']['business_category'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passbc", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if(!isset($apiData['data']['business_notes']) && empty($apiData['data']['business_notes'])){
          $response['status'] = "0";
          $response['message'] = $this->GetNotification("passbusinessnotes",$lang);
          header('Content-Type: application/json; charset=utf-8');
          echo json_encode($response);
          exit();
        }
        if (!isset($apiData['data']['business_owner']) && empty($apiData['data']['business_owner'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passbo", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if(!isset($apiData['data']['business_osnap_id']) && empty($apiData['data']['business_osnap_id'])){
          $response['status'] = "0";
          $response['message'] = $this->GetNotification("passboid",$lang);
          header('Content-Type: application/json; charset=utf-8');
          echo json_encode($response);
          exit();
        }
        if(!isset($apiData['data']['business_esta_month']) && empty($apiData['data']['business_esta_month'])){
          $response['status'] = "0";
          $response['message'] = $this->GetNotification("passbem",$lang);
          header('Content-Type: application/json; charset=utf-8');
          echo json_encode($response);
          exit();
        }
        if(!isset($apiData['data']['business_esta_year']) && empty($apiData['data']['business_esta_year'])){
          $response['status'] = "0";
          $response['message'] = $this->GetNotification("passbey",$lang);
          header('Content-Type: application/json; charset=utf-8');
          echo json_encode($response);
          exit();
        }
        /* if(!isset($apiData['data']['business_address']) && empty($apiData['data']['business_address'])){
          $response['status'] = "0";
          $response['message'] = $this->GetNotification("passba",$lang);
          header('Content-Type: application/json; charset=utf-8');
          echo json_encode($response);
          exit();
          }
          if(!isset($apiData['data']['business_latitude']) && empty($apiData['data']['business_latitude'])){
          $response['status'] = "0";
          $response['message'] = $this->GetNotification("passblati",$lang);
          header('Content-Type: application/json; charset=utf-8');
          echo json_encode($response);
          exit();
          }
          if(!isset($apiData['data']['business_longtitude']) && empty($apiData['data']['business_longtitude'])){
          $response['status'] = "0";
          $response['message'] = $this->GetNotification("passblong",$lang);
          header('Content-Type: application/json; charset=utf-8');
          echo json_encode($response);
          exit();
          } */
       /* if (!isset($apiData['data']['business_image']) && empty($apiData['data']['business_image'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passbi", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }*/ else {

            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
                $checkData = User::model()->find("id ='" . $apiData['data']['id'] . "'");
                if (!empty($checkData)) {
                    
                    $checkBusinessosnap = $this->BusinessOsnapExist($apiData['data']['business_osnap_id'], $apiData['data']['id']);
                    if ($checkBusinessosnap == '1') {

                        $response['status'] = "0";
                        $response['message'] = $this->GetNotification("boalready", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }
                     
                     
                    $userID = $apiData['data']['id'];

                    $userRegistration = $this->loadModel($userID, 'User');
                    $userRegistration->business_name = $apiData['data']['business_name'];

                     


                    $userRegistration->business_type = $apiData['data']['business_type'];
                    $userRegistration->business_category = $apiData['data']['business_category'];
                    $userRegistration->business_osnap_id = $apiData['data']['business_osnap_id'];
                    $userRegistration->business_esta_month = $apiData['data']['business_esta_month'];
                    $userRegistration->business_esta_year = $apiData['data']['business_esta_year'];
                    $userRegistration->business_owner = $apiData['data']['business_owner'];
                    $userRegistration->business_notes = $apiData['data']['business_notes'];

                    if(isset($apiData['data']['business_image']) && !empty($apiData['data']['business_image'])){
                         $userRegistration->business_image = $apiData['data']['business_image'];
                    }
                   

                    if ($userRegistration->save(false)) {
                        // Code - New Password updated and send password to mail
                        $response['status'] = "1";
                        $response['message'] = $this->GetNotification("profileupdatesuccess", $lang);

                        $checkDataList = User::model()->find("id ='" . $apiData['data']['id'] . "'");
                        $response['data']['id'] = ($checkDataList->id) ? $checkDataList->id : '';
                        $response['data']['token'] = ($checkDataList->token) ? $checkDataList->token : '';
                        $response['data']['first_name'] = $checkDataList->first_name . "";
                        $response['data']['last_name'] = $checkDataList->last_name . "";
                        $response['data']['user_type'] = $checkDataList->user_type . "";

                        $response['data']['time_ago'] = $this->time_diffrent($checkDataList->created_at);
                        $is_security_code_exist = "0"; 
                        if( $checkDataList->security_code !="" && $checkDataList->security_code!=0 )
                        {
                            $is_security_code_exist = "1";     
                        }
                        $response['data']['security_code_exist'] = $is_security_code_exist . "";

                        $response['data']['business_name'] = $checkDataList->business_name . "";

                        

                        $response['data']['business_type_id'] = $checkDataList->business_type . "";
                        $response['data']['business_type'] = GlobalFunction::getBusinessTypes($checkDataList->business_type) . "";  
                        $response['data']['business_category'] = $checkDataList->business_category . "";
                        $response['data']['business_category_name'] =  $this->GetBusinessCategoryName($checkDataList->business_category );
                        $response['data']['business_osnap_id'] = $checkDataList->business_osnap_id . "";
                        $response['data']['business_esta_month'] = $checkDataList->business_esta_month . "";
                        $response['data']['business_esta_year'] = $checkDataList->business_esta_year . "";
                        $response['data']['business_owner'] = $checkDataList->business_owner . "";
                        $response['data']['business_notes'] = $checkDataList->business_notes . "";
                        $response['data']['exp_level'] = $checkDataList->exp_level . "";
                        $response['data']['business_image'] = $checkDataList->business_image . "";

                        $response['data']['exp_level'] = $checkDataList->exp_level . "";

                        if ($checkDataList->business_name == "" || $checkDataList->business_type == "" || $checkDataList->business_category == "" || $checkDataList->business_osnap_id == "" || $checkDataList->business_owner == "" /*|| $checkDataList->business_image == ""*/) {

                            $response['data']['business_step'] = 0;
                        } else {
                            $response['data']['business_step'] = 1;
                        }

                        if($checkDataList->stripe_user_id=="")
                        {
                            $response['data']['stripe_step'] = 0;
                        }
                        else
                        {
                            $response['data']['stripe_step'] = 1;
                        }


                        $connection = Yii::app()->db;
                        $sql1 = "SELECT * from user_experience where user_id=" . $checkDataList->id;
                        $command1 = Yii::app()->db->createCommand($sql1);
                        $explist = $command1->queryAll();
                      if (!empty($explist)) {
                        $exparray = array();
                        $professional_experience = "";
                        $education = "";
                        foreach ($explist as $key => $value) {
                            $temp = array();
                            $exid = $value['id'];
                            $temp['id'] = $exid;
                            $professional_experience = $value['professional_experience'] . "";
                            $education_id = $value['education_id'] ;
                            $child1 = $value['child1'] ;
                            $child2 = $value['child2'] ;
                            $child1value = $value['child1value'] ;
                            $child2value = $value['child2value'] ;
                            $temp['company_name'] = $value['company_name'] . "";
                            $temp['from_month'] = $value['from_month'];
                            $temp['from_year'] = $value['from_year'];
                            $temp['to_month'] = $value['to_month'];
                            $temp['to_year'] = $value['to_year'];
                            $temp['is_current'] = $value['is_current'];
                            $exparray[] = $temp;
                        }
                        $response['data']['user_exp'] = $exparray;
                        $response['data']['professional_experience'] = $professional_experience;
                        $response['data']['education_id'] = $education_id;
                        $response['data']['education_id_name'] = $this->GetEducationName($education_id);
                        $response['data']['child1'] = $child1;
                        $response['data']['child1_name'] = $this->GetEducationName($child1);
                        $response['data']['child2'] = $child2;
                        $response['data']['child2_name'] = $this->GetEducationName($child2);
                        $response['data']['child1value'] = $child1value;
                        $response['data']['child2value'] = $child2value;
                        $response['data']['experience_step'] = 1;
                    } else {
                        $response['data']['user_exp'] = [];
                        $response['data']['professional_experience'] = "";
                        $response['data']['education_id'] = "";
                        $response['data']['education_id_name'] = "";
                        $response['data']['child1'] = "";
                        $response['data']['child1_name'] = "";
                        $response['data']['child2'] = "";
                        $response['data']['child2_name'] = "";
                        $response['data']['child1value'] = "";
                        $response['data']['child2value'] = "";
                        $response['data']['experience_step'] = 0;
                    }


                        $connection = Yii::app()->db;
                        $sql2 = "SELECT * from user_skill where user_id=" . $checkDataList->id;
                        $command2 = Yii::app()->db->createCommand($sql2);
                        $skilllist = $command2->queryAll();
                        if (!empty($skilllist)) {
                            $skillarray = array();
                            foreach ($skilllist as $key => $value) {
                                $temp = array();
                                $skillid = $value['id'];
                                $temp['id'] = $skillid;
                                $temp['service_name'] = $value['service_name'] . "";
                                $temp['category_id'] = $value['category_id'];
                                $temp['subcategory_id'] = $value['subcategory_id'];
                                $temp['category_name'] = $this->GetCategoryName($value['category_id']);
                                $temp['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);
                                $temp['price'] = $value['price'];
                                $temp['price_type'] = $value['price_type'];
                                $temp['start_time'] = $value['start_time'];
                                $temp['end_time'] = $value['end_time'];
                                $temp['description'] = $value['description'];
                                $temp['service_photo'] = ( (!empty($value['service_photo']) && $value['service_photo']!="null" ) ?  json_decode($value['service_photo']) : [] );
                                $skillarray[] = $temp;
                            }
                            $response['data']['user_skill'] = $skillarray;
                            $response['data']['skill_step'] = 1;
                        } else {
                            $response['data']['user_skill'] = [];
                            $response['data']['skill_step'] = 0;
                        }


                        $response['data']['birth_date'] = $checkDataList->birth_date . "";
                        $response['data']['country_code'] = $checkDataList->country_code . "";
                        $response['data']['phone'] = $checkDataList->phone . "";
                        $response['data']['email'] = $checkDataList->email . "";
                        $response['data']['username'] = $checkDataList->username . "";
                        $response['data']['osnap_id'] = $checkDataList->osnap_id . "";
                        $response['data']['image'] = $checkDataList->image . "";
                        $response['data']['post_code'] = $checkDataList->post_code . "";

                        $response['data']['address'] = $checkDataList->address . "";
                        $response['data']['latitude'] = $checkDataList->latitude . "";
                        $response['data']['longtitude'] = $checkDataList->longtitude . "";
                        $response['data']['city'] = $checkDataList->city . "";
                        $response['data']['state'] = $checkDataList->state . "";
                        $response['data']['country'] = $checkDataList->country . "";


                        $response['data']['device_type'] = $checkDataList->device_type . "";
                        $response['data']['device_token'] = $checkDataList->device_token . "";
                        $response['data']['is_agree'] = $checkDataList->is_agree . "";
                        if ($checkDataList->is_agree == "0") {
                            $response['data']['agreement_step'] = 0;
                        } else {
                            $response['data']['agreement_step'] = 1;
                        }
                        $response['data']['payment_step'] = 1;


                        $sql6 = "SELECT * from `user_review` where user_id = " . $checkDataList->id. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];

                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }
                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data']['ratearray'] = $ratearray;
                        $response['data']['avgrate'] = round($avg,2)."";

                        $sql8 = "SELECT * from `user_licenses` where user_id = " . $checkDataList->id;
                        $command8 = Yii::app()->db->createCommand($sql8);
                        $licensesdata = $command8->queryAll();
                        $licensesarray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($licensesdata)) {
                            $gaarray = array();
                            foreach ($licensesdata as $key7 => $val7) {
                                
                                    $temparray = array();
                                    $temparray['name'] = $val7['name'];
                                    $temparray['month'] = $val7['month'];
                                    $temparray['year'] = $val7['year'];
                                    $temparray['ul_id'] = $val7['ul_id'];
                                    $licensesarray[] = $temparray;
                            }
                           
                        }
                        $response['data']['licensesarray'] = $licensesarray;


                        $userexp = array();

                        $connection = Yii::app()->db;

                        $sql1 = "SELECT * from user_experience where user_id=" . $checkDataList->id;


                        $command1 = Yii::app()->db->createCommand($sql1);
                        $explist = $command1->queryAll();
                       if (!empty($explist)) {
                        $exparray = array();
                        $professional_experience = "";
                        $education = "";
                        foreach ($explist as $key => $value) {
                            $temp = array();
                            $exid = $value['id'];
                            $temp['id'] = $exid;
                            $professional_experience = $value['professional_experience'] . "";
                            $education_id = $value['education_id'] ;
                            $child1 = $value['child1'] ;
                            $child2 = $value['child2'] ;
                            $child1value = $value['child1value'] ;
                            $child2value = $value['child2value'] ;
                            $temp['company_name'] = $value['company_name'] . "";
                            $temp['from_month'] = $value['from_month'];
                            $temp['from_year'] = $value['from_year'];
                            $temp['to_month'] = $value['to_month'];
                            $temp['to_year'] = $value['to_year'];
                            $temp['is_current'] = $value['is_current'];
                            $exparray[] = $temp;
                        }
                        $response['data']['user_exp'] = $exparray;
                        $response['data']['professional_experience'] = $professional_experience;
                        $response['data']['education_id'] = $education_id;
                        $response['data']['education_id_name'] = $this->GetEducationName($education_id);
                        $response['data']['child1'] = $child1;
                        $response['data']['child1_name'] = $this->GetEducationName($child1);
                        $response['data']['child2'] = $child2;
                        $response['data']['child2_name'] = $this->GetEducationName($child2);
                        $response['data']['child1value'] = $child1value;
                        $response['data']['child2value'] = $child2value;
                        $response['data']['experience_step'] = 1;
                    } else {
                        $response['data']['user_exp'] = [];
                        $response['data']['professional_experience'] = "";
                        $response['data']['education_id'] = "";
                        $response['data']['education_id_name'] = "";
                        $response['data']['child1'] = "";
                        $response['data']['child1_name'] = "";
                        $response['data']['child2'] = "";
                        $response['data']['child2_name'] = "";
                        $response['data']['child1value'] = "";
                        $response['data']['child2value'] = "";
                        $response['data']['experience_step'] = 0;
                    }


                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    } else {
                        // Error Message for password update
                        $response['status'] = "0";
                        $response['message'] = $this->GetNotification("updatefail", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("usernotexist", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : July 27 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Add Experience.
     * */
    public function actionAddUpdateExperience() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) || empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) || empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }

        if (!isset($apiData['data']['experience']) || empty($apiData['data']['experience'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpe", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
       
        if (count($apiData['data']['experience']) == 0) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passoneexp", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            /* if(!isset($apiData['data']['professional_experience']) ||  empty($apiData['data']['professional_experience'])){
              $response['status'] = "0";
              $response['message'] = $this->GetNotification("passpe",$lang);
              header('Content-Type: application/json; charset=utf-8');
              echo json_encode($response);
              exit();
              }
              if(!isset($apiData['data']['education']) ||  empty($apiData['data']['education'])){
              $response['status'] = "0";
              $response['message'] = $this->GetNotification("passeducation",$lang);
              header('Content-Type: application/json; charset=utf-8');
              echo json_encode($response);
              exit();
              }
              if(!isset($apiData['data']['company_name']) ||  empty($apiData['data']['company_name'])){
              $response['status'] = "0";
              $response['message'] = $this->GetNotification("passcname",$lang);
              header('Content-Type: application/json; charset=utf-8');
              echo json_encode($response);
              exit();
              }
              if(!isset($apiData['data']['from_month']) ||  empty($apiData['data']['from_month'])){
              $response['status'] = "0";
              $response['message'] = $this->GetNotification("passfrommonth",$lang);
              header('Content-Type: application/json; charset=utf-8');
              echo json_encode($response);
              exit();
              }
              if(!isset($apiData['data']['from_year']) ||  empty($apiData['data']['from_year'])){
              $response['status'] = "0";
              $response['message'] = $this->GetNotification("passfromyear",$lang);
              header('Content-Type: application/json; charset=utf-8');
              echo json_encode($response);
              exit();
              }
              if(!isset($apiData['data']['to_month']) ||  empty($apiData['data']['to_month'])){
              $response['status'] = "0";
              $response['message'] = $this->GetNotification("passtomonth",$lang);
              header('Content-Type: application/json; charset=utf-8');
              echo json_encode($response);
              exit();
              }
              if(!isset($apiData['data']['to_year']) ||  empty($apiData['data']['to_year'])){
              $response['status'] = "0";
              $response['message'] = $this->GetNotification("passtoyear",$lang);
              header('Content-Type: application/json; charset=utf-8');
              echo json_encode($response);
              exit();
              } */
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {

                $ExperienceData = $apiData['data']['experience'];
                $deleteExperienceData = UserExperience::model()->deleteAll("user_id = '" . $apiData['data']['id'] . "'");
                $success = 0;
                foreach ($ExperienceData as $data) {
                    $UserExperienceData = new UserExperience();
                    $UserExperienceData->user_id = $apiData['data']['id'];
                    $UserExperienceData->professional_experience = $data['professional_experience'];
                    $UserExperienceData->education_id = $data['education_id'];               
                    $UserExperienceData->child1 = $data['child1'];
                    $UserExperienceData->child2 = $data['child2'];
                    $UserExperienceData->child1value = $data['child1value'];
                    $UserExperienceData->child2value = $data['child2value'];
                    $UserExperienceData->company_name = $data['company_name'];
                    $UserExperienceData->from_month = $data['from_month'];
                    $UserExperienceData->from_year = $data['from_year'];
                    $UserExperienceData->to_month = $data['to_month'];
                    $UserExperienceData->to_year = $data['to_year'];
                    $UserExperienceData->is_current = $data['is_current'];
                    
                    $UserExperienceData->save(false);
                    $success = 1;
                }
                if ($success == 1) {

                    $checkDataList = User::model()->find("id ='" . $apiData['data']['id'] . "'");
                    $response['data']['id'] = ($checkDataList->id) ? $checkDataList->id : '';
                    $response['data']['token'] = ($checkDataList->token) ? $checkDataList->token : '';
                    $response['data']['first_name'] = $checkDataList->first_name . "";
                    $response['data']['last_name'] = $checkDataList->last_name . "";
                    $response['data']['user_type'] = $checkDataList->user_type . "";

                    $response['data']['time_ago'] = $this->time_diffrent($checkDataList->created_at);
                    $is_security_code_exist = "0"; 
                        if( $checkDataList->security_code !="" && $checkDataList->security_code!=0 )
                        {
                            $is_security_code_exist = "1";     
                        }
                        $response['data']['security_code_exist'] = $is_security_code_exist . "";
                    $response['data']['business_name'] = $checkDataList->business_name . "";

                    $response['data']['business_type_id'] = $checkDataList->business_type . "";
                        $response['data']['business_type'] = GlobalFunction::getBusinessTypes($checkDataList->business_type) . "";  



                    $response['data']['business_category'] = $checkDataList->business_category . "";

                    $response['data']['business_category_name'] =  $this->GetBusinessCategoryName($checkDataList->business_category );

                    $response['data']['business_osnap_id'] = $checkDataList->business_osnap_id . "";
                    $response['data']['business_esta_month'] = $checkDataList->business_esta_month . "";
                    $response['data']['business_esta_year'] = $checkDataList->business_esta_year . "";
                    $response['data']['business_owner'] = $checkDataList->business_owner . "";
                    $response['data']['business_notes'] = $checkDataList->business_notes . "";
                    
                    $response['data']['exp_level'] = $checkDataList->exp_level . "";
                    $response['data']['business_image'] = $checkDataList->business_image . "";


                    if ($checkDataList->business_name == "" || $checkDataList->business_type == "" || $checkDataList->business_category == "" || $checkDataList->business_osnap_id == "" || $checkDataList->business_owner == "" /*|| $checkDataList->business_image == ""*/) {
                        $response['data']['business_step'] = 0;
                    } else {
                        $response['data']['business_step'] = 1;
                    }

                    if($checkDataList->stripe_user_id=="")
                    {
                        $response['data']['stripe_step'] = 0;
                    }
                    else
                    {
                        $response['data']['stripe_step'] = 1;
                    }


                    $connection = Yii::app()->db;
                    $sql1 = "SELECT * from user_experience where user_id=" . $checkDataList->id;
                    $command1 = Yii::app()->db->createCommand($sql1);
                    $explist = $command1->queryAll();
                  if (!empty($explist)) {
                        $exparray = array();
                        $professional_experience = "";
                        $education = "";
                        foreach ($explist as $key => $value) {
                            $temp = array();
                            $exid = $value['id'];
                            $temp['id'] = $exid;
                            $professional_experience = $value['professional_experience'] . "";
                            $education_id = $value['education_id'] ;
                            $child1 = $value['child1'] ;
                            $child2 = $value['child2'] ;
                            $child1value = $value['child1value'] ;
                            $child2value = $value['child2value'] ;
                            $temp['company_name'] = $value['company_name'] . "";
                            $temp['from_month'] = $value['from_month'];
                            $temp['from_year'] = $value['from_year'];
                            $temp['to_month'] = $value['to_month'];
                            $temp['to_year'] = $value['to_year'];
                            $temp['is_current'] = $value['is_current'];
                            $exparray[] = $temp;
                        }
                        $response['data']['user_exp'] = $exparray;
                        $response['data']['professional_experience'] = $professional_experience;
                        $response['data']['education_id'] = $education_id;
                        $response['data']['education_id_name'] = $this->GetEducationName($education_id);
                        $response['data']['child1'] = $child1;
                        $response['data']['child1_name'] = $this->GetEducationName($child1);
                        $response['data']['child2'] = $child2;
                        $response['data']['child2_name'] = $this->GetEducationName($child2);
                        $response['data']['child1value'] = $child1value;
                        $response['data']['child2value'] = $child2value;
                        $response['data']['experience_step'] = 1;
                    } else {
                        $response['data']['user_exp'] = [];
                        $response['data']['professional_experience'] = "";
                        $response['data']['education_id'] = "";
                        $response['data']['education_id_name'] = "";
                        $response['data']['child1'] = "";
                        $response['data']['child1_name'] = "";
                        $response['data']['child2'] = "";
                        $response['data']['child2_name'] = "";
                        $response['data']['child1value'] = "";
                        $response['data']['child2value'] = "";
                        $response['data']['experience_step'] = 0;
                    }

                    $connection = Yii::app()->db;
                    $sql2 = "SELECT * from user_skill where user_id=" . $checkDataList->id;
                    $command2 = Yii::app()->db->createCommand($sql2);
                    $skilllist = $command2->queryAll();
                    if (!empty($skilllist)) {
                        $skillarray = array();
                        foreach ($skilllist as $key => $value) {
                            $temp = array();
                            $skillid = $value['id'];
                            $temp['id'] = $skillid;
                            $temp['service_name'] = $value['service_name'] . "";
                            $temp['category_id'] = $value['category_id'];
                            $temp['subcategory_id'] = $value['subcategory_id'];
                            $temp['category_name'] = $this->GetCategoryName($value['category_id']);
                            $temp['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);
                            $temp['price'] = $value['price'];
                            $temp['price_type'] = $value['price_type'];
                            $temp['start_time'] = $value['start_time'];
                            $temp['end_time'] = $value['end_time'];
                            $temp['description'] = $value['description'];
                            $temp['service_photo'] = ( (!empty($value['service_photo']) && $value['service_photo']!="null" ) ?  json_decode($value['service_photo']) : [] );
                            $skillarray[] = $temp;
                        }
                        $response['data']['user_skill'] = $skillarray;
                        $response['data']['skill_step'] = 1;
                    } else {
                        $response['data']['user_skill'] = [];
                        $response['data']['skill_step'] = 0;
                    }


                    $response['data']['birth_date'] = $checkDataList->birth_date . "";
                    $response['data']['country_code'] = $checkDataList->country_code . "";
                    $response['data']['phone'] = $checkDataList->phone . "";
                    $response['data']['email'] = $checkDataList->email . "";
                    $response['data']['username'] = $checkDataList->username . "";
                    $response['data']['osnap_id'] = $checkDataList->osnap_id . "";
                    $response['data']['image'] = $checkDataList->image . "";
                    $response['data']['post_code'] = $checkDataList->post_code . "";

                    $response['data']['address'] = $checkDataList->address . "";
                    $response['data']['latitude'] = $checkDataList->latitude . "";
                    $response['data']['longtitude'] = $checkDataList->longtitude . "";
                    $response['data']['city'] = $checkDataList->city . "";
                    $response['data']['state'] = $checkDataList->state . "";
                    $response['data']['country'] = $checkDataList->country . "";


                    $response['data']['device_type'] = $checkDataList->device_type . "";
                    $response['data']['device_token'] = $checkDataList->device_token . "";
                    $response['data']['is_agree'] = $checkDataList->is_agree . "";

                    if ($checkDataList->is_agree == "0") {
                        $response['data']['agreement_step'] = 0;
                    } else {
                        $response['data']['agreement_step'] = 1;
                    }
                    $response['data']['payment_step'] = 1;


                    $sql6 = "SELECT * from `user_review` where user_id = " . $checkDataList->id. " order by review_date limit 5";
                    $command6 = Yii::app()->db->createCommand($sql6);
                    $ratedata = $command6->queryAll();
                    $ratearray = array();
                    $avg = 0;
                    $total = 0;
                    $cnt = 0;
                    if (!empty($ratedata)) {
                        $gaarray = array();
                        foreach ($ratedata as $key6 => $value6) {
                            $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                            if ($fromuser) {
                                $temparray = array();
                                $temparray['review_count'] = $value6['review_count'];
                                $temparray['review'] = $value6['review'];
                                $temparray['review_date'] = $value6['review_date'];

                                $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }

                                //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                //  print_r($temparray);

                                $temparray['user_id'] = $fromuser->id;
                                $temparray['first_name'] = $fromuser->first_name;
                                $temparray['last_name'] = $fromuser->last_name;
                                $temparray['profile_image'] = $fromuser->image;
                                $ratearray[] = $temparray;
                                $total = $total + $value6['review_count'];
                                $cnt++;
                            }
                            //$gaarray[] = $temparray;
                        }
                        $avg = $total / $cnt;
                        //$response['data']['gallery'] = $gaarray;
                    }
                    $response['data']['ratearray'] = $ratearray;
                    $response['data']['avgrate'] = round($avg,2)."";

                    $sql8 = "SELECT * from `user_licenses` where user_id = " . $checkDataList->id;
                    $command8 = Yii::app()->db->createCommand($sql8);
                    $licensesdata = $command8->queryAll();
                    $licensesarray = array();
                    $avg = 0;
                    $total = 0;
                    $cnt = 0;
                    if (!empty($licensesdata)) {
                        $gaarray = array();
                        foreach ($licensesdata as $key7 => $val7) {
                            
                                $temparray = array();
                                $temparray['name'] = $val7['name'];
                                $temparray['month'] = $val7['month'];
                                $temparray['year'] = $val7['year'];
                                $temparray['ul_id'] = $val7['ul_id'];
                                $licensesarray[] = $temparray;
                        }
                       
                    }
                    $response['data']['licensesarray'] = $licensesarray;

                    $userexp = array();

                    $connection = Yii::app()->db;

                    $sql1 = "SELECT * from user_experience where user_id=" . $checkDataList->id;


                    $command1 = Yii::app()->db->createCommand($sql1);
                    $explist = $command1->queryAll();
                   if (!empty($explist)) {
                        $exparray = array();
                        $professional_experience = "";
                        $education = "";
                        foreach ($explist as $key => $value) {
                            $temp = array();
                            $exid = $value['id'];
                            $temp['id'] = $exid;
                            $professional_experience = $value['professional_experience'] . "";
                            $education_id = $value['education_id'] ;
                            $child1 = $value['child1'] ;
                            $child2 = $value['child2'] ;
                            $child1value = $value['child1value'] ;
                            $child2value = $value['child2value'] ;
                            $temp['company_name'] = $value['company_name'] . "";
                            $temp['from_month'] = $value['from_month'];
                            $temp['from_year'] = $value['from_year'];
                            $temp['to_month'] = $value['to_month'];
                            $temp['to_year'] = $value['to_year'];
                            $temp['is_current'] = $value['is_current'];
                            $exparray[] = $temp;
                        }
                        $response['data']['user_exp'] = $exparray;
                        $response['data']['professional_experience'] = $professional_experience;
                        $response['data']['education_id'] = $education_id;
                        $response['data']['education_id_name'] = $this->GetEducationName($education_id);
                        $response['data']['child1'] = $child1;
                        $response['data']['child1_name'] = $this->GetEducationName($child1);
                        $response['data']['child2'] = $child2;
                        $response['data']['child2_name'] = $this->GetEducationName($child2);
                        $response['data']['child1value'] = $child1value;
                        $response['data']['child2value'] = $child2value;
                        $response['data']['experience_step'] = 1;
                    } else {
                        $response['data']['user_exp'] = [];
                        $response['data']['professional_experience'] = "";
                        $response['data']['education_id'] = "";
                        $response['data']['education_id_name'] = "";
                        $response['data']['child1'] = "";
                        $response['data']['child1_name'] = "";
                        $response['data']['child2'] = "";
                        $response['data']['child2_name'] = "";
                        $response['data']['child1value'] = "";
                        $response['data']['child2value'] = "";
                        $response['data']['experience_step'] = 0;
                    }



                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("successexp", $lang);
                    /* $response['data']['user_id'] =   $UserExperienceData->attributes['user_id']."";
                      $response['professional_experience'] =    $UserExperienceData->attributes['professional_experience']."";
                      $response['education'] =  $UserExperienceData->attributes['education']."";
                      $response['data']['company_name'] =   $UserExperienceData->attributes['company_name']."";
                      $response['data']['from_month'] =     $UserExperienceData->attributes['from_month']."";
                      $response['data']['from_year'] =  $UserExperienceData->attributes['from_year']."";
                      $response['data']['to_month'] =   $UserExperienceData->attributes['to_month']."";
                      $response['data']['to_year'] =    $UserExperienceData->attributes['to_year'].""; */
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("savedfail", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }
 
    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : July 27 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Add Experience.
     * */
    public function actionAddUpdateLicenses() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) || empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) || empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }

        if (!isset($apiData['data']['licenses']) || empty($apiData['data']['licenses'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlicenses", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
       else {

            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {

                $licensesData = $apiData['data']['licenses'];
                $deleteLicensesData = UserLicenses::model()->deleteAll("user_id = '" . $apiData['data']['id'] . "'");
                $success = 0;
                foreach ($licensesData as $data) {
                    $UserLicensesData = new UserLicenses();
                    $UserLicensesData->user_id = $apiData['data']['id'];
                    $UserLicensesData->name = $data['name'];
                    $UserLicensesData->month = $data['month'];               
                    $UserLicensesData->year = $data['year'];                   
                    $UserLicensesData->save(false);
                    $success = 1;
                }
                if ($success == 1) {

                    $checkDataList = User::model()->find("id ='" . $apiData['data']['id'] . "'");
                    $response['data']['id'] = ($checkDataList->id) ? $checkDataList->id : '';
                    $response['data']['token'] = ($checkDataList->token) ? $checkDataList->token : '';
                    $response['data']['first_name'] = $checkDataList->first_name . "";
                    $response['data']['last_name'] = $checkDataList->last_name . "";
                    $response['data']['user_type'] = $checkDataList->user_type . "";

                    $response['data']['time_ago'] = $this->time_diffrent($checkDataList->created_at);
                    $is_security_code_exist = "0"; 
                        if( $checkDataList->security_code !="" && $checkDataList->security_code!=0 )
                        {
                            $is_security_code_exist = "1";     
                        }
                        $response['data']['security_code_exist'] = $is_security_code_exist . "";
                    $response['data']['business_name'] = $checkDataList->business_name . "";

                    $response['data']['business_type_id'] = $checkDataList->business_type . "";
                        $response['data']['business_type'] = GlobalFunction::getBusinessTypes($checkDataList->business_type) . "";  


                    $response['data']['business_category'] = $checkDataList->business_category . "";

                    $response['data']['business_category_name'] =  $this->GetBusinessCategoryName($checkDataList->business_category );

                    $response['data']['business_osnap_id'] = $checkDataList->business_osnap_id . "";
                    $response['data']['business_esta_month'] = $checkDataList->business_esta_month . "";
                    $response['data']['business_esta_year'] = $checkDataList->business_esta_year . "";
                    $response['data']['business_owner'] = $checkDataList->business_owner . "";
                    $response['data']['business_notes'] = $checkDataList->business_notes . "";
                    
                    $response['data']['exp_level'] = $checkDataList->exp_level . "";
                    $response['data']['business_image'] = $checkDataList->business_image . "";


                    if ($checkDataList->business_name == "" || $checkDataList->business_type == "" || $checkDataList->business_category == "" || $checkDataList->business_osnap_id == "" || $checkDataList->business_owner == "" /*|| $checkDataList->business_image == ""*/) {
                        $response['data']['business_step'] = 0;
                    } else {
                        $response['data']['business_step'] = 1;
                    }

                    if($checkDataList->stripe_user_id=="")
                    {
                        $response['data']['stripe_step'] = 0;
                    }
                    else
                    {
                        $response['data']['stripe_step'] = 1;
                    }


                    $connection = Yii::app()->db;
                    $sql1 = "SELECT * from user_experience where user_id=" . $checkDataList->id;
                    $command1 = Yii::app()->db->createCommand($sql1);
                    $explist = $command1->queryAll();
                  if (!empty($explist)) {
                        $exparray = array();
                        $professional_experience = "";
                        $education = "";
                        foreach ($explist as $key => $value) {
                            $temp = array();
                            $exid = $value['id'];
                            $temp['id'] = $exid;
                            $professional_experience = $value['professional_experience'] . "";
                            $education_id = $value['education_id'] ;
                            $child1 = $value['child1'] ;
                            $child2 = $value['child2'] ;
                            $child1value = $value['child1value'] ;
                            $child2value = $value['child2value'] ;
                            $temp['company_name'] = $value['company_name'] . "";
                            $temp['from_month'] = $value['from_month'];
                            $temp['from_year'] = $value['from_year'];
                            $temp['to_month'] = $value['to_month'];
                            $temp['to_year'] = $value['to_year'];
                            $temp['is_current'] = $value['is_current'];
                            $exparray[] = $temp;
                        }
                        $response['data']['user_exp'] = $exparray;
                        $response['data']['professional_experience'] = $professional_experience;
                        $response['data']['education_id'] = $education_id;
                        $response['data']['education_id_name'] = $this->GetEducationName($education_id);
                        $response['data']['child1'] = $child1;
                        $response['data']['child1_name'] = $this->GetEducationName($child1);
                        $response['data']['child2'] = $child2;
                        $response['data']['child2_name'] = $this->GetEducationName($child2);
                        $response['data']['child1value'] = $child1value;
                        $response['data']['child2value'] = $child2value;
                        $response['data']['experience_step'] = 1;
                    } else {
                        $response['data']['user_exp'] = [];
                        $response['data']['professional_experience'] = "";
                        $response['data']['education_id'] = "";
                        $response['data']['education_id_name'] = "";
                        $response['data']['child1'] = "";
                        $response['data']['child1_name'] = "";
                        $response['data']['child2'] = "";
                        $response['data']['child2_name'] = "";
                        $response['data']['child1value'] = "";
                        $response['data']['child2value'] = "";
                        $response['data']['experience_step'] = 0;
                    }

                    $connection = Yii::app()->db;
                    $sql2 = "SELECT * from user_skill where user_id=" . $checkDataList->id;
                    $command2 = Yii::app()->db->createCommand($sql2);
                    $skilllist = $command2->queryAll();
                    if (!empty($skilllist)) {
                        $skillarray = array();
                        foreach ($skilllist as $key => $value) {
                            $temp = array();
                            $skillid = $value['id'];
                            $temp['id'] = $skillid;
                            $temp['service_name'] = $value['service_name'] . "";
                            $temp['category_id'] = $value['category_id'];
                            $temp['subcategory_id'] = $value['subcategory_id'];
                            $temp['category_name'] = $this->GetCategoryName($value['category_id']);
                            $temp['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);
                            $temp['price'] = $value['price'];
                            $temp['price_type'] = $value['price_type'];
                            $temp['start_time'] = $value['start_time'];
                            $temp['end_time'] = $value['end_time'];
                            $temp['description'] = $value['description'];
                            $temp['service_photo'] = ( (!empty($value['service_photo']) && $value['service_photo']!="null" ) ?  json_decode($value['service_photo']) : [] );
                            $skillarray[] = $temp;
                        }
                        $response['data']['user_skill'] = $skillarray;
                        $response['data']['skill_step'] = 1;
                    } else {
                        $response['data']['user_skill'] = [];
                        $response['data']['skill_step'] = 0;
                    }


                    $response['data']['birth_date'] = $checkDataList->birth_date . "";
                    $response['data']['country_code'] = $checkDataList->country_code . "";
                    $response['data']['phone'] = $checkDataList->phone . "";
                    $response['data']['email'] = $checkDataList->email . "";
                    $response['data']['username'] = $checkDataList->username . "";
                    $response['data']['osnap_id'] = $checkDataList->osnap_id . "";
                    $response['data']['image'] = $checkDataList->image . "";
                    $response['data']['post_code'] = $checkDataList->post_code . "";

                    $response['data']['address'] = $checkDataList->address . "";
                    $response['data']['latitude'] = $checkDataList->latitude . "";
                    $response['data']['longtitude'] = $checkDataList->longtitude . "";
                    $response['data']['city'] = $checkDataList->city . "";
                    $response['data']['state'] = $checkDataList->state . "";
                    $response['data']['country'] = $checkDataList->country . "";


                    $response['data']['device_type'] = $checkDataList->device_type . "";
                    $response['data']['device_token'] = $checkDataList->device_token . "";
                    $response['data']['is_agree'] = $checkDataList->is_agree . "";

                    if ($checkDataList->is_agree == "0") {
                        $response['data']['agreement_step'] = 0;
                    } else {
                        $response['data']['agreement_step'] = 1;
                    }
                    $response['data']['payment_step'] = 1;


                    $sql6 = "SELECT * from `user_review` where user_id = " . $checkDataList->id. " order by review_date limit 5";
                    $command6 = Yii::app()->db->createCommand($sql6);
                    $ratedata = $command6->queryAll();
                    $ratearray = array();
                    $avg = 0;
                    $total = 0;
                    $cnt = 0;
                    if (!empty($ratedata)) {
                        $gaarray = array();
                        foreach ($ratedata as $key6 => $value6) {
                            $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                            if ($fromuser) {
                                $temparray = array();
                                $temparray['review_count'] = $value6['review_count'];
                                $temparray['review'] = $value6['review'];
                                $temparray['review_date'] = $value6['review_date'];

                                $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }

                                //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                //  print_r($temparray);

                                $temparray['user_id'] = $fromuser->id;
                                $temparray['first_name'] = $fromuser->first_name;
                                $temparray['last_name'] = $fromuser->last_name;
                                $temparray['profile_image'] = $fromuser->image;
                                $ratearray[] = $temparray;
                                $total = $total + $value6['review_count'];
                                $cnt++;
                            }
                            //$gaarray[] = $temparray;
                        }
                        $avg = $total / $cnt;
                        //$response['data']['gallery'] = $gaarray;
                    }
                    $response['data']['ratearray'] = $ratearray;
                    $response['data']['avgrate'] = round($avg,2)."";

                    $sql8 = "SELECT * from `user_licenses` where user_id = " . $checkDataList->id;
                    $command8 = Yii::app()->db->createCommand($sql8);
                    $licensesdata = $command8->queryAll();
                    $licensesarray = array();
                    $avg = 0;
                    $total = 0;
                    $cnt = 0;
                    if (!empty($licensesdata)) {
                        $gaarray = array();
                        foreach ($licensesdata as $key7 => $val7) {
                            
                                $temparray = array();
                                $temparray['name'] = $val7['name'];
                                $temparray['month'] = $val7['month'];
                                $temparray['year'] = $val7['year'];
                                $temparray['ul_id'] = $val7['ul_id'];
                                $licensesarray[] = $temparray;
                        }
                       
                    }
                    $response['data']['licensesarray'] = $licensesarray;

                    $sql8 = "SELECT * from `user_licenses` where user_id = " . $checkDataList->id;
                    $command8 = Yii::app()->db->createCommand($sql8);
                    $licensesdata = $command8->queryAll();
                    $licensesarray = array();
                    $avg = 0;
                    $total = 0;
                    $cnt = 0;
                    if (!empty($licensesdata)) {
                        $gaarray = array();
                        foreach ($licensesdata as $key7 => $val7) {
                            
                                $temparray = array();
                                $temparray['name'] = $val7['name'];
                                $temparray['month'] = $val7['month'];
                                $temparray['year'] = $val7['year'];
                                $temparray['ul_id'] = $val7['ul_id'];
                                $licensesarray[] = $temparray;
                        }
                       
                    }
                    $response['data']['licensesarray'] = $licensesarray;



                    $userexp = array();

                    $connection = Yii::app()->db;

                    $sql1 = "SELECT * from user_experience where user_id=" . $checkDataList->id;


                    $command1 = Yii::app()->db->createCommand($sql1);
                    $explist = $command1->queryAll();
                   if (!empty($explist)) {
                        $exparray = array();
                        $professional_experience = "";
                        $education = "";
                        foreach ($explist as $key => $value) {
                            $temp = array();
                            $exid = $value['id'];
                            $temp['id'] = $exid;
                            $professional_experience = $value['professional_experience'] . "";
                            $education_id = $value['education_id'] ;
                            $child1 = $value['child1'] ;
                            $child2 = $value['child2'] ;
                            $child1value = $value['child1value'] ;
                            $child2value = $value['child2value'] ;
                            $temp['company_name'] = $value['company_name'] . "";
                            $temp['from_month'] = $value['from_month'];
                            $temp['from_year'] = $value['from_year'];
                            $temp['to_month'] = $value['to_month'];
                            $temp['to_year'] = $value['to_year'];
                            $temp['is_current'] = $value['is_current'];
                            $exparray[] = $temp;
                        }
                        $response['data']['user_exp'] = $exparray;
                        $response['data']['professional_experience'] = $professional_experience;
                        $response['data']['education_id'] = $education_id;
                        $response['data']['education_id_name'] = $this->GetEducationName($education_id);
                        $response['data']['child1'] = $child1;
                        $response['data']['child1_name'] = $this->GetEducationName($child1);
                        $response['data']['child2'] = $child2;
                        $response['data']['child2_name'] = $this->GetEducationName($child2);
                        $response['data']['child1value'] = $child1value;
                        $response['data']['child2value'] = $child2value;
                        $response['data']['experience_step'] = 1;
                    } else {
                        $response['data']['user_exp'] = [];
                        $response['data']['professional_experience'] = "";
                        $response['data']['education_id'] = "";
                        $response['data']['education_id_name'] = "";
                        $response['data']['child1'] = "";
                        $response['data']['child1_name'] = "";
                        $response['data']['child2'] = "";
                        $response['data']['child2_name'] = "";
                        $response['data']['child1value'] = "";
                        $response['data']['child2value'] = "";
                        $response['data']['experience_step'] = 0;
                    }



                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("successexp", $lang);
                    /* $response['data']['user_id'] =   $UserExperienceData->attributes['user_id']."";
                      $response['professional_experience'] =    $UserExperienceData->attributes['professional_experience']."";
                      $response['education'] =  $UserExperienceData->attributes['education']."";
                      $response['data']['company_name'] =   $UserExperienceData->attributes['company_name']."";
                      $response['data']['from_month'] =     $UserExperienceData->attributes['from_month']."";
                      $response['data']['from_year'] =  $UserExperienceData->attributes['from_year']."";
                      $response['data']['to_month'] =   $UserExperienceData->attributes['to_month']."";
                      $response['data']['to_year'] =    $UserExperienceData->attributes['to_year'].""; */
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("savedfail", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }
    

    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : July 27 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Add Skill.
     * */
    public function actionAddUpdateSkill() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) || empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) || empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }

        if (!isset($apiData['data']['skill']) || empty($apiData['data']['skill'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passskill", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {

                $skillData = $apiData['data']['skill'];
                $deleteExperienceData = UserSkill::model()->deleteAll("user_id = '" . $apiData['data']['id'] . "'");
                $success = 0;
                foreach ($skillData as $data) {
                    $UserSkillData = new UserSkill();
                    $UserSkillData->user_id = $apiData['data']['id'];
                    $UserSkillData->service_name = $data['service_name'];
                    $UserSkillData->category_id = $data['category_id'];
                    $UserSkillData->subcategory_id = $data['subcategory_id'];

                    $UserSkillData->price = $data['price'];
                    $UserSkillData->price_type = $data['price_type'];
                    $UserSkillData->start_time = $data['start_time'];
                    $UserSkillData->end_time = $data['end_time'];
                    $UserSkillData->description = $data['description'];
                    $UserSkillData->service_photo = ( (!empty($data['service_photo']) && $data['service_photo']!="null" ) ?  json_encode($data['service_photo']) : '' );
                    $UserSkillData->save(false);
                    $success = 1;
                }
                if ($success == 1) {

                    $checkDataList = User::model()->find("id ='" . $apiData['data']['id'] . "'");
                    $response['data']['id'] = ($checkDataList->id) ? $checkDataList->id : '';
                    $response['data']['token'] = ($checkDataList->token) ? $checkDataList->token : '';
                    $response['data']['first_name'] = $checkDataList->first_name . "";
                    $response['data']['last_name'] = $checkDataList->last_name . "";
                    $response['data']['user_type'] = $checkDataList->user_type . "";
                    $response['data']['time_ago'] = $this->time_diffrent($checkDataList->created_at);
                    $is_security_code_exist = "0"; 
                        if( $checkDataList->security_code !="" && $checkDataList->security_code!=0 )
                        {
                            $is_security_code_exist = "1";     
                        }
                        $response['data']['security_code_exist'] = $is_security_code_exist . "";
                    $response['data']['business_name'] = $checkDataList->business_name . "";
                    $response['data']['business_type_id'] = $checkDataList->business_type . "";
                        $response['data']['business_type'] = GlobalFunction::getBusinessTypes($checkDataList->business_type) . "";  

                    $response['data']['business_category'] = $checkDataList->business_category . "";
                    $response['data']['business_category_name'] =  $this->GetBusinessCategoryName($checkDataList->business_category );
                    $response['data']['business_osnap_id'] = $checkDataList->business_osnap_id . "";
                    $response['data']['business_esta_month'] = $checkDataList->business_esta_month . "";
                    $response['data']['business_esta_year'] = $checkDataList->business_esta_year . "";
                    $response['data']['business_owner'] = $checkDataList->business_owner . "";
                    $response['data']['business_notes'] = $checkDataList->business_notes . "";
                    $response['data']['exp_level'] = $checkDataList->exp_level . "";
                    $response['data']['business_image'] = $checkDataList->business_image . "";

                    if ($checkDataList->business_name == "" || $checkDataList->business_type == "" || $checkDataList->business_category == "" ||  $checkDataList->business_osnap_id == "" || $checkDataList->business_owner == "" /*|| $checkDataList->business_image == ""*/) {
                        $response['data']['business_step'] = 0;
                    } else {
                        $response['data']['business_step'] = 1;
                    }

                    if($checkDataList->stripe_user_id=="")
                    {
                        $response['data']['stripe_step'] = 0;
                    }
                    else
                    {
                        $response['data']['stripe_step'] = 1;
                    }
                        

                    $connection = Yii::app()->db;
                    $sql1 = "SELECT * from user_experience where user_id=" . $checkDataList->id;
                    $command1 = Yii::app()->db->createCommand($sql1);
                    $explist = $command1->queryAll();
                    if (!empty($explist)) {
                        $exparray = array();
                        $professional_experience = "";
                        $education = "";
                        foreach ($explist as $key => $value) {
                            $temp = array();
                            $exid = $value['id'];
                            $temp['id'] = $exid;
                            $professional_experience = $value['professional_experience'] . "";
                            $education_id = $value['education_id'] ;
                            $child1 = $value['child1'] ;
                            $child2 = $value['child2'] ;
                            $child1value = $value['child1value'] ;
                            $child2value = $value['child2value'] ;
                            $temp['company_name'] = $value['company_name'] . "";
                            $temp['from_month'] = $value['from_month'];
                            $temp['from_year'] = $value['from_year'];
                            $temp['to_month'] = $value['to_month'];
                            $temp['to_year'] = $value['to_year'];
                            $temp['is_current'] = $value['is_current'];
                            $exparray[] = $temp;
                        }
                        $response['data']['user_exp'] = $exparray;
                        $response['data']['professional_experience'] = $professional_experience;
                        $response['data']['education_id'] = $education_id;
                        $response['data']['education_id_name'] = $this->GetEducationName($education_id);
                        $response['data']['child1'] = $child1;
                        $response['data']['child1_name'] = $this->GetEducationName($child1);
                        $response['data']['child2'] = $child2;
                        $response['data']['child2_name'] = $this->GetEducationName($child2);
                        $response['data']['child1value'] = $child1value;
                        $response['data']['child2value'] = $child2value;
                        $response['data']['experience_step'] = 1;
                    } else {
                        $response['data']['user_exp'] = [];
                        $response['data']['professional_experience'] = "";
                        $response['data']['education_id'] = "";
                        $response['data']['education_id_name'] = "";
                        $response['data']['child1'] = "";
                        $response['data']['child1_name'] = "";
                        $response['data']['child2'] = "";
                        $response['data']['child2_name'] = "";
                        $response['data']['child1value'] = "";
                        $response['data']['child2value'] = "";
                        $response['data']['experience_step'] = 0;
                    }


                    $connection = Yii::app()->db;
                    $sql2 = "SELECT * from user_skill where user_id=" . $checkDataList->id;
                    $command2 = Yii::app()->db->createCommand($sql2);
                    $skilllist = $command2->queryAll();
                    if (!empty($skilllist)) {
                        $skillarray = array();
                        foreach ($skilllist as $key => $value) {
                            $temp = array();
                            $skillid = $value['id'];
                            $temp['id'] = $skillid;
                            $temp['service_name'] = $value['service_name'] . "";
                            $temp['category_id'] = $value['category_id'];
                            $temp['subcategory_id'] = $value['subcategory_id'];

                            $temp['category_name'] = $this->GetCategoryName($value['category_id']);
                            $temp['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);

                            $temp['price'] = $value['price'];
                            $temp['price_type'] = $value['price_type'];
                            $temp['start_time'] = $value['start_time'];
                            $temp['end_time'] = $value['end_time'];
                            $temp['description'] = $value['description'];
                            $temp['service_photo'] = ( (!empty($value['service_photo']) && $value['service_photo']!="null" ) ?  json_decode($value['service_photo']) : [] );
                            $skillarray[] = $temp;
                        }
                        $response['data']['user_skill'] = $skillarray;
                        $response['data']['skill_step'] = 1;
                    } else {
                        $response['data']['user_skill'] = [];
                        $response['data']['skill_step'] = 0;
                    }


                    $response['data']['birth_date'] = $checkDataList->birth_date . "";
                    $response['data']['country_code'] = $checkDataList->country_code . "";
                    $response['data']['phone'] = $checkDataList->phone . "";
                    $response['data']['email'] = $checkDataList->email . "";
                    $response['data']['username'] = $checkDataList->username . "";
                    $response['data']['osnap_id'] = $checkDataList->osnap_id . "";
                    $response['data']['image'] = $checkDataList->image . "";
                    $response['data']['post_code'] = $checkDataList->post_code . "";

                    $response['data']['address'] = $checkDataList->address . "";
                    $response['data']['latitude'] = $checkDataList->latitude . "";
                    $response['data']['longtitude'] = $checkDataList->longtitude . "";
                    $response['data']['city'] = $checkDataList->city . "";
                    $response['data']['state'] = $checkDataList->state . "";
                    $response['data']['country'] = $checkDataList->country . "";

                    $response['data']['device_type'] = $checkDataList->device_type . "";
                    $response['data']['device_token'] = $checkDataList->device_token . "";
                    $response['data']['is_agree'] = $checkDataList->is_agree . "";

                    if ($checkDataList->is_agree == "0") {
                        $response['data']['agreement_step'] = 0;
                    } else {
                        $response['data']['agreement_step'] = 1;
                    }
                    $response['data']['payment_step'] = 1;


                    $sql6 = "SELECT * from `user_review` where user_id = " . $checkDataList->id. " order by review_date limit 5";
                    $command6 = Yii::app()->db->createCommand($sql6);
                    $ratedata = $command6->queryAll();
                    $ratearray = array();
                    $avg = 0;
                    $total = 0;
                    $cnt = 0;
                    if (!empty($ratedata)) {
                        $gaarray = array();
                        foreach ($ratedata as $key6 => $value6) {
                            $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                            if ($fromuser) {
                                $temparray = array();
                                $temparray['review_count'] = $value6['review_count'];
                                $temparray['review'] = $value6['review'];
                                $temparray['review_date'] = $value6['review_date'];

                                $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }

                                //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                //  print_r($temparray);

                                $temparray['user_id'] = $fromuser->id;
                                $temparray['first_name'] = $fromuser->first_name;
                                $temparray['last_name'] = $fromuser->last_name;
                                $temparray['profile_image'] = $fromuser->image;
                                $ratearray[] = $temparray;
                                $total = $total + $value6['review_count'];
                                $cnt++;
                            }
                            //$gaarray[] = $temparray;
                        }
                        $avg = $total / $cnt;
                        //$response['data']['gallery'] = $gaarray;
                    }
                    $response['data']['ratearray'] = $ratearray;
                    $response['data']['avgrate'] = round($avg,2)."";

                    $sql8 = "SELECT * from `user_licenses` where user_id = " . $checkDataList->id;
                    $command8 = Yii::app()->db->createCommand($sql8);
                    $licensesdata = $command8->queryAll();
                    $licensesarray = array();
                    $avg = 0;
                    $total = 0;
                    $cnt = 0;
                    if (!empty($licensesdata)) {
                        $gaarray = array();
                        foreach ($licensesdata as $key7 => $val7) {
                            
                                $temparray = array();
                                $temparray['name'] = $val7['name'];
                                $temparray['month'] = $val7['month'];
                                $temparray['year'] = $val7['year'];
                                $temparray['ul_id'] = $val7['ul_id'];
                                $licensesarray[] = $temparray;
                        }
                       
                    }
                    $response['data']['licensesarray'] = $licensesarray;



                    $userexp = array();

                    $connection = Yii::app()->db;

                    $sql1 = "SELECT * from user_experience where user_id=" . $checkDataList->id;


                    $command1 = Yii::app()->db->createCommand($sql1);
                    $explist = $command1->queryAll();
                   if (!empty($explist)) {
                        $exparray = array();
                        $professional_experience = "";
                        $education = "";
                        foreach ($explist as $key => $value) {
                            $temp = array();
                            $exid = $value['id'];
                            $temp['id'] = $exid;
                            $professional_experience = $value['professional_experience'] . "";
                            $education_id = $value['education_id'] ;
                            $child1 = $value['child1'] ;
                            $child2 = $value['child2'] ;
                            $child1value = $value['child1value'] ;
                            $child2value = $value['child2value'] ;
                            $temp['company_name'] = $value['company_name'] . "";
                            $temp['from_month'] = $value['from_month'];
                            $temp['from_year'] = $value['from_year'];
                            $temp['to_month'] = $value['to_month'];
                            $temp['to_year'] = $value['to_year'];
                            $temp['is_current'] = $value['is_current'];
                            $exparray[] = $temp;
                        }
                        $response['data']['user_exp'] = $exparray;
                        $response['data']['professional_experience'] = $professional_experience;
                        $response['data']['education_id'] = $education_id;
                        $response['data']['education_id_name'] = $this->GetEducationName($education_id);
                        $response['data']['child1'] = $child1;
                        $response['data']['child1_name'] = $this->GetEducationName($child1);
                        $response['data']['child2'] = $child2;
                        $response['data']['child2_name'] = $this->GetEducationName($child2);
                        $response['data']['child1value'] = $child1value;
                        $response['data']['child2value'] = $child2value;
                        $response['data']['experience_step'] = 1;
                    } else {
                        $response['data']['user_exp'] = [];
                        $response['data']['professional_experience'] = "";
                        $response['data']['education_id'] = "";
                        $response['data']['education_id_name'] = "";
                        $response['data']['child1'] = "";
                        $response['data']['child1_name'] = "";
                        $response['data']['child2'] = "";
                        $response['data']['child2_name'] = "";
                        $response['data']['child1value'] = "";
                        $response['data']['child2value'] = "";
                        $response['data']['experience_step'] = 0;
                    }


                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("successskill", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("savedfail", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : July 03 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Add Review By Business.
     * */
    public function actionAddReviewByBusiness() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) || empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) || empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }

        if (!isset($apiData['data']['pb_id']) || empty($apiData['data']['pb_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpbid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['review_count']) || empty($apiData['data']['review_count'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passreviewcount", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['review']) || empty($apiData['data']['review'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passreview", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {

                   $pData = UserReview::model()->find("review_by='".$apiData['data']['id']."' AND pb_id = '".$apiData['data']['pb_id']."'");
                   if(!$pData){

                        $PostBid_info = PostBid::model()->find("pb_id ='".$apiData['data']['pb_id']."'");
                        $temp_date =  date('Y-m-d H:i:s');
                        $temp_review = json_decode($PostBid_info->temp_review,true);

                        $tempreviewData = new UserReview();
                        $tempreviewData->user_id = $temp_review['user_id'];
                        $tempreviewData->review_by = $temp_review['review_by'];
                        $tempreviewData->pb_id = $temp_review['pb_id'];
                        $tempreviewData->review_count = $temp_review['review_count'];
                        $tempreviewData->review = $temp_review['review'];
                        $tempreviewData->review_date = $temp_date;
                        $tempreviewData->save(false);

                  
                        $reviewData = new UserReview();
                        $reviewData->user_id = $PostBid_info->offer_by;
                        $reviewData->review_by = $apiData['data']['id'];
                        $reviewData->pb_id = $apiData['data']['pb_id'];
                        $reviewData->review_count = $apiData['data']['review_count'];
                        $reviewData->review = $apiData['data']['review'];
                        $reviewData->review_date = $temp_date;

                       if ($reviewData->save(false)) {

                             $PostBidData = $this->loadModel($apiData['data']['pb_id'], 'PostBid');
                             $PostBidData->temp_review = "";
                             $PostBidData->review_by_user = "1";
                             $PostBidData->save(false);


                            $response['status'] = "1";
                            $response['message'] = $this->GetNotification("successreview",$lang);
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode($response);
                            exit();
                        }
                        else
                        {
                            $response['status'] = "0";
                            $response['message'] = $this->GetNotification("savedfail",$lang);
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode($response);
                            exit();
                        }
                    }
                    else
                    {
                        $response['status'] = "0";
                        $response['message'] = $this->GetNotification("alrdygivenreview",$lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }
                    
               
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : Aug 08 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Add Post
     * */
    public function actionAddPost() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) || empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) || empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }

        if (!isset($apiData['data']['job_title']) || empty($apiData['data']['job_title'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passjobtitle", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['job_description']) || empty($apiData['data']['job_description'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passjobdescription", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['category_id']) || empty($apiData['data']['category_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passcate", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['subcategory_id']) || empty($apiData['data']['subcategory_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passsubcate", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['work_type']) || empty($apiData['data']['work_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passworktype", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['pay_by']) || empty($apiData['data']['pay_by'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpayby", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['exp_level']) || empty($apiData['data']['exp_level'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passexplevel", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['how_long']) || empty($apiData['data']['how_long'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passhowlong", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['commitment']) || empty($apiData['data']['commitment'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passcommitment", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {

            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {

                $ExperienceData = $apiData['data']['experience'];


                $PostJobData = new PostJob();
                $PostJobData->job_title = $apiData['data']['job_title'];
                $PostJobData->job_description = $apiData['data']['job_description'];
                $PostJobData->category_id = $apiData['data']['category_id'];
                $PostJobData->subcategory_id = $apiData['data']['subcategory_id'];
                $PostJobData->work_type = $apiData['data']['work_type'];
                $PostJobData->pay_by = $apiData['data']['pay_by'];
                $PostJobData->exp_level = $apiData['data']['exp_level'];
                $PostJobData->how_long = $apiData['data']['how_long'];

                $PostJobData->latitude = $apiData['data']['latitude'];
                $PostJobData->longtitude = $apiData['data']['longtitude'];

                $PostJobData->commitment = $apiData['data']['commitment'];
                $PostJobData->user_id = $apiData['data']['id'];
                $PostJobData->rate = $apiData['data']['rate'];
                $PostJobData->attachments = json_encode($apiData['data']['attachments']);
                $PostJobData->post_datetime = date('Y-m-d H:i:s');
                
                //$PostJobData->save(false);
                if ($PostJobData->save(false)) {



                 
                $connection = Yii::app()->db;
                $select = "a.*";
                $table = "user as a";
                $where = " a.is_active=1 and a.user_type=2 and a.is_agree = 1 and a.expiration_datetime >= NOW() ";                
                $having  = "";
                $connection = Yii::app()->db;                
                $user_info = User::model()->find("id ='".$apiData['data']['id']."'");
                $latitude = $user_info->latitude;
                $longtitude = $user_info->longtitude;                
                $miles = "50";
                $select .=  (!empty($select) ? " , " : "")." ((ACOS(SIN(".$latitude."* PI() / 180) * SIN(a.latitude * PI() / 180) + COS(".$latitude."* PI() / 180) * COS(a.latitude * PI() / 180) * COS((".$longtitude." - a.longtitude) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS distance ";            
                $having = " having distance <=". $miles;                
               
                if( (isset($apiData['data']['category_id']) && !empty($apiData['data']['category_id'])) || (isset($apiData['data']['subcategory_id']) && !empty($apiData['data']['subcategory_id']))){

                        $table  .= " LEFT JOIN user_skill as c ON a.id = c.user_id ";
                        if(isset($apiData['data']['category_id']) && !empty($apiData['data']['category_id']))
                        {
                            $where  .= (!empty($where) ? " OR " : ""). "  c.category_id = ". $apiData['data']['category_id'];
                        }
                        if(isset($apiData['data']['subcategory_id']) && !empty($apiData['data']['subcategory_id']))
                        {
                            $where  .= (!empty($where) ? " OR " : ""). "  c.subcategory_id = ". $apiData['data']['subcategory_id'];
                        }
                        
                }

                $sql = "SELECT " . $select . " from " . $table . " where " . $where  . $having   ;

                $command = Yii::app()->db->createCommand($sql);
                $userslist = $command->queryAll();
                if (!empty($userslist)) {
                    foreach ($userslist as $key => $value) {
                        $user_id = $value['id'];

                        $touser = User::model()->find("id ='".$user_id."'");
                        $fromuser = User::model()->find("id ='".$apiData['data']['id']."'");


                        $fromusername = $fromuser->first_name . " " . $fromuser->last_name;
                        $message =  $this->GetNotification("addnewpost", $lang);



                        $activityFeed = new FeedAcivity();

                        $activityFeed->user_id = $apiData['data']['id'];
                        $activityFeed->feed_id = $PostJobData->attributes['post_id'];
                        $activityFeed->author_id = $user_id;
                        $activityFeed->activity_detail_id = $PostJobData->attributes['post_id']; //EventToUser table id
                        $activityFeed->msg = $message;
                        $activityFeed->status = 1; //Event Accept
                        $activityFeed->Is_read = "0";
                        $activityFeed->created_at = date("Y-m-d H:i:s");
                        $activityFeed->save(false);
                        $actid = $activityFeed->activity_id;
                        $deviceId = $touser->device_token;
                        $deviceType = $touser->device_type;
                        $screen = "1";
                        $connection = Yii::app()->db;
                        
                        $updateBase = $this->loadModel($user_id, 'User');
                        $updateBase->base = $updateBase->base + 1;
                        $updateBase->save(false);
                        
                        
                        $sql = "SELECT count(*) as unreadmsg FROM `feed_acivity` WHERE  author_id = '" . $user_id . "' and Is_read=0";
                        
                        $command = Yii::app()->db->createCommand($sql);
                        $activityDatas = $command->queryAll();
                        foreach ($activityDatas as $readcount) {
                            $unreadmsg = $readcount['unreadmsg'];
                        }
                        
                        $unreadmessages = $updateBase->attributes['base'];

                        $find = User::model()->find("id = " .$user_id);
                        $orderId = $PostJobData->attributes['post_id'];
                        
                        if (!empty($find) && $find->device_token!="") {


                           FeedDetail::model()->sendNotification($deviceId, $deviceType, $message, $screen, $fromusername, $unreadmessages, $orderId);
                        }

                    }
                }



                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("postsaved", $lang);
                    $response['data']['post_id'] = $PostJobData->attributes['post_id'] . "";

                    $response['data']['job_title'] = $PostJobData->attributes['job_title'] . "";
                    $response['data']['rate'] = $PostJobData->attributes['rate'] . "";
                    $response['data']['job_description'] = $PostJobData->attributes['job_description'] . "";
                    $response['data']['category_id'] = $PostJobData->attributes['category_id'] . "";
                    $response['data']['subcategory_id'] = $PostJobData->attributes['subcategory_id'] . "";

                    $response['data']['latitude'] = $PostJobData->attributes['latitude'] . "";
                    $response['data']['longtitude'] = $PostJobData->attributes['longtitude'] . "";
                    

                    $response['data']['category_name'] = $this->GetCategoryName($PostJobData->attributes['category_id']);
                    $response['data']['subcategory_name'] = $this->GetSubCategoryName($PostJobData->attributes['subcategory_id']);


                    $response['data']['work_type'] = $PostJobData->attributes['work_type'] . "";
                    $response['data']['pay_by'] = $PostJobData->attributes['pay_by'] . "";
                    $response['data']['exp_level'] = $PostJobData->attributes['exp_level'] . "";
                    $response['data']['how_long'] = $PostJobData->attributes['how_long'] . "";
                    $response['data']['commitment'] = $PostJobData->attributes['commitment'] . "";
                    $response['data']['attachments'] = ($PostData->attachments!="" ? json_decode($PostJobData->attachments) : [] );
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("savedfail", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 28 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : My Active Post.
     * */
    public function actionMyPost() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
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
                $connection = Yii::app()->db;


                //$temp = " ";
                // End Pagination
                //$miles = $apiData['data']['miles'];


                $connection = Yii::app()->db;



                $select = " a.*,b.first_name,b.last_name,b.email,b.image,b.username ";
                $table = "post_job as a";
                $where = " a.status=1 and a.user_id=" . $apiData['data']['id'];
                //$having = " having distance <=". $miles;
                // $orderBy = " ORDER BY a.article_id desc ";
                $orderBy = "";
                $orderBy = " ORDER BY a.post_id desc ";
                // $groupBy = " GROUP BY a.article_id ";
                $groupBy = "";
                $having = "";
                $table .= " INNER JOIN user as b on a.user_id = b.id ";
                //$where .= (!empty($where) ? " AND " : ""). "  b.ac_id IN(". $apiData['data']['ac_id'] .") ";
                /* if(isset($apiData['data']['ac_id']) && !empty($apiData['data']['ac_id'])){
                  $table .= " INNER JOIN article_category_detail as b on a.article_id = b.article_id ";
                  //$table .= " INNER JOIN drug_disease as c on c.dd_id = b.drug_disease_id ";
                  $where .= (!empty($where) ? " AND " : ""). "  b.ac_id IN(". $apiData['data']['ac_id'] .") ";
                  } */
                /* if(isset($apiData['data']['drug_name']) && !empty($apiData['data']['drug_name'])){
                  //$table .= " INNER JOIN drug_disease_detail as b on a.drug_id = b.drug_id ";
                  //$table .= " INNER JOIN drug_disease as c on c.dd_id = b.drug_disease_id ";
                  $where .= (!empty($where) ? " AND " : ""). "  a.drug_name like '%". $apiData['data']['drug_name']."%'";
                  //echo $where;
                  } */

                $sql = "SELECT " . $select . " from " . $table . " where " . $where . $having . $groupBy . $orderBy . $temp;




                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;


                $command = Yii::app()->db->createCommand($sql);
                $postlist = $command->queryAll();
                if (!empty($postlist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("postlist", $lang);
                    foreach ($postlist as $key => $value) {




                        $response['data'][$key]['post_id'] = $value['post_id'] . "";
                         $response['data'][$key]['status'] = $value['status'] . "";

                        $response['data'][$key]['job_title'] = $value['job_title'] . "";
                        $response['data'][$key]['job_description'] = $value['job_description'] . "";
                        $response['data'][$key]['category_id'] = $value['category_id'] . "";
                        $response['data'][$key]['subcategory_id'] = $value['subcategory_id'] . "";

                        $response['data'][$key]['category_name'] = $this->GetCategoryName($value['category_id']);
                        $response['data'][$key]['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);


                        $response['data'][$key]['work_type'] = $value['work_type'] . "";
                        $response['data'][$key]['work_type_text'] = $this->GetWorkTypeText($value['work_type']). "";

                        $response['data'][$key]['pay_by'] = $value['pay_by'] . "";
                        $response['data'][$key]['pay_by_text'] = $this->GetPayByText($value['pay_by']). "";

                        $response['data'][$key]['rate'] = $value['rate'] . "";
                        $response['data'][$key]['exp_level'] = $value['exp_level'] . "";
                        $response['data'][$key]['exp_level_text'] = $this->GetExpLevelText($value['exp_level']). "";

                        $response['data'][$key]['post_datetime'] = $value['post_datetime'];
                        $response['data'][$key]['time_diffrent'] = $this->time_diffrent($value['post_datetime']);
                        $response['data'][$key]['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$value['post_id']);
                        $response['data'][$key]['is_bid'] =  $this->CheckBid($value['post_id'],$apiData['data']['id']);

                        


                        $connection = Yii::app()->db;
                        $total_offers = 0;
                        $total_offers_sql = "select * from post_bid where post_id=".$value['post_id']." and offer_status=0 and is_offer=0";
                        $tocommand = Yii::app()->db->createCommand($total_offers_sql);
                        $total_offerslist = $tocommand->queryAll();
                        if($total_offerslist)
                        {
                                foreach ($total_offerslist as $key1 => $value1) { $total_offers++; }
                        }
                        

                        $response['data'][$key]['total_offers'] = $total_offers;

                        $response['data'][$key]['how_long'] = $value['how_long'] . "";
                        $response['data'][$key]['how_long_text'] = $this->GetHowLongText($value['how_long']). "";

                        $response['data'][$key]['commitment'] = $value['commitment'] . "";
                        $response['data'][$key]['commitment_text'] = $this->GetCommitmentText($value['commitment']). "";
                        $response['data'][$key]['attachments'] =  ($value['attachments']!="" ? json_decode($value['attachments']) : [] );  



                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }


    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 28 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : My Active Post.
     * */
    public function actionMyPostAll() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
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
                $connection = Yii::app()->db;


                //$temp = " ";
                // End Pagination
                //$miles = $apiData['data']['miles'];

                $connection = Yii::app()->db;

                $select = " a.* ";
                $table = "post_bid as a";
               // $where = " a.status=2 ";
               // $table  .= " JOIN post_bid as b ON a.post_id = b.post_id ";
                $where .= (!empty($where) ? " AND " : ""). "  a.offer_by = ".$apiData['data']['id'];
                $where .= (!empty($where) ? " AND " : ""). "  a.status not in(2,3,4,5) " ;



                $connection = Yii::app()->db;


                //$where .= (!empty($where) ? " AND " : ""). "  b.ac_id IN(". $apiData['data']['ac_id'] .") ";
                /* if(isset($apiData['data']['ac_id']) && !empty($apiData['data']['ac_id'])){
                  $table .= " INNER JOIN article_category_detail as b on a.article_id = b.article_id ";
                  //$table .= " INNER JOIN drug_disease as c on c.dd_id = b.drug_disease_id ";
                  $where .= (!empty($where) ? " AND " : ""). "  b.ac_id IN(". $apiData['data']['ac_id'] .") ";
                  } */
                /* if(isset($apiData['data']['drug_name']) && !empty($apiData['data']['drug_name'])){
                  //$table .= " INNER JOIN drug_disease_detail as b on a.drug_id = b.drug_id ";
                  //$table .= " INNER JOIN drug_disease as c on c.dd_id = b.drug_disease_id ";
                  $where .= (!empty($where) ? " AND " : ""). "  a.drug_name like '%". $apiData['data']['drug_name']."%'";
                  //echo $where;
                  } */

                 $sql = "SELECT " . $select . " from " . $table . " where " . $where . $having . $groupBy . $orderBy . $temp;




                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;


                $command = Yii::app()->db->createCommand($sql);
                $postlist = $command->queryAll();
                if (!empty($postlist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("postlist", $lang);
                    foreach ($postlist as $key => $value) {



                        $response['data'][$key]['is_offer'] = $value['is_offer'] . "";
                        $response['data'][$key]['pb_id'] = $value['pb_id'] . "";
                        
                        if($value['post_id']!=0)
                        {
                            $PostData = PostJob::model()->find("post_id ='".$value['post_id']."'");

                            $response['data'][$key]['post_id'] = $value['post_id'] . "";
                            $response['data'][$key]['job_title'] = $PostData->job_title. "";
                            $response['data'][$key]['job_description'] = $PostData->job_description. "";
                            $response['data'][$key]['category_id'] = $PostData->category_id. "";
                            $response['data'][$key]['subcategory_id'] = $PostData->subcategory_id. "";

                            $response['data'][$key]['category_name'] = $this->GetCategoryName($PostData->category_id)."";
                            $response['data'][$key]['subcategory_name'] = $this->GetSubCategoryName($PostData->subcategory_id)."";

                            $response['data'][$key]['work_type'] = $PostData->work_type . "";
                            $response['data'][$key]['work_type_text'] = $this->GetWorkTypeText($PostData->work_type). "";

                            $response['data'][$key]['pay_by'] = $PostData->pay_by . "";
                            $response['data'][$key]['pay_by_text'] = $this->GetPayByText($PostData->pay_by). "";

                            $response['data'][$key]['rate'] = $PostData->rate . "";
                            $response['data'][$key]['exp_level'] = $PostData->exp_level . "";
                            $response['data'][$key]['exp_level_text'] = $this->GetExpLevelText($PostData->exp_level). "";

                            $response['data'][$key]['post_datetime'] = $PostData->post_datetime;
                            $response['data'][$key]['time_diffrent'] = $this->time_diffrent($PostData->post_datetime);

                            $response['data'][$key]['how_long'] = $PostData->how_long . "";
                            $response['data'][$key]['how_long_text'] = $this->GetHowLongText($PostData->how_long). "";

                            $response['data'][$key]['commitment'] = $PostData->commitment . "";
                            $response['data'][$key]['commitment_text'] = $this->GetCommitmentText($PostData->commitment). "";

                            $connection = Yii::app()->db;
                            $total_offers = 0;
                            $total_offers_sql = "select * from post_bid where post_id=".$value['post_id']." and offer_status=0 and is_offer=0";
                            $tocommand = Yii::app()->db->createCommand($total_offers_sql);
                            $total_offerslist = $tocommand->queryAll();
                            if($total_offerslist)
                            {
                                    foreach ($total_offerslist as $key1 => $value1) { $total_offers++; }
                            }
                            

                            $response['data'][$key]['total_offers'] = $total_offers;

                            

                        }
                        else
                        {
                            $response['data'][$key]['post_id'] = $value['post_id'] . "";
                            $response['data'][$key]['job_title'] = $value['job_title'] . "";
                            $response['data'][$key]['job_description'] = $value['job_description'] . "";
                            $response['data'][$key]['category_id'] = $value['category_id'] . "";
                            $response['data'][$key]['subcategory_id'] = $value['subcategory_id'] . "";

                            $response['data'][$key]['category_name'] = $this->GetCategoryName($value['category_id']);
                            $response['data'][$key]['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);

                            $response['data'][$key]['work_type'] = $value['work_type'] . "";
                            $response['data'][$key]['work_type_text'] = $this->GetWorkTypeText($value['work_type']). "";

                            $response['data'][$key]['pay_by'] = $value['pay_by'] . "";
                            $response['data'][$key]['pay_by_text'] = $this->GetPayByText($value['pay_by']). "";

                            $response['data'][$key]['rate'] = $value['rate'] . "";
                            $response['data'][$key]['exp_level'] = $value['exp_level'] . "";
                            $response['data'][$key]['exp_level_text'] = $this->GetExpLevelText($value['exp_level']). "";

                            $response['data'][$key]['post_datetime'] = $value['bid_datetime'];
                            $response['data'][$key]['time_diffrent'] = $this->time_diffrent($value['bid_datetime']);

                            $response['data'][$key]['how_long'] = $value['how_long'] . "";
                            $response['data'][$key]['how_long_text'] = $this->GetHowLongText($value['how_long']). "";

                            $response['data'][$key]['commitment'] = $value['commitment'] . "";
                            $response['data'][$key]['commitment_text'] = $this->GetCommitmentText($value['commitment']). "";
                            $response['data'][$key]['total_offers'] = "1";
                           

                        }
                        
                        $user_id = $value['bid_by'];
                        $postowner = User::model()->find("id ='".$user_id."'");
                                    //  print_r($temparray);


                        $response['data'][$key]['user_id'] = $postowner->id;
                        $response['data'][$key]['first_name'] = $postowner->first_name;
                        $response['data'][$key]['last_name'] = $postowner->last_name;
                        $response['data'][$key]['profile_image'] = $postowner->image;
                        $response['data'][$key]['country'] = $postowner->country;
                        $response['data'][$key]['state'] = $postowner->state;
                        $response['data'][$key]['city'] = $postowner->city;



                        $sql6 = "SELECT * from `user_review` where user_id = " .$user_id. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];

                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }

                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data'][$key]['ratearray'] = $ratearray;
                        $response['data'][$key]['avgrate'] = round($avg,2)."";
                        $response['data'][$key]['totalrate'] = $cnt;



                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 28 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : My Active Post.
     * */
    public function actionMyRunningPost() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
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
                $connection = Yii::app()->db;


                //$temp = " ";
                // End Pagination
                //$miles = $apiData['data']['miles'];


                $connection = Yii::app()->db;

                $select = " a.*,b.first_name,b.last_name,b.email,b.image,b.username ";
                $table = "post_job as a";
                $where = " a.status=2 and a.user_id=" . $apiData['data']['id'];
                //$having = " having distance <=". $miles;
                // $orderBy = " ORDER BY a.article_id desc ";
                $orderBy = "";
                // $groupBy = " GROUP BY a.article_id ";
                $groupBy = "";
                $having = "";
                $table .= " INNER JOIN user as b on a.user_id = b.id ";
                //$where .= (!empty($where) ? " AND " : ""). "  b.ac_id IN(". $apiData['data']['ac_id'] .") ";
                /* if(isset($apiData['data']['ac_id']) && !empty($apiData['data']['ac_id'])){
                  $table .= " INNER JOIN article_category_detail as b on a.article_id = b.article_id ";
                  //$table .= " INNER JOIN drug_disease as c on c.dd_id = b.drug_disease_id ";
                  $where .= (!empty($where) ? " AND " : ""). "  b.ac_id IN(". $apiData['data']['ac_id'] .") ";
                  } */
                /* if(isset($apiData['data']['drug_name']) && !empty($apiData['data']['drug_name'])){
                  //$table .= " INNER JOIN drug_disease_detail as b on a.drug_id = b.drug_id ";
                  //$table .= " INNER JOIN drug_disease as c on c.dd_id = b.drug_disease_id ";
                  $where .= (!empty($where) ? " AND " : ""). "  a.drug_name like '%". $apiData['data']['drug_name']."%'";
                  //echo $where;
                  } */

                $sql = "SELECT " . $select . " from " . $table . " where " . $where . $having . $groupBy . $orderBy . $temp;




                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;


                $command = Yii::app()->db->createCommand($sql);
                $postlist = $command->queryAll();
                if (!empty($postlist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("postlist", $lang);
                    foreach ($postlist as $key => $value) {




                        $response['data'][$key]['post_id'] = $value['post_id'] . "";
                         $response['data'][$key]['status'] = $value['status'] . "";
                        $response['data'][$key]['job_title'] = $value['job_title'] . "";
                        $response['data'][$key]['job_description'] = $value['job_description'] . "";
                        $response['data'][$key]['category_id'] = $value['category_id'] . "";
                        $response['data'][$key]['subcategory_id'] = $value['subcategory_id'] . "";

                        $response['data'][$key]['category_name'] = $this->GetCategoryName($value['category_id']);
                        $response['data'][$key]['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);


                        $response['data'][$key]['work_type'] = $value['work_type'] . "";
                        $response['data'][$key]['work_type_text'] = $this->GetWorkTypeText($value['work_type']). "";

                        $response['data'][$key]['pay_by'] = $value['pay_by'] . "";
                        $response['data'][$key]['pay_by_text'] = $this->GetPayByText($value['pay_by']). "";

                        $response['data'][$key]['rate'] = $value['rate'] . "";
                        $response['data'][$key]['exp_level'] = $value['exp_level'] . "";
                        $response['data'][$key]['exp_level_text'] = $this->GetExpLevelText($value['exp_level']). "";

                        $response['data'][$key]['post_datetime'] = $value['post_datetime'];
                        $response['data'][$key]['time_diffrent'] = $this->time_diffrent($value['post_datetime']);
                        $response['data'][$key]['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$value['post_id']);
                        $response['data'][$key]['is_bid'] =  $this->CheckBid($value['post_id'],$apiData['data']['id']);

                        


                        $connection = Yii::app()->db;
                        $total_offers = 0;
                        $total_offers_sql = "select * from post_bid where post_id=".$value['post_id']." and offer_status=0 and is_offer=0";
                        $tocommand = Yii::app()->db->createCommand($total_offers_sql);
                        $total_offerslist = $tocommand->queryAll();
                        if($total_offerslist)
                        {
                                foreach ($total_offerslist as $key1 => $value1) { $total_offers++; }
                        }
                        

                        $response['data'][$key]['total_offers'] = $total_offers;

                        $response['data'][$key]['how_long'] = $value['how_long'] . "";
                        $response['data'][$key]['how_long_text'] = $this->GetHowLongText($value['how_long']). "";

                        $response['data'][$key]['commitment'] = $value['commitment'] . "";
                        $response['data'][$key]['commitment_text'] = $this->GetCommitmentText($value['commitment']). "";
                        $response['data'][$key]['attachments'] =  ($value['attachments']!="" ? json_decode($value['attachments']) : [] );  



                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : Aug 17 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Search User.
     * */
    public function actionSearchUser() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) || empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) || empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {

                // echo "ff";

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
                $connection = Yii::app()->db;


                $temp = " LIMIT $offset,$limit";
                // End Pagination
                $connection = Yii::app()->db;
                $select = "a.*";
                $table = "user as a";
                $where = " a.is_active=1 and a.user_type=2 and a.is_agree = 1 and a.expiration_datetime >= NOW() ";
                //$orderBy = " ORDER BY a.article_id desc ";
                $orderBy = "";
                $groupBy = " GROUP BY a.id ";
                $having  = "";
                //   $limit = "";
                //  $table .= " INNER JOIN favouritestore as b on a.id = b.store_id ";
                //$table .= " INNER JOIN drug_disease as c on c.dd_id = b.drug_disease_id ";
                //  $where .= (!empty($where) ? " AND " : ""). "  b.user_id = ". $apiData['data']['user_id'];
                $table .= " INNER JOIN user_skill as us on a.id = us.user_id ";

                if(isset($apiData['data']['exp_level']) && !empty($apiData['data']['exp_level'])){
                  $where .= (!empty($where) ? " AND " : ""). "  a.exp_level in (". $apiData['data']['exp_level'].")";
                }

                if(isset($apiData['data']['keyword']) && !empty($apiData['data']['keyword'])){
                  $where .= (!empty($where) ? " AND " : ""). "  a.username like '%". $apiData['data']['keyword']."%' or a.first_name like '%". $apiData['data']['keyword']."%' or a.last_name like '%". $apiData['data']['keyword']."%'";
                }


                $connection = Yii::app()->db;                
                if( isset($apiData['data']['latitude']) && !empty($apiData['data']['latitude']) && isset($apiData['data']['longtitude']) && !empty($apiData['data']['longtitude']) && isset($apiData['data']['miles']) && !empty($apiData['data']['miles'])){                                       
                
                        $miles = $apiData['data']['miles'];
                        $select .=  (!empty($select) ? " , " : "")." ((ACOS(SIN(".$apiData['data']['latitude']."* PI() / 180) * SIN(a.latitude * PI() / 180) + COS(".$apiData['data']['latitude']."* PI() / 180) * COS(a.latitude * PI() / 180) * COS((".$apiData['data']['longtitude']." - a.longtitude) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS distance ";            
                        $having = " having distance <=". $miles;
                        
                }

                if(isset($apiData['data']['rate_by_asc']) && !empty($apiData['data']['rate_by_asc'])){

                        $select .=  (!empty($select) ? " , " : "")." Coalesce(SUM(b.review_count)) as review_count "; 
                        $table  .= " LEFT JOIN user_review as b ON a.id = b.user_id ";
                        $orderBy  .= " SUM(b.review_count) IS NULL ASC, SUM(b.review_count) ASC ";

                }
                if(isset($apiData['data']['rate_by_desc']) && !empty($apiData['data']['rate_by_desc'])){

                        $select .=  (!empty($select) ? " , " : "")." Coalesce(SUM(b.review_count)) as review_count "; 
                        $table  .= " LEFT JOIN user_review as b ON a.id = b.user_id ";
                        $orderBy  .= " SUM(b.review_count) IS NULL ASC, SUM(b.review_count) DESC ";

                }
               
                if( (isset($apiData['data']['category_id']) && !empty($apiData['data']['category_id'])) || (isset($apiData['data']['subcategory_id']) && !empty($apiData['data']['subcategory_id']))){

                        $table  .= " LEFT JOIN user_skill as c ON a.id = c.user_id ";
                        if(isset($apiData['data']['category_id']) && !empty($apiData['data']['category_id']))
                        {
                            $where  .= (!empty($where) ? " AND " : ""). "  c.category_id = ". $apiData['data']['category_id'];
                        }
                        if(isset($apiData['data']['subcategory_id']) && !empty($apiData['data']['subcategory_id']))
                        {
                            $where  .= (!empty($where) ? " AND " : ""). "  c.subcategory_id = ". $apiData['data']['subcategory_id'];
                        }
                        
                }



                $sql = "SELECT " . $select . " from " . $table . " where " . $where . $groupBy . $having . (!empty($orderBy) ? ' ORDER BY '. $orderBy : '')  . $temp;


                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;


                $command = Yii::app()->db->createCommand($sql);
                $userslist = $command->queryAll();
                if (!empty($userslist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("userslist", $lang);
                    foreach ($userslist as $key => $value) {
                        $user_id = $value['id'];
                        $response['data'][$key]['user_id'] = $user_id;
                        $response['data'][$key]['first_name'] = $value['first_name'];
                        $response['data'][$key]['last_name'] = $value['last_name'];
                        $response['data'][$key]['username'] = $value['username'];
                        $response['data'][$key]['image'] = $value['image'];
                        $response['data'][$key]['osnap_id'] = $value['osnap_id'];
                        $response['data'][$key]['address'] = $value['address'];
                        $response['data'][$key]['latitude'] = $value['latitude'];
                        $response['data'][$key]['longtitude'] = $value['longtitude'];

                        $response['data'][$key]['city'] = $value['city'];
                        $response['data'][$key]['state'] = $value['state'];
                        $response['data'][$key]['country'] = $value['country'];

                        $response['data'][$key]['business_name'] =  $value['business_name'];


                        $response['data'][$key]['business_type_id'] =  $value['business_type'];
                        $response['data'][$key]['business_type'] =  GlobalFunction::getBusinessTypes($value['business_type'])."";
                        $response['data'][$key]['business_category'] =  $value['business_category'];


                        $response['data'][$key]['business_osnap_id'] =  $value['business_osnap_id'];
                        $response['data'][$key]['business_esta_month'] =  $value['business_esta_month'];
                        $response['data'][$key]['business_esta_year'] =  $value['business_esta_year'];
                        $response['data'][$key]['business_category_name']= $this->GetBusinessCategoryName($value['business_category']);
                            
                        $response['data'][$key]['business_owner'] =  $value['business_owner'];
                        $response['data'][$key]['business_notes'] =  $value['business_notes'];                        
                        $response['data'][$key]['exp_level'] =  $value['exp_level'];
                        $response['data'][$key]['business_image'] =  $value['business_image'];




                        $sql6 = "SELECT * from `user_review` where user_id = " . $user_id. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];


                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }


                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data'][$key]['ratearray'] = $ratearray;
                        $response['data'][$key]['avgrate'] = round($avg,2)."";
                        $response['data'][$key]['totalrate'] = $cnt;

                        if( (isset($apiData['data']['Dlatitude']) && !empty($apiData['data']['Dlatitude'])) &&  (isset($apiData['data']['Dlongtitude']) && !empty($apiData['data']['Dlongtitude'])) ){

                             $response['data'][$key]['distance'] = $this->distance($apiData['data']['Dlatitude'],$apiData['data']['Dlongtitude'],$value['latitude'],$value['longtitude']);
                        }
                        else
                        {
                            $response['data'][$key]['distance'] = "";
                        }
                        $response['data'][$key]['is_contact'] =  $this->IsContactuser($apiData['data']['id'],$user_id);
                        $response['data'][$key]['is_favourite'] =  $this->Isfvrtuser($apiData['data']['id'],$user_id);
                        
                        $response['data'][$key]['available'] =  1;
                        
                        $connection = Yii::app()->db;
                        $sql2 = "SELECT * from user_skill where user_id=" . $user_id . " limit 1 ";
                        $command2 = Yii::app()->db->createCommand($sql2);
                        $skilllist = $command2->queryAll();
                        if (!empty($skilllist)) {
                            $skillarray = array();
                            foreach ($skilllist as $key => $value1) {
                                $temp = array();
                                $response['data'][$key]['price'] = $value1['price'];
                                $response['data'][$key]['price_type'] = $value1['price_type'];
                            }
                           
                        } else {
                                $response['data'][$key]['price'] = 0;
                                $response['data'][$key]['price_type'] = 0;
                        }


                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

     /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : Aug 17 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Add to fvrt user.
     * */

    public function actionAddRemoveFrvtUser() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if(!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang",1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if(!isset($apiData['data']['id']) && empty($apiData['data']['id'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if(!isset($apiData['data']['token']) && empty($apiData['data']['token'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if(!isset($apiData['data']['user_id']) && empty($apiData['data']['user_id'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }       
        else 
        {
            $checkUserTokenData = User::model()->find("id='".$apiData['data']['id']."' AND token = '".$apiData['data']['token']."'");
        if($checkUserTokenData){
           $fvrtData = Favouriteuser::model()->find("user_id='".$apiData['data']['id']."' AND fvrtuser_id = '".$apiData['data']['user_id']."'");
           if(!$fvrtData){
          
                $FavouriteuserData = new Favouriteuser();
                $FavouriteuserData->user_id = $apiData['data']['id'];
                $FavouriteuserData->fvrtuser_id = $apiData['data']['user_id'];
               if ($FavouriteuserData->save(false)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("successfvrt",$lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
                else
                {
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("savedfail",$lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            }
            else
            {
                /*$response['status'] = "0";
                $response['message'] = $this->GetNotification("alreadydvrtdoctor",$lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();*/
                $userfvrt = new Favouriteuser();
                $userfvrt = Favouriteuser::model()->findByAttributes(array('user_id' => $apiData['data']['id'], 'fvrtuser_id' => $apiData['data']['user_id']));
                if ($userfvrt->delete()) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("userremovedsuccess",$lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
                else
                {
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("userremovedfail",$lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
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
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : Aug 17 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Add to Contact.
     * */

    public function actionAddRemoveContact() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if(!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang",1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if(!isset($apiData['data']['id']) && empty($apiData['data']['id'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if(!isset($apiData['data']['token']) && empty($apiData['data']['token'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if(!isset($apiData['data']['user_id']) && empty($apiData['data']['user_id'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }       
        else 
        {
            $checkUserTokenData = User::model()->find("id='".$apiData['data']['id']."' AND token = '".$apiData['data']['token']."'");
        if($checkUserTokenData){
           $cData = UserContact::model()->find("user_id='".$apiData['data']['id']."' AND contact_user_id = '".$apiData['data']['user_id']."'");
           if(!$cData){
          
                $UserContactData = new UserContact();
                $UserContactData->user_id = $apiData['data']['id'];
                $UserContactData->contact_user_id = $apiData['data']['user_id'];
                $UserContactData->created_at = date('Y-m-d H:i:s');
               if ($UserContactData->save(false)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("successcontact",$lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
                else
                {
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("savedfail",$lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            }
            else
            {
                /*$response['status'] = "0";
                $response['message'] = $this->GetNotification("alreadydvrtdoctor",$lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();*/
                $userfvrt = new UserContact();
                $userfvrt = UserContact::model()->findByAttributes(array('user_id' => $apiData['data']['id'], 'contact_user_id' => $apiData['data']['user_id']));
                if ($userfvrt->delete()) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("contactremovedsuccess",$lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
                else
                {
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("contactremovedfail",$lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
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
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : Aug 18 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Fvrt Doctor  List.
     * */
    public function actionFvrtUsersList() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if(!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang",1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if(!isset($apiData['data']['id']) && empty($apiData['data']['id'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if(!isset($apiData['data']['token']) && empty($apiData['data']['token'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='".$apiData['data']['id']."' AND token = '".$apiData['data']['token']."'");
        if($checkUserTokenData){
           
          // echo "ff";
            
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
                $connection = Yii::app()->db;
                
                
                //$temp = " LIMIT $offset,$limit";
                // End Pagination
                $connection = Yii::app()->db;
                $select = "*";
                $table = "user as a";
                $where = "a.is_active=1";
                //$orderBy = " ORDER BY a.article_id desc ";
                $orderBy = "";
                $groupBy = " GROUP BY a.id ";
             //   $limit = "";
                
               
                    $table .= " INNER JOIN favouriteuser as b on a.id = b.fvrtuser_id ";
                    //$table .= " INNER JOIN drug_disease as c on c.dd_id = b.drug_disease_id ";
                    $where .= (!empty($where) ? " AND " : ""). "  b.user_id = ". $apiData['data']['id'];
                
               /* if(isset($apiData['data']['drug_name']) && !empty($apiData['data']['drug_name'])){
                    //$table .= " INNER JOIN drug_disease_detail as b on a.drug_id = b.drug_id ";
                    //$table .= " INNER JOIN drug_disease as c on c.dd_id = b.drug_disease_id ";
                    $where .= (!empty($where) ? " AND " : ""). "  a.drug_name like '%". $apiData['data']['drug_name']."%'";
                    //echo $where;
                }*/
                
               $sql = "SELECT ". $select ." from ". $table ." where ". $where . $groupBy . $orderBy . $temp;



              //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;

        
                $command = Yii::app()->db->createCommand($sql);
                $userslist = $command->queryAll();
                if (!empty($userslist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("userslist",$lang);
                    foreach ($userslist as $key => $value) {
                        

                        $user_id = $value['id'];
                        $response['data'][$key]['user_id'] = $user_id;
                        $response['data'][$key]['first_name'] = $value['first_name'];
                        $response['data'][$key]['last_name'] = $value['last_name'];
                        $response['data'][$key]['username'] = $value['username'];
                        $response['data'][$key]['image'] = $value['image'];
                        $response['data'][$key]['osnap_id'] = $value['osnap_id'];
                        $response['data'][$key]['address'] = $value['address'];
                        $response['data'][$key]['latitude'] = $value['latitude'];
                        $response['data'][$key]['longtitude'] = $value['longtitude'];

                        $response['data'][$key]['city'] = $value['city'];
                        $response['data'][$key]['state'] = $value['state'];
                        $response['data'][$key]['country'] = $value['country'];

                        

                        $response['data'][$key]['business_name'] =  $value['business_name'];


                       


                        $response['data'][$key]['business_type_id'] =  $value['business_type'];
                        $response['data'][$key]['business_type'] =  GlobalFunction::getBusinessTypes($value['business_type'])."";

                        $response['data'][$key]['business_category'] =  $value['business_category'];
                        $response['data'][$key]['business_osnap_id'] =  $value['business_osnap_id'];

                        $response['data'][$key]['business_esta_month'] =  $value['business_esta_month'];
                        $response['data'][$key]['business_esta_year'] =  $value['business_esta_year'];


                        $response['data'][$key]['business_category_name']= $this->GetBusinessCategoryName($value['business_category']);
                            
                        $response['data'][$key]['business_owner'] =  $value['business_owner'];
                        $response['data'][$key]['business_notes'] =  $value['business_notes'];                        
                        $response['data'][$key]['exp_level'] =  $value['exp_level'];
                        $response['data'][$key]['business_image'] =  $value['business_image'];


                        $sql6 = "SELECT * from `user_review` where user_id = " . $user_id. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];

                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }

                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data'][$key]['ratearray'] = $ratearray;
                        $response['data'][$key]['avgrate'] = round($avg,2)."";
                        $response['data'][$key]['totalrate'] = $cnt;

                        if( (isset($apiData['data']['Dlatitude']) && !empty($apiData['data']['Dlatitude'])) &&  (isset($apiData['data']['Dlongtitude']) && !empty($apiData['data']['Dlongtitude'])) ){

                             $response['data'][$key]['distance'] = $this->distance($apiData['data']['Dlatitude'],$apiData['data']['Dlongtitude'],$value['latitude'],$value['longtitude']);
                        }
                        else
                        {
                            $response['data'][$key]['distance'] = "";
                        }
                        $response['data'][$key]['is_contact'] =  $this->IsContactuser($apiData['data']['id'],$user_id);
                        $response['data'][$key]['is_favourite'] =  $this->Isfvrtuser($apiData['data']['id'],$user_id);
                        
                        $response['data'][$key]['available'] =  1;
                        
                        $connection = Yii::app()->db;
                        $sql2 = "SELECT * from user_skill where user_id=" . $user_id . " limit 1 ";
                        $command2 = Yii::app()->db->createCommand($sql2);
                        $skilllist = $command2->queryAll();
                        if (!empty($skilllist)) {
                            $skillarray = array();
                            foreach ($skilllist as $key => $value1) {
                                $temp = array();
                                $response['data'][$key]['price'] = $value1['price'];
                                $response['data'][$key]['price_type'] = $value1['price_type'];
                            }
                           
                        } else {
                                $response['data'][$key]['price'] = 0;
                                $response['data'][$key]['price_type'] = 0;
                        }
                        
                        
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
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : Aug 18 2017
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Contact  List.
     * */
    public function actionContactList() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if(!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang",1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if(!isset($apiData['data']['id']) && empty($apiData['data']['id'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if(!isset($apiData['data']['token']) && empty($apiData['data']['token'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='".$apiData['data']['id']."' AND token = '".$apiData['data']['token']."'");
        if($checkUserTokenData){
           
          // echo "ff";
            
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
                $connection = Yii::app()->db;
                
                
                //$temp = " LIMIT $offset,$limit";
                // End Pagination
                $connection = Yii::app()->db;
                $select = "*";
                $table = "user as a";
                $where = "a.is_active=1";
                //$orderBy = " ORDER BY a.article_id desc ";
                $orderBy = "";
                $groupBy = " GROUP BY a.id ";
             //   $limit = "";
                
               
                    $table .= " INNER JOIN user_contact as b on a.id = b.contact_user_id ";
                    //$table .= " INNER JOIN drug_disease as c on c.dd_id = b.drug_disease_id ";
                    $where .= (!empty($where) ? " AND " : ""). "  b.user_id = ". $apiData['data']['id'];
                
               /* if(isset($apiData['data']['drug_name']) && !empty($apiData['data']['drug_name'])){
                    //$table .= " INNER JOIN drug_disease_detail as b on a.drug_id = b.drug_id ";
                    //$table .= " INNER JOIN drug_disease as c on c.dd_id = b.drug_disease_id ";
                    $where .= (!empty($where) ? " AND " : ""). "  a.drug_name like '%". $apiData['data']['drug_name']."%'";
                    //echo $where;
                }*/
                
               $sql = "SELECT ". $select ." from ". $table ." where ". $where . $groupBy . $orderBy . $temp;



              //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;

        
                $command = Yii::app()->db->createCommand($sql);
                $userslist = $command->queryAll();
                if (!empty($userslist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("contactlist",$lang);
                    foreach ($userslist as $key => $value) {
                        

                        $user_id = $value['id'];
                        $response['data'][$key]['user_id'] = $user_id;
                        $response['data'][$key]['first_name'] = $value['first_name'];
                        $response['data'][$key]['last_name'] = $value['last_name'];
                        $response['data'][$key]['username'] = $value['username'];
                        $response['data'][$key]['image'] = $value['image'];
                        $response['data'][$key]['osnap_id'] = $value['osnap_id'];
                        $response['data'][$key]['address'] = $value['address'];
                        $response['data'][$key]['latitude'] = $value['latitude'];
                        $response['data'][$key]['longtitude'] = $value['longtitude'];

                        $response['data'][$key]['city'] = $value['city'];
                        $response['data'][$key]['state'] = $value['state'];
                        $response['data'][$key]['country'] = $value['country'];


                        $response['data'][$key]['business_name'] =  $value['business_name'];

                       


                        $response['data'][$key]['business_type_id'] =  $value['business_type'];
                        $response['data'][$key]['business_type'] =  GlobalFunction::getBusinessTypes($value['business_type'])."";


                        $response['data'][$key]['business_category'] =  $value['business_category'];
                        $response['data'][$key]['business_osnap_id'] =  $value['business_osnap_id'];

                        $response['data'][$key]['business_esta_month'] =  $value['business_esta_month'];
                        $response['data'][$key]['business_esta_year'] =  $value['business_esta_year'];

                        $response['data'][$key]['business_category_name']= $this->GetBusinessCategoryName($value['business_category']);
                            
                        $response['data'][$key]['business_owner'] =  $value['business_owner'];
                        $response['data'][$key]['business_notes'] =  $value['business_notes'];                        
                        $response['data'][$key]['exp_level'] =  $value['exp_level'];
                        $response['data'][$key]['business_image'] =  $value['business_image'];


                        $sql6 = "SELECT * from `user_review` where user_id = " . $user_id. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];

                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }


                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data'][$key]['ratearray'] = $ratearray;
                        $response['data'][$key]['avgrate'] = round($avg,2)."";
                        $response['data'][$key]['totalrate'] = $cnt;

                        if( (isset($apiData['data']['Dlatitude']) && !empty($apiData['data']['Dlatitude'])) &&  (isset($apiData['data']['Dlongtitude']) && !empty($apiData['data']['Dlongtitude'])) ){

                             $response['data'][$key]['distance'] = $this->distance($apiData['data']['Dlatitude'],$apiData['data']['Dlongtitude'],$value['latitude'],$value['longtitude']);
                        }
                        else
                        {
                            $response['data'][$key]['distance'] = "";
                        }
                        $response['data'][$key]['is_contact'] =  $this->IsContactuser($apiData['data']['id'],$user_id);
                        $response['data'][$key]['is_favourite'] =  $this->Isfvrtuser($apiData['data']['id'],$user_id);
                        
                        $response['data'][$key]['available'] =  1;
                        
                        $connection = Yii::app()->db;
                        $sql2 = "SELECT * from user_skill where user_id=" . $user_id . " limit 1 ";
                        $command2 = Yii::app()->db->createCommand($sql2);
                        $skilllist = $command2->queryAll();
                        if (!empty($skilllist)) {
                            $skillarray = array();
                            foreach ($skilllist as $key => $value1) {
                                $temp = array();
                                $response['data'][$key]['price'] = $value1['price'];
                                $response['data'][$key]['price_type'] = $value1['price_type'];
                            }
                           
                        } else {
                                $response['data'][$key]['price'] = 0;
                                $response['data'][$key]['price_type'] = 0;
                        }
                        
                        
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
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 28 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Search Business.
     * */
    public function actionSearchBusiness() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) || empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) || empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {

                // echo "ff";

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
                $connection = Yii::app()->db;


                $temp = " LIMIT $offset,$limit";
                // End Pagination
                $connection = Yii::app()->db;
                $select = "a.*";
                $table = "user as a";
                $where = " a.is_active=1 and a.user_type=1 and a.is_agree=1 and a.expiration_datetime >= NOW() ";
                //$orderBy = " ORDER BY a.article_id desc ";
                $orderBy = "";
                $groupBy = " GROUP BY a.id ";
                $having  = "";
                //   $limit = "";
            
                //$table .= " INNER JOIN drug_disease as c on c.dd_id = b.drug_disease_id ";
                //  $where .= (!empty($where) ? " AND " : ""). "  b.user_id = ". $apiData['data']['user_id'];

                if(isset($apiData['data']['exp_level']) && !empty($apiData['data']['exp_level'])){
                  $where .= (!empty($where) ? " AND " : ""). "  a.exp_level in (". $apiData['data']['exp_level'].")";
                }

                if(isset($apiData['data']['keyword']) && !empty($apiData['data']['keyword'])){
                  $where .= (!empty($where) ? " AND " : ""). "  a.username like '%". $apiData['data']['keyword']."%' or a.first_name like '%". $apiData['data']['keyword']."%' or a.last_name like '%". $apiData['data']['keyword']."%'";
                }


                $connection = Yii::app()->db;                
                if( isset($apiData['data']['latitude']) && !empty($apiData['data']['latitude']) && isset($apiData['data']['longtitude']) && !empty($apiData['data']['longtitude']) && isset($apiData['data']['miles']) && !empty($apiData['data']['miles'])){                                   
                
                        $miles = $apiData['data']['miles'];
                        $select .=  (!empty($select) ? " , " : "")." ((ACOS(SIN(".$apiData['data']['latitude']."* PI() / 180) * SIN(a.latitude * PI() / 180) + COS(".$apiData['data']['latitude']."* PI() / 180) * COS(a.latitude * PI() / 180) * COS((".$apiData['data']['longtitude']." - a.longtitude) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS distance ";            
                        $having = " having distance <=". $miles;
                        
                }

               



                if(isset($apiData['data']['rate_by_asc']) && !empty($apiData['data']['rate_by_asc'])){

                        $select .=  (!empty($select) ? " , " : "")." Coalesce(b.review_count,0) as review_count "; 
                        $table  .= " LEFT JOIN (SELECT Coalesce(AVG(review_count), 0) as review_count, user_id FROM user_review GROUP BY user_id) as b ON a.id = b.user_id ";
                        $orderBy  .= " -review_count DESC, review_count DESC ";

                }
                if(isset($apiData['data']['rate_by_desc']) && !empty($apiData['data']['rate_by_desc'])){

                        $select .=  (!empty($select) ? " , " : "")." Coalesce(b.review_count,0) as review_count "; 
                        $table  .= " LEFT JOIN (SELECT Coalesce(AVG(review_count), 0) as review_count, user_id FROM user_review GROUP BY user_id) as b ON a.id = b.user_id ";
                        $orderBy  .= " review_count DESC, review_count DESC ";

                }
               
                if( (isset($apiData['data']['category_id']) && !empty($apiData['data']['category_id'])) || (isset($apiData['data']['subcategory_id']) && !empty($apiData['data']['subcategory_id']))){

                        $table  .= " LEFT JOIN user_skill as c ON a.id = c.user_id ";
                        if(isset($apiData['data']['category_id']) && !empty($apiData['data']['category_id']))
                        {
                            $where  .= (!empty($where) ? " AND " : ""). "  c.category_id = ". $apiData['data']['category_id'];
                        }
                        if(isset($apiData['data']['subcategory_id']) && !empty($apiData['data']['subcategory_id']))
                        {
                            $where  .= (!empty($where) ? " AND " : ""). "  c.subcategory_id = ". $apiData['data']['subcategory_id'];
                        }
                        
                }



                $sql = "SELECT " . $select . " from " . $table . " where " . $where . $groupBy . $having . (!empty($orderBy) ? ' ORDER BY '. $orderBy : '')  . $temp;


                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;


                $command = Yii::app()->db->createCommand($sql);
                $userslist = $command->queryAll();
                if (!empty($userslist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("userslist", $lang);
                    foreach ($userslist as $key => $value) {
                        $user_id = $value['id'];
                        $response['data'][$key]['user_id'] = $user_id;
                        $response['data'][$key]['first_name'] = $value['first_name'];
                        $response['data'][$key]['last_name'] = $value['last_name'];
                        $response['data'][$key]['username'] = $value['username'];
                        $response['data'][$key]['image'] = $value['image'];
                        $response['data'][$key]['osnap_id'] = $value['osnap_id'];
                        $response['data'][$key]['address'] = $value['address'];
                        $response['data'][$key]['latitude'] = $value['latitude'];
                        $response['data'][$key]['longtitude'] = $value['longtitude'];

                        $response['data'][$key]['city'] = $value['city'];
                        $response['data'][$key]['state'] = $value['state'];
                        $response['data'][$key]['country'] = $value['country'];

                        $response['data'][$key]['business_name'] =  $value['business_name'];


                        $response['data'][$key]['business_type_id'] =  $value['business_type'];
                        $response['data'][$key]['business_type'] =  GlobalFunction::getBusinessTypes($value['business_type']);
                        $response['data'][$key]['business_category'] =  $value['business_category'];


                        $response['data'][$key]['business_osnap_id'] =  $value['business_osnap_id'];
                        $response['data'][$key]['business_esta_month'] =  $value['business_esta_month'];
                        $response['data'][$key]['business_esta_year'] =  $value['business_esta_year'];
                        $response['data'][$key]['business_category_name']= $this->GetBusinessCategoryName($value['business_category']);
                            
                        $response['data'][$key]['business_owner'] =  $value['business_owner'];
                        $response['data'][$key]['business_notes'] =  $value['business_notes'];                        
                        $response['data'][$key]['exp_level'] =  $value['exp_level'];
                        $response['data'][$key]['business_image'] =  $value['business_image'];




                        $sql6 = "SELECT * from `user_review` where user_id = " . $user_id. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];

                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }


                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data'][$key]['ratearray'] = $ratearray;
                        $response['data'][$key]['avgrate'] = round($avg,2)."";
                        $response['data'][$key]['totalrate'] = $cnt;

                        if( (isset($apiData['data']['Dlatitude']) && !empty($apiData['data']['Dlatitude'])) &&  (isset($apiData['data']['Dlongtitude']) && !empty($apiData['data']['Dlongtitude'])) ){

                             $response['data'][$key]['distance'] = $this->distance($apiData['data']['Dlatitude'],$apiData['data']['Dlongtitude'],$value['latitude'],$value['longtitude']);
                        }
                        else
                        {
                            $response['data'][$key]['distance'] = "";
                        }
                        $response['data'][$key]['is_contact'] =  $this->IsContactuser($apiData['data']['id'],$user_id);
                        $response['data'][$key]['is_favourite'] =  $this->Isfvrtuser($apiData['data']['id'],$user_id);
                        
                        $response['data'][$key]['available'] =  1;
                        
                        $connection = Yii::app()->db;
                        $sql2 = "SELECT * from user_skill where user_id=" . $user_id . " limit 1 ";
                        $command2 = Yii::app()->db->createCommand($sql2);
                        $skilllist = $command2->queryAll();
                        if (!empty($skilllist)) {
                            $skillarray = array();
                            foreach ($skilllist as $key => $value1) {
                                $temp = array();
                                $response['data'][$key]['price'] = $value1['price'];
                                $response['data'][$key]['price_type'] = $value1['price_type'];
                            }
                           
                        } else {
                                $response['data'][$key]['price'] = 0;
                                $response['data'][$key]['price_type'] = 0;
                        }


                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }


    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 28 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : My Explore Requests.
     * */
    public function actionExploreRequests() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
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
                $connection = Yii::app()->db;


                //$temp = " ";
                // End Pagination
                //$miles = $apiData['data']['miles'];


                $connection = Yii::app()->db;

                $select = " a.* ";
                $table = "post_job as a";
                $where = " a.status=1 ";
                //$having = " having distance <=". $miles;
                // $orderBy = " ORDER BY a.article_id desc ";
                $orderBy = "order by post_id desc";
                // $groupBy = " GROUP BY a.article_id ";
                $groupBy = " GROUP BY a.post_id ";
                $having = "";
                $table .= " INNER JOIN user_skill as b on a.category_id = b.category_id or a.subcategory_id = b.subcategory_id";
                $where .= (!empty($where) ? " AND " : ""). "  b.user_id=". $apiData['data']['id'];
                /* if(isset($apiData['data']['ac_id']) && !empty($apiData['data']['ac_id'])){
                  $table .= " INNER JOIN article_category_detail as b on a.article_id = b.article_id ";
                  //$table .= " INNER JOIN drug_disease as c on c.dd_id = b.drug_disease_id ";
                  $where .= (!empty($where) ? " AND " : ""). "  b.ac_id IN(". $apiData['data']['ac_id'] .") ";
                  } */
                /* if(isset($apiData['data']['drug_name']) && !empty($apiData['data']['drug_name'])){
                  //$table .= " INNER JOIN drug_disease_detail as b on a.drug_id = b.drug_id ";
                  //$table .= " INNER JOIN drug_disease as c on c.dd_id = b.drug_disease_id ";
                  $where .= (!empty($where) ? " AND " : ""). "  a.drug_name like '%". $apiData['data']['drug_name']."%'";
                  //echo $where;
                  } */

                $sql = "SELECT " . $select . " from " . $table . " where " . $where . $having . $groupBy . $orderBy . $temp;



                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;


                $command = Yii::app()->db->createCommand($sql);
                $postlist = $command->queryAll();
                if (!empty($postlist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("postlist", $lang);
                    foreach ($postlist as $key => $value) {




                        $response['data'][$key]['post_id'] = $value['post_id'] . "";
                        $response['data'][$key]['job_title'] = $value['job_title'] . "";
                        $response['data'][$key]['job_description'] = $value['job_description'] . "";
                        $response['data'][$key]['category_id'] = $value['category_id'] . "";
                        $response['data'][$key]['subcategory_id'] = $value['subcategory_id'] . "";

                        $response['data'][$key]['category_name'] = $this->GetCategoryName($value['category_id']);
                        $response['data'][$key]['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);


                        $response['data'][$key]['work_type'] = $value['work_type'] . "";
                        $response['data'][$key]['work_type_text'] = $this->GetWorkTypeText($value['work_type']). "";

                        $response['data'][$key]['pay_by'] = $value['pay_by'] . "";
                        $response['data'][$key]['pay_by_text'] = $this->GetPayByText($value['pay_by']). "";

                        $response['data'][$key]['rate'] = $value['rate'] . "";
                        $response['data'][$key]['exp_level'] = $value['exp_level'] . "";
                        $response['data'][$key]['exp_level_text'] = $this->GetExpLevelText($value['exp_level']). "";

                        $response['data'][$key]['post_datetime'] = $value['post_datetime'];
                        $response['data'][$key]['time_diffrent'] = $this->time_diffrent($value['post_datetime']);

                        $response['data'][$key]['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$value['post_id']);
                         $response['data'][$key]['is_bid'] =  $this->CheckBid($value['post_id'],$apiData['data']['id']);

                        $connection = Yii::app()->db;
                        $total_offers = 0;
                        $total_offers_sql = "select * from post_bid where post_id=".$value['post_id']." and offer_status=0 and is_offer=0";
                        $tocommand = Yii::app()->db->createCommand($total_offers_sql);
                        $total_offerslist = $tocommand->queryAll();
                        if($total_offerslist)
                        {
                                foreach ($total_offerslist as $key1 => $value1) { $total_offers++; }
                        }
                        

                        $response['data'][$key]['total_offers'] = $total_offers;

                        $response['data'][$key]['how_long'] = $value['how_long'] . "";
                        $response['data'][$key]['how_long_text'] = $this->GetHowLongText($value['how_long']). "";

                        $response['data'][$key]['commitment'] = $value['commitment'] . "";
                        $response['data'][$key]['commitment_text'] = $this->GetCommitmentText($value['commitment']). "";
                        $response['data'][$key]['attachments'] =  ($value['attachments']!="" ? json_decode($value['attachments']) : [] );  

                        $postowner = User::model()->find("id ='".$value['user_id']."'");
                                    //  print_r($temparray);


                        $response['data'][$key]['user_id'] = $postowner->id;
                        $response['data'][$key]['first_name'] = $postowner->first_name;
                        $response['data'][$key]['last_name'] = $postowner->last_name;
                        $response['data'][$key]['profile_image'] = $postowner->image;
                        $response['data'][$key]['country'] = $postowner->country;
                        $response['data'][$key]['state'] = $postowner->state;
                        $response['data'][$key]['city'] = $postowner->city;



                        $sql6 = "SELECT * from `user_review` where user_id = " . $value['user_id']. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];

                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }

                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data'][$key]['ratearray'] = $ratearray;
                        $response['data'][$key]['avgrate'] = round($avg,2)."";
                        $response['data'][$key]['totalrate'] = $cnt;

                        $response['data'][$key]['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$value['post_id']);




                       



                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }



    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 28 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Single Post Detail
     * */
    public function actionSinglePostDetail() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } 
        if (!isset($apiData['data']['post_id']) && empty($apiData['data']['post_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpostid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
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
                $connection = Yii::app()->db;


                //$temp = " ";
                // End Pagination
                //$miles = $apiData['data']['miles'];


                $connection = Yii::app()->db;

                $select = " a.* ";
                $table = "post_job as a";
                $where = " a.status!=0 ";

                $where .= (!empty($where) ? " AND " : ""). "  a.post_id=". $apiData['data']['post_id'];
                /* if(isset($apiData['data']['ac_id']) && !empty($apiData['data']['ac_id'])){
                  $table .= " INNER JOIN article_category_detail as b on a.article_id = b.article_id ";
                  //$table .= " INNER JOIN drug_disease as c on c.dd_id = b.drug_disease_id ";
                  $where .= (!empty($where) ? " AND " : ""). "  b.ac_id IN(". $apiData['data']['ac_id'] .") ";
                  } */
                /* if(isset($apiData['data']['drug_name']) && !empty($apiData['data']['drug_name'])){
                  //$table .= " INNER JOIN drug_disease_detail as b on a.drug_id = b.drug_id ";
                  //$table .= " INNER JOIN drug_disease as c on c.dd_id = b.drug_disease_id ";
                  $where .= (!empty($where) ? " AND " : ""). "  a.drug_name like '%". $apiData['data']['drug_name']."%'";
                  //echo $where;
                  } */

                $sql = "SELECT " . $select . " from " . $table . " where " . $where . $having . $groupBy . $orderBy . $temp;



                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;


                $command = Yii::app()->db->createCommand($sql);
                $postlist = $command->queryAll();
                if (!empty($postlist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("postlist", $lang);
                    foreach ($postlist as $key => $value) {




                        $response['data']['post_id'] = $value['post_id'] . "";
                        $response['data']['status'] = $value['status'] . "";
                        $response['data']['job_title'] = $value['job_title'] . "";
                        $response['data']['job_description'] = $value['job_description'] . "";
                        $response['data']['category_id'] = $value['category_id'] . "";
                        $response['data']['subcategory_id'] = $value['subcategory_id'] . "";

                        $response['data']['category_name'] = $this->GetCategoryName($value['category_id']);
                        $response['data']['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);


                        $response['data']['work_type'] = $value['work_type'] . "";
                        $response['data']['work_type_text'] = $this->GetWorkTypeText($value['work_type']). "";

                        $response['data']['pay_by'] = $value['pay_by'] . "";
                        $response['data']['pay_by_text'] = $this->GetPayByText($value['pay_by']). "";

                        $response['data']['rate'] = $value['rate'] . "";
                        $response['data']['exp_level'] = $value['exp_level'] . "";
                        $response['data']['exp_level_text'] = $this->GetExpLevelText($value['exp_level']). "";

                        $response['data']['post_datetime'] = $value['post_datetime'];
                        $response['data']['time_diffrent'] = $this->time_diffrent($value['post_datetime']);

                        $response['data']['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$value['post_id']);
                         $response['data']['is_bid'] =  $this->CheckBid($value['post_id'],$apiData['data']['id']);

                        $connection = Yii::app()->db;
                        $total_offers = 0;
                        $total_offers_sql = "select * from post_bid where post_id=".$value['post_id']." and offer_status=0 and is_offer=0";
                        $tocommand = Yii::app()->db->createCommand($total_offers_sql);
                        $total_offerslist = $tocommand->queryAll();
                        if($total_offerslist)
                        {
                                foreach ($total_offerslist as $key1 => $value1) { $total_offers++; }
                        }
                        

                        $response['data']['total_offers'] = $total_offers;

                        $response['data']['how_long'] = $value['how_long'] . "";
                        $response['data']['how_long_text'] = $this->GetHowLongText($value['how_long']). "";

                        $response['data']['commitment'] = $value['commitment'] . "";
                        $response['data']['commitment_text'] = $this->GetCommitmentText($value['commitment']). "";
                        $response['data']['attachments'] =  ($value['attachments']!="" ? json_decode($value['attachments']) : [] );  

                        $postowner = User::model()->find("id ='".$value['user_id']."'");
                                    //  print_r($temparray);


                        $response['data']['user_id'] = $postowner->id;
                        $response['data']['first_name'] = $postowner->first_name;
                        $response['data']['last_name'] = $postowner->last_name;
                        $response['data']['profile_image'] = $postowner->image;
                        $response['data']['country'] = $postowner->country;
                        $response['data']['state'] = $postowner->state;
                        $response['data']['city'] = $postowner->city;



                        $sql6 = "SELECT * from `user_review` where user_id = " . $value['user_id']. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];

                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }
                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data']['ratearray'] = $ratearray;
                        $response['data']['avgrate'] = round($avg,2)."";
                        $response['data']['totalrate'] = $cnt;

                        $response['data']['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$value['post_id']);




                       



                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "0";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }



    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 28 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Place Bid 
     * */
    public function actionPlaceBid() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) || empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) || empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }

        if (!isset($apiData['data']['post_id']) || empty($apiData['data']['post_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpostid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['how_long']) || empty($apiData['data']['how_long'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passhowlong", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['pay_by']) || empty($apiData['data']['pay_by'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpayby", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['rate']) || empty($apiData['data']['rate'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passrate", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['description']) || empty($apiData['data']['description'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passdescription", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['pay_by']) || empty($apiData['data']['pay_by'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpayby", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        else {


            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {

                
                $checkPlaceBidData = PostBid::model()->find("bid_by=" . $apiData['data']['id'] . " AND post_id = " . $apiData['data']['post_id']);
                if(!$checkPlaceBidData)
                {   
                        $PostJobData = new PostBid();
                        $PostJobData->post_id = $apiData['data']['post_id'];
                        $PostJobData->bid_by = $apiData['data']['id'];
                        $PostJobData->how_long = $apiData['data']['how_long'];
                        $PostJobData->pay_by = $apiData['data']['pay_by'];

                        $PostData = PostJob::model()->find("post_id ='".$apiData['data']['post_id']."'");

                        $PostJobData->offer_by = $PostData->user_id;


                        $PostJobData->rate = $apiData['data']['rate'];
                        $PostJobData->description = $apiData['data']['description'];
                        $PostJobData->bid_datetime = date('Y-m-d H:i:s');

                        if($apiData['data']['attachments']!="")
                        {
                            if(!empty(($apiData['data']['attachments'])))
                            {
                                $PostJobData->attachments = json_encode($apiData['data']['attachments']);
                            }
                        }
                        if($apiData['data']['skill']!="")
                        {
                            if(!empty(($apiData['data']['skill'])))
                            {
                                $PostJobData->skill = json_encode($apiData['data']['skill']);
                            }
                        }


                        //$PostJobData->save(false);
                        if ($PostJobData->save(false)) {



                            $user_id = $PostData->user_id;
                            $from_id = $apiData['data']['id'];

                            $touser = User::model()->find("id ='".$user_id."'");
                            $fromuser = User::model()->find("id ='".$from_id."'");


                            $fromusername = $fromuser->first_name . " " . $fromuser->last_name;
                            $message = $fromusername .  " " . $this->GetNotification("placebid", $lang);



                            $activityFeed = new FeedAcivity();

                            $activityFeed->user_id = $from_id;
                            $activityFeed->feed_id = $apiData['data']['post_id'];
                            $activityFeed->author_id = $user_id;
                            $activityFeed->activity_detail_id = $PostJobData->attributes['pb_id'] . '';  //EventToUser table id
                            $activityFeed->msg = $message;
                            $activityFeed->status = 2; //Event Accept
                            $activityFeed->Is_read = "0";
                            $activityFeed->created_at = date("Y-m-d H:i:s");
                            $activityFeed->save(false);
                            $actid = $activityFeed->activity_id;
                            $deviceId = $touser->device_token; 
                            $deviceType = $touser->device_type;
                            $screen = "2";
                            $connection = Yii::app()->db;
                            
                            $updateBase = $this->loadModel($user_id, 'User');
                            $updateBase->base = $updateBase->base + 1;
                            $updateBase->save(false);
                            
                            
                            $sql = "SELECT count(*) as unreadmsg FROM `feed_acivity` WHERE  author_id = '" . $user_id . "' and Is_read=0";
                            
                            $command = Yii::app()->db->createCommand($sql);
                            $activityDatas = $command->queryAll();
                            foreach ($activityDatas as $readcount) {
                                $unreadmsg = $readcount['unreadmsg'];
                            }
                            
                            $unreadmessages = $updateBase->attributes['base'];

                            $find = User::model()->find("id = " .$user_id);
                            $orderId = $apiData['data']['post_id'];
                            
                            if (!empty($find) && $find->device_token!="") {


                               FeedDetail::model()->sendNotification($deviceId, $deviceType, $message, $screen, $fromusername, $unreadmessages, $PostJobData->attributes['pb_id']);
                            }

                            $response['status'] = "1";
                            $response['message'] = $this->GetNotification("successbid", $lang);
                            $response['data'] = [];
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode($response);
                            exit();
                        } else {
                            $response['status'] = "0";
                            $response['message'] = $this->GetNotification("savedfail", $lang);
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode($response);
                            exit();
                        }
                }
                else
                {
                        $response['status'] = "0";
                        $response['message'] = $this->GetNotification("alreadybid", $lang);
                        $response['data'] = [];
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }


    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 29 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Search Job.
     * */
    public function actionSearchJob() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
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
                $connection = Yii::app()->db;


                //$temp = " ";
                // End Pagination
                //$miles = $apiData['data']['miles'];


                $connection = Yii::app()->db;

                $select = " a.* ";
                $table = "post_job as a";
                $where = " a.status=1 ";
                //$having = " having distance <=". $miles;
                // $orderBy = " ORDER BY a.article_id desc ";
                $orderBy = "";
                // $groupBy = " GROUP BY a.article_id ";
                $groupBy = "";
                $having = "";

                $select .=  (!empty($select) ? " , " : "")." Coalesce(b.review_count,0) as review_count "; 
                $table  .= " LEFT JOIN (SELECT Coalesce(AVG(review_count), 0) as review_count, user_id FROM user_review GROUP BY user_id) as b ON a.user_id = b.user_id ";
                $orderBy  .= " review_count DESC, review_count DESC ";

                $connection = Yii::app()->db;     
                if(isset($apiData['data']['keyword']) && !empty($apiData['data']['keyword'])){
                  $where .= (!empty($where) ? " AND " : ""). "  a.job_title like '%". $apiData['data']['keyword']."%' ";
                }

                if(isset($apiData['data']['category_id']) && !empty($apiData['data']['category_id'])){
                  $where .= (!empty($where) ? " AND " : ""). "  a.category_id like '%". $apiData['data']['category_id']."%' ";
                }

                if(isset($apiData['data']['subcategory_id']) && !empty($apiData['data']['subcategory_id'])){
                  $where .= (!empty($where) ? " AND " : ""). "  a.job_title like '%". $apiData['data']['subcategory_id']."%' ";
                }


                           
                if( isset($apiData['data']['latitude']) && !empty($apiData['data']['latitude']) && isset($apiData['data']['longtitude']) && !empty($apiData['data']['longtitude']) && isset($apiData['data']['miles']) && !empty($apiData['data']['miles'])){                       
                
                        $miles = $apiData['data']['miles'];
                        $select .=  (!empty($select) ? " , " : "")." ((ACOS(SIN(".$apiData['data']['latitude']."* PI() / 180) * SIN(a.latitude * PI() / 180) + COS(".$apiData['data']['latitude']."* PI() / 180) * COS(a.latitude * PI() / 180) * COS((".$apiData['data']['longtitude']." - a.longtitude) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS distance ";            
                        $having = " having distance <=". $miles;
                        
                }


                if(isset($apiData['data']['rate_by_asc']) && !empty($apiData['data']['rate_by_asc'])){


                        $select .=  (!empty($select) ? " , " : "")." Coalesce(b.review_count,0) as review_count "; 
                        $table  .= " LEFT JOIN (SELECT Coalesce(AVG(review_count), 0) as review_count, user_id FROM user_review GROUP BY user_id) as b ON a.user_id = b.user_id ";
                        $orderBy  .= " -review_count DESC, review_count DESC ";
                       // $groupBy .= " GROUP BY b.user_id ";
                }
                if(isset($apiData['data']['rate_by_desc']) && !empty($apiData['data']['rate_by_desc'])){

                        
                        //$groupBy .= " GROUP BY b.user_id ";


                }


                 $sql = "SELECT " . $select . " from " . $table . " where " . $where . $groupBy . $having . (!empty($orderBy) ? ' ORDER BY '. $orderBy : '')  . $temp;


               // echo $sql = "SELECT " . $select . " from " . $table . " where " . $where . $having . $groupBy . $orderBy . $temp;

                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;


                $command = Yii::app()->db->createCommand($sql);
                $postlist = $command->queryAll();
                if (!empty($postlist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("postlist", $lang);
                    foreach ($postlist as $key => $value) {




                        $response['data'][$key]['post_id'] = $value['post_id'] . "";
                        $response['data'][$key]['job_title'] = $value['job_title'] . "";
                        $response['data'][$key]['job_description'] = $value['job_description'] . "";
                        $response['data'][$key]['category_id'] = $value['category_id'] . "";
                        $response['data'][$key]['subcategory_id'] = $value['subcategory_id'] . "";

                        $response['data'][$key]['category_name'] = $this->GetCategoryName($value['category_id']);
                        $response['data'][$key]['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);


                        $response['data'][$key]['work_type'] = $value['work_type'] . "";
                        $response['data'][$key]['work_type_text'] = $this->GetWorkTypeText($value['work_type']). "";

                        $response['data'][$key]['pay_by'] = $value['pay_by'] . "";
                        $response['data'][$key]['pay_by_text'] = $this->GetPayByText($value['pay_by']). "";

                        $response['data'][$key]['rate'] = $value['rate'] . "";
                        $response['data'][$key]['exp_level'] = $value['exp_level'] . "";
                        $response['data'][$key]['exp_level_text'] = $this->GetExpLevelText($value['exp_level']). "";

                       $response['data'][$key]['post_datetime'] = $value['post_datetime'];
                       $response['data'][$key]['time_diffrent'] = $this->time_diffrent($value['post_datetime']);

                       $response['data'][$key]['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$value['post_id']);
                        $response['data'][$key]['is_bid'] =  $this->CheckBid($value['post_id'],$apiData['data']['id']);


                        $connection = Yii::app()->db;
                        $total_offers = 0;
                        $total_offers_sql = "select * from post_bid where post_id=".$value['post_id']." and offer_status=0 and is_offer=0";
                        $tocommand = Yii::app()->db->createCommand($total_offers_sql);
                        $total_offerslist = $tocommand->queryAll();
                        if($total_offerslist)
                        {
                                foreach ($total_offerslist as $key1 => $value1) { $total_offers++; }
                        }
                        

                        $response['data'][$key]['total_offers'] = $total_offers;

                        $response['data'][$key]['how_long'] = $value['how_long'] . "";
                        $response['data'][$key]['how_long_text'] = $this->GetHowLongText($value['how_long']). "";

                        $response['data'][$key]['commitment'] = $value['commitment'] . "";
                        $response['data'][$key]['commitment_text'] = $this->GetCommitmentText($value['commitment']). "";
                        $response['data'][$key]['attachments'] =  ($value['attachments']!="" ? json_decode($value['attachments']) : [] );  

                        $postowner = User::model()->find("id ='".$value['user_id']."'");
                                    //  print_r($temparray);


                        $response['data'][$key]['user_id'] = $postowner->id;
                        $response['data'][$key]['first_name'] = $postowner->first_name;
                        $response['data'][$key]['last_name'] = $postowner->last_name;
                        $response['data'][$key]['profile_image'] = $postowner->image;
                        $response['data'][$key]['country'] = $postowner->country;
                        $response['data'][$key]['state'] = $postowner->state;
                        $response['data'][$key]['city'] = $postowner->city;



                        $sql6 = "SELECT * from `user_review` where user_id = " . $value['user_id']. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];

                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }


                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data'][$key]['ratearray'] = $ratearray;
                        $response['data'][$key]['avgrate'] = round($avg,2)."";
                        $response['data'][$key]['totalrate'] = $cnt;

                        $response['data'][$key]['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$value['post_id']);




                       



                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }


     /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 29 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : My Bid Post.
     * */
    public function actionMyBidPost() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
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
                $connection = Yii::app()->db;


                //$temp = " ";
                // End Pagination
                //$miles = $apiData['data']['miles'];


                $connection = Yii::app()->db;

                $select = " a.* ";
                $table = "post_job as a";
                $where = " a.status=1 ";
                $table  .= " JOIN post_bid as b ON a.post_id = b.post_id ";
                $where .= (!empty($where) ? " AND " : ""). "  b.bid_by = ".$apiData['data']['id'];
                $where .= (!empty($where) ? " AND " : ""). "  b.is_offer = 0 and b.status = 0 " ;
                //$having = " having distance <=". $miles;
                 
                $orderBy = " a.post_id desc ";
                // $groupBy = " GROUP BY a.article_id ";
                $groupBy = "";
                $having = "";

              

                $sql = "SELECT " . $select . " from " . $table . " where " . $where . $groupBy . $having . (!empty($orderBy) ? ' ORDER BY '. $orderBy : '')  . $temp;


               // echo $sql = "SELECT " . $select . " from " . $table . " where " . $where . $having . $groupBy . $orderBy . $temp;

                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;


                $command = Yii::app()->db->createCommand($sql);
                $postlist = $command->queryAll();
                if (!empty($postlist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("postlist", $lang);
                    foreach ($postlist as $key => $value) {




                        $response['data'][$key]['post_id'] = $value['post_id'] . "";
                        $response['data'][$key]['job_title'] = $value['job_title'] . "";
                        $response['data'][$key]['job_description'] = $value['job_description'] . "";
                        $response['data'][$key]['category_id'] = $value['category_id'] . "";
                        $response['data'][$key]['subcategory_id'] = $value['subcategory_id'] . "";

                        $response['data'][$key]['category_name'] = $this->GetCategoryName($value['category_id']);
                        $response['data'][$key]['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);


                        $response['data'][$key]['work_type'] = $value['work_type'] . "";
                        $response['data'][$key]['work_type_text'] = $this->GetWorkTypeText($value['work_type']). "";

                        $response['data'][$key]['pay_by'] = $value['pay_by'] . "";
                        $response['data'][$key]['pay_by_text'] = $this->GetPayByText($value['pay_by']). "";

                        $response['data'][$key]['rate'] = $value['rate'] . "";
                        $response['data'][$key]['exp_level'] = $value['exp_level'] . "";
                        $response['data'][$key]['exp_level_text'] = $this->GetExpLevelText($value['exp_level']). "";

                        $response['data'][$key]['post_datetime'] = $value['post_datetime'];
                        $response['data'][$key]['time_diffrent'] = $this->time_diffrent($value['post_datetime']);
                        $response['data'][$key]['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$value['post_id']);
                         $response['data'][$key]['is_bid'] =  $this->CheckBid($value['post_id'],$apiData['data']['id']);


                        $connection = Yii::app()->db;
                        $total_offers = 0;
                        $total_offers_sql = "select * from post_bid where post_id=".$value['post_id']." and offer_status=0 and is_offer=0";
                        $tocommand = Yii::app()->db->createCommand($total_offers_sql);
                        $total_offerslist = $tocommand->queryAll();
                        if($total_offerslist)
                        {
                                foreach ($total_offerslist as $key1 => $value1) { $total_offers++; }
                        }
                        

                        $response['data'][$key]['total_offers'] = $total_offers;

                        $response['data'][$key]['how_long'] = $value['how_long'] . "";
                        $response['data'][$key]['how_long_text'] = $this->GetHowLongText($value['how_long']). "";

                        $response['data'][$key]['commitment'] = $value['commitment'] . "";
                        $response['data'][$key]['commitment_text'] = $this->GetCommitmentText($value['commitment']). "";
                        $response['data'][$key]['attachments'] =  ($value['attachments']!="" ? json_decode($value['attachments']) : [] );  

                        $postowner = User::model()->find("id ='".$value['user_id']."'");
                                    //  print_r($temparray);


                        $response['data'][$key]['user_id'] = $postowner->id;
                        $response['data'][$key]['first_name'] = $postowner->first_name;
                        $response['data'][$key]['last_name'] = $postowner->last_name;
                        $response['data'][$key]['profile_image'] = $postowner->image;
                        $response['data'][$key]['country'] = $postowner->country;
                        $response['data'][$key]['state'] = $postowner->state;
                        $response['data'][$key]['city'] = $postowner->city;



                        $sql6 = "SELECT * from `user_review` where user_id = " . $value['user_id']. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];

                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }


                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data'][$key]['ratearray'] = $ratearray;
                        $response['data'][$key]['avgrate'] = round($avg,2)."";
                        $response['data'][$key]['totalrate'] = $cnt;

                        $response['data'][$key]['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$value['post_id']);

                        $bid_data = PostBid::model()->find("post_id ='".$value['post_id']."' and bid_by=".$apiData['data']['id']);

                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['bid_datetime'] = $bid_data->bid_datetime; 
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['how_long'] = $bid_data->how_long;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['how_long_text'] = $this->GetHowLongText($bid_data->how_long);
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['pay_by'] = $bid_data->pay_by;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['pay_by_text'] = $this->GetPayByText($bid_data->pay_by); 
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['rate'] = $bid_data->rate;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['description'] = $bid_data->description;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['attachments'] = ($bid_data->attachments!="" ? json_decode($bid_data->attachments) : [] );
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['skill'] = ($bid_data->skill!="" ? json_decode($bid_data->skill) : [] );
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['status'] = $bid_data->status;



                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }


     /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 29 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : My Bid Post Running.
     * */
    public function actionMyBidPostRunning() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
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
                $connection = Yii::app()->db;


                //$temp = " ";
                // End Pagination
                //$miles = $apiData['data']['miles'];


                $connection = Yii::app()->db;

                $select = " a.* ";
                $table = "post_job as a";
                $where = " a.status=2 ";
                $table  .= " JOIN post_bid as b ON a.post_id = b.post_id ";
                $where .= (!empty($where) ? " AND " : ""). "  b.bid_by = ".$apiData['data']['id'];
                $where .= (!empty($where) ? " AND " : ""). "  b.is_offer = 0 and b.status = 2 " ;
                //$having = " having distance <=". $miles;
                // $orderBy = " ORDER BY a.article_id desc ";
                $orderBy = "";
                // $groupBy = " GROUP BY a.article_id ";
                $groupBy = "";
                $having = "";

              

                $sql = "SELECT " . $select . " from " . $table . " where " . $where . $groupBy . $having . (!empty($orderBy) ? ' ORDER BY '. $orderBy : '')  . $temp;


               // echo $sql = "SELECT " . $select . " from " . $table . " where " . $where . $having . $groupBy . $orderBy . $temp;

                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;


                $command = Yii::app()->db->createCommand($sql);
                $postlist = $command->queryAll();
                if (!empty($postlist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("postlist", $lang);
                    foreach ($postlist as $key => $value) {




                        $response['data'][$key]['post_id'] = $value['post_id'] . "";
                        $response['data'][$key]['job_title'] = $value['job_title'] . "";
                        $response['data'][$key]['job_description'] = $value['job_description'] . "";
                        $response['data'][$key]['category_id'] = $value['category_id'] . "";
                        $response['data'][$key]['subcategory_id'] = $value['subcategory_id'] . "";

                        $response['data'][$key]['category_name'] = $this->GetCategoryName($value['category_id']);
                        $response['data'][$key]['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);


                        $response['data'][$key]['work_type'] = $value['work_type'] . "";
                        $response['data'][$key]['work_type_text'] = $this->GetWorkTypeText($value['work_type']). "";

                        $response['data'][$key]['pay_by'] = $value['pay_by'] . "";
                        $response['data'][$key]['pay_by_text'] = $this->GetPayByText($value['pay_by']). "";

                        $response['data'][$key]['rate'] = $value['rate'] . "";
                        $response['data'][$key]['exp_level'] = $value['exp_level'] . "";
                        $response['data'][$key]['exp_level_text'] = $this->GetExpLevelText($value['exp_level']). "";

                        $response['data'][$key]['post_datetime'] = $value['post_datetime'];
                        $response['data'][$key]['time_diffrent'] = $this->time_diffrent($value['post_datetime']);
                        $response['data'][$key]['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$value['post_id']);
                         $response['data'][$key]['is_bid'] =  $this->CheckBid($value['post_id'],$apiData['data']['id']);


                        $connection = Yii::app()->db;
                        $total_offers = 0;
                        $total_offers_sql = "select * from post_bid where post_id=".$value['post_id']." and offer_status=0 and is_offer=0";
                        $tocommand = Yii::app()->db->createCommand($total_offers_sql);
                        $total_offerslist = $tocommand->queryAll();
                        if($total_offerslist)
                        {
                                foreach ($total_offerslist as $key1 => $value1) { $total_offers++; }
                        }
                        

                        $response['data'][$key]['total_offers'] = $total_offers;

                        $response['data'][$key]['how_long'] = $value['how_long'] . "";
                        $response['data'][$key]['how_long_text'] = $this->GetHowLongText($value['how_long']). "";

                        $response['data'][$key]['commitment'] = $value['commitment'] . "";
                        $response['data'][$key]['commitment_text'] = $this->GetCommitmentText($value['commitment']). "";
                        $response['data'][$key]['attachments'] = ($value['attachments']!="" ? json_decode($value['attachments']) : [] );  

                        $postowner = User::model()->find("id ='".$value['user_id']."'");
                                    //  print_r($temparray);


                        $response['data'][$key]['user_id'] = $postowner->id;
                        $response['data'][$key]['first_name'] = $postowner->first_name;
                        $response['data'][$key]['last_name'] = $postowner->last_name;
                        $response['data'][$key]['profile_image'] = $postowner->image;
                        $response['data'][$key]['country'] = $postowner->country;
                        $response['data'][$key]['state'] = $postowner->state;
                        $response['data'][$key]['city'] = $postowner->city;



                        $sql6 = "SELECT * from `user_review` where user_id = " . $value['user_id']. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];

                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }

                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data'][$key]['ratearray'] = $ratearray;
                        $response['data'][$key]['avgrate'] = round($avg,2)."";
                        $response['data'][$key]['totalrate'] = $cnt;

                        $response['data'][$key]['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$value['post_id']);

                        $bid_data = PostBid::model()->find("post_id ='".$value['post_id']."' and bid_by=".$apiData['data']['id']);

                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['bid_datetime'] = $bid_data->bid_datetime; 
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['how_long'] = $bid_data->how_long;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['how_long_text'] = $this->GetHowLongText($bid_data->how_long);
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['pay_by'] = $bid_data->pay_by;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['pay_by_text'] = $this->GetPayByText($bid_data->pay_by); 
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['rate'] = $bid_data->rate;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['description'] = $bid_data->description;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['attachments'] =  ($bid_data->attachments!="" ? json_decode($bid_data->attachments) : [] );
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['skill'] =  ($bid_data->skill!="" ? json_decode($bid_data->skill) : [] );
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['status'] = $bid_data->status;



                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }


     /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 29 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : My Bid Post Running All.
     * */
    public function actionMyBidPostRunningAll() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
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
                $connection = Yii::app()->db;


                //$temp = " ";
                // End Pagination
                //$miles = $apiData['data']['miles'];


                $connection = Yii::app()->db;

                $select = " a.* ";
                $table = "post_bid as a";
               // $where = " a.status=2 ";
               // $table  .= " JOIN post_bid as b ON a.post_id = b.post_id ";
                $where .= (!empty($where) ? " AND " : ""). "  a.bid_by = ".$apiData['data']['id'];
                $where .= (!empty($where) ? " AND " : ""). "  a.status = 2 " ;
                //$having = " having distance <=". $miles;
                // $orderBy = " ORDER BY a.article_id desc ";
               // $orderBy = "";
                $orderBy = " a.pb_id desc ";
                // $groupBy = " GROUP BY a.article_id ";
                $groupBy = "";
                $having = "";

              

                $sql = "SELECT " . $select . " from " . $table . " where " . $where . $groupBy . $having . (!empty($orderBy) ? ' ORDER BY '. $orderBy : '')  . $temp;


               // echo $sql = "SELECT " . $select . " from " . $table . " where " . $where . $having . $groupBy . $orderBy . $temp;

                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;


                $command = Yii::app()->db->createCommand($sql);
                $postlist = $command->queryAll();
                if (!empty($postlist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("postlist", $lang);
                    foreach ($postlist as $key => $value) {



                        $response['data'][$key]['is_offer'] = $value['is_offer'] . "";
                        $response['data'][$key]['pb_id'] = $value['pb_id'] . "";
                        $response['data'][$key]['is_temp_payment'] =  $value['is_temp_payment'] . "";
                        $user_id = "";
                        if($value['post_id']!=0)
                        {
                            $PostData = PostJob::model()->find("post_id ='".$value['post_id']."'");

                            $response['data'][$key]['post_id'] = $value['post_id'] . "";
                            $response['data'][$key]['job_title'] = $PostData->job_title. "";
                            $response['data'][$key]['job_description'] = $PostData->job_description. "";
                            $response['data'][$key]['category_id'] = $PostData->category_id. "";
                            $response['data'][$key]['subcategory_id'] = $PostData->subcategory_id. "";

                            $response['data'][$key]['category_name'] = $this->GetCategoryName($PostData->category_id)."";
                            $response['data'][$key]['subcategory_name'] = $this->GetSubCategoryName($PostData->subcategory_id)."";

                            $response['data'][$key]['work_type'] = $PostData->work_type . "";
                            $response['data'][$key]['work_type_text'] = $this->GetWorkTypeText($PostData->work_type). "";

                            $response['data'][$key]['pay_by'] = $PostData->pay_by . "";
                            $response['data'][$key]['pay_by_text'] = $this->GetPayByText($PostData->pay_by). "";

                            $response['data'][$key]['rate'] = $PostData->rate . "";
                            $response['data'][$key]['exp_level'] = $PostData->exp_level . "";
                            $response['data'][$key]['exp_level_text'] = $this->GetExpLevelText($PostData->exp_level). "";

                            $response['data'][$key]['post_datetime'] = $value['response_datetime'];
                            $response['data'][$key]['time_diffrent'] = $this->time_diffrent($value['response_datetime']);

                            $response['data'][$key]['how_long'] = $PostData->how_long . "";
                            $response['data'][$key]['how_long_text'] = $this->GetHowLongText($PostData->how_long). "";

                            $response['data'][$key]['commitment'] = $PostData->commitment . "";
                            $response['data'][$key]['commitment_text'] = $this->GetCommitmentText($PostData->commitment). "";

                            $user_id = $PostData->user_id;

                        }
                        else
                        {
                            $response['data'][$key]['post_id'] = $value['post_id'] . "";
                            $response['data'][$key]['job_title'] = $value['job_title'] . "";
                            $response['data'][$key]['job_description'] = $value['job_description'] . "";
                            $response['data'][$key]['category_id'] = $value['category_id'] . "";
                            $response['data'][$key]['subcategory_id'] = $value['subcategory_id'] . "";

                            $response['data'][$key]['category_name'] = $this->GetCategoryName($value['category_id']);
                            $response['data'][$key]['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);

                            $response['data'][$key]['work_type'] = $value['work_type'] . "";
                            $response['data'][$key]['work_type_text'] = $this->GetWorkTypeText($value['work_type']). "";

                            $response['data'][$key]['pay_by'] = $value['pay_by'] . "";
                            $response['data'][$key]['pay_by_text'] = $this->GetPayByText($value['pay_by']). "";

                            $response['data'][$key]['rate'] = $value['rate'] . "";
                            $response['data'][$key]['exp_level'] = $value['exp_level'] . "";
                            $response['data'][$key]['exp_level_text'] = $this->GetExpLevelText($value['exp_level']). "";

                            $response['data'][$key]['post_datetime'] = $value['response_datetime'];
                            $response['data'][$key]['time_diffrent'] = $this->time_diffrent($value['response_datetime']);

                            $response['data'][$key]['how_long'] = $value['how_long'] . "";
                            $response['data'][$key]['how_long_text'] = $this->GetHowLongText($value['how_long']). "";

                            $response['data'][$key]['commitment'] = $value['commitment'] . "";
                            $response['data'][$key]['commitment_text'] = $this->GetCommitmentText($value['commitment']). "";



                            $user_id = $value['offer_by'];

                        }
                        

                        $postowner = User::model()->find("id ='".$user_id."'");
                                    //  print_r($temparray);


                        $response['data'][$key]['user_id'] = $postowner->id;
                        $response['data'][$key]['first_name'] = $postowner->first_name;
                        $response['data'][$key]['last_name'] = $postowner->last_name;
                        $response['data'][$key]['profile_image'] = $postowner->image;
                        $response['data'][$key]['country'] = $postowner->country;
                        $response['data'][$key]['state'] = $postowner->state;
                        $response['data'][$key]['city'] = $postowner->city;



                        $sql6 = "SELECT * from `user_review` where user_id = " .$user_id. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];


                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }


                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data'][$key]['ratearray'] = $ratearray;
                        $response['data'][$key]['avgrate'] = round($avg,2)."";
                        $response['data'][$key]['totalrate'] = $cnt;


                        $bid_data = PostBid::model()->find("bid_by=".$apiData['data']['id']." and pb_id = ".$value['pb_id']);

                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['bid_datetime'] = $bid_data->bid_datetime; 
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['how_long'] = $bid_data->how_long;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['how_long_text'] = $this->GetHowLongText($bid_data->how_long);
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['pay_by'] = $bid_data->pay_by;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['pay_by_text'] = $this->GetPayByText($bid_data->pay_by); 
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['rate'] = $bid_data->rate;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['description'] = $bid_data->description;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['attachments'] =  ($bid_data->attachments!="" ? json_decode($bid_data->attachments) : [] );
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['skill'] =  ($bid_data->skill!="" ? json_decode($bid_data->skill) : [] );
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['status'] = $bid_data->status;




                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : July 02 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : My Bid Post completed All.
     * */
    public function actionMyBidPostcompletedAll() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
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
                $connection = Yii::app()->db;


                //$temp = " ";
                // End Pagination
                //$miles = $apiData['data']['miles'];


                $connection = Yii::app()->db;

                $select = " a.* ";
                $table = "post_bid as a";
               // $where = " a.status=2 ";
               // $table  .= " JOIN post_bid as b ON a.post_id = b.post_id ";
                $where .= (!empty($where) ? " AND " : ""). "  a.bid_by = ".$apiData['data']['id'];
                $where .= (!empty($where) ? " AND " : ""). "  a.status = 4 " ;
                //$having = " having distance <=". $miles;
                // $orderBy = " ORDER BY a.article_id desc ";
                $orderBy = "";
                $orderBy = " a.pb_id desc ";
                // $groupBy = " GROUP BY a.article_id ";
                $groupBy = "";
                $having = "";

              

                $sql = "SELECT " . $select . " from " . $table . " where " . $where . $groupBy . $having . (!empty($orderBy) ? ' ORDER BY '. $orderBy : '')  . $temp;


               // echo $sql = "SELECT " . $select . " from " . $table . " where " . $where . $having . $groupBy . $orderBy . $temp;

                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;


                $command = Yii::app()->db->createCommand($sql);
                $postlist = $command->queryAll();
                if (!empty($postlist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("postlist", $lang);
                    foreach ($postlist as $key => $value) {



                        $response['data'][$key]['is_offer'] = $value['is_offer'] . "";
                        $response['data'][$key]['pb_id'] = $value['pb_id'] . "";
                        $response['data'][$key]['total_amount'] = $value['total_amount'] . "";
                         $response['data'][$key]['approved_hour'] = $value['approved_hour'] . "";
                        $user_id = "";
                        if($value['post_id']!=0)
                        {
                            $PostData = PostJob::model()->find("post_id ='".$value['post_id']."'");

                            $response['data'][$key]['post_id'] = $value['post_id'] . "";
                            $response['data'][$key]['job_title'] = $PostData->job_title. "";
                            $response['data'][$key]['job_description'] = $PostData->job_description. "";
                            $response['data'][$key]['category_id'] = $PostData->category_id. "";
                            $response['data'][$key]['subcategory_id'] = $PostData->subcategory_id. "";

                            $response['data'][$key]['category_name'] = $this->GetCategoryName($PostData->category_id)."";
                            $response['data'][$key]['subcategory_name'] = $this->GetSubCategoryName($PostData->subcategory_id)."";

                            $response['data'][$key]['work_type'] = $PostData->work_type . "";
                            $response['data'][$key]['work_type_text'] = $this->GetWorkTypeText($PostData->work_type). "";

                            $response['data'][$key]['pay_by'] = $PostData->pay_by . "";
                            $response['data'][$key]['pay_by_text'] = $this->GetPayByText($PostData->pay_by). "";

                            $response['data'][$key]['rate'] = $PostData->rate . "";
                            $response['data'][$key]['exp_level'] = $PostData->exp_level . "";
                            $response['data'][$key]['exp_level_text'] = $this->GetExpLevelText($PostData->exp_level). "";

                            $response['data'][$key]['post_datetime'] = $value['response_datetime'];
                            $response['data'][$key]['time_diffrent'] = $this->time_diffrent($value['response_datetime']);

                            $response['data'][$key]['how_long'] = $PostData->how_long . "";
                            $response['data'][$key]['how_long_text'] = $this->GetHowLongText($PostData->how_long). "";

                            $response['data'][$key]['commitment'] = $PostData->commitment . "";
                            $response['data'][$key]['commitment_text'] = $this->GetCommitmentText($PostData->commitment). "";

                            $user_id = $PostData->user_id;

                        }
                        else
                        {
                            $response['data'][$key]['post_id'] = $value['post_id'] . "";
                            $response['data'][$key]['job_title'] = $value['job_title'] . "";
                            $response['data'][$key]['job_description'] = $value['job_description'] . "";
                            $response['data'][$key]['category_id'] = $value['category_id'] . "";
                            $response['data'][$key]['subcategory_id'] = $value['subcategory_id'] . "";

                            $response['data'][$key]['category_name'] = $this->GetCategoryName($value['category_id']);
                            $response['data'][$key]['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);

                            $response['data'][$key]['work_type'] = $value['work_type'] . "";
                            $response['data'][$key]['work_type_text'] = $this->GetWorkTypeText($value['work_type']). "";

                            $response['data'][$key]['pay_by'] = $value['pay_by'] . "";
                            $response['data'][$key]['pay_by_text'] = $this->GetPayByText($value['pay_by']). "";

                            $response['data'][$key]['rate'] = $value['rate'] . "";
                            $response['data'][$key]['exp_level'] = $value['exp_level'] . "";
                            $response['data'][$key]['exp_level_text'] = $this->GetExpLevelText($value['exp_level']). "";

                            $response['data'][$key]['post_datetime'] = $value['response_datetime'];
                            $response['data'][$key]['time_diffrent'] = $this->time_diffrent($value['response_datetime']);

                            $response['data'][$key]['how_long'] = $value['how_long'] . "";
                            $response['data'][$key]['how_long_text'] = $this->GetHowLongText($value['how_long']). "";

                            $response['data'][$key]['commitment'] = $value['commitment'] . "";
                            $response['data'][$key]['commitment_text'] = $this->GetCommitmentText($value['commitment']). "";

                            $user_id = $value['offer_by'];

                        }
                        

                        $postowner = User::model()->find("id ='".$user_id."'");
                                    //  print_r($temparray);


                        $response['data'][$key]['user_id'] = $postowner->id;
                        $response['data'][$key]['first_name'] = $postowner->first_name;
                        $response['data'][$key]['last_name'] = $postowner->last_name;
                        $response['data'][$key]['profile_image'] = $postowner->image;
                        $response['data'][$key]['country'] = $postowner->country;
                        $response['data'][$key]['state'] = $postowner->state;
                        $response['data'][$key]['city'] = $postowner->city;



                        $sql6 = "SELECT * from `user_review` where user_id = " .$user_id. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];

                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }


                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                    
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data'][$key]['ratearray'] = $ratearray;
                        $response['data'][$key]['avgrate'] = round($avg,2)."";
                        $response['data'][$key]['totalrate'] = $cnt;


                        $bid_data = PostBid::model()->find("bid_by=".$apiData['data']['id']." and pb_id = ".$value['pb_id']);

                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['bid_datetime'] = $bid_data->bid_datetime; 
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['how_long'] = $bid_data->how_long;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['how_long_text'] = $this->GetHowLongText($bid_data->how_long);
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['pay_by'] = $bid_data->pay_by;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['pay_by_text'] = $this->GetPayByText($bid_data->pay_by); 
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['rate'] = $bid_data->rate;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['description'] = $bid_data->description;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['attachments'] =  ($bid_data->attachments!="" ? json_decode($bid_data->attachments) : [] );
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['skill'] =  ($bid_data->skill!="" ? json_decode($bid_data->skill) : [] );
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['status'] = $bid_data->status;

                        $response['data'][$key]['payment_datetime'] = $value['payment_datetime'];
                        $response['data'][$key]['review_by_client'] = $value['review_by_client'];
                        $response['data'][$key]['review_by_user'] = $value['review_by_user'];


                        $please_review = "0";
                        if($value['review_by_client']==1 && !empty($value['temp_review']) && $value['review_by_user']==0)
                        {
                                $please_review = "1"; 
                        }
                       
                        $response['data'][$key]['please_review'] = $please_review; 

                        $sql7 = "SELECT * from `user_review` where pb_id=".$value['pb_id']." and user_id = " .$value['bid_by'];
                        $command7 = Yii::app()->db->createCommand($sql7);
                        $projectratedata = $command7->queryAll();
                        $projectratearray = array();

                        
                        if (!empty($projectratedata)) {
                           
                            foreach ($projectratedata as $key7 => $value7) {
                                $fromuser = User::model()->find("id ='" . $value7['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value7['review_count'];
                                    $temparray['review'] = $value7['review'];
                                    $temparray['review_date'] = $value7['review_date'];
                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $projectratearray = $temparray;                                    
                                }
                                
                            }
                        }
                        $response['data'][$key]['project_rating_client_to_business'] = $projectratearray; 

                        $sql8 = "SELECT * from `user_review` where pb_id=".$value['pb_id']." and user_id = " .$value['offer_by'];
                        $command8 = Yii::app()->db->createCommand($sql8);
                        $btovprojectratedata = $command8->queryAll();
                        $btocprojectratearray = array();
                        if (!empty($btovprojectratedata)) {
                           
                            foreach ($btovprojectratedata as $key8 => $value8) {
                                $fromuser = User::model()->find("id ='" . $value8['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value8['review_count'];
                                    $temparray['review'] = $value8['review'];
                                    $temparray['review_date'] = $value8['review_date'];
                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $btocprojectratearray = $temparray;                                    
                                }
                                
                            }
                        }
                        $response['data'][$key]['project_rating_business_to_client'] = $btocprojectratearray; 


                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }


    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 29 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : MyRunningPost.
     * */
    public function actionMyRunningPostAll() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
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
                $connection = Yii::app()->db;


                //$temp = " ";
                // End Pagination
                //$miles = $apiData['data']['miles'];


                $connection = Yii::app()->db;

                $select = " a.* ";
                $table = "post_bid as a";
               // $where = " a.status=2 ";
               // $table  .= " JOIN post_bid as b ON a.post_id = b.post_id ";
                $where .= (!empty($where) ? " AND " : ""). "  a.offer_by = ".$apiData['data']['id'];
                $where .= (!empty($where) ? " AND " : ""). "  a.status = 2 " ;
                //$having = " having distance <=". $miles;
                // $orderBy = " ORDER BY a.article_id desc ";
                $orderBy = "";
                $orderBy = "  a.pb_id desc ";
                // $groupBy = " GROUP BY a.article_id ";
                $groupBy = "";
                $having = "";

              

                $sql = "SELECT " . $select . " from " . $table . " where " . $where . $groupBy . $having . (!empty($orderBy) ? ' ORDER BY '. $orderBy : '')  . $temp;


               // echo $sql = "SELECT " . $select . " from " . $table . " where " . $where . $having . $groupBy . $orderBy . $temp;

                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;


                $command = Yii::app()->db->createCommand($sql);
                $postlist = $command->queryAll();
                if (!empty($postlist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("postlist", $lang);
                    foreach ($postlist as $key => $value) {



                        $response['data'][$key]['is_offer'] = $value['is_offer'] . "";
                        $response['data'][$key]['pb_id'] = $value['pb_id'] . "";
                        $response['data'][$key]['is_temp_payment'] =  $value['is_temp_payment'] . "";
                        if($value['post_id']!=0)
                        {
                            $PostData = PostJob::model()->find("post_id ='".$value['post_id']."'");

                            $response['data'][$key]['post_id'] = $value['post_id'] . "";
                            $response['data'][$key]['job_title'] = $PostData->job_title. "";
                            $response['data'][$key]['job_description'] = $PostData->job_description. "";
                            $response['data'][$key]['category_id'] = $PostData->category_id. "";
                            $response['data'][$key]['subcategory_id'] = $PostData->subcategory_id. "";

                            $response['data'][$key]['category_name'] = $this->GetCategoryName($PostData->category_id)."";
                            $response['data'][$key]['subcategory_name'] = $this->GetSubCategoryName($PostData->subcategory_id)."";

                            $response['data'][$key]['work_type'] = $PostData->work_type . "";
                            $response['data'][$key]['work_type_text'] = $this->GetWorkTypeText($PostData->work_type). "";

                            $response['data'][$key]['pay_by'] = $PostData->pay_by . "";
                            $response['data'][$key]['pay_by_text'] = $this->GetPayByText($PostData->pay_by). "";

                            $response['data'][$key]['rate'] = $PostData->rate . "";
                            $response['data'][$key]['exp_level'] = $PostData->exp_level . "";
                            $response['data'][$key]['exp_level_text'] = $this->GetExpLevelText($PostData->exp_level). "";

                            $response['data'][$key]['post_datetime'] = $value['response_datetime'];
                            $response['data'][$key]['time_diffrent'] = $this->time_diffrent($value['response_datetime']);

                            $response['data'][$key]['how_long'] = $PostData->how_long . "";
                            $response['data'][$key]['how_long_text'] = $this->GetHowLongText($PostData->how_long). "";

                            $response['data'][$key]['commitment'] = $PostData->commitment . "";
                            $response['data'][$key]['commitment_text'] = $this->GetCommitmentText($PostData->commitment). "";
                            

                        }
                        else
                        {
                            $response['data'][$key]['post_id'] = $value['post_id'] . "";
                            $response['data'][$key]['job_title'] = $value['job_title'] . "";
                            $response['data'][$key]['job_description'] = $value['job_description'] . "";
                            $response['data'][$key]['category_id'] = $value['category_id'] . "";
                            $response['data'][$key]['subcategory_id'] = $value['subcategory_id'] . "";

                            $response['data'][$key]['category_name'] = $this->GetCategoryName($value['category_id']);
                            $response['data'][$key]['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);

                            $response['data'][$key]['work_type'] = $value['work_type'] . "";
                            $response['data'][$key]['work_type_text'] = $this->GetWorkTypeText($value['work_type']). "";

                            $response['data'][$key]['pay_by'] = $value['pay_by'] . "";
                            $response['data'][$key]['pay_by_text'] = $this->GetPayByText($value['pay_by']). "";

                            $response['data'][$key]['rate'] = $value['rate'] . "";
                            $response['data'][$key]['exp_level'] = $value['exp_level'] . "";
                            $response['data'][$key]['exp_level_text'] = $this->GetExpLevelText($value['exp_level']). "";

                            $response['data'][$key]['post_datetime'] = $value['response_datetime'];
                            $response['data'][$key]['time_diffrent'] = $this->time_diffrent($value['response_datetime']);

                            $response['data'][$key]['how_long'] = $value['how_long'] . "";
                            $response['data'][$key]['how_long_text'] = $this->GetHowLongText($value['how_long']). "";

                            $response['data'][$key]['commitment'] = $value['commitment'] . "";
                            $response['data'][$key]['commitment_text'] = $this->GetCommitmentText($value['commitment']). "";
                           

                        }
                         $bid_data = PostBid::model()->find("bid_by=".$value['bid_by']." and pb_id = ".$value['pb_id']);

                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['bid_datetime'] = $bid_data->bid_datetime; 
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['how_long'] = $bid_data->how_long;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['how_long_text'] = $this->GetHowLongText($bid_data->how_long);
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['pay_by'] = $bid_data->pay_by;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['pay_by_text'] = $this->GetPayByText($bid_data->pay_by); 
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['rate'] = $bid_data->rate;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['description'] = $bid_data->description;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['attachments'] =  ($bid_data->attachments!="" ? json_decode($bid_data->attachments) : [] );
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['skill'] =  ($bid_data->skill!="" ? json_decode($bid_data->skill) : [] );
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['status'] = $bid_data->status;



                        $user_id = $value['bid_by'];
                        $postowner = User::model()->find("id ='".$user_id."'");
                                    //  print_r($temparray);


                        $response['data'][$key]['user_id'] = $postowner->id;
                        $response['data'][$key]['first_name'] = $postowner->first_name;
                        $response['data'][$key]['last_name'] = $postowner->last_name;
                        $response['data'][$key]['profile_image'] = $postowner->image;
                        $response['data'][$key]['country'] = $postowner->country;
                        $response['data'][$key]['state'] = $postowner->state;
                        $response['data'][$key]['city'] = $postowner->city;



                        $sql6 = "SELECT * from `user_review` where user_id = " .$user_id. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];

                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }
                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data'][$key]['ratearray'] = $ratearray;
                        $response['data'][$key]['avgrate'] = round($avg,2)."";
                        $response['data'][$key]['totalrate'] = $cnt;



                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 29 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : MyRunningPost.
     * */
    public function actionMyCompletedPostAll() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
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
                $connection = Yii::app()->db;


                //$temp = " ";
                // End Pagination
                //$miles = $apiData['data']['miles'];


                $connection = Yii::app()->db;

                $select = " a.* ";
                $table = "post_bid as a";
               // $where = " a.status=2 ";
               // $table  .= " JOIN post_bid as b ON a.post_id = b.post_id ";
                $where .= (!empty($where) ? " AND " : ""). "  a.offer_by = ".$apiData['data']['id'];
                $where .= (!empty($where) ? " AND " : ""). "  a.status = 4 " ;
                //$having = " having distance <=". $miles;
                // $orderBy = " ORDER BY a.article_id desc ";
                $orderBy = "";
                $orderBy = " a.pb_id desc ";
                // $groupBy = " GROUP BY a.article_id ";
                $groupBy = "";
                $having = "";

              

                $sql = "SELECT " . $select . " from " . $table . " where " . $where . $groupBy . $having . (!empty($orderBy) ? ' ORDER BY '. $orderBy : '')  . $temp;


               // echo $sql = "SELECT " . $select . " from " . $table . " where " . $where . $having . $groupBy . $orderBy . $temp;

                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;


                $command = Yii::app()->db->createCommand($sql);
                $postlist = $command->queryAll();
                if (!empty($postlist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("postlist", $lang);
                    foreach ($postlist as $key => $value) {



                        $response['data'][$key]['is_offer'] = $value['is_offer'] . "";
                        $response['data'][$key]['pb_id'] = $value['pb_id'] . "";
                        
                        $response['data'][$key]['total_amount'] = $value['total_amount'] . "";
                         $response['data'][$key]['approved_hour'] = $value['approved_hour'] . "";
                        
                        if($value['post_id']!=0)
                        {
                            $PostData = PostJob::model()->find("post_id ='".$value['post_id']."'");

                            $response['data'][$key]['post_id'] = $value['post_id'] . "";
                            $response['data'][$key]['job_title'] = $PostData->job_title. "";
                            $response['data'][$key]['job_description'] = $PostData->job_description. "";
                            $response['data'][$key]['category_id'] = $PostData->category_id. "";
                            $response['data'][$key]['subcategory_id'] = $PostData->subcategory_id. "";

                            $response['data'][$key]['category_name'] = $this->GetCategoryName($PostData->category_id)."";
                            $response['data'][$key]['subcategory_name'] = $this->GetSubCategoryName($PostData->subcategory_id)."";

                            $response['data'][$key]['work_type'] = $PostData->work_type . "";
                            $response['data'][$key]['work_type_text'] = $this->GetWorkTypeText($PostData->work_type). "";

                            $response['data'][$key]['pay_by'] = $PostData->pay_by . "";
                            $response['data'][$key]['pay_by_text'] = $this->GetPayByText($PostData->pay_by). "";

                            $response['data'][$key]['rate'] = $PostData->rate . "";
                            $response['data'][$key]['exp_level'] = $PostData->exp_level . "";
                            $response['data'][$key]['exp_level_text'] = $this->GetExpLevelText($PostData->exp_level). "";

                            $response['data'][$key]['post_datetime'] = $value['response_datetime'];
                            $response['data'][$key]['time_diffrent'] = $this->time_diffrent($value['response_datetime']);

                            $response['data'][$key]['how_long'] = $PostData->how_long . "";
                            $response['data'][$key]['how_long_text'] = $this->GetHowLongText($PostData->how_long). "";

                            $response['data'][$key]['commitment'] = $PostData->commitment . "";
                            $response['data'][$key]['commitment_text'] = $this->GetCommitmentText($PostData->commitment). "";
                            

                        }
                        else
                        {
                            $response['data'][$key]['post_id'] = $value['post_id'] . "";
                            $response['data'][$key]['job_title'] = $value['job_title'] . "";
                            $response['data'][$key]['job_description'] = $value['job_description'] . "";
                            $response['data'][$key]['category_id'] = $value['category_id'] . "";
                            $response['data'][$key]['subcategory_id'] = $value['subcategory_id'] . "";

                            $response['data'][$key]['category_name'] = $this->GetCategoryName($value['category_id']);
                            $response['data'][$key]['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);

                            $response['data'][$key]['work_type'] = $value['work_type'] . "";
                            $response['data'][$key]['work_type_text'] = $this->GetWorkTypeText($value['work_type']). "";

                            $response['data'][$key]['pay_by'] = $value['pay_by'] . "";
                            $response['data'][$key]['pay_by_text'] = $this->GetPayByText($value['pay_by']). "";

                            $response['data'][$key]['rate'] = $value['rate'] . "";
                            $response['data'][$key]['exp_level'] = $value['exp_level'] . "";
                            $response['data'][$key]['exp_level_text'] = $this->GetExpLevelText($value['exp_level']). "";

                            $response['data'][$key]['post_datetime'] = $value['response_datetime'];
                            $response['data'][$key]['time_diffrent'] = $this->time_diffrent($value['response_datetime']);

                            $response['data'][$key]['how_long'] = $value['how_long'] . "";
                            $response['data'][$key]['how_long_text'] = $this->GetHowLongText($value['how_long']). "";

                            $response['data'][$key]['commitment'] = $value['commitment'] . "";
                            $response['data'][$key]['commitment_text'] = $this->GetCommitmentText($value['commitment']). "";
                           

                        }
                        
                        $user_id = $value['bid_by'];
                        $postowner = User::model()->find("id ='".$user_id."'");
                                    //  print_r($temparray);


                        $response['data'][$key]['user_id'] = $postowner->id;
                        $response['data'][$key]['first_name'] = $postowner->first_name;
                        $response['data'][$key]['last_name'] = $postowner->last_name;
                        $response['data'][$key]['profile_image'] = $postowner->image;
                        $response['data'][$key]['country'] = $postowner->country;
                        $response['data'][$key]['state'] = $postowner->state;
                        $response['data'][$key]['city'] = $postowner->city;



                        $sql6 = "SELECT * from `user_review` where user_id = " .$user_id. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];


                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }


                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data'][$key]['ratearray'] = $ratearray;
                        $response['data'][$key]['avgrate'] = round($avg,2)."";
                        $response['data'][$key]['totalrate'] = $cnt;

                        $response['data'][$key]['review_by_client'] = $value['review_by_client'];
                        $response['data'][$key]['review_by_user'] = $value['review_by_user'];

                        $response['data'][$key]['payment_datetime'] = $value['payment_datetime'];
                        $response['data'][$key]['temp_review'] = json_decode($value['temp_review']);

                        $bid_data = PostBid::model()->find("bid_by=".$value['bid_by']." and pb_id = ".$value['pb_id']);

                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['bid_datetime'] = $bid_data->bid_datetime; 
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['how_long'] = $bid_data->how_long;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['how_long_text'] = $this->GetHowLongText($bid_data->how_long);
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['pay_by'] = $bid_data->pay_by;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['pay_by_text'] = $this->GetPayByText($bid_data->pay_by); 
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['rate'] = $bid_data->rate;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['description'] = $bid_data->description;
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['attachments'] =  ($bid_data->attachments!="" ? json_decode($bid_data->attachments) : [] );
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['skill'] =  ($bid_data->skill!="" ? json_decode($bid_data->skill) : [] );
                        $response['data'][$key]['my_bid_data']['freelancer_bid_data']['status'] = $bid_data->status;

                        


                        $please_review = "0";
                        if($value['review_by_client']==1 && !empty($value['temp_review']) && $value['review_by_user']==0)
                        {
                                $please_review = "1"; 
                        }
                       
                        $response['data'][$key]['please_review'] = $please_review; 


                         $sql7 = "SELECT * from `user_review` where pb_id=".$value['pb_id']." and user_id = " .$value['bid_by'];
                        $command7 = Yii::app()->db->createCommand($sql7);
                        $projectratedata = $command7->queryAll();
                        $projectratearray = array();

                        
                        if (!empty($projectratedata)) {
                           
                            foreach ($projectratedata as $key7 => $value7) {
                                $fromuser = User::model()->find("id ='" . $value7['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value7['review_count'];
                                    $temparray['review'] = $value7['review'];
                                    $temparray['review_date'] = $value7['review_date'];
                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $projectratearray = $temparray;                                    
                                }
                                
                            }
                        }
                        $response['data'][$key]['project_rating_client_to_business'] = $projectratearray; 

                        $sql8 = "SELECT * from `user_review` where pb_id=".$value['pb_id']." and user_id = " .$value['offer_by'];
                        $command8 = Yii::app()->db->createCommand($sql8);
                        $btovprojectratedata = $command8->queryAll();
                        $btocprojectratearray = array();
                        if (!empty($btovprojectratedata)) {
                           
                            foreach ($btovprojectratedata as $key8 => $value8) {
                                $fromuser = User::model()->find("id ='" . $value8['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value8['review_count'];
                                    $temparray['review'] = $value8['review'];
                                    $temparray['review_date'] = $value8['review_date'];
                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $btocprojectratearray = $temparray;                                    
                                }
                                
                            }
                        }
                        $response['data'][$key]['project_rating_business_to_client'] = $btocprojectratearray; 



                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }




    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 29 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : SingleMyBidPost.
     * */
    public function actionSingleMyBidPost() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['post_id']) && empty($apiData['data']['post_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpostid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
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
                $connection = Yii::app()->db;


                //$temp = " ";
                // End Pagination
                //$miles = $apiData['data']['miles'];


                $connection = Yii::app()->db;

                $select = " a.* ";
                $table = "post_job as a";
                $where = "  a.post_id=".$apiData['data']['post_id'];
                $table  .= " JOIN post_bid as b ON a.post_id = b.post_id ";
                $where .= (!empty($where) ? " AND " : ""). "  b.bid_by = ".$apiData['data']['id'];
                $where .= (!empty($where) ? " AND " : ""). "  b.is_offer = 0";
                //$having = " having distance <=". $miles;
                // $orderBy = " ORDER BY a.article_id desc ";
                $orderBy = "";
                // $groupBy = " GROUP BY a.article_id ";
                $groupBy = "";
                $having = "";

              

                $sql = "SELECT " . $select . " from " . $table . " where " . $where . $groupBy . $having . (!empty($orderBy) ? ' ORDER BY '. $orderBy : '')  . $temp;


               // echo $sql = "SELECT " . $select . " from " . $table . " where " . $where . $having . $groupBy . $orderBy . $temp;

                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;


                $command = Yii::app()->db->createCommand($sql);
                $postlist = $command->queryAll();
                if (!empty($postlist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("postlist", $lang);
                    foreach ($postlist as $key => $value) {




                        $response['data']['post_id'] = $value['post_id'] . "";
                        $response['data']['job_title'] = $value['job_title'] . "";
                        $response['data']['job_description'] = $value['job_description'] . "";
                        $response['data']['category_id'] = $value['category_id'] . "";
                        $response['data']['subcategory_id'] = $value['subcategory_id'] . "";

                        $response['data']['category_name'] = $this->GetCategoryName($value['category_id']);
                        $response['data']['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);


                        $response['data']['work_type'] = $value['work_type'] . "";
                        $response['data']['work_type_text'] = $this->GetWorkTypeText($value['work_type']). "";

                        $response['data']['pay_by'] = $value['pay_by'] . "";
                        $response['data']['pay_by_text'] = $this->GetPayByText($value['pay_by']). "";

                        $response['data']['rate'] = $value['rate'] . "";
                        $response['data']['exp_level'] = $value['exp_level'] . "";
                        $response['data']['exp_level_text'] = $this->GetExpLevelText($value['exp_level']). "";

                        $response['data']['post_datetime'] = $value['post_datetime'];
                        $response['data']['time_diffrent'] = $this->time_diffrent($value['post_datetime']);
                        $response['data']['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$value['post_id']);
                         $response['data']['is_bid'] =  $this->CheckBid($value['post_id'],$apiData['data']['id']);


                        $connection = Yii::app()->db;
                        $total_offers = 0;
                        $total_offers_sql = "select * from post_bid where post_id=".$value['post_id']." and offer_status=0 and is_offer=0";
                        $tocommand = Yii::app()->db->createCommand($total_offers_sql);
                        $total_offerslist = $tocommand->queryAll();
                        if($total_offerslist)
                        {
                                foreach ($total_offerslist as $key1 => $value1) { $total_offers++; }
                        }
                        

                        $response['data']['total_offers'] = $total_offers;

                        $response['data']['how_long'] = $value['how_long'] . "";
                        $response['data']['how_long_text'] = $this->GetHowLongText($value['how_long']). "";

                        $response['data']['commitment'] = $value['commitment'] . "";
                        $response['data']['commitment_text'] = $this->GetCommitmentText($value['commitment']). "";
                        $response['data']['attachments'] =  ($value['attachments']!="" ? json_decode($value['attachments']) : [] ); 

                        $postowner = User::model()->find("id ='".$value['user_id']."'");
                                    //  print_r($temparray);


                        $response['data']['user_id'] = $postowner->id;
                        $response['data']['first_name'] = $postowner->first_name;
                        $response['data']['last_name'] = $postowner->last_name;
                        $response['data']['profile_image'] = $postowner->image;
                        $response['data']['country'] = $postowner->country;
                        $response['data']['state'] = $postowner->state;
                        $response['data']['city'] = $postowner->city;



                        $sql6 = "SELECT * from `user_review` where user_id = " . $value['user_id']. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];

                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }

                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data']['ratearray'] = $ratearray;
                        $response['data']['avgrate'] = round($avg,2)."";
                        $response['data']['totalrate'] = $cnt;

                        $response['data']['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$value['post_id']);

                        $bid_data = PostBid::model()->find("post_id ='".$value['post_id']."' and bid_by=".$apiData['data']['id']);

                        $response['data']['my_bid_data']['freelancer_bid_data']['bid_datetime'] = $bid_data->bid_datetime; 
                        $response['data']['my_bid_data']['freelancer_bid_data']['how_long'] = $bid_data->how_long;
                        $response['data']['my_bid_data']['freelancer_bid_data']['how_long_text'] = $this->GetHowLongText($bid_data->how_long);
                        $response['data']['my_bid_data']['freelancer_bid_data']['pay_by'] = $bid_data->pay_by;
                        $response['data']['my_bid_data']['freelancer_bid_data']['pay_by_text'] = $this->GetPayByText($bid_data->pay_by); 
                        $response['data']['my_bid_data']['freelancer_bid_data']['rate'] = $bid_data->rate;
                        $response['data']['my_bid_data']['freelancer_bid_data']['description'] = $bid_data->description;
                        $response['data']['my_bid_data']['freelancer_bid_data']['attachments'] =  ($bid_data->attachments!="" ? json_decode($bid_data->attachments) : [] );
                        $response['data']['my_bid_data']['freelancer_bid_data']['skill'] =  ($bid_data->skill!="" ? json_decode($bid_data->skill) : [] );
                        $response['data']['my_bid_data']['freelancer_bid_data']['status'] = $bid_data->status;




                        $response['data']['my_bid_data']['client_bid_data_response']['selected_skill'] = ($bid_data->selected_skill!="" ? json_decode($bid_data->selected_skill) : [] );
                        $response['data']['my_bid_data']['client_bid_data_response']['preferred_datetime'] = $bid_data->preferred_datetime;
                        $response['data']['my_bid_data']['client_bid_data_response']['address'] = $bid_data->preferred_datetime;
                        $response['data']['my_bid_data']['client_bid_data_response']['latitude'] = $bid_data->latitude;
                        $response['data']['my_bid_data']['client_bid_data_response']['longtitude'] = $bid_data->longtitude;
                        $response['data']['my_bid_data']['client_bid_data_response']['notes'] = $bid_data->notes;
                        $response['data']['my_bid_data']['client_bid_data_response']['client_attachments'] = ($bid_data->client_attachments!="" ? json_decode($bid_data->client_attachments) : [] );
                        $response['data']['my_bid_data']['client_bid_data_response']['response_datetime'] = $bid_data->response_datetime;
                        $response['data']['my_bid_data']['client_bid_data_response']['signature'] = $bid_data->signature;
                        $response['data']['my_bid_data']['client_bid_data_response']['is_agree'] = $bid_data->is_agree;







                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }


     /**
     * @Method        : POST
     * @Params        : usertype,username,password
     * @author        : Vijay   
     * @created       : March 29 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Booking
     * */
    public function actionBooking() {
        $res = array();
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['pb_id']) && empty($apiData['data']['pb_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpbid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }

         else {

            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
                $checkData = PostBid::model()->find("pb_id ='" . $apiData['data']['pb_id'] . "'");
                if (!empty($checkData)) {
                    $pb_id = $apiData['data']['pb_id'];

                    $PostBidData = $this->loadModel($pb_id, 'PostBid');

                    if($apiData['data']['selected_skill']!="")
                    {
                        if(!empty(($apiData['data']['selected_skill'])))
                        {
                            $PostBidData->selected_skill = json_encode($apiData['data']['selected_skill']);
                        }
                    }
                    if($apiData['data']['client_attachments']!="")
                    {
                        if(!empty(($apiData['data']['client_attachments'])))
                        {
                            $PostBidData->client_attachments = json_encode($apiData['data']['client_attachments']);
                        }
                    }


                    if (isset($apiData['data']['preferred_datetime']) && !empty($apiData['data']['preferred_datetime'])) {
                        $PostBidData->preferred_datetime = $apiData['data']['preferred_datetime'];
                    }
                    if (isset($apiData['data']['pay_by']) && !empty($apiData['data']['pay_by'])) {
                        $PostBidData->pay_by = $apiData['data']['pay_by'];
                    }
                    if (isset($apiData['data']['rate']) && !empty($apiData['data']['rate'])) {
                        $PostBidData->rate = $apiData['data']['rate'];
                    }
                    if (isset($apiData['data']['description']) && !empty($apiData['data']['description'])) {
                        $PostBidData->description = $apiData['data']['description'];
                    }
                    
                    if (isset($apiData['data']['post_code']) && !empty($apiData['data']['post_code'])) {
                        $PostBidData->post_code = $apiData['data']['post_code'];
                    }

                    if (isset($apiData['data']['address']) && !empty($apiData['data']['address'])) {
                        $PostBidData->address = $apiData['data']['address'];
                    }
                    if (isset($apiData['data']['latitude']) && !empty($apiData['data']['latitude'])) {
                        $PostBidData->latitude = $apiData['data']['latitude'];
                    }
                    if (isset($apiData['data']['longtitude']) && !empty($apiData['data']['longtitude'])) {
                        $PostBidData->longtitude = $apiData['data']['longtitude'];
                    }
                    if (isset($apiData['data']['notes']) && !empty($apiData['data']['notes'])) {
                        $PostBidData->notes = $apiData['data']['notes'];
                    }
                    if (isset($apiData['data']['is_agree']) && !empty($apiData['data']['is_agree'])) {
                        $PostBidData->is_agree = $apiData['data']['is_agree'];
                    }
                    if (isset($apiData['data']['signature']) && !empty($apiData['data']['signature'])) {
                        $PostBidData->signature = $apiData['data']['signature'];
                    }
                    //$PostBidData->offer_datetime = date('Y-m-d H:i:s');
                    $PostBidData->status = 1;
                    
                    if ($PostBidData->save(false)) {
                        // Code - New Password updated and send password to mail
                        $response['status'] = "1";
                        $response['message'] = $this->GetNotification("successbooking", $lang);                      
                        $response['data'] = [];


                         $user_id = $PostBidData->bid_by;
                        $from_id = $apiData['data']['id'];

                        $touser = User::model()->find("id ='".$user_id."'");
                        $fromuser = User::model()->find("id ='".$from_id."'");

                         $bidData = PostBid::model()->find("pb_id ='".$apiData['data']['pb_id']."'");
                         $postData = PostJob::model()->find("post_id ='".$bidData->post_id."'");


                        $fromusername = $fromuser->first_name . " " . $fromuser->last_name;

                        $message = $this->GetNotification("bidresponse", $lang).' "'. $postData->job_title. ' " by ' . $fromusername ;


                        //$message = $fromusername .  " " . $this->GetNotification("bidresponse", $lang);



                        $activityFeed = new FeedAcivity();

                        $activityFeed->user_id = $from_id;
                        $activityFeed->feed_id = $PostBidData->post_id;
                        $activityFeed->author_id = $user_id;
                        $activityFeed->activity_detail_id = $PostBidData->pb_id; //EventToUser table id
                        $activityFeed->msg = $message;
                        $activityFeed->status = 8; //Event Accept
                        $activityFeed->Is_read = "0";
                        $activityFeed->created_at = date("Y-m-d H:i:s");
                        $activityFeed->save(false);
                        $actid = $activityFeed->activity_id;
                        $deviceId = $touser->device_token;
                        $deviceType = $touser->device_type;
                        $screen = "8";
                        $connection = Yii::app()->db;
                        
                        $updateBase = $this->loadModel($user_id, 'User');
                        $updateBase->base = $updateBase->base + 1;
                        $updateBase->save(false);
                        
                        
                        $sql = "SELECT count(*) as unreadmsg FROM `feed_acivity` WHERE  author_id = '" . $user_id . "' and Is_read=0";
                        
                        $command = Yii::app()->db->createCommand($sql);
                        $activityDatas = $command->queryAll();
                        foreach ($activityDatas as $readcount) {
                            $unreadmsg = $readcount['unreadmsg'];
                        }
                        
                        $unreadmessages = $updateBase->attributes['base'];

                        $find = User::model()->find("id = " .$user_id);
                        $orderId = $PostBidData->pb_id;
                        
                        if (!empty($find) && $find->device_token!="") {


                           FeedDetail::model()->sendNotification($deviceId, $deviceType, $message, $screen, $fromusername, $unreadmessages, $orderId);
                        }



                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    } else {
                        // Error Message for password update
                        $response['status'] = "0";
                        $response['message'] = $this->GetNotification("savedfail", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("recordnotfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }



     /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 29 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Like Dislike Post.
     * */

    public function actionLikeDislikePost() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if(!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang",1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if(!isset($apiData['data']['id']) && empty($apiData['data']['id'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if(!isset($apiData['data']['token']) && empty($apiData['data']['token'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if(!isset($apiData['data']['post_id']) && empty($apiData['data']['post_id'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpostid",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }       
        else 
        {
            $checkUserTokenData = User::model()->find("id='".$apiData['data']['id']."' AND token = '".$apiData['data']['token']."'");
        if($checkUserTokenData){
           $pData = Postlike::model()->find("user_id='".$apiData['data']['id']."' AND post_id = '".$apiData['data']['post_id']."'");
           if(!$pData){
          
                $PostlikeData = new Postlike();
                $PostlikeData->user_id = $apiData['data']['id'];
                $PostlikeData->post_id = $apiData['data']['post_id'];
                $PostlikeData->created_at = date('Y-m-d H:i:s');
               if ($PostlikeData->save(false)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("successfvrtpost",$lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
                else
                {
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("savedfail",$lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            }
            else
            {
                /*$response['status'] = "0";
                $response['message'] = $this->GetNotification("alreadydvrtdoctor",$lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();*/
                $postfvrt = new Postlike();
                $postfvrt = Postlike::model()->findByAttributes(array('user_id' => $apiData['data']['id'], 'post_id' => $apiData['data']['post_id']));
                if ($postfvrt->delete()) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("postremovedsuccess",$lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
                else
                {
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("postremovedfail",$lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
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
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 30 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Liked Post.
     * */
    public function actionLikedPost() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
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
                $connection = Yii::app()->db;


                //$temp = " ";
                // End Pagination
                //$miles = $apiData['data']['miles'];


                $connection = Yii::app()->db;

                $select = " a.* ";
                $table = "post_job as a";
                $table .= " INNER JOIN postlike as b on a.post_id = b.post_id ";
                $where = " a.status=1 and b.user_id=".$apiData['data']['id'];
                //$having = " having distance <=". $miles;
                // $orderBy = " ORDER BY a.article_id desc ";
                $orderBy = "";
                // $groupBy = " GROUP BY a.article_id ";
                $groupBy = "";
                $having = "";

                


                 $sql = "SELECT " . $select . " from " . $table . " where " . $where . $groupBy . $having . (!empty($orderBy) ? ' ORDER BY '. $orderBy : '')  . $temp;


               // echo $sql = "SELECT " . $select . " from " . $table . " where " . $where . $having . $groupBy . $orderBy . $temp;

                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;


                $command = Yii::app()->db->createCommand($sql);
                $postlist = $command->queryAll();
                if (!empty($postlist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("postlist", $lang);
                    foreach ($postlist as $key => $value) {




                        $response['data'][$key]['post_id'] = $value['post_id'] . "";
                        $response['data'][$key]['job_title'] = $value['job_title'] . "";
                        $response['data'][$key]['job_description'] = $value['job_description'] . "";
                        $response['data'][$key]['category_id'] = $value['category_id'] . "";
                        $response['data'][$key]['subcategory_id'] = $value['subcategory_id'] . "";

                        $response['data'][$key]['category_name'] = $this->GetCategoryName($value['category_id']);
                        $response['data'][$key]['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);


                        $response['data'][$key]['work_type'] = $value['work_type'] . "";
                        $response['data'][$key]['work_type_text'] = $this->GetWorkTypeText($value['work_type']). "";

                        $response['data'][$key]['pay_by'] = $value['pay_by'] . "";
                        $response['data'][$key]['pay_by_text'] = $this->GetPayByText($value['pay_by']). "";

                        $response['data'][$key]['rate'] = $value['rate'] . "";
                        $response['data'][$key]['exp_level'] = $value['exp_level'] . "";
                        $response['data'][$key]['exp_level_text'] = $this->GetExpLevelText($value['exp_level']). "";

                        $response['data'][$key]['post_datetime'] = $value['post_datetime'];
                        $response['data'][$key]['time_diffrent'] = $this->time_diffrent($value['post_datetime']);
                        $response['data'][$key]['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$value['post_id']);
                         $response['data'][$key]['is_bid'] =  $this->CheckBid($value['post_id'],$apiData['data']['id']);


                        $connection = Yii::app()->db;
                        $total_offers = 0;
                        $total_offers_sql = "select * from post_bid where post_id=".$value['post_id']." and offer_status=0 and is_offer=0";
                        $tocommand = Yii::app()->db->createCommand($total_offers_sql);
                        $total_offerslist = $tocommand->queryAll();
                        if($total_offerslist)
                        {
                                foreach ($total_offerslist as $key1 => $value1) { $total_offers++; }
                        }
                        

                        $response['data'][$key]['total_offers'] = $total_offers;

                        $response['data'][$key]['how_long'] = $value['how_long'] . "";
                        $response['data'][$key]['how_long_text'] = $this->GetHowLongText($value['how_long']). "";

                        $response['data'][$key]['commitment'] = $value['commitment'] . "";
                        $response['data'][$key]['commitment_text'] = $this->GetCommitmentText($value['commitment']). "";
                        $response['data'][$key]['attachments'] =  ($value['attachments']!="" ? json_decode($value['attachments']) : [] ); 

                        $postowner = User::model()->find("id ='".$value['user_id']."'");
                                    //  print_r($temparray);


                        $response['data'][$key]['user_id'] = $postowner->id;
                        $response['data'][$key]['first_name'] = $postowner->first_name;
                        $response['data'][$key]['last_name'] = $postowner->last_name;
                        $response['data'][$key]['profile_image'] = $postowner->image;
                        $response['data'][$key]['country'] = $postowner->country;
                        $response['data'][$key]['state'] = $postowner->state;
                        $response['data'][$key]['city'] = $postowner->city;



                        $sql6 = "SELECT * from `user_review` where user_id = " . $value['user_id']. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];


                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }
                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data'][$key]['ratearray'] = $ratearray;
                        $response['data'][$key]['avgrate'] = round($avg,2)."";
                        $response['data'][$key]['totalrate'] = $cnt;

                        $response['data'][$key]['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$value['post_id']);




                       



                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    
    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 29 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : SingleClientPost.
     * */
    public function actionSingleClientPost() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['post_id']) && empty($apiData['data']['post_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpostid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
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
                $connection = Yii::app()->db;


                //$temp = " ";
                // End Pagination
                //$miles = $apiData['data']['miles'];


                $connection = Yii::app()->db;

                $select = " a.* ";
                $table = "post_bid as a";
                $where = "  a.post_id=".$apiData['data']['post_id']." and is_offer=0  ";
               // $table  .= " JOIN post_bid as b ON a.post_id = b.post_id ";
               // $where .= (!empty($where) ? " AND " : ""). "  b.bid_by = ".$apiData['data']['id'];
                //$having = " having distance <=". $miles;
                // $orderBy = " ORDER BY a.article_id desc ";
                $orderBy = "";
                // $groupBy = " GROUP BY a.article_id ";
                $groupBy = "";
                $having = "";

              

                $sql = "SELECT " . $select . " from " . $table . " where " . $where . $groupBy . $having . (!empty($orderBy) ? ' ORDER BY '. $orderBy : '')  . $temp;


               // echo $sql = "SELECT " . $select . " from " . $table . " where " . $where . $having . $groupBy . $orderBy . $temp;

                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;


                $command = Yii::app()->db->createCommand($sql);
                $post_bid_list = $command->queryAll();
                if (!empty($post_bid_list)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("postlist", $lang);
                    $outerArray = array();
                    foreach ($post_bid_list as $key => $value) {

                            $superArray = array();
                            $bidderinfo = User::model()->find("id ='" . $value['bid_by'] . "'");


                            if ($bidderinfo) {
                                $temparray = array();

                                $temparray['user_id'] = $bidderinfo->id;
                                $temparray['first_name'] = $bidderinfo->first_name;
                                $temparray['last_name'] = $bidderinfo->last_name;
                                $temparray['profile_image'] = $bidderinfo->image;
                                $temparray['business_osnap_id'] = $bidderinfo->business_osnap_id;
                                $temparray['business_category'] = $bidderinfo->business_category;
                                $temparray['business_category_name'] = $this->GetBusinessCategoryName($bidderinfo->business_category);
                                $temparray['city'] = $bidderinfo->city;
                                $temparray['state'] = $bidderinfo->state;
                                $temparray['country'] = $bidderinfo->country;
                                $temparray['created_at'] = $bidderinfo->created_at;
                                $temparray['created_at_diffrent'] = $this->time_diffrent($bidderinfo->created_at); 
                                if( (isset($apiData['data']['Dlatitude']) && !empty($apiData['data']['Dlatitude'])) &&  (isset($apiData['data']['Dlongtitude']) && !empty($apiData['data']['Dlongtitude'])) ){

                                    $temparray['distance'] = $this->distance($apiData['data']['Dlatitude'],$apiData['data']['Dlongtitude'],$bidderinfo->latitude,$bidderinfo->longtitude);
                                }
                                else
                                {
                                    $temparray['distance'] = "";
                                }
                                $temparray['available'] = 1;
                                $sql6 = "SELECT * from `user_review` where user_id = " . $bidderinfo->id. " order by review_date limit 5";
                                $command6 = Yii::app()->db->createCommand($sql6);
                                $ratedata = $command6->queryAll();
                                $ratearray = array();
                                $avg = 0;
                                $total = 0;
                                $cnt = 0;
                                if (!empty($ratedata)) {
                                    $gaarray = array();
                                    foreach ($ratedata as $key6 => $value6) {
                                        $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                        if ($fromuser) {
                                            $temparray1 = array();
                                            $temparray1['review_count'] = $value6['review_count'];
                                            $temparray1['review'] = $value6['review'];
                                            $temparray1['review_date'] = $value6['review_date'];


                                            $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                            $temparray1['job_title'] = $postbiddetail->job_title."";
                                            $temparray1['total_amount'] = $postbiddetail->total_amount."";
                                            if($postbiddetail->post_id!=0)
                                            {
                                                $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                                $temparray1['job_title'] = $postdetail->job_title."";
                                            }


                                            //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                            //  print_r($temparray);

                                            $temparray1['user_id'] = $fromuser->id;
                                            $temparray1['first_name'] = $fromuser->first_name;
                                            $temparray1['last_name'] = $fromuser->last_name;
                                            $temparray1['profile_image'] = $fromuser->image;
                                            $ratearray[] = $temparray1;
                                            $total = $total + $value6['review_count'];
                                            $cnt++;
                                        }
                                        //$gaarray[] = $temparray;
                                    }
                                    $avg = $total / $cnt;
                                    //$response['data']['gallery'] = $gaarray;
                                }
                                $temparray['ratearray'] = $ratearray;
                                $temparray['avgrate'] = round($avg,2)."";
                                $temparray['totalrate'] = $cnt;

                                $temparray['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$apiData['data']['post_id']);

                                $superArray['bidderinfo'] = $temparray;

                            }
                           
                            if ($bidderinfo) {
                                $temparray2 = array();

                                $bid_data = PostBid::model()->find("post_id ='".$apiData['data']['post_id']."' and bid_by=".$bidderinfo->id);

                                $temparray2['bid_datetime'] = $bid_data->bid_datetime; 
                                $temparray2['how_long'] = $bid_data->how_long;
                                $temparray2['how_long_text'] = $this->GetHowLongText($bid_data->how_long);
                                $temparray2['pay_by'] = $bid_data->pay_by;
                                $temparray2['pay_by_text'] = $this->GetPayByText($bid_data->pay_by); 
                                $temparray2['rate'] = $bid_data->rate;
                                $temparray2['description'] = $bid_data->description;
                                $temparray2['attachments'] = ($bid_data->attachments!="" ? json_decode($bid_data->attachments) : [] );
                                $temparray2['skill'] =  ($bid_data->skill!="" ? json_decode($bid_data->skill) : [] );
                                $temparray2['status'] = $bid_data->status;
                              

                                $superArray['freelancer_bid_data'] = $temparray2;
                                $superArray['pb_id'] = $value['pb_id'];
                                $superArray['status'] = $value['status'];

                         }
                         if(!empty($superArray))
                         {
                            $outerArray[] = $superArray;
                         }
                         

                    }
                    $response['data'] = $outerArray;
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }


    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 28 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Add Offer 
     * */
    public function actionAddOffer() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) || empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) || empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }

        else {


            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {

                
               /* $checkPlaceBidData = PostBid::model()->find("bid_by=" . $apiData['data']['id'] . " AND post_id = " . $apiData['data']['post_id']);
                if(!$checkPlaceBidData)
                { */  
                        $PostJobData = new PostBid();
                        $PostJobData->post_id = 0;
                        $PostJobData->bid_by = $apiData['data']['user_id'];
                        $PostJobData->offer_by = $apiData['data']['id'];
                        $PostJobData->is_offer = 1;
                        $PostJobData->status = 1;
                        $PostJobData->offer_datetime = date('Y-m-d H:i:s');
                         $PostJobData->bid_datetime = date('Y-m-d H:i:s');

                        if (isset($apiData['data']['description']) && !empty($apiData['data']['description'])) {
                            $PostJobData->description = $apiData['data']['description'];
                        }

                        if( isset($apiData['data']['selected_skill']) && $apiData['data']['selected_skill']!="")
                        {
                            if(!empty(($apiData['data']['selected_skill'])))
                            {
                                $PostJobData->selected_skill = json_encode($apiData['data']['selected_skill']);
                            }
                        }

                        if (isset($apiData['data']['preferred_datetime']) && !empty($apiData['data']['preferred_datetime'])) {
                            $PostJobData->preferred_datetime = $apiData['data']['preferred_datetime'];
                        }
                        if (isset($apiData['data']['job_title']) && !empty($apiData['data']['job_title'])) {
                            $PostJobData->job_title = $apiData['data']['job_title'];
                        }
                        if (isset($apiData['data']['job_description']) && !empty($apiData['data']['job_description'])) {
                            $PostJobData->job_description = $apiData['data']['job_description'];
                        }
                        if (isset($apiData['data']['category_id']) && !empty($apiData['data']['category_id'])) {
                            $PostJobData->category_id = $apiData['data']['category_id'];
                        }
                        if (isset($apiData['data']['subcategory_id']) && !empty($apiData['data']['subcategory_id'])) {
                            $PostJobData->subcategory_id = $apiData['data']['subcategory_id'];
                        }
                        if (isset($apiData['data']['work_type']) && !empty($apiData['data']['work_type'])) {
                            $PostJobData->work_type = $apiData['data']['work_type'];
                        }
                        if (isset($apiData['data']['how_long']) && !empty($apiData['data']['how_long'])) {
                            $PostJobData->how_long = $apiData['data']['how_long'];
                        }
                        if (isset($apiData['data']['exp_level']) && !empty($apiData['data']['exp_level'])) {
                            $PostJobData->exp_level = $apiData['data']['exp_level'];
                        }
                        if (isset($apiData['data']['commitment']) && !empty($apiData['data']['commitment'])) {
                            $PostJobData->commitment = $apiData['data']['commitment'];
                        }
                        if (isset($apiData['data']['pay_by']) && !empty($apiData['data']['pay_by'])) {
                            $PostJobData->pay_by = $apiData['data']['pay_by'];
                        }
                        if (isset($apiData['data']['rate']) && !empty($apiData['data']['rate'])) {
                            $PostJobData->rate = $apiData['data']['rate'];
                        }

                        if($apiData['data']['attachments']!="")
                        {
                            if(!empty(($apiData['data']['attachments'])))
                            {
                                $PostJobData->attachments = json_encode($apiData['data']['attachments']);
                            }
                        }

                        if (isset($apiData['data']['address']) && !empty($apiData['data']['address'])) {
                            $PostJobData->address = $apiData['data']['address'];
                        }
                        if (isset($apiData['data']['latitude']) && !empty($apiData['data']['latitude'])) {
                            $PostJobData->latitude = $apiData['data']['latitude'];
                        }
                        if (isset($apiData['data']['longtitude']) && !empty($apiData['data']['longtitude'])) {
                            $PostJobData->longtitude = $apiData['data']['longtitude'];
                        }
                        if (isset($apiData['data']['notes']) && !empty($apiData['data']['notes'])) {
                            $PostJobData->notes = $apiData['data']['notes'];
                        }

                        if($apiData['data']['client_attachments']!="")
                        {
                            if(!empty(($apiData['data']['client_attachments'])))
                            {
                                $PostJobData->client_attachments = json_encode($apiData['data']['client_attachments']);
                            }
                        }

                        


                        //$PostJobData->save(false);
                        if ($PostJobData->save(false)) {



                            $user_id = $apiData['data']['user_id'];
                            $from_id = $apiData['data']['id'];

                            $touser = User::model()->find("id ='".$user_id."'");
                            $fromuser = User::model()->find("id ='".$from_id."'");


                            $fromusername = $fromuser->first_name . " " . $fromuser->last_name;
                            //$message = $fromusername .  " " . $this->GetNotification("addoffer", $lang);
                            $message = $this->GetNotification("addoffer", $lang).' "'. $apiData['data']['job_title']. ' " by ' . $fromusername ;



                            $activityFeed = new FeedAcivity();

                            $activityFeed->user_id = $from_id;
                            $activityFeed->feed_id = 0;
                            $activityFeed->author_id = $user_id;
                            $activityFeed->activity_detail_id = $PostJobData->attributes['pb_id']; //EventToUser table id
                            $activityFeed->msg = $message;
                            $activityFeed->status = 3; //Event Accept
                            $activityFeed->Is_read = "0";
                            $activityFeed->created_at = date("Y-m-d H:i:s");
                            $activityFeed->save(false);
                            $actid = $activityFeed->activity_id;
                            $deviceId = $touser->device_token;
                            $deviceType = $touser->device_type;
                            $screen = "3";
                            $connection = Yii::app()->db;
                            
                            $updateBase = $this->loadModel($user_id, 'User');
                            $updateBase->base = $updateBase->base + 1;
                            $updateBase->save(false);
                            
                            
                            $sql = "SELECT count(*) as unreadmsg FROM `feed_acivity` WHERE  author_id = '" . $user_id . "' and Is_read=0";
                            
                            $command = Yii::app()->db->createCommand($sql);
                            $activityDatas = $command->queryAll();
                            foreach ($activityDatas as $readcount) {
                                $unreadmsg = $readcount['unreadmsg'];
                            }
                            
                            $unreadmessages = $updateBase->attributes['base'];

                            $find = User::model()->find("id = " .$user_id);
                            $orderId = $PostJobData->attributes['pb_id'];
                            
                            if (!empty($find) && $find->device_token!="") {


                               FeedDetail::model()->sendNotification($deviceId, $deviceType, $message, $screen, $fromusername, $unreadmessages, $orderId);
                            }


                            $response['status'] = "1";
                            $response['message'] = $this->GetNotification("successoffer", $lang);
                            $response['data'] = [];
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode($response);
                            exit();
                        } else {
                            $response['status'] = "0";
                            $response['message'] = $this->GetNotification("savedfail", $lang);
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode($response);
                            exit();
                        }
             /*   }
                else
                {
                        $response['status'] = "0";
                        $response['message'] = $this->GetNotification("alreadybid", $lang);
                        $response['data'] = [];
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                }*/
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }


    /**
     * @Method        : POST
     * @Params        : usertype,username,password
     * @author        : Vijay   
     * @created       : March 31 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Offer Response
     * */
    public function actionOfferResponse() {
        $res = array();
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['offer_id']) && empty($apiData['data']['offer_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passofferid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }

         else {

            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {

                $checkData = PostBid::model()->find("pb_id ='" . $apiData['data']['offer_id'] . "'");

                if (!empty($checkData)) {
                    $pb_id = $apiData['data']['offer_id'];

                    $PostBidData = $this->loadModel($pb_id, 'PostBid');

                   // if($PostBidData->post_id!=0)
                   // {
                        if($apiData['data']['status']==2)
                        {

                            if($PostBidData->post_id!=0)
                            {
                                 $PostJobData = $this->loadModel($PostBidData->post_id, 'PostJob');
                                 $PostJobData->status = 2;
                                 $PostJobData->work_by = $PostBidData->bid_by;
                                 $PostJobData->save(false);

                            }
                            $user_id = $PostBidData->offer_by;
                            $from_id = $apiData['data']['id'];

                            $touser = User::model()->find("id ='".$user_id."'");
                            $fromuser = User::model()->find("id ='".$from_id."'");


                            $fromusername = $fromuser->first_name . " " . $fromuser->last_name;
                            if($PostBidData->post_id!=0)
                            {
                                $messageData = PostJob::model()->find("post_id ='".$bidData->post_id."'");
                            }
                            else
                            {
                             
                                $messageData = PostBid::model()->find("pb_id ='".$apiData['data']['offer_id']."'");
                            }
                            

                            $message = $fromusername .' '. $this->GetNotification("offerresponse", $lang).' '.$messageData->job_title.'offer.';

 

                            $activityFeed = new FeedAcivity();

                            $activityFeed->user_id = $from_id;
                            $activityFeed->feed_id = $PostBidData->post_id;
                            $activityFeed->author_id = $user_id;
                            $activityFeed->activity_detail_id = $PostBidData->pb_id; //EventToUser table id
                            $activityFeed->msg = $message;
                            $activityFeed->status = 4; //Event Accept
                            $activityFeed->Is_read = "0";
                            $activityFeed->created_at = date("Y-m-d H:i:s");
                            $activityFeed->save(false);
                            $actid = $activityFeed->activity_id;
                            $deviceId = $touser->device_token;
                            $deviceType = $touser->device_type;
                            $screen = "4";
                            $connection = Yii::app()->db;
                            
                            $updateBase = $this->loadModel($user_id, 'User');
                            $updateBase->base = $updateBase->base + 1;
                            $updateBase->save(false);
                            
                             
                            $sql = "SELECT count(*) as unreadmsg FROM `feed_acivity` WHERE  author_id = '" . $user_id . "' and Is_read=0";
                            
                            $command = Yii::app()->db->createCommand($sql);
                            $activityDatas = $command->queryAll();
                            foreach ($activityDatas as $readcount) {
                                $unreadmsg = $readcount['unreadmsg'];
                            }
                            
                            $unreadmessages = $updateBase->attributes['base'];

                            $find = User::model()->find("id = " .$user_id);
                            $orderId = $PostBidData->pb_id;
                            
                            if (!empty($find) && $find->device_token!="") {


                               FeedDetail::model()->sendNotification($deviceId, $deviceType, $message, $screen, $fromusername, $unreadmessages, $orderId);
                            }
                        }                         
                         
                 //   }
                    if (isset($apiData['data']['status']) && !empty($apiData['data']['status'])) {
                            $PostBidData->status = $apiData['data']['status'];
                    }


                    if (isset($apiData['data']['is_agree']) && !empty($apiData['data']['is_agree'])) {
                        $PostBidData->is_agree = $apiData['data']['is_agree'];
                    }
                    if (isset($apiData['data']['signature']) && !empty($apiData['data']['signature'])) {
                        $PostBidData->signature = $apiData['data']['signature'];
                    }
                    $PostBidData->response_datetime = date('Y-m-d H:i:s');
                  
                   
                    
                    if ($PostBidData->save(false)) {
                        // Code - New Password updated and send password to mail
                        $response['status'] = "1";
                        $response['message'] = $this->GetNotification("successofferreponse", $lang);                      
                        $response['data'] = [];

                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    } else {
                        // Error Message for password update
                        $response['status'] = "0";
                        $response['message'] = $this->GetNotification("savedfail", $lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }
                } else {
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("recordnotfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }


    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 31 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : MyOffers.
     * */
    public function actionMyOffers() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
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
                $connection = Yii::app()->db;


                //$temp = " ";
                // End Pagination
                //$miles = $apiData['data']['miles'];


                $connection = Yii::app()->db;

                $select = " a.* ";
                $table = "post_bid as a";
                //$where = " a.status=1 ";
                //$table  .= " JOIN post_bid as b ON a.post_id = b.post_id ";
                $where .= (!empty($where) ? " AND " : ""). "  a.bid_by = ".$apiData['data']['id'];
                $where .= (!empty($where) ? " AND " : ""). "  a.status = 1 ";
                //$having = " having distance <=". $miles;
                // $orderBy = " ORDER BY a.article_id desc ";
                $orderBy = "";
                // $groupBy = " GROUP BY a.article_id ";
                $groupBy = "";
                $having = "";

              

                $sql = "SELECT " . $select . " from " . $table . " where " . $where . $groupBy . $having . (!empty($orderBy) ? ' ORDER BY '. $orderBy : '')  . $temp;


               // echo $sql = "SELECT " . $select . " from " . $table . " where " . $where . $having . $groupBy . $orderBy . $temp;

                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;


                $command = Yii::app()->db->createCommand($sql);
                $myofferlist = $command->queryAll();
                if (!empty($myofferlist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("offerlist", $lang);
                    foreach ($myofferlist as $key => $value) {




                        $response['data'][$key]['pb_id'] = $value['pb_id'] . "";
                        $response['data'][$key]['is_offer'] = $value['is_offer'] . "";
                        $response['data'][$key]['status'] = $value['status'] . "";
                        $post_data = array();
                        if($value['is_offer']==1)
                        {
                                
                                $post_data['job_title'] = $value['job_title'] . "";
                                $post_data['job_description'] = $value['job_description'] . "";

                                $post_data['category_id'] = $value['category_id']. "";
                                $post_data['subcategory_id'] = $value['subcategory_id']. "";

                                $post_data['category_name'] = $this->GetCategoryName($value['category_id']);
                                $post_data['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);


                                $post_data['work_type'] = $value['work_type'] ."";
                                $post_data['work_type_text'] = $this->GetWorkTypeText($value['work_type']). "";

                                $post_data['pay_by'] = $value['pay_by'] . "";
                                $post_data['pay_by_text'] = $this->GetPayByText($value['pay_by']). "";

                                $post_data['how_long'] = $value['how_long'] . "";
                                $post_data['how_long_text'] = $this->GetHowLongText($value['how_long']). "";

                                $post_data['rate'] = $value['rate'] . "";
                                $post_data['exp_level'] = $value['exp_level'] . "";
                                $post_data['exp_level_text'] = $this->GetExpLevelText($value['exp_level']). "";

                                $post_data['post_datetime'] = $value['post_datetime'];
                                $post_data['time_diffrent'] = $this->time_diffrent($value['post_datetime']);



                                $postowner = User::model()->find("id ='".$value['offer_by']."'");
                                            //  print_r($temparray);


                                $post_data['user_id'] = $postowner->id;
                                $post_data['first_name'] = $postowner->first_name;
                                $post_data['last_name'] = $postowner->last_name;
                                $post_data['profile_image'] = $postowner->image;
                                $post_data['country'] = $postowner->country;
                                $post_data['state'] = $postowner->state;
                                $post_data['city'] = $postowner->city;


                                $sql6 = "SELECT * from `user_review` where user_id = " . $value['offer_by']. " order by review_date limit 5";
                                $command6 = Yii::app()->db->createCommand($sql6);
                                $ratedata = $command6->queryAll();
                                $ratearray = array();
                                $avg = 0;
                                $total = 0;
                                $cnt = 0;
                                if (!empty($ratedata)) {
                                    $gaarray = array();
                                    foreach ($ratedata as $key6 => $value6) {
                                        $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                        if ($fromuser) {
                                            $temparray = array();
                                            $temparray['review_count'] = $value6['review_count'];
                                            $temparray['review'] = $value6['review'];
                                            $temparray['review_date'] = $value6['review_date'];

                                            $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }


                                            //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                            //  print_r($temparray);

                                            $temparray['user_id'] = $fromuser->id;
                                            $temparray['first_name'] = $fromuser->first_name;
                                            $temparray['last_name'] = $fromuser->last_name;
                                            $temparray['profile_image'] = $fromuser->image;
                                            $ratearray[] = $temparray;
                                            $total = $total + $value6['review_count'];
                                            $cnt++;
                                        }
                                        //$gaarray[] = $temparray;
                                    }
                                    $avg = $total / $cnt;
                                    //$response['data']['gallery'] = $gaarray;
                                }
                                $post_data['ratearray'] = $ratearray;
                                $post_data['avgrate'] = round($avg,2)."";
                                $post_data['totalrate'] = $cnt;
                                $post_data['commitment'] = $value['commitment'];
                                $post_data['commitment_text'] = $this->GetCommitmentText($value['commitment']);
                                
                        }
                        else
                        {
                                $PostData = PostJob::model()->find("post_id ='".$value['post_id']."'");
                                //$POSTowner = User::model()->find("id ='".$value['offer_by']."'");

                                $post_data['post_id'] = $PostData->post_id . "";
                                $post_data['job_title'] = $PostData->job_title. "";
                                $post_data['job_description'] = $PostData->job_description. "";
                                $post_data['category_id'] = $PostData->category_id. "";
                                $post_data['subcategory_id'] = $PostData->subcategory_id. "";

                                $post_data['category_name'] = $this->GetCategoryName($PostData->category_id);
                                $post_data['subcategory_name'] = $this->GetSubCategoryName($PostData->subcategory_id);


                                $post_data['work_type'] = $PostData->work_type ."";
                                $post_data['work_type_text'] = $this->GetWorkTypeText($PostData->work_type). "";

                                $post_data['pay_by'] = $PostData->pay_by . "";
                                $post_data['pay_by_text'] = $this->GetPayByText($PostData->pay_by). "";

                                $post_data['rate'] = $PostData->rate . "";
                                $post_data['exp_level'] = $PostData->exp_level . "";
                                $post_data['exp_level_text'] = $this->GetExpLevelText($PostData->exp_level). "";

                                $post_data['post_datetime'] = $PostData->post_datetime;
                                $post_data['time_diffrent'] = $this->time_diffrent($PostData->post_datetime);
                                $post_data['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$PostData->post_id);
                                 $post_data['is_bid'] =  $this->CheckBid($PostData->post_id,$apiData['data']['id']);


                                $connection = Yii::app()->db;
                                $total_offers = 0;
                                $total_offers_sql = "select * from post_bid where post_id=".$PostData->post_id." and offer_status=0 and is_offer=0";
                                $tocommand = Yii::app()->db->createCommand($total_offers_sql);
                                $total_offerslist = $tocommand->queryAll();
                                if($total_offerslist)
                                {
                                        foreach ($total_offerslist as $key1 => $value1) { $total_offers++; }
                                }
                                

                                $post_data['total_offers'] = $total_offers;

                                $post_data['how_long'] = $PostData->how_long . "";
                                $post_data['how_long_text'] = $this->GetHowLongText($PostData->how_long). "";

                                $post_data['commitment'] = $PostData->commitment . "";
                                $post_data['commitment_text'] = $this->GetCommitmentText($PostData->commitment). "";


                                $post_data['attachments'] =   ($PostData->attachments!="" ? json_decode($PostData->attachments) : [] );

                                $postowner = User::model()->find("id ='".$PostData->user_id."'");
                                            //  print_r($temparray);


                                $post_data['postowner_user_id'] = $postowner->id;
                                $post_data['postowner_first_name'] = $postowner->first_name;
                                $post_data['postowner_last_name'] = $postowner->last_name;
                                $post_data['postowner_profile_image'] = $postowner->image;
                                $post_data['postowner_country'] = $postowner->country;
                                $post_data['postowner_state'] = $postowner->state;
                                $post_data['postowner_city'] = $postowner->city;



                                $sql6 = "SELECT * from `user_review` where user_id = " . $PostData->user_id. " order by review_date limit 5";
                                $command6 = Yii::app()->db->createCommand($sql6);
                                $ratedata = $command6->queryAll();
                                $ratearray = array();
                                $avg = 0;
                                $total = 0;
                                $cnt = 0;
                                if (!empty($ratedata)) {
                                    $gaarray = array();
                                    foreach ($ratedata as $key6 => $value6) {
                                        $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                        if ($fromuser) {
                                            $temparray = array();
                                            $temparray['review_count'] = $value6['review_count'];
                                            $temparray['review'] = $value6['review'];
                                            $temparray['review_date'] = $value6['review_date'];

                                            $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }


                                            //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                            //  print_r($temparray);

                                            $temparray['user_id'] = $fromuser->id;
                                            $temparray['first_name'] = $fromuser->first_name;
                                            $temparray['last_name'] = $fromuser->last_name;
                                            $temparray['profile_image'] = $fromuser->image;
                                            $ratearray[] = $temparray;
                                            $total = $total + $value6['review_count'];
                                            $cnt++;
                                        }
                                        //$gaarray[] = $temparray;
                                    }
                                    $avg = $total / $cnt;
                                    //$response['data']['gallery'] = $gaarray;
                                }
                                $post_data['postowner_ratearray'] = $ratearray;
                                $post_data['postowner_avgrate'] = round($avg,2)."";
                                $post_data['postowner_totalrate'] = $cnt;

                                $post_data['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$PostData->post_id);
                        }

                        $response['data'][$key]['post_data'] = $post_data;
                        
                        $freelancer_bid_data = array();
                        $freelancer_bid_data['pay_by'] = $value['pay_by'];
                        $freelancer_bid_data['pay_by_text'] = $this->GetPayByText($value['pay_by']); 
                        $freelancer_bid_data['rate'] = $value['rate'];
                        $freelancer_bid_data['how_long'] = $value['how_long'];
                        $freelancer_bid_data['how_long_text'] = $this->GetHowLongText($value['how_long']);

                        $freelancer_bid_data['category_id'] = $value['category_id'];
                        $freelancer_bid_data['subcategory_id'] = $value['subcategory_id'];

                        $freelancer_bid_data['category_name'] = $this->GetCategoryName($value['category_id']);
                        $freelancer_bid_data['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);

                        $freelancer_bid_data['work_type'] = $value['work_type'];
                        $freelancer_bid_data['work_type_text'] = $this->GetWorkTypeText($value['work_type']). "";


                        $freelancer_bid_data['exp_level'] = $value['exp_level'];
                        $freelancer_bid_data['exp_level_text'] = $this->GetExpLevelText($value['exp_level']). "";

                        $freelancer_bid_data['commitment'] = $value['commitment'];
                        $freelancer_bid_data['commitment_text'] =  $this->GetCommitmentText($value['commitment'])."";

                        $freelancer_bid_data['description'] = $value['description'];


                        $freelancer_bid_data['attachments'] = ($value['attachments']!="" ? json_decode($value['attachments']) : [] );  
                        $freelancer_bid_data['skill'] = ($value['skill']!="" ? json_decode($value['skill']) : [] ); 


                        $response['data'][$key]['freelancer_bid_data'] = $freelancer_bid_data;


                        $client_bid_data_response = array();



                        $client_bid_data_response['response_datetime'] = $value['response_datetime'];
                        $client_bid_data_response['response_time_diffrent'] =  $this->time_diffrent($value['response_datetime']);

                        $client_bid_data_response['selected_skill'] = ($value['selected_skill']!="" ? json_decode($value['selected_skill']) : [] );

                        $client_bid_data_response['preferred_datetime'] = $value['preferred_datetime'];
                        $client_bid_data_response['client_response_address'] = $value['address'];
                        $client_bid_data_response['latitude'] = $value['latitude'];
                        $client_bid_data_response['longtitude'] = $value['longtitude'];
                        $client_bid_data_response['notes'] = $value['notes'];
                         $client_bid_data_response['client_attachments'] = ($value['client_attachments']!="" ? json_decode($value['client_attachments']) : [] );
                        $client_bid_data_response['signature'] = $value['signature'];
                        $client_bid_data_response['is_agree'] = $value['is_agree'];


                        $response['data'][$key]['client_bid_data_response'] = $client_bid_data_response;







                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }


     /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 31 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : MyRequestedOffers.
     * */
    public function actionMyRequestedOffers() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
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
                $connection = Yii::app()->db;


                //$temp = " ";
                // End Pagination
                //$miles = $apiData['data']['miles'];


                $connection = Yii::app()->db;

                $select = " a.* ";
                $table = "post_bid as a";
                //$where = " a.status=1 ";
                //$table  .= " JOIN post_bid as b ON a.post_id = b.post_id ";
                $where .= (!empty($where) ? " AND " : ""). "  a.offer_by = ".$apiData['data']['id'];
                $where .= (!empty($where) ? " AND " : ""). "  a.is_offer = 1";
                //$having = " having distance <=". $miles;
                // $orderBy = " ORDER BY a.article_id desc ";
                $orderBy = "";
                // $groupBy = " GROUP BY a.article_id ";
                $groupBy = "";
                $having = "";

              

                $sql = "SELECT " . $select . " from " . $table . " where " . $where . $groupBy . $having . (!empty($orderBy) ? ' ORDER BY '. $orderBy : '')  . $temp;


               // echo $sql = "SELECT " . $select . " from " . $table . " where " . $where . $having . $groupBy . $orderBy . $temp;

                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;


                $command = Yii::app()->db->createCommand($sql);
                $myofferlist = $command->queryAll();
                if (!empty($myofferlist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("offerlist", $lang);
                    foreach ($myofferlist as $key => $value) {




                        $response['data'][$key]['offer_id'] = $value['pb_id'] . "";
                        $post_data = array();
                        $post_data['job_title'] = $value['job_title'] . "";
                        $post_data['job_description'] = $value['job_description'] . "";

                        $postowner = User::model()->find("id ='".$value['offer_by']."'");
                                    //  print_r($temparray);


                        $post_data['postowner_user_id'] = $postowner->id;
                        $post_data['postowner_first_name'] = $postowner->first_name;
                        $post_data['postowner_last_name'] = $postowner->last_name;
                        $post_data['postowner_profile_image'] = $postowner->image;
                        $post_data['postowner_country'] = $postowner->country;
                        $post_data['postowner_state'] = $postowner->state;
                        $post_data['postowner_city'] = $postowner->city;


                        $sql6 = "SELECT * from `user_review` where user_id = " . $value['offer_by']. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];


                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }


                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $post_data['postowner_ratearray'] = $ratearray;
                        $post_data['postowner_avgrate'] = round($avg,2)."";
                        $post_data['postowner_totalrate'] = $cnt;
                        $post_data['commitment'] = $value['commitment'];
                        $post_data['commitment_text'] = $this->GetCommitmentText($value['commitment']);
                        $response['data'][$key]['post_data'] = $post_data;



                        
                        $freelancer_bid_data = array();
                        $freelancer_bid_data['pay_by'] = $value['pay_by'];
                        $freelancer_bid_data['pay_by_text'] = $this->GetPayByText($value['pay_by']); 
                        $freelancer_bid_data['rate'] = $value['rate'];
                        $response['data'][$key]['freelancer_bid_data'] = $freelancer_bid_data;


                        $client_bid_data_response = array();


                        $client_bid_data_response['response_datetime'] = $value['response_datetime'];
                        $client_bid_data_response['response_time_diffrent'] =  $this->time_diffrent($value['response_datetime']);
                        $response['data'][$key]['client_bid_data_response'] = $client_bid_data_response;







                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }


     /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 29 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : My Event.
     * */
    public function actionBusinessMyEvent() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        /*if (!isset($apiData['data']['month']) && empty($apiData['data']['month'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passmonth", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['year']) && empty($apiData['data']['year'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passyear", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } */else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
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
                $connection = Yii::app()->db;


                //$temp = " ";
                // End Pagination
                //$miles = $apiData['data']['miles'];


                $connection = Yii::app()->db;

                $select = " a.* ";
                $table = "post_bid as a";
                //$where = " a.status=1 ";
                //$table  .= " JOIN post_bid as b ON a.post_id = b.post_id ";
                $where .= (!empty($where) ? " AND " : ""). "  a.bid_by = ".$apiData['data']['id'];

                $where .= (!empty($where) ? " AND " : ""). "  a.bid_by = ".$apiData['data']['id'];
                
                if($apiData['data']['year']!="" && $apiData['data']['month']!="")
                {
                    $where .= (!empty($where) ? " AND " : ""). "  a.status = 2 and DATE_FORMAT(a.preferred_datetime, '%Y-%m') = '".$apiData['data']['year']."-".$apiData['data']['month']."'";
                }
                else
                {
                     $cumonth = date('m');
                    $cday = date('d');
                    $where .= (!empty($where) ? " AND " : ""). "  a.status = 2 and  DATE_FORMAT(preferred_datetime, '%Y-%m-%d') >= DATE_FORMAT('".$apiData['data']['year']."-".$cumonth."-".$cday."', '%Y-%m-%d')";
                   // $where .= (!empty($where) ? " AND " : ""). "  a.status = 2 and DATE_FORMAT(a.preferred_datetime, '%Y') = '".$apiData['data']['year']."' and DATE_FORMAT(a.preferred_datetime, '%m') >= ".$cumonth." and DATE_FORMAT(a.preferred_datetime, '%d') >= ".$cday;
                }


               // $where .= (!empty($where) ? " AND " : ""). "  a.status = 2 and DATE_FORMAT(a.preferred_datetime, '%Y-%m') = '".$apiData['data']['year']."-".$apiData['data']['month']."'";
                //$having = " having distance <=". $miles;
                // $orderBy = " ORDER BY a.article_id desc ";
                $orderBy = "";
                // $groupBy = " GROUP BY a.article_id ";
                $groupBy = "";
                $having = "";

              

                 $sql = "SELECT " . $select . " from " . $table . " where " . $where . $groupBy . $having . (!empty($orderBy) ? ' ORDER BY '. $orderBy : '')  . $temp;


               // echo $sql = "SELECT " . $select . " from " . $table . " where " . $where . $having . $groupBy . $orderBy . $temp;

                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;


                $command = Yii::app()->db->createCommand($sql);
                $myofferlist = $command->queryAll();
                if (!empty($myofferlist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("eventlist", $lang);
                    foreach ($myofferlist as $key => $value) {

                        $response['data'][$key]['preferred_datetime'] = $value['preferred_datetime'];
                        if($value['post_id']!="0")
                        {
                             $postowners = PostJob::model()->find("post_id ='".$value['post_id']."'");
                             $displyinfo = User::model()->find("id ='".$postowners->user_id."'");
                             
                        }
                        else
                        {
                           
                            //$postowners = PostJob::model()->find("post_id ='".$value['offer_by']."'");

                        //    $postowners = PostJob::model()->find("user_id ='".$value['offer_by']."'");                           
                             $displyinfo = User::model()->find("id ='".$value['offer_by']."'");

                           //  $displyinfo = PostBid::model()->find("post_id ='".$value['offer_by']."'");
                        }
                        
                                            //  print_r($temparray);


                        $response['data'][$key]['displyinfo_user_id'] = $displyinfo->id;
                        $response['data'][$key]['displyinfo_first_name'] = $displyinfo->first_name."";
                        $response['data'][$key]['displyinfo_last_name'] = $displyinfo->last_name."";
                        $response['data'][$key]['displyinfo_profile_image'] = $displyinfo->image."";
                        $response['data'][$key]['displyinfo_country'] = $displyinfo->country."";
                        $response['data'][$key]['displyinfo_state'] = $displyinfo->state."";
                        $response['data'][$key]['displyinfo_city'] = $displyinfo->city."";
                        $response['data'][$key]['displyinfo_business_name'] = $displyinfo->business_name."";
                        $response['data'][$key]['displyinfo_business_type'] = $displyinfo->business_type."";
                        $response['data'][$key]['displyinfo_business_category'] =   $displyinfo->business_category."";
                        $response['data'][$key]['displyinfo_business_category_name'] =  $this->GetBusinessCategoryName($displyinfo->business_category)."";
                        $response['data'][$key]['displyinfo_business_osnap_id'] = $displyinfo->business_osnap_id."";
                        $response['data'][$key]['pb_id'] = $value['pb_id'];

                        
                            $postbiddetail = PostBid::model()->find("pb_id ='".$value['pb_id']."'");
                            $response['data'][$key]['job_title'] = $postbiddetail->job_title."";
                            if($postbiddetail->post_id!=0)
                            {
                                $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                $response['data'][$key]['job_title'] = $postdetail->job_title."";
                            }



                        

                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

     /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 29 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : My Event.
     * */
    public function actionClientMyEvent() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
       /* if (!isset($apiData['data']['month']) && empty($apiData['data']['month'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passmonth", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['year']) && empty($apiData['data']['year'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passyear", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }*/ else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
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
                $connection = Yii::app()->db;


                //$temp = " ";
                // End Pagination
                //$miles = $apiData['data']['miles'];


                $connection = Yii::app()->db;

                $select = " a.* ";
                $table = "post_bid as a";
                //$where = " a.status=1 ";
                //$table  .= " JOIN post_bid as b ON a.post_id = b.post_id ";
                //$where .= (!empty($where) ? " AND " : ""). " a.offer_by=0 or a.offer_by = ".$apiData['data']['id'];
                
                if($apiData['data']['year']!="" && $apiData['data']['month']!="")
                {
                    $where .= (!empty($where) ? " AND " : ""). "  a.status = 2 and DATE_FORMAT(a.preferred_datetime, '%Y-%m') = '".$apiData['data']['year']."-".$apiData['data']['month']."'";
                }
                else
                {
                    $cumonth = date('m');
                    $cday = date('d');
                    $where .= (!empty($where) ? " AND " : ""). "  a.status = 2 and  DATE_FORMAT(preferred_datetime, '%Y-%m-%d') >= DATE_FORMAT('".$apiData['data']['year']."-".$cumonth."-".$cday."', '%Y-%m-%d')";
                }



               // $where .= (!empty($where) ? " AND " : ""). "  a.status = 2 and DATE_FORMAT(a.preferred_datetime, '%Y-%m') = '".$apiData['data']['year']."-".$apiData['data']['month']."'";
                //$having = " having distance <=". $miles;
                // $orderBy = " ORDER BY a.article_id desc ";
                $orderBy = "";
                // $groupBy = " GROUP BY a.article_id ";
                $groupBy = "";
                $having = "";

              

                  $sql = "SELECT " . $select . " from " . $table . " where " . $where . $groupBy . $having . (!empty($orderBy) ? ' ORDER BY '. $orderBy : '')  . $temp;


               // echo $sql = "SELECT " . $select . " from " . $table . " where " . $where . $having . $groupBy . $orderBy . $temp;

                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;

                $postq = " select * from post_job where status=2 and user_id=".$apiData['data']['id'];
                $commandq = Yii::app()->db->createCommand($postq);
                $postqlist = $commandq->queryAll();
                $postarray = array();
                if (!empty($postqlist)) {
                    foreach ($postqlist as $qkey => $qvalue) {
                        $postarray[] = $qvalue['post_id'];
                    }
                }


                $command = Yii::app()->db->createCommand($sql);
                $myofferlist = $command->queryAll();
                if (!empty($myofferlist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("eventlist", $lang);
                    $mainArray = array();
                    foreach ($myofferlist as $key => $value) {
                        $tempArray = array();
                        if( ( $value['post_id']!=0 && $value['is_offer']==0 && in_array($value['post_id'], $postarray)) || ($value['is_offer']==1 && $value['offer_by']==$apiData['data']['id'])  )
                        {
                            $tempArray['preferred_datetime'] = $value['preferred_datetime'];
                            

                                 $displyinfo = User::model()->find("id ='".$value['bid_by']."'");
                           
                            
                                                //  print_r($temparray);


                            $tempArray['displyinfo_user_id'] = $displyinfo->id;
                            $tempArray['displyinfo_first_name'] = $displyinfo->first_name."";
                            $tempArray['displyinfo_last_name'] = $displyinfo->last_name."";
                            $tempArray['displyinfo_profile_image'] = $displyinfo->image."";
                            $tempArray['displyinfo_country'] = $displyinfo->country."";
                            $tempArray['displyinfo_state'] = $displyinfo->state."";
                            $tempArray['displyinfo_city'] = $displyinfo->city."";
                            $tempArray['displyinfo_business_name'] = $displyinfo->business_name."";
                            $tempArray['displyinfo_business_type'] = $displyinfo->business_type."";
                            $tempArray['displyinfo_business_category'] =   $displyinfo->business_category."";
                            $tempArray['displyinfo_business_category_name'] =  $this->GetBusinessCategoryName($displyinfo->business_category)."";
                            $tempArray['displyinfo_business_osnap_id'] = $displyinfo->business_osnap_id."";

                            $tempArray['pb_id'] = $value['pb_id'];

                            $postbiddetail = PostBid::model()->find("pb_id ='".$value['pb_id']."'");
                            $tempArray['job_title'] = $postbiddetail->job_title."";
                            if($postbiddetail->post_id!=0)
                            {
                                $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                $tempArray['job_title'] = $postdetail->job_title."";
                            }


                           
                            $mainArray[] = $tempArray;

                        }




                    }
                    $response['data'] = $mainArray;
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }


    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 29 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : My Event.
     * */
    public function actionEventDetail() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['pb_id']) && empty($apiData['data']['pb_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpbid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
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
                $connection = Yii::app()->db;


                //$temp = " ";
                // End Pagination
                //$miles = $apiData['data']['miles'];


                $connection = Yii::app()->db;

                $select = " a.* ";
                $table = "post_bid as a";
                //$where = " a.status=1 ";
                //$table  .= " JOIN post_bid as b ON a.post_id = b.post_id ";
                //$where .= (!empty($where) ? " AND " : ""). " a.offer_by=0 or a.offer_by = ".$apiData['data']['id'];
               // $where .= (!empty($where) ? " AND " : ""). "  (a.status = 2 or a.status = 4)  and pb_id=".$apiData['data']['pb_id'] ;

                 $where .= (!empty($where) ? " AND " : ""). "   pb_id=".$apiData['data']['pb_id'] ;
                //$having = " having distance <=". $miles;
                // $orderBy = " ORDER BY a.article_id desc ";
                $orderBy = "";
                // $groupBy = " GROUP BY a.article_id ";
                $groupBy = "";
                $having = "";

              

                $sql = "SELECT " . $select . " from " . $table . " where " . $where . $groupBy . $having . (!empty($orderBy) ? ' ORDER BY '. $orderBy : '')  . $temp;


               // echo $sql = "SELECT " . $select . " from " . $table . " where " . $where . $having . $groupBy . $orderBy . $temp;

                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;

                $postq = " select * from post_job where status=2 and user_id=".$apiData['data']['id'];
                $commandq = Yii::app()->db->createCommand($postq);
                $postqlist = $commandq->queryAll();
                $postarray = array();
                if (!empty($postqlist)) {
                    foreach ($postqlist as $qkey => $qvalue) {
                        $postarray[] = $qvalue['post_id'];
                    }
                }


                $command = Yii::app()->db->createCommand($sql);
                $myofferlist = $command->queryAll();
                if (!empty($myofferlist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("eventlist", $lang);
                    foreach ($myofferlist as $key => $value) {

                       
                        $response['data']['preferred_datetime'] = $value['preferred_datetime'];                        
                        $response['data']['pb_id'] = $value['pb_id'] . "";
                        
                         $response['data']['total_amount'] = $value['total_amount'] . "";
                         $response['data']['approved_hour'] = $value['approved_hour'] . "";
                        $response['data']['is_offer'] = $value['is_offer'] . "";
                        $response['data']['status'] = $value['status'] . "";

                        

                        $PaymentRequest = PaymentRequest::model()->find("pb_id ='".$value['pb_id']."' and status=0");
                        if($PaymentRequest)
                        {
                        	$start_date = new DateTime($PaymentRequest->request_datetime);
							$since_start = $start_date->diff(new DateTime(date("Y-m-d H:i:s")));
							$minutes = $since_start->days * 24 * 60;
							$minutes += $since_start->h * 60;
							$minutes += $since_start->i;
							//echo $minutes;
							$send = "0";
							if($minutes>=1440)
							{
								$send = "1";
							}
                        	$response['data']['payment_request_datetime'] = $PaymentRequest->request_datetime;
                        	$response['data']['payment_request_send'] = $send;
                        }
                        else
                        {
                        	$response['data']['payment_request_datetime'] = "";
                        	$response['data']['payment_request_send'] = "1";
                        }


                        $post_data = array();
                        if($value['is_offer']==1)
                        {
                                
                                $post_data['job_title'] = $value['job_title'] . "";
                                $post_data['job_description'] = $value['job_description'] . "";

                                $post_data['category_id'] = $value['category_id']. "";
                                $post_data['subcategory_id'] = $value['subcategory_id']. "";

                                $post_data['category_name'] = $this->GetCategoryName($value['category_id']);
                                $post_data['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);


                                $post_data['work_type'] = $value['work_type'] ."";
                                $post_data['work_type_text'] = $this->GetWorkTypeText($value['work_type']). "";

                                $post_data['pay_by'] = $value['pay_by'] . "";
                                $post_data['pay_by_text'] = $this->GetPayByText($value['pay_by']). "";

                                $post_data['how_long'] = $value['how_long'] . "";
                                $post_data['how_long_text'] = $this->GetHowLongText($value['how_long']). "";

                                $post_data['rate'] = $value['rate'] . "";
                                $post_data['exp_level'] = $value['exp_level'] . "";
                                $post_data['exp_level_text'] = $this->GetExpLevelText($value['exp_level']). "";

                                $post_data['post_datetime'] = $value['bid_datetime'];
                                $post_data['time_diffrent'] = $this->time_diffrent($value['bid_datetime']);

                                $post_data['bid_datetime'] = $value['bid_datetime'];

                                




                                $postowner = User::model()->find("id ='".$value['offer_by']."'");
                                            //  print_r($temparray);


                                $post_data['user_id'] = $postowner->id;
                                $post_data['first_name'] = $postowner->first_name;
                                $post_data['last_name'] = $postowner->last_name;
                                $post_data['profile_image'] = $postowner->image;
                                $post_data['country'] = $postowner->country;
                                $post_data['state'] = $postowner->state;
                                $post_data['city'] = $postowner->city;


                                $sql6 = "SELECT * from `user_review` where user_id = " . $value['offer_by']. " order by review_date limit 5";
                                $command6 = Yii::app()->db->createCommand($sql6);
                                $ratedata = $command6->queryAll();
                                $ratearray = array();
                                $avg = 0;
                                $total = 0;
                                $cnt = 0;
                                if (!empty($ratedata)) {
                                    $gaarray = array();
                                    foreach ($ratedata as $key6 => $value6) {
                                        $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                        if ($fromuser) {
                                            $temparray = array();
                                            $temparray['review_count'] = $value6['review_count'];
                                            $temparray['review'] = $value6['review'];
                                            $temparray['review_date'] = $value6['review_date'];

                                            $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }


                                            //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                            //  print_r($temparray);

                                            $temparray['user_id'] = $fromuser->id;
                                            $temparray['first_name'] = $fromuser->first_name;
                                            $temparray['last_name'] = $fromuser->last_name;
                                            $temparray['profile_image'] = $fromuser->image;
                                            $ratearray[] = $temparray;
                                            $total = $total + $value6['review_count'];
                                            $cnt++;
                                        }
                                        //$gaarray[] = $temparray;
                                    }
                                    $avg = $total / $cnt;
                                    //$response['data']['gallery'] = $gaarray;
                                }
                                $post_data['ratearray'] = $ratearray;
                                $post_data['avgrate'] = round($avg,2)."";
                                $post_data['totalrate'] = $cnt;
                                $post_data['commitment'] = $value['commitment'];
                                $post_data['commitment_text'] = $this->GetCommitmentText($value['commitment']);
                                
                        }
                        else
                        {
                                $PostData = PostJob::model()->find("post_id ='".$value['post_id']."'");
                                //$POSTowner = User::model()->find("id ='".$value['offer_by']."'");

                                $post_data['post_id'] = $PostData->post_id . "";
                                $post_data['job_title'] = $PostData->job_title. "";
                                $post_data['job_description'] = $PostData->job_description. "";
                                $post_data['category_id'] = $PostData->category_id. "";
                                $post_data['subcategory_id'] = $PostData->subcategory_id. "";

                                $post_data['category_name'] = $this->GetCategoryName($PostData->category_id);
                                $post_data['subcategory_name'] = $this->GetSubCategoryName($PostData->subcategory_id);


                                $post_data['work_type'] = $PostData->work_type ."";
                                $post_data['work_type_text'] = $this->GetWorkTypeText($PostData->work_type). "";

                                $post_data['pay_by'] = $PostData->pay_by . "";
                                $post_data['pay_by_text'] = $this->GetPayByText($PostData->pay_by). "";

                                $post_data['rate'] = $PostData->rate . "";
                                $post_data['exp_level'] = $PostData->exp_level . "";
                                $post_data['exp_level_text'] = $this->GetExpLevelText($PostData->exp_level). "";

                                $post_data['post_datetime'] = $PostData->post_datetime;
                                $post_data['bid_datetime'] = $PostData->post_datetime;
                                $post_data['time_diffrent'] = $this->time_diffrent($PostData->post_datetime);
                                $post_data['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$PostData->post_id);
                                 $post_data['is_bid'] =  $this->CheckBid($PostData->post_id,$apiData['data']['id']);


                                $connection = Yii::app()->db;
                                $total_offers = 0;
                                $total_offers_sql = "select * from post_bid where post_id=".$PostData->post_id." and offer_status=0 and is_offer=0";
                                $tocommand = Yii::app()->db->createCommand($total_offers_sql);
                                $total_offerslist = $tocommand->queryAll();
                                if($total_offerslist)
                                {
                                        foreach ($total_offerslist as $key1 => $value1) { $total_offers++; }
                                }
                                

                                $post_data['total_offers'] = $total_offers;

                                $post_data['how_long'] = $PostData->how_long . "";
                                $post_data['how_long_text'] = $this->GetHowLongText($PostData->how_long). "";

                                $post_data['commitment'] = $PostData->commitment . "";
                                $post_data['commitment_text'] = $this->GetCommitmentText($PostData->commitment). "";


                                $post_data['attachments'] =   ($PostData->attachments!="" ? json_decode($PostData->attachments) : [] );

                                $postowner = User::model()->find("id ='".$PostData->user_id."'");
                                            //  print_r($temparray);


                                $post_data['postowner_user_id'] = $postowner->id;
                                $post_data['postowner_first_name'] = $postowner->first_name;
                                $post_data['postowner_last_name'] = $postowner->last_name;
                                $post_data['postowner_profile_image'] = $postowner->image;
                                $post_data['postowner_country'] = $postowner->country;
                                $post_data['postowner_state'] = $postowner->state;
                                $post_data['postowner_city'] = $postowner->city;



                                $sql6 = "SELECT * from `user_review` where user_id = " . $PostData->user_id. " order by review_date limit 5";
                                $command6 = Yii::app()->db->createCommand($sql6);
                                $ratedata = $command6->queryAll();
                                $ratearray = array();
                                $avg = 0;
                                $total = 0;
                                $cnt = 0;
                                if (!empty($ratedata)) {
                                    $gaarray = array();
                                    foreach ($ratedata as $key6 => $value6) {
                                        $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                        if ($fromuser) {
                                            $temparray = array();
                                            $temparray['review_count'] = $value6['review_count'];
                                            $temparray['review'] = $value6['review'];
                                            $temparray['review_date'] = $value6['review_date'];

                                            $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }

                                            //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                            //  print_r($temparray);

                                            $temparray['user_id'] = $fromuser->id;
                                            $temparray['first_name'] = $fromuser->first_name;
                                            $temparray['last_name'] = $fromuser->last_name;
                                            $temparray['profile_image'] = $fromuser->image;
                                            $ratearray[] = $temparray;
                                            $total = $total + $value6['review_count'];
                                            $cnt++;
                                        }
                                        //$gaarray[] = $temparray;
                                    }
                                    $avg = $total / $cnt;
                                    //$response['data']['gallery'] = $gaarray;
                                }
                                $post_data['postowner_ratearray'] = $ratearray;
                                $post_data['postowner_avgrate'] = round($avg,2)."";
                                $post_data['postowner_totalrate'] = $cnt;

                                $post_data['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$PostData->post_id);
                        }

                        $response['data']['post_data'] = $post_data;
                        
                        $freelancer_bid_data = array();
                        $freelancer_bid_data['pay_by'] = $value['pay_by'];
                        $freelancer_bid_data['pay_by_text'] = $this->GetPayByText($value['pay_by']); 
                        $freelancer_bid_data['rate'] = $value['rate'];
                        $freelancer_bid_data['how_long'] = $value['how_long'];
                        $freelancer_bid_data['how_long_text'] = $this->GetHowLongText($value['how_long']);

                        if($value['is_offer']==1)
                        {
                          $freelancer_bid_data['bid_datetime'] = $value['response_datetime'];
                        }
                        else
                        {
                            $freelancer_bid_data['bid_datetime'] = $value['bid_datetime'];
                        }

                       $freelancer_bid_data['category_id'] = $value['category_id'];
                        $freelancer_bid_data['subcategory_id'] = $value['subcategory_id'];

                        $freelancer_bid_data['category_name'] = $this->GetCategoryName($value['category_id']);
                        $freelancer_bid_data['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);

                        $freelancer_bid_data['work_type'] = $value['work_type'];
                        $freelancer_bid_data['work_type_text'] = $this->GetWorkTypeText($value['work_type']). "";


                        $freelancer_bid_data['exp_level'] = $value['exp_level'];
                        $freelancer_bid_data['exp_level_text'] = $this->GetExpLevelText($value['exp_level']). "";

                        $freelancer_bid_data['commitment'] = $value['commitment'];
                        $freelancer_bid_data['commitment_text'] =  $this->GetCommitmentText($value['commitment'])."";

                        $freelancer_bid_data['description'] = $value['description'];


                        $freelancer_bid_data['attachments'] = ($value['attachments']!="" ? json_decode($value['attachments']) : [] );  
                        $freelancer_bid_data['skill'] = ($value['skill']!="" ? json_decode($value['skill']) : [] ); 


                        


                        $response['data']['freelancer_bid_data'] = $freelancer_bid_data;


                        $client_bid_data_response = array();



                        $client_bid_data_response['response_datetime'] = $value['response_datetime'];
                        $client_bid_data_response['response_time_diffrent'] =  $this->time_diffrent($value['response_datetime']);

                        $client_bid_data_response['selected_skill'] = ($value['selected_skill']!="" ? json_decode($value['selected_skill']) : [] );

                        $client_bid_data_response['preferred_datetime'] = $value['preferred_datetime'];
                        $client_bid_data_response['client_response_address'] = $value['address'];
                        $client_bid_data_response['latitude'] = $value['latitude'];
                        $client_bid_data_response['longtitude'] = $value['longtitude'];
                        $client_bid_data_response['notes'] = $value['notes'];
                         $client_bid_data_response['client_attachments'] = ($value['client_attachments']!="" ? json_decode($value['client_attachments']) : [] );
                        $client_bid_data_response['signature'] = $value['signature'];
                        $client_bid_data_response['is_agree'] = $value['is_agree'];


                        $response['data']['client_bid_data_response'] = $client_bid_data_response;



                        $bidderinfo = User::model()->find("id ='" . $value['bid_by'] . "'");


                    if ($bidderinfo) {
                        $biddertemparray = array();

                        $biddertemparray['user_id'] = $bidderinfo->id;
                        $biddertemparray['first_name'] = $bidderinfo->first_name;
                        $biddertemparray['last_name'] = $bidderinfo->last_name;
                        $biddertemparray['profile_image'] = $bidderinfo->image;
                        $biddertemparray['business_osnap_id'] = $bidderinfo->business_osnap_id;
                        $biddertemparray['business_category'] = $bidderinfo->business_category;
                        $biddertemparray['business_category_name'] = $this->GetBusinessCategoryName($bidderinfo->business_category);
                        $biddertemparray['city'] = $bidderinfo->city;
                        $biddertemparray['state'] = $bidderinfo->state;
                        $biddertemparray['country'] = $bidderinfo->country;
                        $biddertemparray['created_at'] = $bidderinfo->created_at;
                        $biddertemparray['created_at_diffrent'] = $this->time_diffrent($bidderinfo->created_at); 
                        if( (isset($apiData['data']['Dlatitude']) && !empty($apiData['data']['Dlatitude'])) &&  (isset($apiData['data']['Dlongtitude']) && !empty($apiData['data']['Dlongtitude'])) ){

                            $biddertemparray['distance'] = $this->distance($apiData['data']['Dlatitude'],$apiData['data']['Dlongtitude'],$bidderinfo->latitude,$bidderinfo->longtitude);
                        }
                        else
                        {
                            $biddertemparray['distance'] = "";
                        }
                        $biddertemparray['available'] = 1;
                        $sql6 = "SELECT * from `user_review` where user_id = " . $bidderinfo->id. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray1 = array();
                                    $temparray1['review_count'] = $value6['review_count'];
                                    $temparray1['review'] = $value6['review'];
                                    $temparray1['review_date'] = $value6['review_date'];

                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray1['job_title'] = $postbiddetail->job_title."";
                                    $temparray1['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray1['job_title'] = $postdetail->job_title."";
                                    }


                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray1['user_id'] = $fromuser->id;
                                    $temparray1['first_name'] = $fromuser->first_name;
                                    $temparray1['last_name'] = $fromuser->last_name;
                                    $temparray1['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray1;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $biddertemparray['ratearray'] = $ratearray;
                        $biddertemparray['avgrate'] = round($avg,2)."";
                        $biddertemparray['totalrate'] = $cnt;

                        $biddertemparray['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$apiData['data']['post_id']);



                    }
                    $response['data']['bidderinfo'] = $biddertemparray;




                       




                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }


     /**
     * @Method        : POST
     * @Params        : usertype,username,password
     * @author        : Vijay   
     * @created       : june 29 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Complete Job
     * */
    public function actionCompleteJob() {
        $res = array();
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['offer_id']) && empty($apiData['data']['offer_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passofferid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        /*if (!isset($apiData['data']['card_token']) && empty($apiData['data']['card_token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passcardtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }*/
        if (!isset($apiData['data']['total_amount']) && empty($apiData['data']['total_amount'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtotalamount", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['payment_type']) && empty($apiData['data']['payment_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpaymenttype", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }


         else {

            if($apiData['data']['payment_type']=="1")
            {
                if (!isset($apiData['data']['card_token']) && empty($apiData['data']['card_token'])) {
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("passcardtoken", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            }
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
                $checkData = PostBid::model()->find("pb_id ='" . $apiData['data']['offer_id'] . "'");
                if (!empty($checkData)) {
                    $pb_id = $apiData['data']['offer_id'];

                    $PostBidData = $this->loadModel($pb_id, 'PostBid');
                    $offer_by = $PostBidData->offer_by;
                    $bid_by = $PostBidData->bid_by;
                    $card_token = ($apiData['data']['card_token'] ? $apiData['data']['card_token'] : "");
                    $payment_receiver = User::model()->find("id ='".$bid_by."'");
                    if($apiData['data']['payment_type']=="1")
                    {
                        if($payment_receiver->stripe_user_id=="" && $payment_receiver->stripe_secret_id=="")
                        {
                            $response['status'] = "0";
                            $response['message'] = $this->GetNotification("notfounduserpaymentdetail", $lang);
                            header('Content-Type: application/json; charset=utf-8');
                            echo json_encode($response);
                            exit();
                        }
                    }
                                                      
                        try {
                                if($apiData['data']['payment_type']=="1")
                                {
                                    $developing  = "sk_test_tUe7byxtLFAZAfKm4JdRqSe9";
                                    \Stripe\Stripe::setApiKey($developing);
                                    $token =  $card_token;
                                    $total_amount = $apiData['data']['total_amount'] * 100;
                                    $charge = \Stripe\Charge::create(array(
                                     "amount" => $total_amount,
                                     "currency" => "usd",
                                     "source" => $token,
                                     "application_fee" => 123,
                                    ), array("stripe_account" => $payment_receiver->stripe_user_id));
                                }

                                if (isset($apiData['data']['review_count']) || isset($apiData['data']['review'])) {

                                    $review_data = array();

                                    $review_data['user_id'] = $bid_by;
                                    $review_data['review_by'] = $offer_by;
                                    $review_data['pb_id'] = $pb_id;
                                    $review_data['review_count'] = $apiData['data']['review_count'];
                                    $review_data['review'] = $apiData['data']['review'];

                                    $review_data['review_date'] = date('Y-m-d H:i:s');

                                    /*
                                    $reviewData = new UserReview();
                                    $reviewData->user_id = $bid_by;
                                    $reviewData->review_by = $offer_by;
                                    $reviewData->pb_id = $pb_id;
                                    $reviewData->review_count = $apiData['data']['review_count'];
                                    $reviewData->review = $apiData['data']['review'];

                                    $PostJobData->review_date = date('Y-m-d H:i:s');
                                    $PostJobData->status = 0;
                                    
                                    //$PostJobData->save(false);
                                    $PostJobData->save(false);*/

                                    $PostBidData->temp_review = json_encode($review_data);
                                    $PostBidData->review_by_client = "1";
                                }
                                 $PostBidData->payment_type = $apiData['data']['payment_type'];
                                 $PostBidData->payment_datetime = date('Y-m-d H:i:s');
                                 $PostBidData->total_amount = $apiData['data']['total_amount'];
                                 if(isset($apiData['data']['approved_hour']))
                                 {
                                    $PostBidData->approved_hour = $apiData['data']['approved_hour'];
                                 }
                                 
                                 
                                 if($apiData['data']['payment_type']=="1")
                                 {
                                    $PostBidData->payment_info = json_encode($charge);
                                    $PostBidData->status = 4;
                                    if($PostBidData->post_id!=0)
                                     {                                  
                                         $PostJobData = $this->loadModel($PostBidData->post_id, 'PostJob');
                                         $PostJobData->status = 4;
                                         $PostJobData->save(false);
                                     }
                                 }
                                 $user_id = $PostBidData->bid_by;
                                 $from_id = $PostBidData->offer_by;
                                 if($apiData['data']['payment_type']=="2" || $apiData['data']['payment_type']=="3"  )
                                 {
                                        $PostBidData->is_temp_payment = "1";
                                        $PostBidData->temp_payment_request_datetime = date('Y-m-d H:i:s');
                                        $PostBidData->payment_info = ($apiData['data']['payment_info'] ?  $apiData['data']['payment_info'] : "" );

                                        $touser = User::model()->find("id ='".$user_id."'");
                                        $fromuser = User::model()->find("id ='".$from_id."'");

                                        $bidData = PostBid::model()->find("pb_id ='".$apiData['data']['offer_id']."'");
                                        $postData = PostJob::model()->find("post_id ='".$bidData->post_id."'");

                                        $paymentTypeText = "";
                                        if($apiData['data']['payment_type']=="2")
                                        {
                                            $paymentTypeText = "cash";
                                        }
                                        if($apiData['data']['payment_type']=="3")
                                        {
                                            $paymentTypeText = "other(".$apiData['data']['payment_info'].")";
                                        }



                                        $fromusername = $fromuser->first_name . " " . $fromuser->last_name;
                                        $message = $fromusername .  ' ' . $this->GetNotification("temppayment", $lang).', "'.$postData->job_title.'" via '.$paymentTypeText.' Please approve this '.$paymentTypeText.' payment for payment process completion.';


                                        $activityFeed = new FeedAcivity();

                                        $activityFeed->user_id = $from_id;
                                        $activityFeed->feed_id = $PostBidData->post_id;
                                        $activityFeed->author_id = $user_id;
                                        $activityFeed->activity_detail_id = $PostBidData->pb_id; 
                                        $activityFeed->msg = $message;
                                        $activityFeed->status = 9; 
                                        $activityFeed->Is_read = "0";
                                        $activityFeed->created_at = date("Y-m-d H:i:s");
                                        $activityFeed->save(false);
                                        $actid = $activityFeed->activity_id;

                                        $PostBidData->notification_id = $actid;

                                        $deviceId = $touser->device_token;
                                        $deviceType = $touser->device_type;
                                        $screen = "9";
                                        $connection = Yii::app()->db;
                                        
                                        $updateBase = $this->loadModel($user_id, 'User');
                                        $updateBase->base = $updateBase->base + 1;
                                        $updateBase->save(false);
                                        
                                        
                                        $sql = "SELECT count(*) as unreadmsg FROM `feed_acivity` WHERE  author_id = '" . $user_id . "' and Is_read=0";
                                        
                                        $command = Yii::app()->db->createCommand($sql);
                                        $activityDatas = $command->queryAll();
                                        foreach ($activityDatas as $readcount) {
                                            $unreadmsg = $readcount['unreadmsg'];
                                        }
                                        
                                        $unreadmessages = $updateBase->attributes['base'];

                                        $find = User::model()->find("id = " .$user_id);
                                        $orderId = $PostBidData->pb_id;
                                        
                                        if (!empty($find) && $find->device_token!="") {

                                           FeedDetail::model()->sendNotification($deviceId, $deviceType, $message, $screen, $fromusername, $unreadmessages, $orderId);
                                        }
                                 }
                                

                                

                                

                                 if($apiData['data']['payment_type']=="1")
                                 {
                                         

                                        $touser = User::model()->find("id ='".$user_id."'");
                                        $fromuser = User::model()->find("id ='".$from_id."'");

                                        $bidData = PostBid::model()->find("pb_id ='".$apiData['data']['offer_id']."'");
                                        $postData = PostJob::model()->find("post_id ='".$bidData->post_id."'");



                                        $fromusername = $fromuser->first_name . " " . $fromuser->last_name;
                                        $message = $fromusername .  ' ' . $this->GetNotification("closecontract", $lang).' '.$postData->job_title;



                                        $activityFeed = new FeedAcivity();

                                        $activityFeed->user_id = $from_id;
                                        $activityFeed->feed_id = $PostBidData->post_id;
                                        $activityFeed->author_id = $user_id;
                                        $activityFeed->activity_detail_id = $PostBidData->pb_id; //EventToUser table id
                                        $activityFeed->msg = $message;
                                        $activityFeed->status = 5; //Event Accept
                                        $activityFeed->Is_read = "0";
                                        $activityFeed->created_at = date("Y-m-d H:i:s");
                                        $activityFeed->save(false);
                                        $actid = $activityFeed->activity_id;
                                        $deviceId = $touser->device_token;
                                        $deviceType = $touser->device_type;
                                        $screen = "5";
                                        $connection = Yii::app()->db;
                                        
                                        $updateBase = $this->loadModel($user_id, 'User');
                                        $updateBase->base = $updateBase->base + 1;
                                        $updateBase->save(false);
                                        
                                        
                                        $sql = "SELECT count(*) as unreadmsg FROM `feed_acivity` WHERE  author_id = '" . $user_id . "' and Is_read=0";
                                        
                                        $command = Yii::app()->db->createCommand($sql);
                                        $activityDatas = $command->queryAll();
                                        foreach ($activityDatas as $readcount) {
                                            $unreadmsg = $readcount['unreadmsg'];
                                        }
                                        
                                        $unreadmessages = $updateBase->attributes['base'];

                                        $find = User::model()->find("id = " .$user_id);
                                        $orderId = $PostBidData->pb_id;
                                         
                                        if (!empty($find) && $find->device_token!="") {

                                           FeedDetail::model()->sendNotification($deviceId, $deviceType, $message, $screen, $fromusername, $unreadmessages, $orderId);
                                        }
                                 }
                                if ($PostBidData->save(false)) {
                                    // Code - New Password updated and send password to mail
                                    $response['status'] = "1";
                                    $response['message'] = $this->GetNotification("completejob", $lang);                      
                                    $response['data'] = [];

                                    header('Content-Type: application/json; charset=utf-8');
                                    echo json_encode($response);
                                    exit();
                                } else {
                                    // Error Message for password update
                                    $response['status'] = "0";
                                    $response['message'] = $this->GetNotification("savedfail", $lang);
                                    header('Content-Type: application/json; charset=utf-8');
                                    echo json_encode($response);
                                    exit();
                                }
                            }
                            catch (Exception $e) 
                            {
                                // var_dump($e);
                                 //$e_json = $e->getJsonBody();
                                 $response['status'] = "0";
                                 $response['message'] = $this->GetNotification("failedtochargecard", $lang);
                                 $response['data'] = $e->getMessage();
                                 header('Content-Type: application/json; charset=utf-8');
                                 echo json_encode($response);
                                 exit();
                             }
                    

                } else {
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("recordnotfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }


     /**
     * @Method        : POST
     * @Params        : usertype,username,password
     * @author        : Vijay   
     * @created       : june 29 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Cancle Job
     * */
    public function actionCancelJob() {
        $res = array();
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['offer_id']) && empty($apiData['data']['offer_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passofferid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
         else {

            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
                $checkData = PostBid::model()->find("pb_id ='" . $apiData['data']['offer_id'] . "'");
                if (!empty($checkData)) {
                    $pb_id = $apiData['data']['offer_id'];

                    $PostBidData = $this->loadModel($pb_id, 'PostBid');
                    $offer_by = $PostBidData->offer_by;
                    $bid_by = $PostBidData->bid_by;
                    $card_token = $apiData['data']['card_token'];
                    $payment_receiver = User::model()->find("id ='".$bid_by."'");

                                 $PostBidData->status = 5;
                                 $PostBidData->cancel_datetime =  date("Y-m-d H:i:s");

                                 if($PostBidData->post_id!=0)
                                 {
                                 	$PostJobData = $this->loadModel($PostBidData->post_id, 'PostJob');
	                                 $PostJobData->status = 5;
	                                 $PostJobData->save(false);
                                 }
                                 




                                 $user_id = $PostBidData->bid_by;
                                 $from_id = $PostBidData->offer_by;

                                $touser = User::model()->find("id ='".$user_id."'");
                                $fromuser = User::model()->find("id ='".$from_id."'");


                                $bidData = PostBid::model()->find("pb_id ='".$apiData['data']['offer_id']."'");
                                $postData = PostJob::model()->find("post_id ='".$bidData->post_id."'");



                                $fromusername = $fromuser->first_name . " " . $fromuser->last_name;
                                $message = 'Contract "' .$postData->job_title.'" Cancel by '.$fromusername;



                                $activityFeed = new FeedAcivity();

                                $activityFeed->user_id = $from_id;
                                $activityFeed->feed_id = $PostBidData->post_id;
                                $activityFeed->author_id = $user_id;
                                $activityFeed->activity_detail_id = $PostBidData->pb_id; //EventToUser table id
                                $activityFeed->msg = $message;
                                $activityFeed->status = 7; //Event Accept
                                $activityFeed->Is_read = "0";
                                $activityFeed->created_at = date("Y-m-d H:i:s");
                                $activityFeed->save(false);
                                $actid = $activityFeed->activity_id;
                                $deviceId = $touser->device_token;
                                $deviceType = $touser->device_type;
                                $screen = "7";
                                $connection = Yii::app()->db;
                                
                                $updateBase = $this->loadModel($user_id, 'User');
                                $updateBase->base = $updateBase->base + 1;
                                $updateBase->save(false);
                                
                                
                                $sql = "SELECT count(*) as unreadmsg FROM `feed_acivity` WHERE  author_id = '" . $user_id . "' and Is_read=0";
                                
                                $command = Yii::app()->db->createCommand($sql);
                                $activityDatas = $command->queryAll();
                                foreach ($activityDatas as $readcount) {
                                    $unreadmsg = $readcount['unreadmsg'];
                                }
                                
                                $unreadmessages = $updateBase->attributes['base'];

                                $find = User::model()->find("id = " .$user_id);
                                $orderId = $PostBidData->pb_id;
                                 
                                if (!empty($find) && $find->device_token!="") {

                                   FeedDetail::model()->sendNotification($deviceId, $deviceType, $message, $screen, $fromusername, $unreadmessages, $orderId);
                                }

                                if ($PostBidData->save(false)) {
                                    // Code - New Password updated and send password to mail
                                    $response['status'] = "1";
                                    $response['message'] = $this->GetNotification("canceljob", $lang);                      
                                    $response['data'] = [];

                                    header('Content-Type: application/json; charset=utf-8');
                                    echo json_encode($response);
                                    exit();
                                } else {
                                    // Error Message for password update
                                    $response['status'] = "0";
                                    $response['message'] = $this->GetNotification("savedfail", $lang);
                                    header('Content-Type: application/json; charset=utf-8');
                                    echo json_encode($response);
                                    exit();
                                }


                           
         
                    
                } else {
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("recordnotfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }


    /**
     * @Method        : POST
     * @Params        : usertype,username,password
     * @author        : Vijay   
     * @created       : Oct 08 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Notification Response
     * */
    public function actionNotificationResponse() {
        $res = array();
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['pb_id']) && empty($apiData['data']['pb_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpbid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        /*if (!isset($apiData['data']['card_token']) && empty($apiData['data']['card_token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passcardtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }*/
       
        if (!isset($apiData['data']['response_status']) && empty($apiData['data']['response_status'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passresponsestatus", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }


         else {

           
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
                $checkData = PostBid::model()->find("pb_id ='" . $apiData['data']['pb_id'] . "'");
                if (!empty($checkData)) {

                    $response_status = $apiData['data']['response_status'];
                    if($response_status=="1")
                    {
                        // remove notification
                        $notification_id = $checkData->notification_id;
                        $deleteNotificationData = FeedAcivity::model()->deleteAll("activity_id = '" . $notification_id . "'");


                        // send payment request
                           $PostBid_info = PostBid::model()->find("pb_id ='".$apiData['data']['pb_id']."'");
                           $post_id = $PostBid_info->post_id;
                           $sender = $PostBid_info->bid_by;
                           $receiver = $PostBid_info->offer_by;
                           $fromuser = User::model()->find("id ='".$sender."'");
                           $touser = User::model()->find("id ='".$receiver."'");
                           $message = "";
                           if($post_id==0)
                           {
                                $message = "You got payment request from " .$fromuser->username." for ".$PostBid_info->job_title. " job";
                           }
                           else
                           {
                                $PostData = PostJob::model()->find("post_id ='".$post_id."'");
                                $message = "You got payment request from " .$fromuser->username." for ".$PostData->job_title. " job";
                           }
                           if($touser->email!="")
                           {
                                 $email = $touser->email;
                                 //$email = "dharmeshmakrubiya@gmail.com";
                                 $username = $touser->username;
                                 User::PaymentRequestMail($email, $username, $message);
                           }    
                          
                           $PaymentRequest = PaymentRequest::model()->find("pb_id ='".$apiData['data']['pb_id']."' and status=0");
                            if($PaymentRequest)
                            {
                                $updateStatus = $this->loadModel($PaymentRequest->pr_id, 'PaymentRequest');
                                $updateStatus->status = $updateBase->status + 1;
                                $updateStatus->save(false);
                            }
                            
                                $PaymentRequestData = new PaymentRequest();
                               $PaymentRequestData->from_id = $fromuser->id;
                               $PaymentRequestData->to_id = $touser->id;
                               $PaymentRequestData->pb_id = $apiData['data']['pb_id'];
                               $PaymentRequestData->request_datetime = date("Y-m-d H:i:s");
                               $PaymentRequestData->save(false);
                            
                           


                           $user_id = $touser->id;
                           $from_id = $fromuser->id;
                            $activityFeed = new FeedAcivity();



                            $activityFeed->user_id = $from_id;
                            $activityFeed->feed_id = $PostBid_info->post_id;
                            $activityFeed->author_id = $user_id;
                            $activityFeed->activity_detail_id = $PostBid_info->pb_id; //EventToUser table id
                            $activityFeed->msg = $message;
                            $activityFeed->status = 6; //Event Accept
                            $activityFeed->Is_read = "0";
                            $activityFeed->created_at = date("Y-m-d H:i:s");
                            $activityFeed->save(false);
                            $actid = $activityFeed->activity_id;
                            $deviceId = $touser->device_token;
                            $deviceType = $touser->device_type;
                            $screen = "6";
                            $connection = Yii::app()->db;
                            
                            $updateBase = $this->loadModel($user_id, 'User');
                            $updateBase->base = $updateBase->base + 1;
                            $updateBase->save(false);
                            
                            
                            $sql = "SELECT count(*) as unreadmsg FROM `feed_acivity` WHERE  author_id = '" . $user_id . "' and Is_read=0";
                            
                            $command = Yii::app()->db->createCommand($sql);
                            $activityDatas = $command->queryAll();
                            foreach ($activityDatas as $readcount) {
                                $unreadmsg = $readcount['unreadmsg'];
                            }
                            
                            $unreadmessages = $updateBase->attributes['base'];

                            $find = User::model()->find("id = " .$user_id);
                            $orderId = $PostBid_info->pb_id;
                            
                            if (!empty($find) && $find->device_token!="") {


                               FeedDetail::model()->sendNotification($deviceId, $deviceType, $message, $screen, $fromusername, $unreadmessages, $orderId);
                            }

                            $updatePostBid = $this->loadModel($PostBid_info->pb_id, 'PostBid');
                            $updatePostBid->payment_request = 1;
                            $updatePostBid->notification_id = '';

                        // remove review
                            $updatePostBid->temp_review = '';

                            $updatePostBid->payment_request_datetime = date("Y-m-d H:i:s");
                            $updatePostBid->save(false);
                    }
                    if($response_status=="2")
                    {
                        // remove notification
                        $notification_id = $checkData->notification_id;
                        $deleteNotificationData = FeedAcivity::model()->deleteAll("activity_id = '" . $notification_id . "'");

                        //job Completed
                        $updatePostBid = $this->loadModel($checkData->pb_id, 'PostBid');
                        $updatePostBid->status = 4;
                        $updatePostBid->notification_id = '';
                        $updatePostBid->save(false);

                        if( $checkData->post_id!=0)
                         {                                  
                             $PostJobData = $this->loadModel($checkData->post_id, 'PostJob');
                             $PostJobData->status = 4;
                             $PostJobData->save(false);
                         }


                    }
                    $notiMsgKey = "";
                    if($response_status=="1") // cancle
                    {
                        $notiMsgKey = "canclemsg";
                    }
                    if($response_status=="2") // approve
                    {
                        $notiMsgKey = "approvemsg";
                    }

                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification($notiMsgKey, $lang);                      
                    $response['data'] = [];

                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                    
                                                      
                    

                } else {
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("recordnotfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }



     /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : March 29 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : My Event.
     * */
    public function actionSingleDirectOfferDetail() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['pb_id']) && empty($apiData['data']['pb_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpbid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
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
                $connection = Yii::app()->db;


                //$temp = " ";
                // End Pagination
                //$miles = $apiData['data']['miles'];


                $connection = Yii::app()->db;

                $select = " a.* ";
                $table = "post_bid as a";
                //$where = " a.status=1 ";
                //$table  .= " JOIN post_bid as b ON a.post_id = b.post_id ";
                //$where .= (!empty($where) ? " AND " : ""). " a.offer_by=0 or a.offer_by = ".$apiData['data']['id'];
                $where .= (!empty($where) ? " AND " : ""). " pb_id=".$apiData['data']['pb_id'] ;
                //$having = " having distance <=". $miles;
                // $orderBy = " ORDER BY a.article_id desc ";
                $orderBy = "";
                // $groupBy = " GROUP BY a.article_id ";
                $groupBy = "";
                $having = "";

              

                $sql = "SELECT " . $select . " from " . $table . " where " . $where . $groupBy . $having . (!empty($orderBy) ? ' ORDER BY '. $orderBy : '')  . $temp;


               // echo $sql = "SELECT " . $select . " from " . $table . " where " . $where . $having . $groupBy . $orderBy . $temp;

                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;

                $postq = " select * from post_job where status=2 and user_id=".$apiData['data']['id'];
                $commandq = Yii::app()->db->createCommand($postq);
                $postqlist = $commandq->queryAll();
                $postarray = array();
                if (!empty($postqlist)) {
                    foreach ($postqlist as $qkey => $qvalue) {
                        $postarray[] = $qvalue['post_id'];
                    }
                }


                $command = Yii::app()->db->createCommand($sql);
                $myofferlist = $command->queryAll();
                if (!empty($myofferlist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("eventlist", $lang);
                    foreach ($myofferlist as $key => $value) {

                       
                        //$response['data']['preferred_datetime'] = $value['preferred_datetime'];                        
                        $response['data'][$key]['pb_id'] = $value['pb_id'] . "";
                        $response['data'][$key]['is_offer'] = $value['is_offer'] . "";
                        $response['data'][$key]['status'] = $value['status'] . "";
                        $post_data = array();
                        if($value['is_offer']==1)
                        {
                                
                                $post_data['job_title'] = $value['job_title'] . "";
                                $post_data['job_description'] = $value['job_description'] . "";

                                $post_data['category_id'] = $value['category_id']. "";
                                $post_data['subcategory_id'] = $value['subcategory_id']. "";

                                $post_data['category_name'] = $this->GetCategoryName($value['category_id']);
                                $post_data['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);


                                $post_data['work_type'] = $value['work_type'] ."";
                                $post_data['work_type_text'] = $this->GetWorkTypeText($value['work_type']). "";

                                $post_data['pay_by'] = $value['pay_by'] . "";
                                $post_data['pay_by_text'] = $this->GetPayByText($value['pay_by']). "";

                                $post_data['how_long'] = $value['how_long'] . "";
                                $post_data['how_long_text'] = $this->GetHowLongText($value['how_long']). "";

                                $post_data['rate'] = $value['rate'] . "";
                                $post_data['exp_level'] = $value['exp_level'] . "";
                                $post_data['exp_level_text'] = $this->GetExpLevelText($value['exp_level']). "";

                                $post_data['post_datetime'] = $value['bid_datetime'];
                                $post_data['time_diffrent'] = $this->time_diffrent($value['bid_datetime']);

                                $post_data['bid_datetime'] = $value['bid_datetime'];

                                




                                $postowner = User::model()->find("id ='".$value['offer_by']."'");
                                            //  print_r($temparray);


                                $post_data['user_id'] = $postowner->id;
                                $post_data['first_name'] = $postowner->first_name;
                                $post_data['last_name'] = $postowner->last_name;
                                $post_data['profile_image'] = $postowner->image;
                                $post_data['country'] = $postowner->country;
                                $post_data['state'] = $postowner->state;
                                $post_data['city'] = $postowner->city;


                                $sql6 = "SELECT * from `user_review` where user_id = " . $value['offer_by']. " order by review_date limit 5";
                                $command6 = Yii::app()->db->createCommand($sql6);
                                $ratedata = $command6->queryAll();
                                $ratearray = array();
                                $avg = 0;
                                $total = 0;
                                $cnt = 0;
                                if (!empty($ratedata)) {
                                    $gaarray = array();
                                    foreach ($ratedata as $key6 => $value6) {
                                        $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                        if ($fromuser) {
                                            $temparray = array();
                                            $temparray['review_count'] = $value6['review_count'];
                                            $temparray['review'] = $value6['review'];
                                            $temparray['review_date'] = $value6['review_date'];


                                            $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }


                                            //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                            //  print_r($temparray);

                                            $temparray['user_id'] = $fromuser->id;
                                            $temparray['first_name'] = $fromuser->first_name;
                                            $temparray['last_name'] = $fromuser->last_name;
                                            $temparray['profile_image'] = $fromuser->image;
                                            $ratearray[] = $temparray;
                                            $total = $total + $value6['review_count'];
                                            $cnt++;
                                        }
                                        //$gaarray[] = $temparray;
                                    }
                                    $avg = $total / $cnt;
                                    //$response['data']['gallery'] = $gaarray;
                                }
                                $post_data['ratearray'] = $ratearray;
                                $post_data['avgrate'] = round($avg,2)."";
                                $post_data['totalrate'] = $cnt;
                                $post_data['commitment'] = $value['commitment'];
                                $post_data['commitment_text'] = $this->GetCommitmentText($value['commitment']);
                                
                        }
                        else
                        {
                                $PostData = PostJob::model()->find("post_id ='".$value['post_id']."'");
                                //$POSTowner = User::model()->find("id ='".$value['offer_by']."'");

                                $post_data['post_id'] = $PostData->post_id . "";
                                $post_data['job_title'] = $PostData->job_title. "";
                                $post_data['job_description'] = $PostData->job_description. "";
                                $post_data['category_id'] = $PostData->category_id. "";
                                $post_data['subcategory_id'] = $PostData->subcategory_id. "";

                                $post_data['category_name'] = $this->GetCategoryName($PostData->category_id);
                                $post_data['subcategory_name'] = $this->GetSubCategoryName($PostData->subcategory_id);


                                $post_data['work_type'] = $PostData->work_type ."";
                                $post_data['work_type_text'] = $this->GetWorkTypeText($PostData->work_type). "";

                                $post_data['pay_by'] = $PostData->pay_by . "";
                                $post_data['pay_by_text'] = $this->GetPayByText($PostData->pay_by). "";

                                $post_data['rate'] = $PostData->rate . "";
                                $post_data['exp_level'] = $PostData->exp_level . "";
                                $post_data['exp_level_text'] = $this->GetExpLevelText($PostData->exp_level). "";

                                $post_data['post_datetime'] = $PostData->post_datetime;
                                $post_data['bid_datetime'] = $PostData->post_datetime;
                                $post_data['time_diffrent'] = $this->time_diffrent($PostData->post_datetime);
                                $post_data['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$PostData->post_id);
                                 $post_data['is_bid'] =  $this->CheckBid($PostData->post_id,$apiData['data']['id']);


                                $connection = Yii::app()->db;
                                $total_offers = 0;
                                $total_offers_sql = "select * from post_bid where post_id=".$PostData->post_id." and offer_status=0 and is_offer=0";
                                $tocommand = Yii::app()->db->createCommand($total_offers_sql);
                                $total_offerslist = $tocommand->queryAll();
                                if($total_offerslist)
                                {
                                        foreach ($total_offerslist as $key1 => $value1) { $total_offers++; }
                                }
                                

                                $post_data['total_offers'] = $total_offers;

                                $post_data['how_long'] = $PostData->how_long . "";
                                $post_data['how_long_text'] = $this->GetHowLongText($PostData->how_long). "";

                                $post_data['commitment'] = $PostData->commitment . "";
                                $post_data['commitment_text'] = $this->GetCommitmentText($PostData->commitment). "";


                                $post_data['attachments'] =   ($PostData->attachments!="" ? json_decode($PostData->attachments) : [] );

                                $postowner = User::model()->find("id ='".$PostData->user_id."'");
                                            //  print_r($temparray);


                                $post_data['postowner_user_id'] = $postowner->id;
                                $post_data['postowner_first_name'] = $postowner->first_name;
                                $post_data['postowner_last_name'] = $postowner->last_name;
                                $post_data['postowner_profile_image'] = $postowner->image;
                                $post_data['postowner_country'] = $postowner->country;
                                $post_data['postowner_state'] = $postowner->state;
                                $post_data['postowner_city'] = $postowner->city;



                                $sql6 = "SELECT * from `user_review` where user_id = " . $PostData->user_id. " order by review_date limit 5";
                                $command6 = Yii::app()->db->createCommand($sql6);
                                $ratedata = $command6->queryAll();
                                $ratearray = array();
                                $avg = 0;
                                $total = 0;
                                $cnt = 0;
                                if (!empty($ratedata)) {
                                    $gaarray = array();
                                    foreach ($ratedata as $key6 => $value6) {
                                        $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                        if ($fromuser) {
                                            $temparray = array();
                                            $temparray['review_count'] = $value6['review_count'];
                                            $temparray['review'] = $value6['review'];
                                            $temparray['review_date'] = $value6['review_date'];

                                            $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }


                                            //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                            //  print_r($temparray);

                                            $temparray['user_id'] = $fromuser->id;
                                            $temparray['first_name'] = $fromuser->first_name;
                                            $temparray['last_name'] = $fromuser->last_name;
                                            $temparray['profile_image'] = $fromuser->image;
                                            $ratearray[] = $temparray;
                                            $total = $total + $value6['review_count'];
                                            $cnt++;
                                        }
                                        //$gaarray[] = $temparray;
                                    }
                                    $avg = $total / $cnt;
                                    //$response['data']['gallery'] = $gaarray;
                                }
                                $post_data['postowner_ratearray'] = $ratearray;
                                $post_data['postowner_avgrate'] = round($avg,2)."";
                                $post_data['postowner_totalrate'] = $cnt;

                                $post_data['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$PostData->post_id);
                        }

                      //  $response['data']['post_data'] = $post_data;
                        
                        $freelancer_bid_data = array();
                        $freelancer_bid_data['pay_by'] = $value['pay_by'];
                        $freelancer_bid_data['pay_by_text'] = $this->GetPayByText($value['pay_by']); 
                        $freelancer_bid_data['rate'] = $value['rate'];
                        $freelancer_bid_data['how_long'] = $value['how_long'];
                        $freelancer_bid_data['how_long_text'] = $this->GetHowLongText($value['how_long']);

                        if($value['is_offer']==1)
                        {
                          $freelancer_bid_data['bid_datetime'] = $value['response_datetime'];
                        }
                        else
                        {
                            $freelancer_bid_data['bid_datetime'] = $value['bid_datetime'];
                        }

                       $freelancer_bid_data['category_id'] = $value['category_id'];
                        $freelancer_bid_data['subcategory_id'] = $value['subcategory_id'];

                        $freelancer_bid_data['category_name'] = $this->GetCategoryName($value['category_id']);
                        $freelancer_bid_data['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);

                        $freelancer_bid_data['work_type'] = $value['work_type'];
                        $freelancer_bid_data['work_type_text'] = $this->GetWorkTypeText($value['work_type']). "";


                        $freelancer_bid_data['exp_level'] = $value['exp_level'];
                        $freelancer_bid_data['exp_level_text'] = $this->GetExpLevelText($value['exp_level']). "";

                        $freelancer_bid_data['commitment'] = $value['commitment'];
                        $freelancer_bid_data['commitment_text'] =  $this->GetCommitmentText($value['commitment'])."";

                        $freelancer_bid_data['description'] = $value['description'];


                        $freelancer_bid_data['attachments'] = ($value['attachments']!="" ? json_decode($value['attachments']) : [] );  
                        $freelancer_bid_data['skill'] = ($value['skill']!="" ? json_decode($value['skill']) : [] ); 


                        


                        $response['data'][$key]['freelancer_bid_data'] = $freelancer_bid_data;


                        $client_bid_data_response = array();



                        $client_bid_data_response['response_datetime'] = $value['response_datetime'];
                        $client_bid_data_response['response_time_diffrent'] =  $this->time_diffrent($value['response_datetime']);

                        $client_bid_data_response['selected_skill'] = ($value['selected_skill']!="" ? json_decode($value['selected_skill']) : [] );

                        $client_bid_data_response['preferred_datetime'] = $value['preferred_datetime'];
                        $client_bid_data_response['client_response_address'] = $value['address'];
                        $client_bid_data_response['latitude'] = $value['latitude'];
                        $client_bid_data_response['longtitude'] = $value['longtitude'];
                        $client_bid_data_response['notes'] = $value['notes'];
                         $client_bid_data_response['client_attachments'] = ($value['client_attachments']!="" ? json_decode($value['client_attachments']) : [] );
                        $client_bid_data_response['signature'] = $value['signature'];
                        $client_bid_data_response['is_agree'] = $value['is_agree'];


                        //$response['data']['client_bid_data_response'] = $client_bid_data_response;



                        $bidderinfo = User::model()->find("id ='" . $value['bid_by'] . "'");


                    if ($bidderinfo) {
                        $biddertemparray = array();

                        $biddertemparray['user_id'] = $bidderinfo->id;
                        $biddertemparray['first_name'] = $bidderinfo->first_name;
                        $biddertemparray['last_name'] = $bidderinfo->last_name;
                        $biddertemparray['profile_image'] = $bidderinfo->image;
                        $biddertemparray['business_osnap_id'] = $bidderinfo->business_osnap_id;
                        $biddertemparray['business_category'] = $bidderinfo->business_category;
                        $biddertemparray['business_category_name'] = $this->GetBusinessCategoryName($bidderinfo->business_category);
                        $biddertemparray['city'] = $bidderinfo->city;
                        $biddertemparray['state'] = $bidderinfo->state;
                        $biddertemparray['country'] = $bidderinfo->country;
                        $biddertemparray['created_at'] = $bidderinfo->created_at;
                        $biddertemparray['created_at_diffrent'] = $this->time_diffrent($bidderinfo->created_at); 
                        if( (isset($apiData['data']['Dlatitude']) && !empty($apiData['data']['Dlatitude'])) &&  (isset($apiData['data']['Dlongtitude']) && !empty($apiData['data']['Dlongtitude'])) ){

                            $biddertemparray['distance'] = $this->distance($apiData['data']['Dlatitude'],$apiData['data']['Dlongtitude'],$bidderinfo->latitude,$bidderinfo->longtitude);
                        }
                        else
                        {
                            $biddertemparray['distance'] = "";
                        }
                        $biddertemparray['available'] = 1;
                        $sql6 = "SELECT * from `user_review` where user_id = " . $bidderinfo->id. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray1 = array();
                                    $temparray1['review_count'] = $value6['review_count'];
                                    $temparray1['review'] = $value6['review'];
                                    $temparray1['review_date'] = $value6['review_date'];

                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray1['job_title'] = $postbiddetail->job_title."";
                                    $temparray1['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray1['job_title'] = $postdetail->job_title."";
                                    }


                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray1['user_id'] = $fromuser->id;
                                    $temparray1['first_name'] = $fromuser->first_name;
                                    $temparray1['last_name'] = $fromuser->last_name;
                                    $temparray1['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray1;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $biddertemparray['ratearray'] = $ratearray;
                        $biddertemparray['avgrate'] = round($avg,2)."";
                        $biddertemparray['totalrate'] = $cnt;

                        $biddertemparray['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$apiData['data']['post_id']);



                    }
                    $response['data'][$key]['bidderinfo'] = $biddertemparray;




                       




                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }


    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : July 10 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Payment Request.
     * */
    public function actionPaymentRequest() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) || empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) || empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['pb_id']) || empty($apiData['data']['pb_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpbid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {

            	   $PostBid_info = PostBid::model()->find("pb_id ='".$apiData['data']['pb_id']."'");
            	   $post_id = $PostBid_info->post_id;
            	   $sender = $PostBid_info->bid_by;
            	   $receiver = $PostBid_info->offer_by;
            	   $fromuser = User::model()->find("id ='".$sender."'");
				   $touser = User::model()->find("id ='".$receiver."'");
            	   $message = "";
            	   if($post_id==0)
            	   {
            	   		$message = "You got payment request from " .$fromuser->username." for ".$PostBid_info->job_title. " job";
            	   }
            	   else
            	   {
            	   		$PostData = PostJob::model()->find("post_id ='".$post_id."'");
            	   		$message = "You got payment request from " .$fromuser->username." for ".$PostData->job_title. " job";
            	   }
            	   if($touser->email!="")
            	   {
            	   		 $email = $touser->email;
            	  	     //$email = "dharmeshmakrubiya@gmail.com";
            	  	     $username = $touser->username;
            	   		 User::PaymentRequestMail($email, $username, $message);
            	   }	
            	  
            	   $PaymentRequest = PaymentRequest::model()->find("pb_id ='".$apiData['data']['pb_id']."' and status=0");
                    if($PaymentRequest)
                    {
                    	$updateStatus = $this->loadModel($PaymentRequest->pr_id, 'PaymentRequest');
	                    $updateStatus->status = $updateBase->status + 1;
	                    $updateStatus->save(false);
                    }
                    
                    	$PaymentRequestData = new PaymentRequest();
					   $PaymentRequestData->from_id = $fromuser->id;
					   $PaymentRequestData->to_id = $touser->id;
					   $PaymentRequestData->pb_id = $apiData['data']['pb_id'];
					   $PaymentRequestData->request_datetime = date("Y-m-d H:i:s");
					   $PaymentRequestData->save(false);
                    
            	   


            	   $user_id = $touser->id;
            	   $from_id = $fromuser->id;
                    $activityFeed = new FeedAcivity();



                    $activityFeed->user_id = $from_id;
                    $activityFeed->feed_id = $PostBid_info->post_id;
                    $activityFeed->author_id = $user_id;
                    $activityFeed->activity_detail_id = $PostBid_info->pb_id; //EventToUser table id
                    $activityFeed->msg = $message;
                    $activityFeed->status = 6; //Event Accept
                    $activityFeed->Is_read = "0";
                    $activityFeed->created_at = date("Y-m-d H:i:s");
                    $activityFeed->save(false);
                    $actid = $activityFeed->activity_id;
                    $deviceId = $touser->device_token;
                    $deviceType = $touser->device_type;
                    $screen = "6";
                    $connection = Yii::app()->db;
                    
                    $updateBase = $this->loadModel($user_id, 'User');
                    $updateBase->base = $updateBase->base + 1;
                    $updateBase->save(false);
                    
                    
                    $sql = "SELECT count(*) as unreadmsg FROM `feed_acivity` WHERE  author_id = '" . $user_id . "' and Is_read=0";
                    
                    $command = Yii::app()->db->createCommand($sql);
                    $activityDatas = $command->queryAll();
                    foreach ($activityDatas as $readcount) {
                        $unreadmsg = $readcount['unreadmsg'];
                    }
                    
                    $unreadmessages = $updateBase->attributes['base'];

                    $find = User::model()->find("id = " .$user_id);
                    $orderId = $PostBid_info->pb_id;
                    
                    if (!empty($find) && $find->device_token!="") {


                       FeedDetail::model()->sendNotification($deviceId, $deviceType, $message, $screen, $fromusername, $unreadmessages, $orderId);
                    }

                    $updatePostBid = $this->loadModel($PostBid_info->pb_id, 'PostBid');
                    $updatePostBid->payment_request = 1;
                    $updatePostBid->payment_request_datetime = date("Y-m-d H:i:s");
                    $updatePostBid->save(false);


                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("successpr",$lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                 /*   }
                    else
                    {
                        $response['status'] = "0";
                        $response['message'] = $this->GetNotification("alrdygivenreview",$lang);
                        header('Content-Type: application/json; charset=utf-8');
                        echo json_encode($response);
                        exit();
                    }*/
                    
               
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    public function actionTestNoti()
    {

            $touser = User::model()->find("id ='2'");
            $fromuser = User::model()->find("id ='3'");


            $fromusername = $fromuser->first_name . " " . $fromuser->last_name;
            $message = $fromusername . " test notification" ;


            $activityFeed = new FeedAcivity();

            $activityFeed->user_id = "3";
            $activityFeed->feed_id = "1";
            $activityFeed->author_id = "2";
            $activityFeed->activity_detail_id = "1"; //EventToUser table id
            $activityFeed->msg = $message;
            $activityFeed->status = 1; //Event Accept
            $activityFeed->Is_read = "0";
            $activityFeed->created_at = date("Y-m-d H:i:s");
            $activityFeed->save(false);
            $actid = $activityFeed->activity_id;
            $deviceId = $touser->device_token;
            $deviceType = $touser->device_type;
            $screen = "1";
            $connection = Yii::app()->db;
            
            $updateBase = $this->loadModel("2", 'User');
            $updateBase->base = $updateBase->base + 1;
            $updateBase->save(false);
            
            
            $sql = "SELECT count(*) as unreadmsg FROM `feed_acivity` WHERE  author_id = '" . "2" . "' and Is_read=0";
            
            $command = Yii::app()->db->createCommand($sql);
            $activityDatas = $command->queryAll();
            foreach ($activityDatas as $readcount) {
                $unreadmsg = $readcount['unreadmsg'];
            }
            
            $unreadmessages = $updateBase->attributes['base'];

            $find = User::model()->find("id = " . "2");
            $orderId = "2";
            
            if ($find) {


              //  FeedDetail::model()->sendNotification($deviceId, $deviceType, $message, $screen, $fromusername, $unreadmessages, $orderId);
            }

    }

    public function actionStripeSuccess() {
      print_r($_REQUEST);
        if( (isset($_REQUEST['code']) && !empty($_REQUEST['code'])) && (isset($_REQUEST['state']) && !empty($_REQUEST['state'])) )
        {
             $code = $_REQUEST['code'];
             $user_id = $_REQUEST['state'];
             $developing  = "sk_test_tUe7byxtLFAZAfKm4JdRqSe9";

             $token_request_body = array(
              'client_secret' => $developing ,
              'grant_type' => 'authorization_code',
              'code' => $code,
            );
            $req = curl_init('https://connect.stripe.com/oauth/token');
            curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($req, CURLOPT_POST, true );
            curl_setopt($req, CURLOPT_POSTFIELDS, http_build_query($token_request_body));
            // TODO: Additional error handling
            $respCode = curl_getinfo($req, CURLINFO_HTTP_CODE);
            $resp = json_decode(curl_exec($req), true);
           // var_dump($resp);
          //  echo "<pre>";
           // print_r($resp);
            if(!empty($resp))
            {
                $stripe_user_id = $resp['stripe_user_id'];       
                $access_token = $resp['access_token'];                
                $updateUser = $this->loadModel($user_id, 'User');
                $updateUser->stripe_user_id = $stripe_user_id;
                $updateUser->stripe_secret_id = $access_token;
                if ($updateUser->save(false)) {
                    
                }
            }

        }
        
    }


    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : July 10 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Get Review.
     * */
    public function actionGetReview() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) || empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) || empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['user_id']) || empty($apiData['data']['user_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {


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

                    $rating_data = array();

                    $sql6 = "SELECT * from `user_review` where user_id = " . $apiData['data']['user_id']. " order by review_date ".$temp;
                    $command6 = Yii::app()->db->createCommand($sql6);
                    $ratedata = $command6->queryAll();
                    $ratearray = array();
                    $avg = 0;
                    $total = 0;
                    $cnt = 0;
                    if (!empty($ratedata)) {
                        $gaarray = array();
                        foreach ($ratedata as $key6 => $value6) {
                            $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                            if ($fromuser) {
                                $temparray = array();
                                $temparray['review_count'] = $value6['review_count'];
                                $temparray['review'] = $value6['review'];
                                $temparray['review_date'] = $value6['review_date'];

                                $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }


                                //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                //  print_r($temparray);

                                $temparray['user_id'] = $fromuser->id;
                                $temparray['first_name'] = $fromuser->first_name;
                                $temparray['last_name'] = $fromuser->last_name;
                                $temparray['profile_image'] = $fromuser->image;
                                $ratearray[] = $temparray;
                                $total = $total + $value6['review_count'];
                                $cnt++;
                            }
                            //$gaarray[] = $temparray;
                        }
                        $avg = $total / $cnt;
                        //$response['data']['gallery'] = $gaarray;
                    }
                    $rating_data['ratearray'] = $ratearray;
                    $rating_data['avgrate'] = round($avg,2)."";
                    $rating_data['totalrate'] = $cnt;


                 


                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("successlist",$lang);
                    $response['data'] = $rating_data;
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
               
                    
               
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : Oct 22 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Add Promotion
     * */

    public function actionAddPromotion() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) || empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) || empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) || empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }

        if (!isset($apiData['data']['promotion_title']) || empty($apiData['data']['promotion_title'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpromotiontitle", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['promotion_description']) || empty($apiData['data']['promotion_description'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpromotiondescription", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['rate']) || empty($apiData['data']['rate'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passrate", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['category_id']) || empty($apiData['data']['category_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passcate", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['subcategory_id']) || empty($apiData['data']['subcategory_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passsubcate", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['work_type']) || empty($apiData['data']['work_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passworktype", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['pay_by']) || empty($apiData['data']['pay_by'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpayby", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['day']) || empty($apiData['data']['day'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passday", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        else {

            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {

                


                $PromotionData = new Promotion();
                $PromotionData->user_id = $apiData['data']['id'];
                $PromotionData->promotion_title = $apiData['data']['promotion_title'];
                $PromotionData->promotion_description = $apiData['data']['promotion_description'];
                $PromotionData->category_id = $apiData['data']['category_id'];
                $PromotionData->subcategory_id = $apiData['data']['subcategory_id'];
                $PromotionData->rate = $apiData['data']['rate'];
                $PromotionData->work_type = $apiData['data']['work_type'];
                $PromotionData->pay_by = $apiData['data']['pay_by'];
                
                $current_date = date('Y-m-d H:i:s');
                $today_datetime = $current_date;
                $current_date = strtotime($current_date);
                $day = $apiData['data']['day'];
                
                $expire_date = strtotime("+".$day." day", $current_date);
                $expire_date = date('Y-m-d H:i:s', $expire_date);


                $PromotionData->promotion_datetime = $today_datetime;
                $PromotionData->promotion_expiredatetime = $expire_date;
                
                //$PostJobData->save(false);
                if ($PromotionData->save(false)) {



                 
                $connection = Yii::app()->db;
                $select = "a.*";
                $table = "user as a";
                $where = " a.is_active=1 and a.user_type=1 and a.is_agree = 1 and a.expiration_datetime >= NOW() ";                
                $having  = "";
                $connection = Yii::app()->db;                
                $user_info = User::model()->find("id ='".$apiData['data']['id']."'");
                $latitude = $user_info->latitude;
                $longtitude = $user_info->longtitude;                
                $miles = "50";
                $select .=  (!empty($select) ? " , " : "")." ((ACOS(SIN(".$latitude."* PI() / 180) * SIN(a.latitude * PI() / 180) + COS(".$latitude."* PI() / 180) * COS(a.latitude * PI() / 180) * COS((".$longtitude." - a.longtitude) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS distance ";            
                $having = " having distance <=". $miles;                
               
               /* if( (isset($apiData['data']['category_id']) && !empty($apiData['data']['category_id'])) || (isset($apiData['data']['subcategory_id']) && !empty($apiData['data']['subcategory_id']))){

                        $table  .= " LEFT JOIN user_skill as c ON a.id = c.user_id ";
                        $cat_string="";
                        if(isset($apiData['data']['category_id']) && !empty($apiData['data']['category_id']))
                        {
                            $cat_string  .= (!empty($cat_string) ? " OR " : ""). "  c.category_id = ". $apiData['data']['category_id'];
                        }
                        if(isset($apiData['data']['subcategory_id']) && !empty($apiData['data']['subcategory_id']))
                        {
                            $cat_string  .= (!empty($cat_string) ? " OR " : ""). "  c.subcategory_id = ". $apiData['data']['subcategory_id'];
                        }
                        $where  .= (!empty($cat_string) ? " and  (".$cat_string.")" : "");
                        // this change by bhautik
                } */

                  $sql = "SELECT " . $select . " from " . $table . " where " . $where  . $having   ;

                $command = Yii::app()->db->createCommand($sql);
                $userslist = $command->queryAll();
                if (!empty($userslist)) {
                    foreach ($userslist as $key => $value) {


                        $user_id = $value['id'];

                        $PromotionUsersData = new PromotionUsers();
                        $PromotionUsersData->user_id = $user_id;
                        $PromotionUsersData->promotion_id = $PromotionData->attributes['promotion_id'];
                        $PromotionUsersData->created_at = date('Y-m-d H:i:s');
                        $PromotionUsersData->save(false);

                        $touser = User::model()->find("id ='".$user_id."'");
                        $fromuser = User::model()->find("id ='".$apiData['data']['id']."'");


                        $fromusername = $fromuser->first_name . " " . $fromuser->last_name;
                        $message =  $this->GetNotification("addnewpromotion", $lang);



                        $activityFeed = new FeedAcivity();

                        $activityFeed->user_id = $apiData['data']['id'];
                        $activityFeed->feed_id = $PromotionData->attributes['promotion_id'];
                        $activityFeed->author_id = $user_id;
                        $activityFeed->activity_detail_id = $PromotionData->attributes['promotion_id']; //promotion table id
                        $activityFeed->msg = $message;
                        $activityFeed->status = 10; //add new promotion
                        $activityFeed->Is_read = "0";
                        $activityFeed->created_at = date("Y-m-d H:i:s");
                        $activityFeed->save(false);
                        $actid = $activityFeed->activity_id;
                        $deviceId = $touser->device_token;
                        $deviceType = $touser->device_type;
                        $screen = "10";
                        $connection = Yii::app()->db;
                        
                        $updateBase = $this->loadModel($user_id, 'User');
                        $updateBase->base = $updateBase->base + 1;
                        $updateBase->save(false);
                        
                        
                        $sql = "SELECT count(*) as unreadmsg FROM `feed_acivity` WHERE  author_id = '" . $user_id . "' and Is_read=0";
                        
                        $command = Yii::app()->db->createCommand($sql);
                        $activityDatas = $command->queryAll();
                        foreach ($activityDatas as $readcount) {
                            $unreadmsg = $readcount['unreadmsg'];
                        }
                        
                        $unreadmessages = $updateBase->attributes['base'];

                        $find = User::model()->find("id = " .$user_id);
                        $orderId = $PromotionData->attributes['post_id'];
                        
                        if (!empty($find) && $find->device_token!="") {


                           FeedDetail::model()->sendNotification($deviceId, $deviceType, $message, $screen, $fromusername, $unreadmessages, $orderId);
                        }

                    }
                }



                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("promotionsaved", $lang);
                    $response['data']['promotion_id'] = $PromotionData->attributes['promotion_id'] . "";
                   

                    $response['data']['promotion_title'] = $PromotionData->attributes['promotion_title'] . "";
                    $response['data']['promotion_description'] = $PromotionData->attributes['promotion_description'] . "";
                    $response['data']['category_id'] = $PromotionData->attributes['category_id'] . "";
                    $response['data']['subcategory_id'] = $PromotionData->attributes['subcategory_id'] . "";

                    $response['data']['rate'] =$PromotionData->attributes['rate'];

                    $response['data']['category_name'] = $this->GetCategoryName($PromotionData->attributes['category_id']);

                    $response['data']['subcategory_name'] = $this->GetSubCategoryName($PromotionData->attributes['subcategory_id']);


                    $response['data']['work_type'] = $PromotionData->attributes['work_type'] . "";
                    $response['data']['work_type_text'] = $this->GetWorkTypeText($PromotionData->attributes['work_type']) . "";

                    $response['data']['pay_by'] = $PromotionData->attributes['pay_by'] . "";
                    $response['data']['pay_by_text'] = $this->GetPayByText($PromotionData->attributes['pay_by']) . "";


                    $response['data']['promotion_datetime'] = $PromotionData->attributes['promotion_datetime'] . "";
                    $response['data']['time_diffrent'] = $this->time_diffrent($PromotionData->attributes['promotion_datetime']) . "";

                    $response['data']['promotion_expiredatetime'] = $PromotionData->attributes['promotion_expiredatetime'] . "";
                    $response['data']['promotion_expire_time_diffrent'] = $this->time_diffrent($PromotionData->attributes['promotion_expiredatetime']) . "";

                    $user_id = $PromotionData->attributes['user_id'];
                    $promotionowner = User::model()->find("id ='".$user_id."'");
                                //  print_r($temparray);


                    $response['data']['user_id'] = $promotionowner->id;
                    $response['data']['first_name'] = $promotionowner->first_name;
                    $response['data']['last_name'] = $promotionowner->last_name;
                    $response['data']['profile_image'] = $promotionowner->image;
                    $response['data']['country'] = $promotionowner->country;
                    $response['data']['state'] = $promotionowner->state;
                    $response['data']['city'] = $promotionowner->city;



                    $sql6 = "SELECT * from `user_review` where user_id = " .$user_id. " order by review_date limit 5";
                    $command6 = Yii::app()->db->createCommand($sql6);
                    $ratedata = $command6->queryAll();
                    $ratearray = array();
                    $avg = 0;
                    $total = 0;
                    $cnt = 0;
                    if (!empty($ratedata)) {
                        $gaarray = array();
                        foreach ($ratedata as $key6 => $value6) {
                            $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                            if ($fromuser) {
                                $temparray = array();
                                $temparray['review_count'] = $value6['review_count'];
                                $temparray['review'] = $value6['review'];
                                $temparray['review_date'] = $value6['review_date'];

                                $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                $temparray['job_title'] = $postbiddetail->job_title."";
                                $temparray['total_amount'] = $postbiddetail->total_amount."";
                                if($postbiddetail->post_id!=0)
                                {
                                    $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                    $temparray['job_title'] = $postdetail->job_title."";
                                }

                                //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                //  print_r($temparray);

                                $temparray['user_id'] = $fromuser->id;
                                $temparray['first_name'] = $fromuser->first_name;
                                $temparray['last_name'] = $fromuser->last_name;
                                $temparray['profile_image'] = $fromuser->image;
                                $ratearray[] = $temparray;
                                $total = $total + $value6['review_count'];
                                $cnt++;
                            }
                            //$gaarray[] = $temparray;
                        }
                        $avg = $total / $cnt;
                        //$response['data']['gallery'] = $gaarray;
                    }
                    $response['data']['ratearray'] = $ratearray;
                    $response['data']['avgrate'] = round($avg,2)."";
                    $response['data']['totalrate'] = $cnt;





                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("savedfail", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }

    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : Oct 22 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Promotion List.
     * */
    public function actionPromotionList() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
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
                $connection = Yii::app()->db;


                //$temp = " ";
                // End Pagination
                //$miles = $apiData['data']['miles'];

                $all_list = "0";
                if (isset($apiData['data']['all_list'])) {
                    $all_list = $apiData['data']['all_list'];
                }

                $only_running = "0";
                if (isset($apiData['data']['only_running'])) {
                    $only_running = $apiData['data']['only_running'];
                }



                $connection = Yii::app()->db;

                $select = " a.* , if(a.promotion_expiredatetime >= '". date('Y-m-d H:i:s')."', 0, 1) as is_expire ";
                $table = "promotion as a";
               // $where = " a.status=2 ";
                
                if($all_list=="0")
                {
                    $where .= (!empty($where) ? " AND " : ""). "  a.user_id = ".$apiData['data']['id'];
                }

                if($all_list=="1")
                {
                    $table  .= " JOIN promotion_users as b ON a.promotion_id = b.promotion_id and b.user_id = ".$apiData['data']['id'];
                }

                if($only_running=="1")
                {
                    $where .= (!empty($where) ? " AND " : ""). "  a.promotion_expiredatetime >= '". date('Y-m-d H:i:s')."'" ;
                }
               // 
                //$having = " having distance <=". $miles;
                // $orderBy = " ORDER BY a.article_id desc ";
               // $orderBy = "";
                $orderBy = " a.promotion_datetime desc ";
                // $groupBy = " GROUP BY a.article_id ";
                $groupBy = "";
                $having = "";

              

                $sql = "SELECT " . $select . " from " . $table . (!empty($where) ? " where " : '') . $where . $groupBy . $having . (!empty($orderBy) ? ' ORDER BY '. $orderBy : '')  . $temp;


                $command = Yii::app()->db->createCommand($sql);
                $promotionlist = $command->queryAll();
                if (!empty($promotionlist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("promotionlist", $lang);
                    foreach ($promotionlist as $key => $value) {

                        $response['data'][$key]['promotion_id'] = $value['promotion_id'] . "";   
                        $response['data'][$key]['is_expire'] = $value['is_expire'] . "";   
                                        

                        $response['data'][$key]['promotion_title'] = $value['promotion_title'] . "";
                        $response['data'][$key]['promotion_description'] = $value['promotion_description'] . "";
                        $response['data'][$key]['category_id'] = $value['category_id'] . "";
                        $response['data'][$key]['subcategory_id'] = $value['subcategory_id'] . "";

                        $response['data'][$key]['rate'] = $value['rate'] . "";
                       

                        $response['data'][$key]['category_name'] = $this->GetCategoryName($value['category_id']);
                        $response['data'][$key]['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);


                        $response['data'][$key]['work_type'] = $value['work_type'] . "";
                        $response['data'][$key]['work_type_text'] = $this->GetWorkTypeText($value['work_type']) . "";

                        $response['data'][$key]['pay_by'] = $value['pay_by'] . "";
                        $response['data'][$key]['pay_by_text'] = $this->GetPayByText($value['pay_by']) . "";


                        $response['data'][$key]['promotion_datetime'] = $value['promotion_datetime'] . "";
                        $response['data'][$key]['time_diffrent'] = $this->time_diffrent($value['promotion_datetime']) . "";

                        $response['data'][$key]['promotion_expiredatetime'] = $value['promotion_expiredatetime'] . "";
                        $response['data'][$key]['promotion_expire_time_diffrent'] = $this->time_diffrent($value['promotion_expiredatetime']) . "";

                        $user_id = $value['user_id'];
                        $promotionowner = User::model()->find("id ='".$user_id."'");
                                    //  print_r($temparray);


                        $response['data'][$key]['user_id'] = $promotionowner->id;
                        $response['data'][$key]['first_name'] = $promotionowner->first_name;
                        $response['data'][$key]['last_name'] = $promotionowner->last_name;
                        $response['data'][$key]['profile_image'] = $promotionowner->image;
                        $response['data'][$key]['country'] = $promotionowner->country;
                        $response['data'][$key]['state'] = $promotionowner->state;
                        $response['data'][$key]['city'] = $promotionowner->city;



                        $sql6 = "SELECT * from `user_review` where user_id = " .$user_id. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];

                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }

                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data'][$key]['ratearray'] = $ratearray;
                        $response['data'][$key]['avgrate'] = round($avg,2)."";
                        $response['data'][$key]['totalrate'] = $cnt;


                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }
    


     /**
     * @Method        : POST
     * @Params        : usertype,username,password
     * @author        : Vijay   
     * @created       : Oct 22 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Remove Promotion
     * */
    public function actionRemovePromotion() {
        $res = array();
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['promotion_id']) && empty($apiData['data']['promotion_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpromotionid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
         else {

            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
                $checkData = Promotion::model()->find("promotion_id ='" . $apiData['data']['promotion_id'] . "' and user_id = '".$apiData['data']['id']."'");
                if (!empty($checkData)) {

                    $deletePromotionData = Promotion::model()->deleteAll("promotion_id = '" . $apiData['data']['promotion_id'] . "'");

                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("promotionremovesuccess", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();

                    
                } else {
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("recordnotfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }


    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : oct 22 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Single Promotion
     * */

    public function actionSinglePromotion() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if (!isset($apiData['data']['id']) && empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) && empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } 
        if (!isset($apiData['data']['promotion_id']) && empty($apiData['data']['promotion_id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passpromotionid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }else {
            $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {
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
                $connection = Yii::app()->db;


                //$temp = " ";
                // End Pagination
                //$miles = $apiData['data']['miles'];

                $all_list = "0";
                if (isset($apiData['data']['all_list'])) {
                    $all_list = $apiData['data']['all_list'];
                }

                $only_running = "0";
                if (isset($apiData['data']['only_running'])) {
                    $only_running = $apiData['data']['only_running'];
                }



                $connection = Yii::app()->db;

                $select = " a.* , 
                                         CASE 
                                              WHEN promotion_expiredatetime >= '". date('Y-m-d H:i:s')."'
                                                 THEN 0 
                                              ELSE 1 
                                         END  as is_expire
                                         ";
                $table = "promotion as a";
                $where .= (!empty($where) ? " AND " : ""). "  a.promotion_id = ".$apiData['data']['promotion_id'];
                // $groupBy = " GROUP BY a.article_id ";
                $groupBy = "";
                $having = "";

              

                $sql = "SELECT " . $select . " from " . $table . " where " . $where . $groupBy . $having . (!empty($orderBy) ? ' ORDER BY '. $orderBy : '')  . $temp;


                $command = Yii::app()->db->createCommand($sql);
                $promotionlist = $command->queryAll();
                if (!empty($promotionlist)) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("promotionlist", $lang);
                    foreach ($promotionlist as $key => $value) {

                        $response['data']['promotion_id'] = $value['promotion_id'] . "";   
                        $response['data']['is_expire'] = $value['is_expire'] . "";   
                                        

                        $response['data']['promotion_title'] = $value['promotion_title'] . "";
                        $response['data']['promotion_description'] = $value['promotion_description'] . "";
                        $response['data']['category_id'] = $value['category_id'] . "";
                        $response['data']['subcategory_id'] = $value['subcategory_id'] . "";
                         $response['data']['rate'] = $value['rate'] . "";

                        $response['data']['category_name'] = $this->GetCategoryName($value['category_id']);
                        $response['data']['subcategory_name'] = $this->GetSubCategoryName($value['subcategory_id']);


                        $response['data']['work_type'] = $value['work_type'] . "";
                        $response['data']['work_type_text'] = $this->GetWorkTypeText($value['work_type']) . "";

                        $response['data']['pay_by'] = $value['pay_by'] . "";
                        $response['data']['pay_by_text'] = $this->GetPayByText($value['pay_by']) . "";


                        $response['data']['promotion_datetime'] = $value['promotion_datetime'] . "";
                        $response['data']['time_diffrent'] = $this->time_diffrent($value['promotion_datetime']) . "";

                        $response['data']['promotion_expiredatetime'] = $value['promotion_expiredatetime'] . "";
                        $response['data']['promotion_expire_time_diffrent'] = $this->time_diffrent($value['promotion_expiredatetime']) . "";

                        $user_id = $value['user_id'];
                        $promotionowner = User::model()->find("id ='".$user_id."'");
                                    //  print_r($temparray);

                        $response['data']['user_id'] = $promotionowner->id;
                        $response['data']['first_name'] = $promotionowner->first_name;
                        $response['data']['osnap_id'] = $promotionowner->osnap_id;
                        $response['data']['last_name'] = $promotionowner->last_name;
                        $response['data']['profile_image'] = $promotionowner->image;
                        $response['data']['business_image'] = $promotionowner->business_image; 	
                        $response['data']['business_osnap_id'] = $promotionowner->business_osnap_id;
                        $response['data']['business_category'] = $promotionowner->business_category;
                        $response['data']['business_category_name'] = $this->GetBusinessCategoryName($promotionowner->business_category);
                        $response['data']['city'] = $promotionowner->city;
                        $response['data']['state'] = $promotionowner->state;
                        $response['data']['country'] = $promotionowner->country;
                        $response['data']['created_at'] = $promotionowner->created_at;
                        $response['data']['created_at_diffrent'] = $this->time_diffrent($promotionowner->created_at); 
                        if( (isset($apiData['data']['Dlatitude']) && !empty($apiData['data']['Dlatitude'])) &&  (isset($apiData['data']['Dlongtitude']) && !empty($apiData['data']['Dlongtitude'])) ){

                            $response['data']['distance'] = $this->distance($apiData['data']['Dlatitude'],$apiData['data']['Dlongtitude'],$promotionowner->latitude,$promotionowner->longtitude)."";
                        }
                        else
                        {
                            $response['data']['distance'] = "";
                        }
                        $response['data']['available'] = 1;
                        $sql6 = "SELECT * from `user_review` where user_id = " . $promotionowner->id. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray1 = array();
                                    $temparray1['review_count'] = $value6['review_count'];
                                    $temparray1['review'] = $value6['review'];
                                    $temparray1['review_date'] = $value6['review_date'];

                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray1['job_title'] = $postbiddetail->job_title."";
                                    $temparray1['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray1['job_title'] = $postdetail->job_title."";
                                    }


                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray1['user_id'] = $fromuser->id;
                                    $temparray1['first_name'] = $fromuser->first_name;
                                    $temparray1['last_name'] = $fromuser->last_name;
                                    $temparray1['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray1;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data']['ratearray'] = $ratearray;
                        $response['data']['avgrate'] = round($avg,2)."";
                        $response['data']['totalrate'] = $cnt;

                        $response['data']['is_favourite'] =  $this->Isfvrtpost($apiData['data']['id'],$apiData['data']['post_id']);






                        $sql6 = "SELECT * from `user_review` where user_id = " .$user_id. " order by review_date limit 5";
                        $command6 = Yii::app()->db->createCommand($sql6);
                        $ratedata = $command6->queryAll();
                        $ratearray = array();
                        $avg = 0;
                        $total = 0;
                        $cnt = 0;
                        if (!empty($ratedata)) {
                            $gaarray = array();
                            foreach ($ratedata as $key6 => $value6) {
                                $fromuser = User::model()->find("id ='" . $value6['review_by'] . "'");
                                if ($fromuser) {
                                    $temparray = array();
                                    $temparray['review_count'] = $value6['review_count'];
                                    $temparray['review'] = $value6['review'];
                                    $temparray['review_date'] = $value6['review_date'];

                                    $postbiddetail = PostBid::model()->find("pb_id ='".$value6['pb_id']."'");
                                    $temparray['job_title'] = $postbiddetail->job_title."";
                                    $temparray['total_amount'] = $postbiddetail->total_amount."";
                                    if($postbiddetail->post_id!=0)
                                    {
                                        $postdetail = PostJob::model()->find("post_id ='".$postbiddetail->post_id."'");
                                        $temparray['job_title'] = $postdetail->job_title."";
                                    }

                                    //$fromuser = UserDetail::model()->find("user_id ='".$value6['user_id']."'");
                                    //  print_r($temparray);

                                    $temparray['user_id'] = $fromuser->id;
                                    $temparray['first_name'] = $fromuser->first_name;
                                    $temparray['last_name'] = $fromuser->last_name;
                                    $temparray['profile_image'] = $fromuser->image;
                                    $ratearray[] = $temparray;
                                    $total = $total + $value6['review_count'];
                                    $cnt++;
                                }
                                //$gaarray[] = $temparray;
                            }
                            $avg = $total / $cnt;
                            //$response['data']['gallery'] = $gaarray;
                        }
                        $response['data']['ratearray'] = $ratearray;
                        $response['data']['avgrate'] = round($avg,2)."";
                        $response['data']['totalrate'] = $cnt;


                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "5";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("promotinonotfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
        }
    }


    /**
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : Nov 22 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Add Card.
     * */
    public function actionAddCard() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if(!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang",1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if(!isset($apiData['data']['id']) && empty($apiData['data']['id'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if(!isset($apiData['data']['token']) && empty($apiData['data']['token'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        
        if(!isset($apiData['data']['cardtoken']) && empty($apiData['data']['cardtoken'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passcardnumber",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if(!isset($apiData['data']['is_default']) && empty($apiData['data']['is_default'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passisdefault",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        /*if(!isset($apiData['data']['cardnumber']) && empty($apiData['data']['cardnumber'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passcardnumber",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }*/
        else 
        {
            $checkUserTokenData = User::model()->find("id='".$apiData['data']['id']."' AND token = '".$apiData['data']['token']."'");
        if($checkUserTokenData){

            $developing  = "sk_test_tUe7byxtLFAZAfKm4JdRqSe9";
            \Stripe\Stripe::setApiKey($developing);
            try
            {
                $customer = \Stripe\Customer::create(array(
                   'card' => $apiData['data']['cardtoken'],
                   'description' => 'Customer('.$apiData['data']['id'].') Recurring Payment'
                ));
            }
            catch(Exception $e)
            {
                $response['status'] = "0";
                $response['message'] = $this->GetNotification("tryanothercard",$lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }
            

            



            Usercard::model()->updateAll(array('is_default'=>0),'user_id="'.$apiData['data']['id'].'"');

            $UsercardData = new Usercard();
            $UsercardData->cardtoken = $customer->id;

            $UsercardData->exp_month = $customer->sources->data[0]->exp_month;
            $UsercardData->exp_year = $customer->sources->data[0]->exp_year;

            $UsercardData->user_id = $apiData['data']['id'];

            $UsercardData->cardnumber = $customer->sources->data[0]->last4;
            $UsercardData->is_default = $apiData['data']['is_default'];

    

            $UsercardData->brand = $customer->sources->data[0]->brand;

            $UsercardData->created_at = date("Y-m-d H:i:s");
            $UsercardData->save(false);
                 
            $response['status'] = "1";
            $response['message'] = $this->GetNotification("successdata",$lang);
            
            
            
             
            // multiple location
            $results = Usercard::model()->findAll("user_id ='".$apiData['data']['id']."'");            
            $multiarray = array();
            if(!empty($results)){
                $is_multi = 1;
                foreach($results as $k => $v){
                    $subarray = array();
                    $subarray['card_id'] = $v->card_id;
                    $subarray['cardnumber'] = $v->cardnumber;
                    $subarray['exp_month'] = $v->exp_month; 
                    $subarray['exp_year'] = $v->exp_year; 
                    $subarray['is_default'] = $v->is_default;
                    $subarray['brand'] = $v->brand;
                    $multiarray[] = $subarray;
                }
            }else{
                $multiarray = [];
            }
            
            
            $response['data']['cards'] = $multiarray;
            
            
            
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
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
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : Nov 22 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Edit Card.
     * */
    public function actionEditCard() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if(!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang",1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if(!isset($apiData['data']['id']) && empty($apiData['data']['id'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if(!isset($apiData['data']['token']) && empty($apiData['data']['token'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if(!isset($apiData['data']['card_id']) && empty($apiData['data']['card_id'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passcardid",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        else 
        {
            $checkUserTokenData = User::model()->find("id='".$apiData['data']['id']."' AND token = '".$apiData['data']['token']."'");
        if($checkUserTokenData){
         $fvrtData = Usercard::model()->find("card_id=".$apiData['data']['card_id']);
         //  print_r($fvrtData);
           if(!empty($fvrtData)){
                Usercard::model()->updateAll(array('is_default'=>0),'user_id="'.$apiData['data']['id'].'"');
                $cardID = $apiData['data']['card_id'];
                $userCard = $this->loadModel($cardID, 'Usercard');
                
                if(isset($apiData['data']['is_default']) && !empty($apiData['data']['is_default'])){
                    $userCard->is_default =     $apiData['data']['is_default'];
                }

                
                $userCard->save(false);
                
                // multiple location
                $results = Usercard::model()->findAll("user_id ='".$apiData['data']['id']."'");            
                $multiarray = array();
                if(!empty($results)){
                    $is_multi = 1;
                    foreach($results as $k => $v){
                        $subarray = array();
                        $subarray['card_id'] = $v->card_id;
                        $subarray['cardnumber'] = $v->cardnumber;
                        $subarray['exp_month'] = $v->exp_month; 
                        $subarray['exp_year'] = $v->exp_year; 
                        $subarray['brand'] = $v->brand;                        
                        $subarray['is_default'] = $v->is_default;                        
                        $multiarray[] = $subarray;
                    }
                }else{
                    $multiarray = [];
                }
                
                $response['status'] = "1";
                $response['message'] = $this->GetNotification("successdata",$lang);
                $response['data']['cards'] = $multiarray;
                
                
                
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
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : Nov 22 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Remove Card .
     * */
    public function actionRemoveCard() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
        if(!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang",1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];
        if(!isset($apiData['data']['id']) && empty($apiData['data']['id'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if(!isset($apiData['data']['token']) && empty($apiData['data']['token'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if(!isset($apiData['data']['card_id']) && empty($apiData['data']['card_id'])){
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passcardid",$lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }               
        else 
        {
            $checkUserTokenData = User::model()->find("id='".$apiData['data']['id']."' AND token = '".$apiData['data']['token']."'");
        if($checkUserTokenData){
        //  echo $apiData['data']['custl_id'];
           $fvrtData = Usercard::model()->find("card_id=".$apiData['data']['card_id']);
         //  print_r($fvrtData);
           if(!empty($fvrtData)){
          
                $cldel = new Usercard();
                //$cldel = Usercard::model()->findByAttributes("card_id =". $apiData['data']['card_id']);
                //print_r($cldel);
                if (Usercard::model()->deleteAll("card_id =". $apiData['data']['card_id'])) {
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("dataremoved",$lang);
                    
                    $results = Usercard::model()->findAll("user_id ='".$apiData['data']['user_id']."'");            
                    $multiarray = array();
                    if(!empty($results)){
                        $is_multi = 1;
                        foreach($results as $k => $v){
                            $subarray = array();
                            $subarray['card_id'] = $v->card_id;
                            $subarray['cardnumber'] = $v->cardnumber;  
                            $subarray['exp_month'] = $v->exp_month; 
                            $subarray['exp_year'] = $v->exp_year;                           
                            $subarray['brand'] = $v->brand;                            
                            $subarray['is_default'] = $v->is_default;
                            $multiarray[] = $subarray;
                        }
                    }else{
                        $multiarray = [];
                    }
                    $response['data']['cards'] = $multiarray;
                                
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
                
                else
                {
                    $response['status'] = "0";
                    $response['message'] = $this->GetNotification("dataremovedfail",$lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
            }
            else
            {
                $response['status'] = "0";
                $response['message'] = $this->GetNotification("datanotexist",$lang);
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
     * @Method        : POST
     * @Params        :
     * @author        : Vijay
     * @created       : Nov 27 2018
     * @Modified by   :
     * @Status        : Status Code :-  0 - Any Error Occurs, 1 - Success
     * @Comment       : Check User Subscription.
     * */
    public function actionCheckUserSubscription() {
        $response = array();
        $apiData = json_decode(file_get_contents('php://input'), TRUE);
       /* if (!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passlang", 1);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        $lang = $apiData['data']['lang_type'];*/
       /* if (!isset($apiData['data']['id']) || empty($apiData['data']['id'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passuserid", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        }
        if (!isset($apiData['data']['token']) || empty($apiData['data']['token'])) {
            $response['status'] = "0";
            $response['message'] = $this->GetNotification("passtoken", $lang);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
            exit();
        } else {*/
           /* $checkUserTokenData = User::model()->find("id='" . $apiData['data']['id'] . "' AND token = '" . $apiData['data']['token'] . "'");
            if ($checkUserTokenData) {*/

                // echo "ff";

                /*$page_number = (isset($apiData['data']['page']) && $apiData['data']['page'] != '') ? $apiData['data']['page'] : '';
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
                $temp = " LIMIT $offset,$limit";*/
                $temp = "";
                // End Pagination
                $connection = Yii::app()->db;


                // $temp = " LIMIT $offset,$limit";
                // End Pagination
                $connection = Yii::app()->db;
                $select = "a.*";
                $table = "user as a";
                $where = " a.is_active=1  and a.is_agree = 1 and a.expiration_datetime <= NOW() ";
                //$orderBy = " ORDER BY a.article_id desc ";
                $orderBy = "";
                $groupBy = "";
                $having  = "";
                
                $sql = "SELECT " . $select . " from " . $table . " where " . $where . $groupBy . $having . (!empty($orderBy) ? ' ORDER BY '. $orderBy : '')  . $temp;


                //  $sql = "SELECT * from article where article_isactive=1 ORDER BY article_id desc " . $temp;


                $command = Yii::app()->db->createCommand($sql);
                $userslist = $command->queryAll();
                if (!empty($userslist)) {
                    
                    $response['status'] = "1";
                    $response['message'] = $this->GetNotification("userslist", $lang);
                    foreach ($userslist as $key => $value) {
                        $curr_date = date("Y-m-d H:i:s");
                        $user_id = $value['id'];
                        $last_notification_datetime = $value['last_notification_datetime'];
                        
                        $day_remaining = $this->day_remaining($value['expiration_datetime']);
                      //      echo $value['expiration_datetime'] ."<br>";
                        $new_time =  date('Y-m-d H:i:s', strtotime("+24 hour", strtotime($value['last_notification_datetime'])));

                         if($day_remaining<=0)
                            {
                                if($value['is_recurring']=="1")
                                {
                                    $carddetails = Usercard::model()->find("user_id ='" . $user_id . "' and is_default=1"); 

                                    if(!empty($carddetails))  
                                    {
                                        try
                                        {
                                            $developing  = "sk_test_tUe7byxtLFAZAfKm4JdRqSe9";
                                            \Stripe\Stripe::setApiKey($developing);
                                            $charge = \Stripe\Charge::create([
                                                            "amount" => 1 * 100,
                                                            "currency" => "USD",
                                                            "customer" => $carddetails->cardtoken,
                                                            "description" => "Charges for osnap subscription"
                                            ]);

                                            $userID = $user_id;
                                            $userUpdateData = $this->loadModel($userID, 'User');
                                           
                                            $userUpdateData->is_subscribe = 1;
                                            $userUpdateData->is_recurring = 1;  
                                            

                                            $current_date = date('Y-m-d H:i:s');

                                            $today_datetime = $current_date;
                                            $current_date = strtotime($current_date);                           
                                            $expire_date = strtotime("+1 year", $current_date);
                                            $expire_date = date('Y-m-d H:i:s', $expire_date);

                                            $userUpdateData->expiration_datetime = $expire_date;



                                            $UserSubscriptionLogData = new UserSubscriptionLog();
                                            $UserSubscriptionLogData->user_id = $userID;
                                            $UserSubscriptionLogData->start_date = $today_datetime;
                                            $UserSubscriptionLogData->end_date = $expire_date;
                                            $UserSubscriptionLogData->is_free_trial = "0";
                                            $UserSubscriptionLogData->payment_info = json_encode($charge);
                                            $UserSubscriptionLogData->created_at = $today_datetime;
                                            $UserSubscriptionLogData->save(false);

                                            $userUpdateData->save(false);

                                            $touser = User::model()->find("id ='".$user_id."'");
                                           // $fromuser = User::model()->find("id ='".$apiData['data']['id']."'");


                                            $fromusername = "System";
                                            $message =  $this->GetNotification("subscriptionRenew", $lang);



                                            $activityFeed = new FeedAcivity();

                                            $activityFeed->user_id = $user_id;
                                            $activityFeed->feed_id = $user_id;
                                            $activityFeed->author_id = $user_id;
                                            $activityFeed->activity_detail_id = $user_id; //EventToUser table id
                                            $activityFeed->msg = $message;
                                            $activityFeed->status = 12; //Event Accept
                                            $activityFeed->Is_read = "0";
                                            $activityFeed->created_at = $curr_date;
                                            $activityFeed->save(false);
                                            $actid = $activityFeed->activity_id;
                                            $deviceId = $touser->device_token;
                                            $deviceType = $touser->device_type;
                                            $screen = "12";
                                            $connection = Yii::app()->db;
                                            
                                            $updateBase = $this->loadModel($user_id, 'User');
                                            $updateBase->last_notification_datetime = $curr_date;
                                            $updateBase->base = $updateBase->base + 1;
                                            $updateBase->save(false);
                                            
                                            
                                            $sql = "SELECT count(*) as unreadmsg FROM `feed_acivity` WHERE  author_id = '" . $user_id . "' and Is_read=0";
                                            
                                            $command = Yii::app()->db->createCommand($sql);
                                            $activityDatas = $command->queryAll();
                                            foreach ($activityDatas as $readcount) {
                                                $unreadmsg = $readcount['unreadmsg'];
                                            }
                                            
                                            $unreadmessages = $updateBase->attributes['base'];


                                            $find = User::model()->find("id = " .$user_id);
                                            $orderId = $user_id;
                                            
                                            if (!empty($find) && $find->device_token!="") {
                                               FeedDetail::model()->sendNotification($deviceId, $deviceType, $message, $screen, $fromusername, $unreadmessages, $orderId);
                                            }

                                            /*$response['status'] = "1";
                                            $response['message'] = $this->GetNotification("subscribeSuccess", $lang);
                                            header('Content-Type: application/json; charset=utf-8');
                                            echo json_encode($response);
                                            exit();*/

                                            continue;
                                        }
                                        catch (Exception $e) 
                                        {
                                             /*$response['status'] = "0";
                                             $response['message'] = $this->GetNotification("failedtochargecard", $lang);
                                             $response['data'] = $e->getMessage();
                                             header('Content-Type: application/json; charset=utf-8');
                                             echo json_encode($response);
                                             exit();*/
                                         }
                                    }
                                }
                            }

                        if($day_remaining<=3 && ($last_notification_datetime=="0000-00-00 00:00:00" || $new_time <= date("Y-m-d H:i:s") ))
                        {


                           
                            

                            $touser = User::model()->find("id ='".$user_id."'");
                           // $fromuser = User::model()->find("id ='".$apiData['data']['id']."'");


                            $fromusername = "System";
                            if($day_remaining<=0)
                            {
                                $message =  $this->GetNotification("subscriptionExpired", $lang);
                            }
                            else
                            {

                                $days =  " Days.";
                                if($day_remaining<="1")
                                {
                                    $days =  " Day.";
                                }
                                $message =  $this->GetNotification("subscriptionWillExpired", $lang).", ".$day_remaining.$days;
                            }
                            



                            $activityFeed = new FeedAcivity();

                            $activityFeed->user_id = $user_id;
                            $activityFeed->feed_id = $user_id;
                            $activityFeed->author_id = $user_id;
                            $activityFeed->activity_detail_id = $user_id; //EventToUser table id
                            $activityFeed->msg = $message;
                            $activityFeed->status = 11; //Event Accept
                            $activityFeed->Is_read = "0";
                            $activityFeed->created_at = $curr_date;
                            $activityFeed->save(false);
                            $actid = $activityFeed->activity_id;
                            $deviceId = $touser->device_token;
                            $deviceType = $touser->device_type;
                            $screen = "11";
                            $connection = Yii::app()->db;
                            
                            $updateBase = $this->loadModel($user_id, 'User');
                            $updateBase->last_notification_datetime = $curr_date;
                            $updateBase->base = $updateBase->base + 1;
                            $updateBase->save(false);
                            
                            
                            $sql = "SELECT count(*) as unreadmsg FROM `feed_acivity` WHERE  author_id = '" . $user_id . "' and Is_read=0";
                            
                            $command = Yii::app()->db->createCommand($sql);
                            $activityDatas = $command->queryAll();
                            foreach ($activityDatas as $readcount) {
                                $unreadmsg = $readcount['unreadmsg'];
                            }
                            
                            $unreadmessages = $updateBase->attributes['base'];


                            $find = User::model()->find("id = " .$user_id);
                            $orderId = $user_id;
                            
                            if (!empty($find) && $find->device_token!="") {
                               FeedDetail::model()->sendNotification($deviceId, $deviceType, $message, $screen, $fromusername, $unreadmessages, $orderId);
                            }
                        }

                    }
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['status'] = "1";
                    $response['data'] = array();
                    $response['message'] = $this->GetNotification("notfound", $lang);
                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($response);
                    exit();
                }
           /* } else {
                $response['status'] = "2";
                $response['message'] = $this->GetNotification("tokenexpired", $lang);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response);
                exit();
            }*/
        //}
    }


    public function actionTestPushNotification() {
        //  FeedDetail::model()->testNotificationI('8774d3a525dfbdfb831b5008c68225b9c724e1a4748c7e8d2f9a30b751e62979');
        FeedDetail::model()->testNotificationA('fqCuTQIlt8I:APA91bGAFTkLytIzFTN0LJ3B8US0CZLKlMI2uhY0asrqhcNIxNOVGw4XIlGvnhNRw1DjyDwS62BRbUvxWN3dRPlrfIJlgqd3B_C6fpO0wvTr9Y55oaryJjxaMb5tvvPM1v_z-6VJYrz6');
    }

    public function actionStripeTest() {
       // print_r($_POST);
       // print_r($_FILES);
       /*  Stripe::setApiKey('sk_test_tUe7byxtLFAZAfKm4JdRqSe9');
        $charge = Stripe_Charge::create(array(

                    "amount" => 1 * 100,
                    "currency" => "USD",
                    "source" => "acct_1CejZeDbTUWRkeRa",
        ));*/

    
        
        // this code is for generate token for accept payment

     	

        \Stripe\Stripe::setApiKey('sk_test_tUe7byxtLFAZAfKm4JdRqSe9');

       $token = \Stripe\Token::create([
		  "card" => [
		    "number" => "5555555555554444",
		    "exp_month" => 11,
		    "exp_year" => 2019,
		    "cvc" => "314"
		  ]
		]);

      echo "Token = ".$token =  $token->id;


   /*  $customer = \Stripe\Customer::create(array(
       'source' => $token,
       'description' => 'Customer('.$apiData['data']['id'].') Recurring Payment'
    ));
     echo "<pre>";
      echo json_encode($customer);
                exit();

        print_r($customer);
      echo "Customer = ".$customer->id;
/*
       $charge = \Stripe\Charge::create([
                        "amount" => 1 * 100,
                        "currency" => "USD",
                        "customer" => $customer->id,
                        "description" => "Charges for osnap subscription"
        ]);
       echo "<pre>";
        print_r($charge);
echo "</pre>";*/

/*
        // code for tranfer above credit card payment to //sk_test_Z1Z45WXiU24h8IXZuSP8iMsu account

        Stripe::setApiKey('sk_test_Z1Z45WXiU24h8IXZuSP8iMsu');
        $charge = Stripe_Charge::create(array(
                    "amount" => 1000 * 100,
                    "currency" => "USD",
                    "source" => $token,
                    "description" => "Payment of work"
        ));

        print_r( $charge);
            */
    }

    public function actionTestStripeTransfer() {

    //   Stripe::setApiKey('sk_test_tUe7byxtLFAZAfKm4JdRqSe9');
     /*  $charge = Stripe_Charge::create(array(

                    "amount" => 1 * 100,
                    "currency" => "USD",
                    "source" => "acct_1CejZeDbTUWRkeRa", // connected account id
        ));
         
*/  
         Stripe::setApiKey("sk_test_wZODYU3XU59jSRZbOFmFYx2b");
        $token = Stripe_Token::create(array(
          "card" => array(
            "number" => "4242424242424242",
            "exp_month" => 1,
            "exp_year" => 2020,
            "cvc" => "314"
          )
        ));
        $token =  $token->id;


      $charge = Stripe_Charge::create(array(
        "amount" => 1000,
        "currency" => "usd",
        "source" => $token
      ));

      var_dump( $charge);
/*
      ,
         "destination" => array(
          "account" => "acct_1CejZeDbTUWRkeRa",
        ) */


        /*
        echo "Stripe::setApiKey('sk_test_tUe7byxtLFAZAfKm4JdRqSe9'); <br>
        $charge = Stripe_Charge::create(array(<br>

                    'amount' => 1 * 100,<br>
                    'currency' => 'USD',<br>
                    'source' => 'acct_1CejZeDbTUWRkeRa', // connected account id<br>
        ));";

        Stripe::setApiKey('sk_test_tUe7byxtLFAZAfKm4JdRqSe9');
        $charge = Stripe_Charge::create(array(

                    "amount" => 1 * 100,
                    "currency" => "USD",
                    "source" => "acct_1CejZeDbTUWRkeRa", // connected account id
        ));
         
        
       

        */
    }

}
