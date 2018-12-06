<?php
//session_start();
class IndexController extends Controller
{
	public function actionIndex()
	{
		//$session = Yii::app()->session;
		//print_r($session);die;
		$this->layout='login';
		$this->render('index');
	}
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->getBaseUrl(TRUE).'/admin');
	}
	
	public function actionLogin_process()
	{
		//print_r($_POST); die();
			
		if (isset($_POST['admin_submit'])) {
			 
			 $username = $_POST['admin_name'];
			 $password = $_POST['admin_password'];

			 $user = AdminLogin::model()->find(array('condition' => "admin_name = '$username'"));
			
			if(!empty($user)){
				if ($user->admin_password == md5($password)) {
				    Yii::app()->session['admin_name'] = $user->admin_name;
				    Yii::app()->session['admin_id'] = $user->admin_id;
				    if($user->admin_pro_pic != ""){
				    	Yii::app()->session['admin_pro_pic'] = $user->admin_pro_pic;
				    }else{
				     	Yii::app()->session['admin_pro_pic'] = "ProfilePic1.jpg";
				    }
			  	    $this->redirect(Yii::app()->getBaseUrl(TRUE).'/admin/dashboard');  
				} else {
					Yii::app()->session['loginfail'] = 'Username and Password Invalid';
					$this->redirect(Yii::app()->getBaseUrl(TRUE).'/admin');  
				}	
			}else{
				Yii::app()->session['loginfail'] = 'Username and Password Invalid';
				$this->redirect(Yii::app()->getBaseUrl(TRUE).'/admin');
			}
		}
	}
}