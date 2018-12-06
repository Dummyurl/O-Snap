<?php

class MultiLanguageController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'MultiLanguage'),
		));
	}

	public function actionCreate() {
		$model = new MultiLanguage;


		if (isset($_POST['MultiLanguage'])) {
			$model->setAttributes($_POST['MultiLanguage']);

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
		$model = $this->loadModel($id, 'MultiLanguage');


		if (isset($_POST['MultiLanguage'])) {
			$model->setAttributes($_POST['MultiLanguage']);

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
			$this->loadModel($id, 'MultiLanguage')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('MultiLanguage');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new MultiLanguage('search');
		$model->unsetAttributes();

		if (isset($_GET['MultiLanguage']))
			$model->setAttributes($_GET['MultiLanguage']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}