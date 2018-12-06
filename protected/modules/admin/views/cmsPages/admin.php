<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
		/*array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('admin')),*/
		array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cms-pages-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>



<?php /*?><?php echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form --><?php */?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'cms-pages-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		//'page_id',
		'page_name',
		//'page_description',
		/*array(
			  'name' => 'image',	
              'type' => 'raw',
              'value' => 'CHtml::image(Yii::app()->getBaseUrl(true) . "/upload/image/" . $data->image,"image",array("width"=>80))'

           ),*/
           array(
		   'name' => 'image',
		   'type' => 'raw',
		   'value' => 'CHtml::image(Yii::app()->getBaseUrl(true) . "/upload/image/" . (!empty($data->image)? $data->image: "noimage.png"),"image",array("width"=>80,"class" => "userimg"))',
		   'filter' => false,
		),
		'page_title',
		array(
					'name' => 'is_active',
					'value' => '($data->is_active === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>