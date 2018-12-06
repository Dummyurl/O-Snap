<?php

class CategoryController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Category'),
		));
	}

	public function actionCreate() {
		$model = new Category;


		if (isset($_POST['Category'])) {
			$rnd = rand(0,9999);  // generate random number between 0-9999
			 
			$model->setAttributes($_POST['Category']);
			
			$uploadedFile=CUploadedFile::getInstance($model,'image');
			if($uploadedFile!="")
			{
				  $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
				  //$fileName = GlobalFunction::srt_replace($fileName);
          		  $model->image = $fileName;
          		  $uploadedFile->saveAs(Yii::app()->basePath.'/../upload/image/'.$fileName);  // 
			}
           else
           {
		   	 $model->image = "";
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
			$model = $this->loadModel($id, 'Category');
		$_model = $this->loadModel($id, 'Category');

		if (isset($_POST['Category'])) {
		    $model->setAttributes($_POST['Category']);
 			$rnd = rand(0,9999);  // generate random number between 0-9999
 			if ($_FILES['Category']['name']['image'] != "") {
	            $uploadedFile=CUploadedFile::getInstance($model,'image');
	            
	            $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
	           // $fileName = GlobalFunction::srt_replace($fileName);
	           
	            if(!empty($uploadedFile))  // check if uploaded file is set or not
	                {
	                	
	                    $uploadedFile->saveAs(Yii::app()->basePath.'/../upload/image/'.$fileName);
	                    $model->image = $fileName;
	                }
			}
			else
			{
				$model->image = $_model->image;
			}
			if ($model->save(false)) {
				// echo "hello world";exit;
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		// if (Yii::app()->getRequest()->getIsPostRequest()) 
		if($id)
		{
			$this->loadModel($id, 'Category')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		}
		else{
			// print_r($id);die();
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
		}
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Category');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Category('search');
		$model->unsetAttributes();

		if (isset($_GET['Category']))
			$model->setAttributes($_GET['Category']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}