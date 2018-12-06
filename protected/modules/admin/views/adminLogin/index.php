<?php
/* @var $this AdminLoginController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Admin Logins',
);

$this->menu=array(
	array('label'=>'Create AdminLogin', 'url'=>array('create')),
	array('label'=>'Manage AdminLogin', 'url'=>array('admin')),
);
?>

<h1>Admin Logins</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
