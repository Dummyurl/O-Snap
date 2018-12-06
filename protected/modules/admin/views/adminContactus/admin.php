
<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
		array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('admin-contactus-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>

<!--<p>
You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done.
</p>-->

<?php //echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php //$this->renderPartial('_search', array('model' => $model,)); ?>
<!--</div>--><!-- search-form -->
<div class="table-responsive">
	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id' => 'admin-contactus-grid',
		'dataProvider' => $model->search(),
		'filter' => $model,
		'columns' => array(
			'contact_id',
			'contact_fname',
			'contact_lname',
			'contact_email',
			'contact_phone',
			'contact_msg',
			/*
			'contact_file',
			array(
						'name' => 'status',
						'value' => '($data->status === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
						'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
						),
			*/
			array(
				'header' => 'Operations',
				'class' => 'CButtonColumn',
			),
		),
	)); ?>
</div>	