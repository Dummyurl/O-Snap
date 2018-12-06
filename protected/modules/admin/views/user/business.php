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
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>

<?php //echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<!--<div class="search-form">
<?php /*$this->renderPartial('_search', array(
	'model' => $model,
));*/ ?>
</div>--><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'user-grid',
	'dataProvider' => $model->search(2),
	'filter' => $model,
	'columns' => array(
		//'id',
		'osnap_id',
		//'business_osnap_id',
		/*array(
		   'name' => 'user_type',
		   'value' => 'GlobalFunction::getUserType($data->user_type)',
		   //'filter'=> array(1=>"User",2=>"Business"),
		),*/
		'first_name',
		'last_name',
		'username',
		'phone',
		'email',
		'city',
		'country',
		/*'status',*/
		/*
		'first_name',
		'last_name',
		'birth_date',
		'country_code',
		'phone',
		'city',
		'state',
		'country',
		'post_code',
		'address',
		'latitude',
		'longtitude',
		'user_type',
		'parent_user',
		'business_name',
		'business_type',
		'business_category',
		'business_owner',
		'business_image',
		'auth_id',
		'auth_provider',
		'token',
		'created_at',
		'device_type',
		'device_token',
		'activation_code',
		'forget_pass_code',
		'base',
		array(
			'name' => 'is_active',
			'value' => '($data->is_active === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
			'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
			),
		array(
			'name' => 'is_agree',
			'value' => '($data->is_agree === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
			'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
			),
		*/
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>