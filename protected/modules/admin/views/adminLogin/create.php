<?php
/* @var $this AdminLoginController */
/* @var $model AdminLogin */

$this->breadcrumbs=array(
	'Admin Logins'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AdminLogin', 'url'=>array('index')),
	array('label'=>'Manage AdminLogin', 'url'=>array('admin')),
);
?>

<h1>Create AdminLogin</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>