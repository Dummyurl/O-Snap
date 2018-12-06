<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('admin')),
	/*array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create')),
	array('label'=>'Update Category', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Category', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Category', 'url'=>array('admin')),*/
);
?>

<h1>View Category #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',		
		'parent',
		/*'image',*/
    array(
		   'name' => 'image',
		   'type' => 'raw',
		   'value' => CHtml::image(Yii::app()->getBaseUrl(true) . "/upload/image/" . (!empty($model->image)? $model->image : "noimage.png")," Image",array("width"=>70,"class" => "userimg")),
		   'filter' => false,
		),
		'is_active',
	),
)); ?>
