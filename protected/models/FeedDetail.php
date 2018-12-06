<?php

Yii::import('application.models._base.BaseFeedDetail');

class FeedDetail extends BaseFeedDetail
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	// user feed Insert Code
	public function addFeed($apiData){
		$userFeed = new FeedDetail();
		
		if(isset($apiData['data']['user_id']) && !empty($apiData['data']['user_id'])){
			$userFeed->author_id = 	$apiData['data']['user_id'];
		}
		if(isset($apiData['data']['feed_title']) && !empty($apiData['data']['feed_title'])){
			$userFeed->feed_title = $apiData['data']['feed_title'];
		}
		if(isset($apiData['data']['feed_content']) && !empty($apiData['data']['feed_content'])){
			$userFeed->feed_content = $apiData['data']['feed_content'];
		}
		if(isset($apiData['data']['feed_image']) && !empty($apiData['data']['feed_image'])){
			$userFeed->feed_image = $apiData['data']['feed_image'];
		}
		if(isset($apiData['data']['feed_privacy']) && !empty($apiData['data']['feed_privacy'])){
			$userFeed->feed_privacy = $apiData['data']['feed_privacy'];
		}
		if(isset($apiData['data']['feed_video']) && !empty($apiData['data']['feed_video'])){
			$userFeed->feed_video = $apiData['data']['feed_video'];
		}
		$userFeed->status = 1;
		$userFeed->created_at = date("Y-m-d H:i:s");
		
		if($userFeed->save(false)){
			return $userFeed;
		}else{
			return '0';
		}
	}
	public function testNotificationI($token)
	{
		//echo $token;
			$pemfile = "pushcert.pem";
			$passphrase = "";
			$deviceToken = "$token";
			//$basepath = Yii::app()->basePath;
			//$basepath = "http://demo.magespider.com/errandz/test/$pemfile";
			$basepath = dirname(Yii::app()->request->scriptFile).'/'.$pemfile;
		//	echo $basepath;
			$ctx = stream_context_create();
			stream_context_set_option($ctx, 'ssl', 'local_cert', $basepath);
			stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
			
			$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
			//$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
			//print_r($fp);
			if (!$fp)
			exit("Failed to connect: $err $errstr" . PHP_EOL);
		//	echo 'Connected to APNS' . PHP_EOL;
			
			$body['aps'] = array(
				'alert' => 'hello test from backend',
				'screen' => '2',
				'fromuser' => 'test user',
				'badge' => 3,
				'activity_id' => 1,
				'sound' => 'default'
			);
			$payload = json_encode($body);
			$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
			$result = fwrite($fp, $msg, strlen($msg));
			fclose($fp);
			print_r($result);
			$json = array("status" => 1, "msg" => "Message has been sent.", "isExclusive" => "0");
			echo json_encode($json, JSON_UNESCAPED_SLASHES);
			//echo $result;
		
	
	}
	public function testNotificationA($token)
	{
			$regID   = $token;
			$apiKey	 = "AIzaSyBHllbJP4gFZmmmZef10YMS7Zw1scONp4E";
			// Set POST variables
			$url = 'https://fcm.googleapis.com/fcm/send';
			$json = array("msg" => "hello test",  "screen" => "2", "fromuser"=>'test user'); 
			$pushmessage = json_encode($json, JSON_UNESCAPED_SLASHES);
			$fields = array(
							'registration_ids'  => array($regID),
							'data'              => array( "message" => $pushmessage ),
							);
			
			$headers = array( 
								'Authorization: key=' .$apiKey ,
								'Content-Type: application/json'
							);
			// Open connection
			$ch = curl_init();
			
			// Set the url, number of POST vars, POST data
			curl_setopt( $ch, CURLOPT_URL, $url );
			curl_setopt( $ch, CURLOPT_POST, true );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			
			// Disabling SSL Certificate support temporarly
    	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
			curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
			
			// Execute post
			$result = curl_exec($ch);
			print_r($result);
			// Close connection
			curl_close($ch); 
		
	
	}
	public function sendNotification($deviceId,$deviceType,$message,$screen,$fromuser,$unreadcount,$actid)
	{
	
		
 		if($deviceId!="" && $deviceId!="0" && $deviceType!="" && $deviceType!="0")
		{
			
				if($deviceType == "1") // iPhone
				{
					//$pemfile = "WaveDeveloperPush.pem";
					//$pemfile = "Wave5DistriPush.pem"; 	
				//	$pemfile = "Wave5DeveloperPush.pem";
					$pemfile = "pushDevCert.pem"; 
				
					$passphrase = "123456";
					$deviceToken = "$deviceId";
					$title = "Osnap";

					if($screen==1)
					{
						$title = "Explore snap";
					}
					//$basepath = Yii::app()->basePath;
					//$basepath = "http://demo.magespider.com/errandz/test/$pemfile";
					try {
						$basepath = dirname(Yii::app()->request->scriptFile).'/'.$pemfile;
					//	echo $basepath;
						$ctx = stream_context_create();
						stream_context_set_option($ctx, 'ssl', 'local_cert', $basepath);
						stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
						//$fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
						$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
						//if (!$fp)
						//exit("Failed to connect: $err $errstr" . PHP_EOL);
						//echo 'Connected to APNS' . PHP_EOL;
						//$unreadcount = $unreadcount + 1;
						$body['aps'] = array(
							"alert" => array(
							    "title" => $title,
							    "body" => $message
							  ),
							//'alert' => $message,
							'screen' => $screen,
							'fromuser' => $fromuser,
							'badge' => (int)$unreadcount,
							'activity_detail_id' => $actid,
							'sound' => 'default'
						);
						//print_r($body);
						$payload = json_encode($body);
						$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
						
						$result = fwrite($fp, $msg, strlen($msg));
						//print_r($result);
						//print_r($fp);
						fclose($fp);
					//	
						
					}
					 catch (Exception $e) {
					   // echo 'Caught exception: ',  $e->getMessage(), "\n";
					}
					
					
					//$json = array("status" => 1, "msg" => "Message has been sent.", "isExclusive" => "0");
					//echo json_encode($json, JSON_UNESCAPED_SLASHES);
				}
				else if($deviceType == "2")
				{
					$regID   = $deviceId;
					//$apiKey	 = "AIzaSyBx5D7OYtZqV8e0ywe1vBZE4hFsPj255h4";
					//$apiKey	 = "AIzaSyAXol6NZqZ8IHY37sUjz3RLItkS4fIkYLE";
					$apiKey	 = "AIzaSyBbDidg5k4Z9d5O32Ui4ZDsAcNSRD9Gp3Y";
					
					// Set POST variables
					//$url = 'https://android.googleapis.com/gcm/send';.
					$url = 'https://fcm.googleapis.com/fcm/send';
					//{"message":{"msg":"ekta Following you","screen":"1","fromuser":"15"}}
					//{"data":{"title":"Wave","message":"ekta Following you","timestamp":"2016-10-26 7:00:08"}}
					$json = array("title"=>"Victrips","message" => "$message","activity_detail_id" => "$actid",  "timestamp"=>date('Y-m-d H:i:s')); 
					$pushmessage = json_encode($json, JSON_UNESCAPED_SLASHES);
					$fields = array(
									'registration_ids'  => array($regID),
									'data'              => array( "data" => $pushmessage ),
									);
					
					$headers = array( 
										'Authorization: key=' .$apiKey ,
										'Content-Type: application/json'
									);
					// Open connection
					try {
						$ch = curl_init();
						
						// Set the url, number of POST vars, POST data
						curl_setopt( $ch, CURLOPT_URL, $url );
						curl_setopt( $ch, CURLOPT_POST, true );
						curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
						curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
						
						// Disabling SSL Certificate support temporarly
	    	  			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    	    
						curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
					
						// Execute post
						$result = curl_exec($ch);
						curl_close($ch);
					}
					 catch (Exception $e) {
					   // echo 'Caught exception: ',  $e->getMessage(), "\n";
					}
					
				//	echo "hello";
				//	print_r($result);
					// Close connection
					
				
				}
		}
		
	}
}