<?php

class UserController extends GxController {


	public function actionView($id) {
		$deposit=PostJob::model()->findAllByAttributes(array('user_id'=>$id));
		$user_detail= $this->loadModel($id, 'User');
        $criteria = new CDbCriteria;
		$criteria->compare('is_offer', 1);
		$criteria->compare('post_id', 0);
		if($user_detail->user_type==1){
			$criteria->compare('offer_by', $id);
		}
		elseif($user_detail->user_type==2){
			$criteria->compare('bid_by', $id);
		}
		$postbid = PostBid::model()->findAll($criteria);
		$this->render('view', array( 
			'model' => $this->loadModel($id, 'User'),'deposit'=>$deposit,'postbid'=>$postbid));
	}
	
	public function actionPostView($id)
	{
		$this->layout='header';
		$post = Yii::app()->db->createCommand();
		$post->select("*");
		$post->from("post_job");
	    $post->where('post_id='.$id);
		$deposit = $post->queryRow();
		$userbid = Yii::app()->db->createCommand();
		$userbid->select("*");
		$userbid->from("post_job");
		$userbid->leftJoin('post_bid','post_job.post_id=post_bid.post_id');
		$userbid->join('user', 'user.id=post_job.user_id');
		$userbid->andwhere('post_job.post_id='.$id);
		
		/*$userbid->from("user");
		$userbid->leftJoin('post_bid', 'post_bid.offer_by=user.id');
		$userbid->leftJoin('post_job', 'post_job.post_id=post_bid.post_id');
		$userbid->where('post_job.post_id='.$id);*/
		$userbidDetail = $userbid->queryAll();
		
		$this->render('PostView', array('deposit'=>$deposit,'postbidDetail'=>$postbidDetail,'userbidDetail'=>$userbidDetail));
	}
	
    public function actionPostbidView($id){
		$this->layout='header';
		$postbid = Yii::app()->db->createCommand();
		$postbid->select("*");
		$postbid->from("post_bid");
	    $postbid->where('pb_id ='.$id);
		$despostbid = $postbid->queryRow();
		$this->render('PostbidView', array('despostbid'=>$despostbid));
	}
	
	public function actionCreate() {
		$model = new User;
		if (isset($_POST['User'])) {
			$model->setAttributes($_POST['User']);
			if(CUploadedFile::getInstance($model,'image') != "") {
    				   $rnd = GlobalFunction::get_random_number();
			           $uploadedFile=CUploadedFile::getInstance($model,'image');
			           $fileName =  "{$rnd}_{$uploadedFile}";  // random number + file name
			           $fileName = GlobalFunction::srt_replace($fileName);
			     $uploadedFile->saveAs(Yii::app()->basePath.'/../upload/image/'.$fileName);
			     $model->image = $fileName;
			    }
			if(CUploadedFile::getInstance($model,'business_image') != "") {
			   $rnd = GlobalFunction::get_random_number();
		           $uploadedFile=CUploadedFile::getInstance($model,'business_image');
		           $fileName =  "{$rnd}_{$uploadedFile}";  // random number + file name
		           $fileName = GlobalFunction::srt_replace($fileName);
		     $uploadedFile->saveAs(Yii::app()->basePath.'/../upload/image/'.$fileName);
		     $model->business_image = $fileName;
		    }
		    if(isset($_POST['business_type'])&& $_POST['business_type']!=''){
				$model->business_type=$_POST['business_type'];
			}
			if(isset($_POST['user_type'])&& $_POST['user_type']!=''){
				$model->user_type=$_POST['user_type'];
			}
			if(isset($_POST['business_category'])&& $_POST['business_category']!=''){
				$model->business_category=$_POST['business_category'];
			}
			    
			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'User');
		$_model = $this->loadModel($id, 'User');
		
        if (isset($_POST['User'])) {
			$model->setAttributes($_POST['User']);
			if(CUploadedFile::getInstance($model,'image') != "") {
			   $rnd = GlobalFunction::get_random_number();
		           $uploadedFile=CUploadedFile::getInstance($model,'image');
		           $fileName =  "{$rnd}_{$uploadedFile}";  // random number + file name
		           $fileName = GlobalFunction::srt_replace($fileName);
		           $uploadedFile->saveAs(Yii::app()->basePath.'/../upload/image/'.$fileName);
		           $model->image = $fileName;
		    }else{
				$model->image =$_model->image;
			}
			if(CUploadedFile::getInstance($model,'business_image') != "") {
			   $rnd = GlobalFunction::get_random_number();
		           $uploadedFile=CUploadedFile::getInstance($model,'business_image');
		           $fileName =  "{$rnd}_{$uploadedFile}";  // random number + file name
		           $fileName = GlobalFunction::srt_replace($fileName);
		           $uploadedFile->saveAs(Yii::app()->basePath.'/../upload/image/'.$fileName);
		           $model->business_image = $fileName;
		    }else{
				$model->business_image =$_model->business_image;
			}
			if(isset($_POST['business_type'])){
					$model->business_type=$_POST['business_type'];
				}
			if(isset($_POST['user_type'])){
					$model->user_type=$_POST['user_type'];
				}
			if(isset($_POST['business_category'])){
					$model->business_category=$_POST['business_category'];
				}
			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		/*if (Yii::app()->getRequest()->getIsPostRequest()) {*/
			
		/*}  
		else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));*/
			if (Yii::app()->controller->action->id) {
			$this->loadModel($id, 'User')->delete();
			if (!Yii::app()->getRequest()->getIsAjaxRequest())
			if (strpos(Yii::app()->request->urlReferrer, 'business') !== false) {
			    $this->redirect(array('business'));
			}else{
				$this->redirect(array('admin'));
			}
		}  
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('User');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new User('search');
		$model->unsetAttributes();

		if (isset($_GET['User']))
			$model->setAttributes($_GET['User']);

		$this->render('admin', array(
			'model' => $model,
		));
	}
	public function actionbusiness() {
		$model = new User('search');
		$model->unsetAttributes();

		if (isset($_GET['User']))
			$model->setAttributes($_GET['User']);

		$this->render('business', array(
			'model' => $model,
		));
	}

}