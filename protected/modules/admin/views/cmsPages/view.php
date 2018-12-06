<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	/*array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('admin')),*/
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->page_id)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->page_id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'page_id',
'page_name',
'page_description',
/*array(
            'type'=>'raw',
            'width'=>'200',
            'alt'=>'Coupen images',
            'value'=> CHtml::image( Yii::app()->getBaseUrl(true).'/upload/image/'.$model->image,"image",array("width"=>200)),
        ),*/
array(
   'name' => 'image',
   'type' => 'raw',
   'value' => CHtml::image(Yii::app()->getBaseUrl(true) . "/upload/image/" . (!empty($model->image)? $model->image : "noimage.png")," Image",array("width"=>70,"class" => "userimg")),
   'filter' => false,
),
'page_title',
'is_active:boolean',
	),
)); ?>

