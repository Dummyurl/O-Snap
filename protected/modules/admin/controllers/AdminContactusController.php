<?php

class AdminContactusController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'AdminContactus'),
		));
	}

	public function actionCreate() {
		$model = new AdminContactus;
		if (isset($_POST['AdminContactus'])) {
			
			$model->setAttributes($_POST['AdminContactus']);
			//print_r($_FILES);die();
			
			if ($_FILES['AdminContactus']['name']['contact_file'] != "") {
				$rnd =GlobalFunction::get_random_number();  // generate random number between 0-9999
				$uploadedFile = CUploadedFile::getInstance($model,'contact_file');
				$fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
				$uploadedFile->saveAs(Yii::app()->basePath.'/../upload/adminContactFile/'.$fileName); 
	            $model->contact_file = $fileName;
	        }
            
			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->contact_id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'AdminContactus');
		$_model = $this->loadModel($id, 'AdminContactus');
		
		if (isset($_POST['AdminContactus'])) {
			$model->setAttributes($_POST['AdminContactus']);
			
			if ($_FILES['AdminContactus']['name']['contact_file'] != "") {
				$rnd =GlobalFunction::get_random_number();  // generate random number between 0-9999
				$uploadedFile = CUploadedFile::getInstance($model,'contact_file');
				$fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
				$uploadedFile->saveAs(Yii::app()->basePath.'/../upload/adminContactFile/'.$fileName); 
				$model->contact_file = $fileName;
			}else{
				$model->contact_file = $_model->contact_file;
				/*echo $_model->contact_file;
				die();*/
			}
            
			if ($model->save(false)) {
				$this->redirect(array('view', 'id' => $model->contact_id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'AdminContactus')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('AdminContactus');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new AdminContactus('search');
		$model->unsetAttributes();

		if (isset($_GET['AdminContactus']))
			$model->setAttributes($_GET['AdminContactus']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}