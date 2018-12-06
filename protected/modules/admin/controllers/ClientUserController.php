<?php

class ClientUserController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'ClientUser'),
		));
	}

	public function actionCreate() {
		$model = new ClientUser;


		if (isset($_POST['ClientUser'])) {
			$model->setAttributes($_POST['ClientUser']);

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
		$model = $this->loadModel($id, 'ClientUser');


		if (isset($_POST['ClientUser'])) {
			$model->setAttributes($_POST['ClientUser']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}
	
	public function actionmultipaldelete(){
		//print_r($_POST);
		$autoIdAll = $_POST['idList'];
		//p($autoIdAll);
		$IdAll = (explode(",",$autoIdAll));
		//p($IdAll);
  		foreach($IdAll as $autoId)
    	{
    		$this->loadModel($autoId, 'ClientUser')->delete();
    	}
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'ClientUser')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('ClientUser');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new ClientUser('search');
		$model->unsetAttributes();

		if (isset($_GET['ClientUser']))
			$model->setAttributes($_GET['ClientUser']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}