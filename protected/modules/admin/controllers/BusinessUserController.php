<?php

class BusinessUserController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'BusinessUser'),
		));
	}

	public function actionCreate() {
		$model = new BusinessUser;


		if (isset($_POST['BusinessUser'])) {
			$model->setAttributes($_POST['BusinessUser']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}
	
	public function actionmultipaldelete(){
		//print_r($_POST);
		$autoIdAll = $_POST['idList'];
		//p($autoIdAll);
		$IdAll = (explode(",",$autoIdAll));
		//p($IdAll);
  		foreach($IdAll as $autoId)
    	{
    		$this->loadModel($autoId, 'BusinessUser')->delete();
    	}
	}
	
	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'BusinessUser');


		if (isset($_POST['BusinessUser'])) {
			$model->setAttributes($_POST['BusinessUser']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'BusinessUser')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('BusinessUser');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new BusinessUser('search');
		$model->unsetAttributes();

		if (isset($_GET['BusinessUser']))
			$model->setAttributes($_GET['BusinessUser']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}