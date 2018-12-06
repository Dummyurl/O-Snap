<?php

class DashboardController extends Controller
{
	public function actionIndex()
	{
		$this->layout='header';
		//this->renderPartial('//admin/layouts/header');
		$this->render('index');
		
	}
	
	public function actionAdmin_reset_password()
	{
		$this->layout='header';
		//this->renderPartial('admin/layouts/header');
		$this->render('admin_reset_password');
	}
	public function actionAdmin_reset_password_process()
	{
		$admin_id =  Yii::app()->session['admin_id'];
		$admin_old_password=$_POST['admin_old_password'];
		$admin_new_password=$_POST['admin_conform_password'];
		$admindata = AdminLogin::model()->find(array('condition' => "admin_id = '$admin_id'"));
		if(!empty($admindata)){
			if($admindata->admin_password == md5($admin_old_password)){
				$admindata->admin_password=md5($admin_new_password);
				$admindata->save(false);
				Yii::app()->session['resetsuccess'] = 'Update Password Successfully';
			 	$this->redirect(Yii::app()->getBaseUrl(TRUE).'/admin/dashboard/admin_reset_password');
			}else{
			 	Yii::app()->session['resetfail'] = 'Old Password Not Match';
			 	$this->redirect(Yii::app()->getBaseUrl(TRUE).'/admin/dashboard/admin_reset_password');
			 }
		}else{
			Yii::app()->session['resetfail'] = 'Old Password Not Match';
			$this->redirect(Yii::app()->getBaseUrl(TRUE).'/admin/dashboard/admin_reset_password');
		}
	}
	public function actionAdmin_pro_pic_edit_process()
	{	
		$admin_id =  Yii::app()->session['admin_id'];
		$admin_record = AdminLogin::model()->findByAttributes(array('admin_id' => $admin_id));
		$rnd = rand(0,99999);
		$profile_pic = CUploadedFile::getInstanceByName('profile_pic');
		$new_profile_pic= $rnd . $profile_pic;
		if($admin_record['admin_pro_pic']!="")
		{
			$del_pro_pic=Yii::app()->basePath.'/../upload/adminProfilePic/' . $admin_record['admin_pro_pic'];
	        unlink($del_pro_pic);
	    }
		$profile_pic->saveAs(Yii::app()->basePath.'/../upload/adminProfilePic/' . $new_profile_pic); //path of folder
		$admin_record->admin_pro_pic = $new_profile_pic;
		$admin_record->save(false);
		Yii::app()->session['admin_pro_pic'] = $admin_record->admin_pro_pic;
		$this->redirect(Yii::app()->getBaseUrl(TRUE).'/admin/dashboard');
		
	}
}