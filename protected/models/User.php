<?php

Yii::import('application.models._base.BaseUser');

class User extends BaseUser
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}


	public static function RegisterVerificationMail($email,$firstname,$activation_code){

		// Send Email Verification Mail
		//$verifyLink = Yii::app()->getBaseUrl(true).'/index/thankyou?id='.$activation_code;
		$date = date('d F Y');
		$homeurl = Yii::app()->getBaseUrl(true);
		$body = '<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<title>Welcome To Osnap</title>
       </head><body style="font-family:Arial, Helvetica, sans-serif; margin:0; padding:0; background:#7FB23D; ">
       <table style="width:800px; margin:0 auto; padding:0px 20px 0 20px;">
     	  <tr>
     		  <td style="text-align:center; padding:30px 0 0px 0; width:150px">
              <a href="'.$homeurl.'"><img src="'.$homeurl.'/images/logo-white.png" style="float: left;padding: 13px 0;width: 150px;"/></a>
             <span style="float: right; margin-top: 25px; background: #fff; padding: 15px; border-radius: 5px;">'.$date.'</span>
              </td>
     	  </tr>     	 
     	  <tr style="padding: 35px 0px; background: #fff; float: left; width: 100%; border-radius: 5px 0px 5px 5px; margin-top: -5px;">
     		  <td>
     			  <table>
     				  <tbody>
                      <tr>
     					  <td style="color: #7fb23d; font-size: 36px; padding: 0 24px;">Confirmation Code</td>
     				  </tr>
     				  <tr style="width:100%">
     					  <td style="font-size:20px;color:#8D8D8D;padding:21px 0 10px 40px">Dear '.$firstname.',</td> 		
     				  </tr>
     				  <tr style="width:100%">
     					  <td style="padding:11px 0 11px 40px;font-size:16px;color:#8D8D8D;">
     						Thank you for registering with Osnap.
     					  </td>
     				  </tr>
     				  <tr style="width:100%">
     					  <td style="padding:11px 0 11px 40px;font-size:16px;color:#8D8D8D;">
     						  Please enter the following confirmation code to complete your registration.
     					  </td>
     				  </tr>
                      <tr>
                          <td style="text-align:center; color: #7fb23d; font-size: 36px;padding:10px 0px; text-transform:uppercase">'.$activation_code.'<td>
                      </tr>
     				  <tr>
     					  <td style="font-size:16px;line-height:20px;color:#8D8D8D;  font-weight: 800;padding:50px 0 0 40px">
     						  Regards,<br><br>
     						  <strong style="color:#45af54; padding:10px 0 0 0px;">Osnap Team</strong>
     					  </td>
     				  </tr>
     			  </tbody></table>
     		  </td>                
     	  </tr>  
     	  <tr>
     		  <td style="text-align:center; color:#d9e8ca;padding:10px 0px;">
     			  <a href="www.Osnap.com" style="color:#d9e8ca;">Privacy Policy</a> | 
     			  <a href="www.Osnap.com" style="color:#d9e8ca;">Terms & Conditions</a>
     		  </td>
     	  </tr>
          <tr>
     		  <td style="font-size:11px; color:#d9e8ca; font-weight:normal; text-transform:uppercase; text-align:center; padding:14px 0; ">Copyright © 2018 Osnap. All Rights Reserved. 86-90 Paul Street, London, EC2A 4NE</td>
     	  </tr>
     	   <tr>
     		  <td style="text-align:center; color:#d9e8ca;padding:10px 0px;">
     			  <a href="https://www.Osnap.com" style="color:#d9e8ca;">www.Osnap.com</a> | 
     			  <a href="mailto:info@Osnap.com" style="color:#d9e8ca;">info@Osnap.com</a>
     		  </td>
     	  </tr>    
       </table>
       </body>
       </html>';
		$headers='MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html;charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Osnap <no-reply@Osnap.com>' . "\r\n";
		$to = $email;
		$subject = "Confirmation Code";
		$mail = mail($to, $subject, $body, $headers);
	}
	


    public static function PaymentRequestMail($email,$username,$message){

    // Send Email Verification Mail
    //$verifyLink = Yii::app()->getBaseUrl(true).'/index/thankyou?id='.$activation_code;
    $date = date('d F Y');
    $homeurl = Yii::app()->getBaseUrl(true);
    $body = '<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<title>Welcome To Osnap</title>
       </head><body style="font-family:Arial, Helvetica, sans-serif; margin:0; padding:0; background:#7FB23D; ">
       <table style="width:800px; margin:0 auto; padding:0px 20px 0 20px;">
        <tr>
          <td style="text-align:center; padding:30px 0 0px 0; width:150px">
              <a href="'.$homeurl.'"><img src="'.$homeurl.'/images/logo-white.png" style="float: left;padding: 13px 0;width: 150px;"/></a>
             <span style="float: right; margin-top: 25px; background: #fff; padding: 15px; border-radius: 5px;">'.$date.'</span>
              </td>
        </tr>        
        <tr style="padding: 35px 0px; background: #fff; float: left; width: 100%; border-radius: 5px 0px 5px 5px; margin-top: -5px;">
          <td>
            <table>
              <tbody>
                      <tr>
                <td style="color: #7fb23d; font-size: 36px; padding: 0 24px;">Payment Request </td>
              </tr>
              <tr style="width:100%">
                <td style="font-size:20px;color:#8D8D8D;padding:21px 0 10px 40px">Dear '.$username.',</td>     
              </tr>
             
              <tr style="width:100%">
                <td style="padding:11px 0 11px 40px;font-size:16px;color:#8D8D8D;">
                  '.$message.'
                </td>
              </tr>
                      <tr>
                          <td style="text-align:center; color: #7fb23d; font-size: 36px;padding:10px 0px; text-transform:uppercase">'."".'<td>
                      </tr>
              <tr>
                <td style="font-size:16px;line-height:20px;color:#8D8D8D;  font-weight: 800;padding:50px 0 0 40px">
                  Regards,<br><br>
                  <strong style="color:#45af54; padding:10px 0 0 0px;">Osnap Team</strong>
                </td>
              </tr>
            </tbody></table>
          </td>                
        </tr>  
        <tr>
          <td style="text-align:center; color:#d9e8ca;padding:10px 0px;">
            <a href="www.Osnap.com" style="color:#d9e8ca;">Privacy Policy</a> | 
            <a href="www.Osnap.com" style="color:#d9e8ca;">Terms & Conditions</a>
          </td>
        </tr>
          <tr>
          <td style="font-size:11px; color:#d9e8ca; font-weight:normal; text-transform:uppercase; text-align:center; padding:14px 0; ">Copyright © 2018 Osnap. All Rights Reserved. 86-90 Paul Street, London, EC2A 4NE</td>
        </tr>
         <tr>
          <td style="text-align:center; color:#d9e8ca;padding:10px 0px;">
            <a href="https://www.Osnap.com" style="color:#d9e8ca;">www.Osnap.com</a> | 
            <a href="mailto:info@Osnap.com" style="color:#d9e8ca;">info@Osnap.com</a>
          </td>
        </tr>    
       </table>
       </body>
       </html>';
    $headers='MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html;charset=iso-8859-1' . "\r\n";
    $headers .= 'From: Osnap <no-reply@Osnap.com>' . "\r\n";
    $to = $email;
    $subject = "Payment Request";
    $mail = mail($to, $subject, $body, $headers);
  }
  
	
	public static function sendWelcomeMail($email,$pin,$uid){
		$firstname = UserDetail::getUserName($uid);
		// Send Email Verification Mail
		//$verifyLink = Yii::app()->getBaseUrl(true).'/index/thankyou?id='.$activation_code;
		$date = date('d F Y');
		$homeurl = Yii::app()->getBaseUrl(true);
		$body = '<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<title>Welcome To Osnap</title>
       </head><body style="font-family:Arial, Helvetica, sans-serif; margin:0; padding:0; background:#7FB23D; ">
       <table style="width:800px; margin:0 auto; padding:0px 20px 0 20px;">
     	  <tr>
     		  <td style="text-align:center; padding:30px 0 0px 0; width:150px">
              <a href="'.$homeurl.'"><img src="'.$homeurl.'/images/logo-white.png" style="float: left;padding: 13px 0;width: 150px;"/></a>
             <span style="float: right; margin-top: 25px; background: #fff; padding: 15px; border-radius: 5px;">'.$date.'</span>
              </td>
     	  </tr>
     	  <tr style="padding: 35px 0px; background: #fff; float: left; width: 100%; border-radius: 5px 0px 5px 5px; margin-top: -5px;">
     		  <td>
     			  <table>
     				  <tbody>
                      <tr>
     					  <td style="color: #7fb23d; font-size: 36px; padding: 0 24px;">Welcome</td>
     				  </tr>
     				  <tr style="width:100%">
     					  <td style="font-size:20px;color:#8D8D8D;padding:21px 0 10px 40px">Dear '.$firstname.',</td> 		
     				  </tr>
     				  <tr style="width:100%">
     					  <td style="padding:11px 0 11px 40px;font-size:16px;color:#8D8D8D;">
     						Thank you for completing your registration with Osnap. Your unique PIN is <a href="www.Osnap.com" style="color:#7FB23D; font-weight: 800;text-transform:uppercase;">'.$pin.'</a>
     					  </td>
     				  </tr>
     				  <tr style="width:100%">
     					  <td style="padding:11px 40px;font-size:16px;color:#8D8D8D;line-height: 25px;">
     						  Osnap is changing the way we traditionally exchange business cards by providing you with a mobile platform to store all your connections on. 
                              We aim to provide you with a tool to increase the size of your network through our discover feature, as well as improve your working efficiency 
                              with colleagues through shared calendar and reminder entries and more.
     					  </td>
     				  </tr>
                      <tr style="width:100%">
     					  <td style="padding:11px 40px;font-size:16px;color:#8D8D8D;line-height: 25px;">
     						  We are always looking for ways to improve the app and would very much appreciate your initial feedback so that we can improve the user experience in the near future. 
                              We have already started working on additional features which we aim to release later this year. We please ask that you send all feedback to feedback@Osnap.com.
     					  </td>
     				  </tr>
                      <tr style="width:100%">
     					  <td style="padding:11px 40px;font-size:16px;color:#8D8D8D;line-height: 25px;">
     						 Welcome to our community and stay tuned for further updates.
     					  </td>
     				  </tr>                    
     				  <tr>
     					  <td style="font-size:16px;line-height:20px;color:#8D8D8D;  font-weight: 800;padding:50px 0 0 40px">
     						  Regards,<br><br>
     						  <strong style="color:#45af54; padding:10px 0 0 0px;">The Osnap Team</strong>
     					  </td>
     				  </tr>
     			  </tbody></table>
     		  </td>                
     	  </tr>  
     	  <tr>
     		  <td style="text-align:center; color:#d9e8ca;padding:10px 0px;">
     			  <a href="www.Osnap.com" style="color:#d9e8ca;">Privacy Policy</a> | 
     			  <a href="www.Osnap.com" style="color:#d9e8ca;">Terms & Conditions</a>
     		  </td>
     	  </tr>
          <tr>
     		  <td style="font-size:11px; color:#d9e8ca; font-weight:normal; text-transform:uppercase; text-align:center; padding:14px 0; ">Copyright © 2018 Osnap Ltd. All Rights Reserved.</td>
     	  </tr>
     	   <tr>
     		  <td style="text-align:center; color:#d9e8ca;padding:10px 0px;">
     			  <a href="https://www.Osnap.com" style="color:#d9e8ca;">www.Osnap.com</a> | 
     			  <a href="mailto:info@Osnap.com" style="color:#d9e8ca;">info@Osnap.com</a>
     		  </td>
     	  </tr>    
       </table>
       </body>
       </html>';
		$headers='MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html;charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Osnap<no-reply@Osnap.com>' . "\r\n";
		$to = $email;
		$subject = "Welcome to Osnap";
		$mail = mail($to, $subject, $body, $headers);
	}
	
	public static function resendCode($country_code,$phoneno,$lang_type){
		$ch = curl_init();
		$phone =  $country_code.$phoneno;
		$type = $lang_type;
				
		
			 $msg = $this->GetNotification("geoverification",$type). $activation_code;
		
		
		//$msg = 'Your Wave verify code is '.$activation_code;
		curl_setopt($ch, CURLOPT_URL, Yii::app()->request->hostInfo.Yii::app()->baseUrl."/sms.php");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,"phone=$phone&msg=$msg");

		// in real life you should use something like:
		// curl_setopt($ch, CURLOPT_POSTFIELDS, 
		//          http_build_query(array('postvar1' => 'value1')));

		// receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec ($ch);
		//echo $server_output;
		curl_close ($ch);
		//echo $server_output;
		if ($server_output == "1") {
			
			$userRegistration->activation_code = $activation_code;
			$userRegistration->is_active=0;
			
			if($userRegistration->save(false)){
				return $userRegistration->user_id;
			}else{
				return '0';
			}
		} else {
			return '00';			
		}
	}
	public static function RegisterVerificatiLinkonMail($email,$firstname,$activation_code,$user_id){
		$date = date('d F Y');
		$homeurl = Yii::app()->getBaseUrl(true);
		$activationurl = $homeurl.'/activation?activation_code='.$activation_code.'&uid='.$user_id;
		$body = '<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<title>Welcome To Osnap</title>
       </head><body style="font-family:Arial, Helvetica, sans-serif; margin:0; padding:0; background:#7FB23D; ">
       <table style="width:800px; margin:0 auto; padding:0px 20px 0 20px;">
     	  <tr>
     		  <td style="text-align:center; padding:30px 0 0px 0; width:150px">
              <a href="'.$homeurl.'"><img src="'.$homeurl.'/images/logo-white.png" style="float: left;padding: 13px 0;width: 150px;"/></a>
             <span style="float: right; margin-top: 25px; background: #fff; padding: 15px; border-radius: 5px;">'.$date.'</span>
              </td>
     	  </tr>     	 
     	  <tr style="padding: 35px 0px; background: #fff; float: left; width: 100%; border-radius: 5px 0px 5px 5px; margin-top: -5px;">
     		  <td>
     			  <table>
     				  <tbody>
                      <tr>
     					  <td style="color: #7fb23d; font-size: 36px; padding: 0 24px;">Account Activation Link</td>
     				  </tr>
     				  <tr style="width:100%">
     					  <td style="font-size:20px;color:#8D8D8D;padding:21px 0 10px 40px">Dear '.$firstname.',</td> 		
     				  </tr>
     				  <tr style="width:100%">
     					  <td style="padding:11px 0 11px 40px;font-size:16px;color:#8D8D8D;">
     						Thank you for registering with Osnap.
     					  </td>
     				  </tr>
     				  <tr style="width:100%">
     					  <td style="padding:11px 0 11px 40px;font-size:16px;color:#8D8D8D;">
     						  Please click below activation link to complete your registration.
     					  </td>
     				  </tr>
                      <tr>
                          <td style="text-align:center; color: #7fb23d; font-size: 25px;padding:10px 0px;"><a href="'.$activationurl.'">'.$activationurl.'<a><td>
                      </tr>
     				  <tr>
     					  <td style="font-size:16px;line-height:20px;color:#8D8D8D;  font-weight: 800;padding:50px 0 0 40px">
     						  Regards,<br><br>
     						  <strong style="color:#45af54; padding:10px 0 0 0px;">The Osnap Team</strong>
     					  </td>
     				  </tr>
     			  </tbody></table>
     		  </td>                
     	  </tr>  
     	  <tr>
     		  <td style="text-align:center; color:#d9e8ca;padding:10px 0px;">
     			  <a href="www.Osnap.com" style="color:#d9e8ca;">Privacy Policy</a> | 
     			  <a href="www.Osnap.com" style="color:#d9e8ca;">Terms & Conditions</a>
     		  </td>
     	  </tr>
          <tr>
     		  <td style="font-size:11px; color:#d9e8ca; font-weight:normal; text-transform:uppercase; text-align:center; padding:14px 0; ">Copyright © 2018 Osnap Ltd. All Rights Reserved. </td>
     	  </tr>
     	   <tr>
     		  <td style="text-align:center; color:#d9e8ca;padding:10px 0px;">
     			  <a href="https://www.Osnap.com" style="color:#d9e8ca;">www.Osnap.com</a> | 
     			  <a href="mailto:info@Osnap.com" style="color:#d9e8ca;">info@Osnap.com</a>
     		  </td>
     	  </tr>    
       </table>
       </body>
       </html>';
		$headers='MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html;charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Osnap<no-reply@Osnap.com>' . "\r\n";
		$to = $email;
		$subject = "Confirmation Code";
		$mail = mail($to, $subject, $body, $headers);
	}



}