<?php
date_default_timezone_set("UTC");

class FeedController extends ApiController{
    //Array multidim array unique
    public function unique_multidim_array($array, $key) {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }

	function checkNullIfExist($array){
		foreach ($array as $key => $value) {
		    if (is_null($value)) {
		         $array[$key] = "";
		    }
		}
		return $array;
	}
	/*
	public function GetNotification($key,$lang){
		// Check Email exists or not query
		$result = Notification::model()->find("notification_key ='".$key."'");
		//print_r($result);
		if($result){
			if($lang==1)
			{
				return $result->attributes['notification_desc_en'];
			}
			else
			{
				return $result->attributes['notification_desc_cn'];
			}
		}else{
			// Email not present then display 0
			return "Message not found";
		}
		//return $valid;
	}
	*/

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


	function time_diffrent($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
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
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
    
	/**
	 * @Method		  :	POST
	 * @Params		  : user_id, oldpassword, newpassword
	 * @author        : krunal
	 * @created		  :	Augest 13 2015
	 * @Modified by	  :
	 * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
	 * @Comment		  : Add Feed (Consumer)
	 **/

	public function actionAddFeed(){
		$res = array();
		$response=array();
		$apiData = json_decode(file_get_contents('php://input'),TRUE);

		// Complusory Field Validation Code
		if(empty($apiData['data']['user_id']) && !isset($apiData['data']['user_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the user id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(empty($apiData['data']['feed_title']) && !isset($apiData['data']['feed_title'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the feed title";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(empty($apiData['data']['feed_content']) && !isset($apiData['data']['feed_content'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the feed content";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(empty($apiData['data']['feed_image']) && !isset($apiData['data']['feed_image'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the image name";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else {

				$userAddAddress = FeedDetail::addFeed($apiData);
				if($userAddAddress != 0){
					// Code - New Password updated and send password to mail
					$response['status'] = "1";
					$response['message'] = "Feed add successfully.";
					header('Content-Type: application/json; charset=utf-8');
					echo json_encode($response);
					exit();
				}else{
					// Error Message for password update
					$response['status'] = "0";
					$response['message'] = "Unable to add feed.";
					header('Content-Type: application/json; charset=utf-8');
					echo json_encode($response);
					exit();
				}

		}
	}

	/**
	 * @Method		  :	POST
	 * @Params		  : usertype,username,password
	 * @author        : krunal
	 * @created		  :	Nov 25 2015
	 * @Modified by	  :
	 * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
	 * @Comment		  : Get My Feed
	 **/

	public function actionGetMyFeeds(){
		$res = array();
		$response=array();
		$friend_feed=array();
		$apiData = json_decode(file_get_contents('php://input'),TRUE);

		// Complusory Field Validation Code
		if(empty($apiData['data']['user_id']) && !isset($apiData['data']['user_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the user id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{
			$userId = $apiData['data']['user_id'];
			//Loign user friend id
			$ceanFriId = array();
			$sel="SELECT from_user_id FROM `user_connection` where to_user_id = '".$userId."' and status = 1";
			$command = Yii::app()->db->createCommand($sel);
			$friendId = $command->queryAll();
			foreach ($friendId as $fId) {
				$ceanFriId[] =  $fId['from_user_id'];
			}
			$cleanFriId = implode(",",$ceanFriId);

			//friend Feeds
			$sel="SELECT * FROM `feed_detail` WHERE author_id = $userId and status = 1";
			$command = Yii::app()->db->createCommand($sel);
			$feedDatas = $command->queryAll();
			$cleanData = "";
			foreach($feedDatas as $feedData){
				$feedId = $feedData['id'];

				$feedLikeTotal = FeedLike::model()->findAll('feed_id ="'.$feedId.'"');
				$likeTotal = count($feedLikeTotal);
				$feedcommentTotal = FeedComment::model()->findAll('feed_id ="'.$feedId.'"');
				$commentTotal = count($feedcommentTotal);
				$feedshareTotal = FeedShare::model()->findAll('feed_id ="'.$feedId.'"');
				$shareTotal = count($feedshareTotal);

				$res['feed_id'] = $feedId;
				$res['user_id'] = $feedData['author_id'];
				$res['feed_title'] = $feedData['feed_title'].'';
				$res['feed_content'] = $feedData['feed_content'].'';
				$res['feed_image'] = $feedData['feed_image'].'';
				$res['created_at'] = $this->time_diffrent($feedData['created_at']);
				$res['likeTotal'] = $likeTotal;
				$res['commentTotal'] = $commentTotal;
				$res['shareTotal'] = $shareTotal;
				//Feed author user name
				$authorData = User::model()->find("id = '".$feedData['author_id']."'");
				$res['user_name'] = $authorData->username;
				$res['email'] = $authorData->email;
				$res['image'] = $authorData->image;

				//Feed share user name
				if($feedData['feed_share'] != 0){
					$shareauthorData = User::model()->find("id = '".$feedData['feed_share']."'");
					$res['feed_share_user_name'] = $shareauthorData->username;
					$res['feed_share_email'] = $shareauthorData->email;
					$res['feed_share_image'] = $shareauthorData->image;
				}else{
					$res['feed_share_user_name'] = "";
					$res['feed_share_email'] = "";
					$res['feed_share_image'] = "";
				}

				$feedUserLike = FeedLike::model()->find('feed_id ="'.$feedId.'" and user_id ="'.$userId.'" and status = 1');
				if(!empty($feedUserLike)){
					//print_r($feedUserLike);
					$res['like'] = 1;
				}else{
					$res['like'] = 0;
				}

				$friend_feed[]=$res;
			}
			if($feedDatas){
				$response['status']='1';
				$response['message'] = "All feed.";
				$response['data'] = $friend_feed;
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}else{
				// Error Message for email not verified
				$response['status'] = "0";
				$response['message'] = "No feed found";
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}
		}
	}

	/**
	 * @Method		  :	POST
	 * @Params		  : usertype,username,password
	 * @author        : krunal
	 * @created		  :	Nov 25 2015
	 * @Modified by	  :
	 * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
	 * @Comment		  : Update Feed
	 **/

	public function actionUpdateFeed(){
		$res = array();
		$response=array();
		$userData = json_decode(file_get_contents('php://input'),TRUE);
		// Complusory Field Validation Code
		if(empty($userData['data']['user_id']) && !isset($userData['data']['user_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the user id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(empty($userData['data']['feed_id']) && !isset($userData['data']['feed_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the user id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{
			// Code - Login user email exists or not
			$checkUserDetail = FeedDetail::model()->find("author_id = '".$userData['data']['user_id']."' and id = '".$userData['data']['feed_id']."'");

			if($checkUserDetail){

				$feedID = $checkUserDetail['id'];
				$userFeed = $this->loadModel($feedID, 'FeedDetail');
				if(isset($userData['data']['feed_title'])){
					$userFeed->feed_title = $userData['data']['feed_title'];
				}
				if(isset($userData['data']['feed_content'])){
					$userFeed->feed_content = $userData['data']['feed_content'];
				}
				if(isset($userData['data']['feed_image'])){
					$userFeed->feed_image = $userData['data']['feed_image'];
				}
				if(isset($userData['data']['feed_privacy'])){
					$userFeed->feed_privacy = $userData['data']['feed_privacy'];
				}
				if(isset($userData['data']['feed_video'])){
					$userFeed->feed_video = $userData['data']['feed_video'];
				}
				if($userFeed->save(false)){
					$response['status']='1';
					$response['message'] = "Feed update successfully.";
					header('Content-Type: application/json; charset=utf-8');
					echo json_encode($response);
					exit();
				}else {
					// Error Message for email not verified
					$response['status'] = "0";
					$response['message'] = "Unable to update Feed.";
					header('Content-Type: application/json; charset=utf-8');
					echo json_encode($response);
					exit();
				}

			}else{
				// Error Message for email not verified
				$response['status'] = "0";
				$response['message'] = "User id is not valid";
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}
		}
	}

	/**
	 * @Method		  :	POST
	 * @Params		  : usertype,username,password
	 * @author        : krunal
	 * @created		  :	Nov 25 2015
	 * @Modified by	  :
	 * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
	 * @Comment		  : Delete Feed
	 **/

	public function actionDeleteFeed(){
		$res = array();
		$response=array();
		$userData = json_decode(file_get_contents('php://input'),TRUE);
		// Complusory Field Validation Code
		if(empty($userData['data']['user_id']) && !isset($userData['data']['user_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the user id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(empty($userData['data']['feed_id']) && !isset($userData['data']['feed_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the user id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{
			// Code - Login user email exists or not
			$checkUserDetail = FeedDetail::model()->find("author_id = '".$userData['data']['user_id']."' and id = '".$userData['data']['feed_id']."'");

			if($checkUserDetail){

				$feedID = $checkUserDetail['id'];
				$userFeed = $this->loadModel($feedID, 'FeedDetail');
				$userFeed->status = 0;
				if($userFeed->save(false)){
					$response['status']='1';
					$response['message'] = "Feed delete successfully.";
					header('Content-Type: application/json; charset=utf-8');
					echo json_encode($response);
					exit();
				}else {
					// Error Message for email not verified
					$response['status'] = "0";
					$response['message'] = "Unable to delete Feed.";
					header('Content-Type: application/json; charset=utf-8');
					echo json_encode($response);
					exit();
				}

			}else{
				// Error Message for email not verified
				$response['status'] = "0";
				$response['message'] = "User id is not valid";
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}
		}
	}

	/**
	 * @Method		  :	POST
	 * @Params		  : usertype,username,password
	 * @author        : krunal
	 * @created		  :	Nov 25 2015
	 * @Modified by	  :
	 * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
	 * @Comment		  : Feed Detail
	 **/

	public function actionFeedDetail(){
		$res = array();
		$response=array();
		$output=array();
		$apiData = json_decode(file_get_contents('php://input'),TRUE);

		// Complusory Field Validation Code
		if(empty($apiData['data']['user_id']) && !isset($apiData['data']['user_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the user id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(empty($apiData['data']['feed_id']) && !isset($apiData['data']['feed_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the feed id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{
			$feedId = $apiData['data']['feed_id'];
			$userId = $apiData['data']['user_id'];

			// Code - Login user email exists or not
			$feedData = FeedDetail::model()->find('id ="'.$feedId.'"');

			$feedLikeTotal = FeedLike::model()->findAll('feed_id ="'.$feedId.'"');
			$likeTotal = count($feedLikeTotal);
			$feedcommentTotal = FeedComment::model()->findAll('feed_id ="'.$feedId.'"');
			$commentTotal = count($feedcommentTotal);
			$feedshareTotal = FeedShare::model()->findAll('feed_id ="'.$feedId.'"');
			$shareTotal = count($feedshareTotal);

				$res['feed_id'] = $feedId;
				$res['user_id'] = ($feedData->author_id)?$feedData->author_id:'';
				$res['feed_title'] = ($feedData->feed_title)?$feedData->feed_title:'';
				$res['feed_content'] = ($feedData->feed_content)?$feedData->feed_content:'';
				$res['feed_image'] = ($feedData->feed_image)?$feedData->feed_image:'';
				$res['feed_video'] = ($feedData->feed_video)?$feedData->feed_video:'';
				$res['feed_share_user_id'] = $feedData['feed_share'].'';
				$res['feed_privacy'] = $feedData->feed_privacy;
				$res['created_at'] = $this->time_diffrent($feedData->created_at);
				$res['likeTotal'] = $likeTotal;
				$res['commentTotal'] = $commentTotal;
				$res['shareTotal'] = $shareTotal;



				$authorData = User::model()->find("id = $feedData->author_id");
				$res['user_name'] = $authorData->username;
				$res['email'] = $authorData->email;
				$res['image'] = $authorData->image;

				//Feed share user name (jeni post share kari hoi anu name avse)
				if($feedData['feed_share'] != 0){
					$shareauthorData = User::model()->find("id = '".$feedData['feed_share']."'");
					$res['feed_share_user_name'] = $shareauthorData->username;
					$res['feed_share_email'] = $shareauthorData->email;
					$res['feed_share_image'] = $shareauthorData->image;
					$res['feed_share'] = 1;
				}else{
					$res['feed_share_user_name'] = "";
					$res['feed_share_email'] = "";
					$res['feed_share_image'] = "";
					$res['feed_share'] = 0;
				}

				$feedUserLike = FeedLike::model()->find('feed_id ="'.$feedId.'" and user_id ="'.$userId.'" and status = 1');
				if(!empty($feedUserLike)){
					//print_r($feedUserLike);
					$res['like'] = 1;
				}else{
					$res['like'] = 0;
				}


			if($feedData){
				$response['status']='1';
				$response['message'] = "Feed detail.";
				$response['data'] = $res;
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}else{
				// Error Message for email not verified
				$response['status'] = "0";
				$response['message'] = "No detail found";
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}
		}
	}

	/**
	 * @Method		  :	POST
	 * @Params		  : user_id, oldpassword, newpassword
	 * @author        : krunal
	 * @created		  :	Augest 13 2015
	 * @Modified by	  :
	 * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
	 * @Comment		  : Add Feed Comment
	 **/

	public function actionAddComment(){

		$res = array();
		$response=array();
		$apiData = json_decode(file_get_contents('php://input'),TRUE);

		// Complusory Field Validation Code
		if(empty($apiData['data']['user_id']) && !isset($apiData['data']['user_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the user id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(empty($apiData['data']['feed_id']) && !isset($apiData['data']['feed_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the feed id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(empty($apiData['data']['comment']) && !isset($apiData['data']['comment'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the comment";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else {

			$userFeed = new FeedComment();
			$userFeed->user_id = $apiData['data']['user_id'];
			$userFeed->feed_id = $apiData['data']['feed_id'];
			$userFeed->comment = $apiData['data']['comment'];
			$userFeed->status = 1;
			$userFeed->created_at = date("Y-m-d H:i:s");
			if($userFeed->save()){

				$feedDetail = FeedDetail::model()->find('id= "'.$apiData['data']['feed_id'].'"');

				if($apiData['data']['user_id'] != $feedDetail->author_id){
					$activityFeed = new FeedAcivity();
					$activityFeed->user_id = $apiData['data']['user_id'];
					$activityFeed->feed_id = $apiData['data']['feed_id'];
					$activityFeed->author_id = $feedDetail->author_id;
					$activityFeed->activity_detail_id = $userFeed->comment_id;
					$activityFeed->status = 2;
					$activityFeed->msg = $message;
					$activityFeed->Is_read = "0";
					$activityFeed->created_at = date("Y-m-d H:i:s");
					$activityFeed->save(false);
					$actid = $activityFeed->activity_id;

					$userSetting = User::model()->find("id ='".$feedDetail->author_id."'");
					$likeduser = User::model()->find("id ='".$userFeed->user_id."'");
					$luser = $likeduser->username;
					
					$deviceId = $userSetting->device_token;
					$deviceType = $userSetting->device_type;
					$message = $luser." commented on your feed";
					$screen = "2";
					
					$connection=Yii::app()->db;
					$sql = "SELECT count(*) as unreadmsg FROM `feed_acivity` WHERE  author_id = '".$feedDetail->author_id."' and Is_read=0";
					$command = Yii::app()->db->createCommand($sql);
					$activityDatas = $command->queryAll();
					foreach ($activityDatas as $readcount)
					{
						$unreadmsg =  $readcount['unreadmsg'];
					}
					$unreadmessages = $unreadmsg;

					FeedDetail::model()->sendNotification($deviceId,$deviceType,$message,$screen,$apiData['data']['feed_id'],$unreadmessages,$actid);
				}

				$response['status'] = "1";
				$response['message'] = "Comment added successfully.";
				$response['comment_id'] = $userFeed->comment_id;
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}else{
				// Error Message for password update
				$response['status'] = "0";
				$response['message'] = "Unable to add comment.";
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}

		}
	}


	/**
	 * @Method		  :	POST
	 * @Params		  : usertype,username,password
	 * @author        : krunal
	 * @created		  :	Nov 25 2015
	 * @Modified by	  :
	 * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
	 * @Comment		  : Update comment
	 **/

	public function actionUpdateComment(){
		$res = array();
		$response=array();
		$userData = json_decode(file_get_contents('php://input'),TRUE);
		// Complusory Field Validation Code
		if(empty($userData['data']['user_id']) && !isset($userData['data']['user_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the user id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(empty($userData['data']['comment_id']) && !isset($userData['data']['comment_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the comment id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(empty($userData['data']['comment']) && !isset($userData['data']['comment'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the comment";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{
			// Code - Login user email exists or not
			$checkUserDetail = FeedComment::model()->find("user_id = '".$userData['data']['user_id']."' and comment_id = '".$userData['data']['comment_id']."'");

			if($checkUserDetail){

				$commentID = $checkUserDetail['comment_id'];
				$userFeed = $this->loadModel($commentID, 'FeedComment');
				$userFeed->comment = $userData['data']['comment'];
				$userFeed->status = 1;
				$userFeed->created_at = date("Y-m-d H:i:s");
				if($userFeed->save(false)){
					$response['status']='1';
					$response['message'] = "Feed update successfully.";
					header('Content-Type: application/json; charset=utf-8');
					echo json_encode($response);
					exit();
				}else {
					// Error Message for email not verified
					$response['status'] = "0";
					$response['message'] = "Unable to update Feed.";
					header('Content-Type: application/json; charset=utf-8');
					echo json_encode($response);
					exit();
				}

			}else{
				// Error Message for email not verified
				$response['status'] = "0";
				$response['message'] = "User id is not valid";
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}
		}
	}

		/**
	 * @Method		  :	POST
	 * @Params		  : usertype,username,password
	 * @author        : krunal
	 * @created		  :	Nov 25 2015
	 * @Modified by	  :
	 * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
	 * @Comment		  : Delete Feed
	 **/

	public function actionDeleteCooment(){
		$res = array();
		$response=array();
		$userData = json_decode(file_get_contents('php://input'),TRUE);
		// Complusory Field Validation Code
		if(empty($userData['data']['user_id']) && !isset($userData['data']['user_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the user id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(empty($userData['data']['comment_id']) && !isset($userData['data']['comment_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the comment id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{
			
			$checkUserDetail = FeedComment::model()->deleteAll("comment_id = '".$userData['data']['comment_id']."'");
			if($checkUserDetail == 1){
				$response['status']='1';
				$response['message'] = "Comment delete successfully.";
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}else {
				// Error Message for email not verified
				$response['status'] = "0";
				$response['message'] = "Unable to delete comment.";
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}
		}
	}

	/**
	 * @Method		  :	POST
	 * @Params		  : usertype,username,password
	 * @author        : krunal
	 * @created		  :	Nov 25 2015
	 * @Modified by	  :
	 * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
	 * @Comment		  : Get Comment
	 **/

	public function actionGetListComment(){
		$res = array();
		$response=array();
		$output=array();
		$apiData = json_decode(file_get_contents('php://input'),TRUE);

		// Complusory Field Validation Code
		if(empty($apiData['data']['user_id']) && !isset($apiData['data']['user_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the user id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}if(empty($apiData['data']['feed_id']) && !isset($apiData['data']['feed_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the feed id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{
			$userId =$apiData['data']['user_id'];
			$feedId =$apiData['data']['feed_id'];
			 //date_default_timezone_set('Asia/Calcutta');
			$connection=Yii::app()->db;
			$sql = "SELECT feed_comment.*,user.username,user.image FROM `feed_comment`,user where feed_comment.feed_id = $feedId and feed_comment.user_id = user.user_id ORDER BY `feed_comment`.`created_at` ASC";
			$command = Yii::app()->db->createCommand($sql);
			$commentDatas = $command->queryAll();
			//print_r($commentDatas);

			$cleanData = "";
			foreach($commentDatas as $comment){

				$res['user_id'] = $comment['user_id']?$comment['user_id']:'';
				$res['feed_id'] = $comment['feed_id']?$comment['feed_id']:'';
				$res['comment_id'] = $comment['comment_id']?$comment['comment_id']:'';
				$res['comment'] = $comment['comment']?$comment['comment']:'';
				$res['username'] = $comment['username']?$comment['username']:'';
				$res['image'] = $comment['image']?$comment['image']:'';
				//$res['db_created_at'] = $comment['created_at'];
				$res['created_at'] = $this->time_diffrent($comment['created_at']);
				$output[]=$res;
			}

			if($commentDatas){
				$response['status']='1';
				$response['message'] = "All comment.";
				$response['data'] = $output;
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}else{
				unset($output);
				$output=array();
				// Error Message for email not verified
				$response['status'] = "1";
				$response['message'] = "No comment";
				$response['data'] = $output;
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}
		}
	}


	/**
	 * @Method		  :	POST
	 * @Params		  : user_id, oldpassword, newpassword
	 * @author        : krunal
	 * @created		  :	Augest 13 2015
	 * @Modified by	  :
	 * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
	 * @Comment		  : Add Feed like
	 **/

	public function actionFeedLikeUnlike(){
		$res = array();
		$response=array();
		$apiData = json_decode(file_get_contents('php://input'),TRUE);

		// Complusory Field Validation Code
		if(empty($apiData['data']['user_id']) && !isset($apiData['data']['user_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the user id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(empty($apiData['data']['feed_id']) && !isset($apiData['data']['feed_title'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the feed id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else {
			$userId =$apiData['data']['user_id'];
			$feedId =$apiData['data']['feed_id'];

			$checkLike = FeedLike::model()->find('feed_id= "'.$feedId.'" and user_id = "'.$userId.'"');

			if(empty($checkLike)){
				$userFeed = new FeedLike();
				$userFeed->user_id = $userId;
				$userFeed->feed_id = $feedId;
				$userFeed->status = 1;
				$userFeed->created_at = date("Y-m-d H:i:s");
				if($userFeed->save()){
					$feedDetail = FeedDetail::model()->find('id= "'.$feedId.'"');
					$userSetting = User::model()->find("id ='".$feedDetail->author_id."'");
					$likeduser = User::model()->find("id ='".$userId."'");
					//check setting on/off
					if($userSetting['likes_noti'] == 1){
						if($userId != $feedDetail->author_id){
							
							$luser = $likeduser->username;
							$deviceId = $userSetting->device_token;
							$deviceType = $userSetting->device_type;
							$message = $luser." liked your feed";
							$screen = "1";
							
							$activityFeed = new FeedAcivity();
							$activityFeed->user_id = $userId;
							$activityFeed->feed_id = $feedId;
							$activityFeed->author_id = $feedDetail->author_id;
							$activityFeed->status = 1;
							$activityFeed->msg = $message;
							$activityFeed->Is_read = "0";
							$activityFeed->created_at = date("Y-m-d H:i:s");
							$activityFeed->save();
							$actid = $activityFeed->activity_id;
							
							$connection=Yii::app()->db;
							$sql = "SELECT count(*) as unreadmsg FROM `feed_acivity` WHERE  author_id = '".$feedDetail->author_id."' and Is_read=0";
							$command = Yii::app()->db->createCommand($sql);
							$activityDatas = $command->queryAll();
							foreach ($activityDatas as $readcount) {
								$unreadmsg =  $readcount['unreadmsg'];
							}
							$unreadmessages = $unreadmsg;
							FeedDetail::model()->sendNotification($deviceId,$deviceType,$message,$screen,$feedId,$unreadmessages,$actid);

						}
					}
					$response['status'] = "1";
					$response['like'] = "1";
					$response['message'] = "Feed like successfully.";
					header('Content-Type: application/json; charset=utf-8');
					echo json_encode($response);
					exit();
				}else{
					// Error Message for password update
					$response['status'] = "0";
					$response['message'] = "Unable to like feed.";
					header('Content-Type: application/json; charset=utf-8');
					echo json_encode($response);
					exit();
				}
			}else{
				$unLike = FeedLike::model()->deleteAll('feed_id= "'.$feedId.'" and user_id = "'.$userId.'"');

				// Error Message for password update
				$response['status'] = "1";
				$response['like'] = "0";
				$response['message'] = "Unlike to feed.";
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}

		}
	}

	/**
	 * @Method		  :	POST
	 * @Params		  : usertype,username,password
	 * @author        : krunal
	 * @created		  :	Nov 25 2015
	 * @Modified by	  :
	 * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
	 * @Comment		  : Get Comment
	 **/

	public function actionGetListLiker(){
		$res = array();
		$response=array();
		$output=array();
		$apiData = json_decode(file_get_contents('php://input'),TRUE);

		// Complusory Field Validation Code
		if(empty($apiData['data']['feed_id']) && !isset($apiData['data']['feed_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the feed id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{
			$feedId =$apiData['data']['feed_id'];

			$connection=Yii::app()->db;
			$sql = "SELECT * FROM `feed_like`,user where feed_like.feed_id = $feedId and feed_like.user_id = user.user_id ORDER BY `feed_like`.`created_at` ASC";
			$command = Yii::app()->db->createCommand($sql);
			$likeDatas = $command->queryAll();
			//print_r($likeDatas);
			$cleanData = "";
			foreach($likeDatas as $likeData){

				$res['feed_like_id'] = $likeData['id']?$likeData['id']:'';
				$res['user_id'] = $likeData['user_id']?$likeData['user_id']:'';
				$res['feed_id'] = $likeData['feed_id']?$likeData['feed_id']:'';
				$res['created_at'] = $likeData['created_at']?$likeData['created_at']:'';
				$res['username'] = $likeData['username']?$likeData['username']:'';
				$res['email'] = $likeData['email']?$likeData['email']:'';
				$res['image'] = $likeData['image']?$likeData['image']:'';
				$res['position'] = $likeData['position']?$likeData['position']:'';
				$res['phone'] = $likeData['phone']?$likeData['phone']:'';
				$output[]=$res;
			}

			if($likeDatas){
				$response['status']='1';
				$response['message'] = "All likers.";
				$response['data'] = $output;
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}else{
				// Error Message for email not verified
				$response['status'] = "1";
				$response['message'] = "No like";
				$response['data'] = $output;
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}
		}
	}

	/**
	 * @Method		  :	POST
	 * @Params		  : user_id, oldpassword, newpassword
	 * @author        : krunal
	 * @created		  :	Augest 13 2015
	 * @Modified by	  :
	 * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
	 * @Comment		  : Add FeedS hare Data
	 **/

	public function actionAddFeedShareData(){
		$res = array();
		$response=array();
		$apiData = json_decode(file_get_contents('php://input'),TRUE);

		// Complusory Field Validation Code
		if(empty($apiData['data']['user_id']) && !isset($apiData['data']['user_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the user id.";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(empty($apiData['data']['feed_id']) && !isset($apiData['data']['feed_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the feed id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}if(empty($apiData['data']['feed_author_id']) && !isset($apiData['data']['feed_author_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the feed author id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else {
			$userAddFeedShare = FeedShare::addFeedShare($apiData);
			if($userAddFeedShare != 0){
				$feedDetail = FeedDetail::model()->find('id= "'.$apiData['data']['feed_id'].'"');
				// add new share feed
				$userFeed = new FeedDetail();
				$userFeed->author_id = 	$apiData['data']['user_id'];
				$userFeed->feed_title = $feedDetail->feed_title;
				$userFeed->feed_content = $feedDetail->feed_content;
				$userFeed->feed_image = $feedDetail->feed_image;
				$userFeed->feed_video = $feedDetail->feed_video;
				$userFeed->feed_share = $apiData['data']['feed_author_id'];
				$userFeed->status = 1;
				$userFeed->created_at = date("Y-m-d H:i:s");
				$userFeed->save(false);

				$userSetting = User::model()->find("id ='".$feedDetail->author_id."'");
				//check setting on/off
				if($userSetting['share_update_noti'] == 1){
					// Add activity
					if($apiData['data']['user_id'] != $feedDetail->author_id){
						$activityFeed = new FeedAcivity();
						$activityFeed->user_id = $apiData['data']['user_id'];
						$activityFeed->feed_id = $apiData['data']['feed_id'];
						$activityFeed->author_id = $feedDetail->author_id;
						$activityFeed->status = 6;
						$activityFeed->created_at = date("Y-m-d H:i:s");
						$activityFeed->save();
					}
				}


				// Code - New Password updated and send password to mail
				$response['status'] = "1";
				$response['message'] = "Feed share successfully.";
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}else{
				// Error Message for password update
				$response['status'] = "0";
				$response['message'] = "Unable to share feed.";
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}
		}
	}

	/**
	 * @Method		  :	POST
	 * @Params		  : usertype,username,password
	 * @author        : krunal
	 * @created		  :	Nov 25 2015
	 * @Modified by	  :
	 * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
	 * @Comment		  : Get User Feeds
	 **/

	public function actionGetFeedsByUser(){
		$res = array();
		$response=array();
		$output=array();
		$apiData = json_decode(file_get_contents('php://input'),TRUE);

		// Complusory Field Validation Code
		if(empty($apiData['data']['user_id']) && !isset($apiData['data']['user_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the user id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{
			$userId = $apiData['data']['user_id'];
			$feedDatas = FeedDetail::model()->findAll("status = 1 and author_id ='".$userId."'");
			$cleanData = "";
			foreach($feedDatas as $feedData){
			
				$feedId = $feedData->id;

				$feedLikeTotal = FeedLike::model()->findAll('feed_id ="'.$feedId.'"');
				$likeTotal = count($feedLikeTotal);
				$feedcommentTotal = FeedComment::model()->findAll('feed_id ="'.$feedId.'"');
				$commentTotal = count($feedcommentTotal);
				$feedshareTotal = FeedShare::model()->findAll('feed_id ="'.$feedId.'"');
				$shareTotal = count($feedshareTotal);

				$res['feed_id'] = $feedId;
				$res['user_id'] = ($feedData->author_id)?$feedData->author_id:'';
				$res['feed_title'] = ($feedData->feed_title)?$feedData->feed_title:'';
				$res['feed_content'] = ($feedData->feed_content)?$feedData->feed_content:'';
				$res['feed_image'] = ($feedData->feed_image)?$feedData->feed_image:'';
				$res['feed_video'] = ($feedData->feed_video)?$feedData->feed_video:'';
				$res['feed_share_user_id'] = $feedData['feed_share'].'';
				$res['feed_privacy'] = $feedData->feed_privacy;
				$res['created_at'] = $this->time_diffrent($feedData->created_at);
				$res['likeTotal'] = $likeTotal;
				$res['commentTotal'] = $commentTotal;
				$res['shareTotal'] = $shareTotal;

				//Feed author user name
				$authorData = User::model()->find("id = $feedData->author_id");
				$res['user_name'] = $authorData->username;
				$res['email'] = $authorData->email;
				$res['image'] = $authorData->image;



				//Feed share user name (jeni post share kari hoi anu name avse)
				if($feedData['feed_share'] != 0){
					$shareauthorData = User::model()->find("id = '".$feedData['feed_share']."'");
					$res['feed_share_user_name'] = $shareauthorData->username;
					$res['feed_share_email'] = $shareauthorData->email;
					$res['feed_share_image'] = $shareauthorData->image;
					$res['feed_share'] = 1;
				}else{
					$res['feed_share_user_name'] = "";
					$res['feed_share_email'] = "";
					$res['feed_share_image'] = "";
					$res['feed_share'] = 0;
				}

				if(empty($apiData['data']['user_id']) && !isset($apiData['data']['user_id'])){
					$feedUserLike = FeedLike::model()->find('feed_id ="'.$feedId.'" and user_id ="'.$userId.'" and status = 1');
					if(!empty($feedUserLike)){
						$res['like'] = 1;
					}else{
						$res['like'] = 0;
					}
				}else{
					$currentuserId = $apiData['data']['currentuser_id'];
					$feedUserLike = FeedLike::model()->find('feed_id ="'.$feedId.'" and user_id ="'.$currentuserId.'" and status = 1');
					if(!empty($feedUserLike)){
						$res['like'] = 1;
					}else{
						$res['like'] = 0;
					}
				}

				$output[]=$res;
			}

			if($feedDatas){
				$response['status']='1';
				$response['message'] = "User feeds.";
				$response['data'] = $output;
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}else{			
				// Error Message for email not verified
				$response['status'] = "1";
				$response['message'] = "No feed found.";
				$response['data'] = $output;
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}
		}
	}

	/**
	 * @Method		  :	POST
	 * @Params		  : usertype,username,password
	 * @author        : krunal
	 * @created		  :	Nov 25 2015
	 * @Modified by	  :
	 * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
	 * @Comment		  : Get Activity
	 **/

	public function actionGetActivity(){
		$res = array();
		$response=array();
		$output=array();
		$apiData = json_decode(file_get_contents('php://input'),TRUE);
		
		// Statt Pagination
		$page_number = (isset($apiData['data']['page']) && $apiData['data']['page']!='') ? $apiData['data']['page']:'';
		$limit = (isset($apiData['data']['limit']) && $apiData['data']['limit']!='') ? $apiData['data']['limit']:10;
		if(isset($apiData['data']['page']) && $apiData['data']['page'] == 1){
		   $offset = 0;
		}else{
		   if(isset($apiData['data']['page']) && $apiData['data']['page'] != '1') {
		   	 $offset = ($page_number*$limit) - $limit;
		   }else{
		      $offset = 0;
		   }
		 }
		// End Pagination
		
		// Complusory Field Validation Code
		if(!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passlang",1);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		$lang = $apiData['data']['lang_type'];
		if(!isset($apiData['data']['user_id']) && empty($apiData['data']['user_id'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passuserid",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(!isset($apiData['data']['user_token']) && empty($apiData['data']['user_token'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passusertoken",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{
			$userId =$apiData['data']['user_id'];
			$checkUserData = User::model()->find("id='".$apiData['data']['user_id']."' AND token = '".$apiData['data']['user_token']."'");
			if($checkUserData){
				$connection=Yii::app()->db;
				$sql = "SELECT a.*,u.first_name,u.last_name,u.image FROM `feed_acivity` a, user u WHERE  a.author_id = '".$userId."' and a.user_id = u.id ORDER BY `a`.`activity_id` DESC ". " LIMIT $offset,$limit";;
				$command = Yii::app()->db->createCommand($sql);
				$activityDatas = $command->queryAll();
				$cleanData = "";
				foreach($activityDatas as $activityData){

					$res['activity_id'] = $activityData['activity_id']?$activityData['activity_id']:'';
					$res['feed_id'] = $activityData['feed_id']?$activityData['feed_id']:'';
					$res['user_id'] = $activityData['user_id']?$activityData['user_id']:'';
					$res['author_id'] = $activityData['author_id']?$activityData['author_id']:'';
					$res['first_name'] = $activityData['first_name']?$activityData['first_name']:'';
					$res['last_name'] = $activityData['last_name']?$activityData['last_name']:'';
					$res['msg'] = $activityData['msg']?$activityData['msg']:'';
					$res['image'] = $activityData['image']?$activityData['image']:'';
					$res['created_at'] = $this->time_diffrent($activityData['created_at']);
					$res['status'] = $activityData['status'].'';
					$res['Is_read'] = $activityData['Is_read'].'';
					$res['activity_detail_id'] = $activityData['activity_detail_id'].'';
					
					$authordetail = User::model()->find("id ='".$activityData['author_id']."'");
					$res['author_first_name'] = $authordetail->first_name.'';
					$res['author_last_name'] = $authordetail->last_name.'';
					$res['author_image'] = $authordetail->image.'';
					
					
					
					$output[]=$res;
				}

				if($activityDatas){
					$response['status']='1';
					$response['message'] = $this->GetNotification("getactivitysuccess",$lang);
					$response['data'] = $output;
					header('Content-Type: application/json; charset=utf-8');
					echo json_encode($response);
					exit();
				}else{
					// Error Message for email not verified
					$response['status'] = "1";
					$response['message'] = $this->GetNotification("notfound",$lang);
					$response['data'] = $output;
					header('Content-Type: application/json; charset=utf-8');
					echo json_encode($response);
					exit();
				}
			}else{
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
	 * @author        : krunal
	 * @created		  :	Nov 25 2015
	 * @Modified by	  :
	 * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
	 * @Comment		  : Add Activity
	 **/
	public function actionAddActivity(){
		$res = array();
		$response=array();
		$output=array();
		$apiData = json_decode(file_get_contents('php://input'),TRUE);
		// Complusory Field Validation Code
		if(empty($apiData['data']['user_id']) && !isset($apiData['data']['user_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the user id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}if(empty($apiData['data']['author_id']) && !isset($apiData['data']['author_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the author id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}if(!isset($apiData['data']['status'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the status";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{
			$activityFeed = new FeedAcivity();
			if(!empty($apiData['data']['feed_id']) && isset($apiData['data']['feed_id'])){
				$activityFeed->feed_id = $apiData['data']['feed_id'];
			}else{
				$activityFeed->feed_id = 0;
			}
			$activityFeed->user_id = $apiData['data']['user_id'];
			$activityFeed->author_id = $apiData['data']['author_id'];
			$activityFeed->status = $apiData['data']['status'];
			$activityFeed->created_at = date("Y-m-d H:i:s");
			if($activityFeed->save()){
				$response['status']='1';
				$response['message'] = "Add to activity.";
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}else{
				// Error Message for email not verified
				$response['status'] = "0";
				$response['message'] = "Unable to add activity";
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}
		}
	}

	/**
	 * @Method		  :	POST
	 * @Params		  : usertype,username,password
	 * @author        : krunal
	 * @created		  :	Nov 25 2015
	 * @Modified by	  :
	 * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
	 * @Comment		  : Get Feeds
	 **/
	public function actionGetFeeds(){
		$res = array();
		$response=array();
		$friend_feed=array();
		$apiData = json_decode(file_get_contents('php://input'),TRUE);

		// Complusory Field Validation Code
		if(empty($apiData['data']['user_id']) && !isset($apiData['data']['user_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the user id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{
			$userId = $apiData['data']['user_id'];

			//Loign user friend id
			$ceanFriId = array();
			$sel="SELECT from_user_id FROM `user_connection` where to_user_id = '".$userId."' and status = 1";
			$command = Yii::app()->db->createCommand($sel);
			$friendId = $command->queryAll();
			foreach ($friendId as $fId) {
				$ceanFriId[] =  $fId['from_user_id'];
			}
			$friendsId = implode(",",$ceanFriId);
				
			if(!empty($friendsId)){				
				//friend Feeds
				$sel="SELECT feed_detail.created_at as short_date, feed_detail.* FROM `feed_detail` WHERE author_id IN ($friendsId,$userId) and status = 1";
				$command = Yii::app()->db->createCommand($sel);
				$feedDatas = $command->queryAll();
				//p($feedDatas);
				
			    //Friend Like feeds
				$sel="SELECT fl.status as like_post,fl.user_id as friend_id,fl.created_at as short_date,fd.* FROM `feed_like` fl, feed_detail fd WHERE fl.user_id IN ($friendsId) and fl.status = 1 and fd.feed_privacy = 0 and fl.feed_id = fd.id";
				$command = Yii::app()->db->createCommand($sel);
				$friendLikeFeeds = $command->queryAll();
				//p($friendLikeFeeds);

				//Friend Comment feeds
				$sel="SELECT fc.comment,fc.user_id as friend_id,fc.created_at as short_date,fd.* FROM `feed_comment` fc, feed_detail fd WHERE fc.user_id IN ($friendsId) and fc.status = 1 and fd.feed_privacy = 0  and fc.feed_id = fd.id";
				$command = Yii::app()->db->createCommand($sel);
				$friendCommentFeeds = $command->queryAll();
				//p($friendLikeFeeds);

				//Friend share feeds
				$sel="SELECT fs.status as share_post,fs.user_id as friend_id,fs.created_at as short_date,fd.* FROM `feed_share` fs, feed_detail fd WHERE fs.user_id IN ($friendsId) and fs.feed_id = fd.id";
				$command = Yii::app()->db->createCommand($sel);
				$friendShareFeeds = $command->queryAll();
				//p($friendShareFeeds);
				$temp = array_merge($feedDatas,$friendLikeFeeds,$friendCommentFeeds);
			}else{
				//friend Feeds
				$sel="SELECT feed_detail.created_at as short_date, feed_detail.* FROM `feed_detail` WHERE author_id IN ($userId) and status = 1";
				$command = Yii::app()->db->createCommand($sel);
				$feedDatas = $command->queryAll();
				$temp = array_merge($feedDatas);
			}
			if($feedDatas){
				$response['status'] = "1";
				$response['message'] = "All feed.";
					foreach ($temp as $key => $row){
					  $orderByDate[$key] = $row['short_date'];
					}
				array_multisort($orderByDate, SORT_DESC, $temp);
                $input = array_map("unserialize", array_unique(array_map("serialize", $temp)));
                $input = $this->unique_multidim_array($input, "id");
				//p($input);
				foreach($input as $feedData){
					//p($feedData);
					$feedId = $feedData['id'];
					$feedLikeTotal = FeedLike::model()->findAll('feed_id ="'.$feedId.'"');
					$likeTotal = count($feedLikeTotal);
					$feedcommentTotal = FeedComment::model()->findAll('feed_id ="'.$feedId.'"');
					$commentTotal = count($feedcommentTotal);
					$feedshareTotal = FeedShare::model()->findAll('feed_id ="'.$feedId.'"');
					$shareTotal = count($feedshareTotal);

					$res['feed_id'] = $feedId;
					$res['user_id'] = $feedData['author_id'];
					$res['feed_title'] = $feedData['feed_title'].'';
					$res['feed_content'] = $feedData['feed_content'].'';
					$res['feed_image'] = $feedData['feed_image'].'';
					$res['feed_video'] = $feedData['feed_video'].'';
					$res['feed_share_user_id'] = $feedData['feed_share'].'';
					$res['created_at'] = $this->time_diffrent($feedData['short_date']);
					$res['likeTotal'] = $likeTotal;
					$res['commentTotal'] = $commentTotal;
					$res['shareTotal'] = $shareTotal;

					// feed author detail
					$authorData = User::model()->find("id = '".$feedData['author_id']."'");
					$res['user_name'] = $authorData->username;
					$res['email'] = $authorData->email;
					$res['image'] = $authorData->image;

					//Feed share user name(jeni feed share kari hoi ani detail)
					if($feedData['feed_share'] != 0){
						$shareauthorData = User::model()->find("id = '".$feedData['feed_share']."'");
						$res['feed_share_user_name'] = $shareauthorData->username;
						$res['feed_share_email'] = $shareauthorData->email;
						$res['feed_share_image'] = $shareauthorData->image;
						$res['feed_share'] = 1;
					}else{
						$res['feed_share_user_name'] = "";
						$res['feed_share_email'] = "";
						$res['feed_share_image'] = "";
						$res['feed_share'] = 0;
					}

					$feedUserLike = FeedLike::model()->find('feed_id ="'.$feedId.'" and user_id ="'.$userId.'" and status = 1');
					if(!empty($feedUserLike)){
						$res['like'] = 1;
					}else{
						$res['like'] = 0;
					}

					//friend id
					if(isset($feedData['friend_id'])){
						$res['friend_id'] = $feedData['friend_id'];
						$authorData = User::model()->find("id = '".$res['friend_id']."'");
						$res['friend_user_name'] = $authorData->username;
						$res['friend_image'] = $authorData->image;
					}else{
						$res['friend_id'] = "";
						$res['friend_user_name'] = "";
						$res['friend_image'] = "";
					}


					//frined like flag
					if($feedData['like_post']){
						$res['feed_like'] = 1;
					}else{
						$res['feed_like'] = 0;
					}

					//frined commnet flag
					if($feedData['comment']){
						$res['feed_comment'] = 1;
					}else{
						$res['feed_comment'] = 0;
					}

					$feedAlls[]=$res;
				}
				$response['data'] = $feedAlls;
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}else{
				// Error Message for email not verified
				$response['status'] = "1";
				$response['message'] = "No feed found.";
				$response['data'] = $friend_feed;
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}
		}
	}

	/**
	 * @Method		  :	POST
	 * @Params		  : usertype,username,password
	 * @author        : krunal
	 * @created		  :	Nov 25 2015
	 * @Modified by	  :
	 * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
	 * @Comment		  : Feed Like Comment Total
	 **/

	public function actionFeedLikeCommentTotal(){
		$res = array();
		$response=array();
		$userData = json_decode(file_get_contents('php://input'),TRUE);
		// Complusory Field Validation Code
		if(empty($userData['data']['feed_id']) && !isset($userData['data']['feed_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the user id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{

			$totalLike = FeedLike::model()->count("feed_id = '".$userData['data']['feed_id']."'");
			$totalComment = FeedComment::model()->count("feed_id = '".$userData['data']['feed_id']."'");
			$response['status'] = "1";
			$response['message'] = "Feed Like Comment Total";
			$response['totalLike'] = $totalLike;
			$response['totalComment'] = $totalComment;
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
	}

	/**
	 * @Method		  :	POST
	 * @Params		  : usertype,username,password
	 * @author        : krunal
	 * @created		  :	Nov 25 2015
	 * @Modified by	  :
	 * @Status		  : Status Code :-  0 - Any Error Occurs, 1 - Success
	 * @Comment		  : Get All Feeds 
	 **/
	public function actionGetAllFeeds(){ 
		$res = array();
		$response=array();
		$friend_feed=array();
		$apiData = json_decode(file_get_contents('php://input'),TRUE);

		// Complusory Field Validation Code
		if(empty($apiData['data']['user_id']) && !isset($apiData['data']['user_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the user id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{
			$userId = $apiData['data']['user_id'];
			$feedDatas = FeedDetail::model()->findAll();			
			if($feedDatas){	
				foreach($feedDatas as $feedData){
					//p($ata);
					$feedId = $feedData['id'];
					$feedLikeTotal = FeedLike::model()->count('feed_id ="'.$feedId.'"');					
					$feedcommentTotal = FeedComment::model()->count('feed_id ="'.$feedId.'"');					
					$feedshareTotal = FeedShare::model()->count('feed_id ="'.$feedId.'"');
					

					$res['feed_id'] = $feedId;
					$res['user_id'] = $feedData['author_id'];
					$res['feed_title'] = $feedData['feed_title'].'';
					$res['feed_content'] = $feedData['feed_content'].'';
					$res['feed_image'] = $feedData['feed_image'].'';
					$res['feed_video'] = $feedData['feed_video'].'';
					$res['created_at'] = $this->time_diffrent($feedData['created_at']);
					$res['likeTotal'] = $feedLikeTotal;
					$res['commentTotal'] = $feedcommentTotal;
					$res['shareTotal'] = $feedshareTotal;

					// feed author detail
					$authorData = User::model()->find("id = '".$feedData['author_id']."'");
					$res['user_name'] = $authorData->username;
					$res['email'] = $authorData->email;
					$res['image'] = $authorData->image;

					

					$feedUserLike = FeedLike::model()->find('feed_id ="'.$feedId.'" and user_id ="'.$userId.'" and status = 1');
					if(!empty($feedUserLike)){
						$res['like'] = 1;
					}else{
						$res['like'] = 0;
					}
					$feedAlls[]=$res;
				}
				
				$response['status'] = "1";
				$response['message'] = "Page content";
				$response['data'] = $feedAlls;
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}else{
				// Error Message for email not verified
				$response['status'] = "1";
				$response['message'] = "No feed found";
				$response['data'] = $friend_feed;
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}
		}
	}
	
	public function actionGetDetailFeed(){  
		$response=array();
		$friend_feed=array();
		$apiData = json_decode(file_get_contents('php://input'),TRUE); 
		// Complusory Field Validation Code
		if(empty($apiData['data']['user_id']) && !isset($apiData['data']['user_id'])){
			$response['status'] = "0";
			$response['message'] = "Please pass the user id";
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{ 
			$userId = $apiData['data']['user_id'];
			$feedId = $apiData['data']['feed_id']; 
			$feedDatas = FeedDetail::model()->find("id = '".$feedId."'");		 
			if($feedDatas){	 
					//p($ata);
					$feedId = $feedDatas->id;
					$feedLikeTotal = FeedLike::model()->count('feed_id ="'.$feedId.'"');					
					$feedcommentTotal = FeedComment::model()->count('feed_id ="'.$feedId.'"');					
					$feedshareTotal = FeedShare::model()->count('feed_id ="'.$feedId.'"');
					$res['feed_id'] = $feedId;
					$res['user_id'] = $feedDatas->author_id;  
					$res['feed_title'] = $feedDatas->feed_title.'';
					$res['feed_content'] = $feedDatas->feed_content.'';
					$res['feed_image'] = $feedDatas->feed_image.'';
					$res['feed_video'] = $feedDatas->feed_video.'';
					$res['created_at'] = $this->time_diffrent($feedDatas->created_at);
					$res['likeTotal'] = $feedLikeTotal;
					$res['commentTotal'] = $feedcommentTotal;
					$res['shareTotal'] = $feedshareTotal;
					// feed author detail
					$authorData = User::model()->find("id = '".$feedDatas->author_id."'");
					$res['user_name'] = $authorData->username;
					$res['email'] = $authorData->email;
					$res['image'] = $authorData->image;

					

					$feedUserLike = FeedLike::model()->find('feed_id ="'.$feedId.'" and user_id ="'.$userId.'" and status = 1');
					if(!empty($feedUserLike)){
						$res['like'] = 1;
					}else{
						$res['like'] = 0;
					} 
				
				$response['data'] = $res;
				$response['status'] = "1";
				$response['message'] = "Page content";
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}else{
				// Error Message for email not verified
				$response['status'] = "1";
				$response['message'] = "No feed found";
				$response['data'] = $friend_feed;
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}
		}
	}
	
	public function actionClearActivity(){
		$response=array();
		$apiData = json_decode(file_get_contents('php://input'),TRUE); 
		// Complusory Field Validation Code
		if(!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passlang",1);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		$lang = $apiData['data']['lang_type'];
		if(!isset($apiData['data']['user_id']) && empty($apiData['data']['user_id'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passuserid",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(!isset($apiData['data']['user_token']) && empty($apiData['data']['user_token'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passusertoken",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{ 
			$checkUserData = User::model()->find("id='".$apiData['data']['user_id']."' AND token = '".$apiData['data']['user_token']."'");
			if($checkUserData){
				$connection=Yii::app()->db; 
				$sql = "delete from `feed_acivity` WHERE  author_id = '".$apiData['data']['user_id']."'";
				$command = Yii::app()->db->createCommand($sql);
				$activityDatas = $command->execute();
				
				/*$checkDataDelete = FeedAcivity::model()->deleteAll("author_id = ".$apiData['data']['user_id']." and Is_read=0");
				echo $checkDataDelete;*/
				
				$response['status'] = "1";
				$response['message'] = $this->GetNotification("clearactivity",$lang);
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}else{
				$response['status'] = "2";
				$response['message'] = $this->GetNotification("tokenexpired",$lang);
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}
		}
	}
	
	public function actionReadActivity(){
		$apiData = json_decode(file_get_contents('php://input'),TRUE); 
		// Complusory Field Validation Code
		if(!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passlang",1);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		$lang = $apiData['data']['lang_type'];
		if(!isset($apiData['data']['user_id']) && empty($apiData['data']['user_id'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passuserid",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(!isset($apiData['data']['user_token']) && empty($apiData['data']['user_token'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passusertoken",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(empty($apiData['data']['activity_id']) && !isset($apiData['data']['activity_id'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passactivityID",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{ 
			$checkUserData = User::model()->find("id='".$apiData['data']['user_id']."' AND token = '".$apiData['data']['user_token']."'");
			if($checkUserData){
				$connection=Yii::app()->db;
				$sql = "Update `feed_acivity` set Is_read='1' WHERE  activity_id in(".$apiData['data']['activity_id'].")";
			
				$command = Yii::app()->db->createCommand($sql);
				$activityDatas = $command->execute();
				$response['status'] = "1";
				$response['message'] = $this->GetNotification("markasreadactivity",$lang);
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}else{
				$response['status'] = "2";
				$response['message'] = $this->GetNotification("tokenexpired",$lang);
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}
		}
	}
	
	public function actionClearBase(){
		$apiData = json_decode(file_get_contents('php://input'),TRUE); 
		// Complusory Field Validation Code
		if(!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passlang",1);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		$lang = $apiData['data']['lang_type'];
		if(!isset($apiData['data']['user_id']) && empty($apiData['data']['user_id'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passuserid",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(!isset($apiData['data']['user_token']) && empty($apiData['data']['user_token'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passusertoken",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{ 
			$checkUserData = User::model()->find("id='".$apiData['data']['user_id']."' AND token = '".$apiData['data']['user_token']."'");
			if($checkUserData){
				$connection=Yii::app()->db;
				$sql = "Update `user` set base=0 WHERE  id=".$apiData['data']['user_id'];
			
				$command = Yii::app()->db->createCommand($sql);
				$activityDatas = $command->execute();
				$response['status'] = "1";
				$response['message'] = $this->GetNotification("baseclear",$lang);
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}else{
				$response['status'] = "2";
				$response['message'] = $this->GetNotification("tokenexpired",$lang);
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}
		}
	}
	
	public function actionCountBase(){
		$apiData = json_decode(file_get_contents('php://input'),TRUE); 
		// Complusory Field Validation Code
		if(!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passlang",1);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		$lang = $apiData['data']['lang_type'];
		if(!isset($apiData['data']['user_id']) && empty($apiData['data']['user_id'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passuserid",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(!isset($apiData['data']['user_token']) && empty($apiData['data']['user_token'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passusertoken",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{ 
			$checkUserData = User::model()->find("id='".$apiData['data']['user_id']."' AND token = '".$apiData['data']['user_token']."'");
			if($checkUserData){
				$connection=Yii::app()->db;
				$sql = "SELECT base as unreadmsg FROM `user` WHERE  id = ".$apiData['data']['user_id'];
				$command = Yii::app()->db->createCommand($sql);
				$activityDatas = $command->queryAll();
				foreach ($activityDatas as $readcount)
				{
					$unreadmsg =  $readcount['unreadmsg'];
				}
				$unreadmessages = $unreadmsg;
				$response['status'] = "1";
				$response['message'] = $this->GetNotification("totalbase",$lang);
				$response['data']['count'] = $unreadmessages;
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}else{
				$response['status'] = "2";
				$response['message'] = $this->GetNotification("tokenexpired",$lang);
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}
		}
	}
	
	public function actionCountUnreadActivity(){
		$response=array();
		$apiData = json_decode(file_get_contents('php://input'),TRUE); 
		// Complusory Field Validation Code
		if(!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passlang",1);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		$lang = $apiData['data']['lang_type'];
		if(!isset($apiData['data']['user_id']) && empty($apiData['data']['user_id'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passuserid",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(!isset($apiData['data']['user_token']) && empty($apiData['data']['user_token'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passusertoken",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{
			$checkUserData = User::model()->find("id='".$apiData['data']['user_id']."' AND token = '".$apiData['data']['user_token']."'");
			if($checkUserData){
				$connection=Yii::app()->db;
				$sql = "select count(*) as unreadmsg from `feed_acivity` WHERE author_id = '".$apiData['data']['user_id']."' and Is_read='0'";
				
				$command = Yii::app()->db->createCommand($sql);
				$activityDatas = $command->queryAll();
				foreach ($activityDatas as $readcount) {
					$unreadmsg =  $readcount['unreadmsg'];
				}
				/*$checkphone = User::model()->find("phone='" . $apiData['data']['user_id'] . "'");
				if($checkphone['device_token'] !=''){
					$userID = $checkphone['user_id'];
					$userUpdateData = $this->loadModel($userID, 'UserDetail');
	                    $userUpdateData->device_token = $apiData['data']['device_token'] . '';
	                $userUpdateData->save(false);
				}*/
				$response['unread'] = $unreadmsg;
				$response['status'] = "1";
				$response['message'] = $this->GetNotification("unreadactivity",$lang);
				$response['data']['count'] = $unreadmsg;
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}else{
				$response['status'] = "2";
				$response['message'] = $this->GetNotification("tokenexpired",$lang);
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}
		}
	}

	public function actionCountUnreadActivitys(){
		$res = array();
		$response=array();
		$friend_feed=array();
		$apiData = json_decode(file_get_contents('php://input'),TRUE);
		// Complusory Field Validation Code
		
		if(!isset($apiData['data']['lang_type']) && empty($apiData['data']['lang_type'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passlang",1);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		$lang = $apiData['data']['lang_type'];
		if(!isset($apiData['data']['user_id']) && empty($apiData['data']['user_id'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passuserid",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}
		if(!isset($apiData['data']['user_token']) && empty($apiData['data']['user_token'])){
			$response['status'] = "0";
			$response['message'] = $this->GetNotification("passusertoken",$lang);
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($response);
			exit();
		}else{
			$checkUserData = User::model()->find("id='".$apiData['data']['user_id']."' AND token = '".$apiData['data']['user_token']."'");
			if($checkUserData){
				$connection=Yii::app()->db;
				$sql = "SELECT count(*) as unreadmsg FROM `feed_acivity` WHERE  author_id = '".$apiData['data']['user_id']."' and Is_read=0";
				$command = Yii::app()->db->createCommand($sql);
				$activityDatas = $command->queryAll();
				foreach ($activityDatas as $readcount)
				{
					$unreadmsg =  $readcount['unreadmsg'];
				}
				$unreadmessages = $unreadmsg;
				$response['status'] = "1";
				$response['message'] = $this->GetNotification("totalfeed",$lang);
				$response['data']['count'] = $unreadmessages;
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}else{
				$response['status'] = "2";
				$response['message'] = $this->GetNotification("tokenexpired",$lang);
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
			}
		}
	}
	
}
