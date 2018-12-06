<?php
/* @var $this AdminLoginController */
/* @var $model AdminLogin */

$this->breadcrumbs=array(
	'Admin Logins'=>array('index'),
	$model->admin_id=>array('view','id'=>$model->admin_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AdminLogin', 'url'=>array('index')),
	array('label'=>'Create AdminLogin', 'url'=>array('create')),
	array('label'=>'View AdminLogin', 'url'=>array('view', 'id'=>$model->admin_id)),
	array('label'=>'Manage AdminLogin', 'url'=>array('admin')),
);
?>

<h1>Update AdminLogin <?php echo $model->admin_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>