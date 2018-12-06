<?php

$this->breadcrumbs = array(
	MultiLanguage::label(2),
	Yii::t('app', 'Index'),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . MultiLanguage::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . MultiLanguage::label(2), 'url' => array('admin')),
);
?>

<h1><?php echo GxHtml::encode(MultiLanguage::label(2)); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 