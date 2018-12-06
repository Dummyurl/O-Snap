<?php

class BusinessCategoryController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'BusinessCategory'),
		));
	}

	public function actionCreate() {
		$model = new BusinessCategory;


		if (isset($_POST['BusinessCategory'])) {
			$model->setAttributes($_POST['BusinessCategory']);

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
		$model = $this->loadModel($id, 'BusinessCategory');


		if (isset($_POST['BusinessCategory'])) {
			$model->setAttributes($_POST['BusinessCategory']);

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
			$this->loadModel($id, 'BusinessCategory')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('BusinessCategory');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new BusinessCategory('search');
		$model->unsetAttributes();

		if (isset($_GET['BusinessCategory']))
			$model->setAttributes($_GET['BusinessCategory']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}