<div class="view">

	<?php /*echo GxHtml::encode($data->getAttributeLabel('id')); */?><!--:
	<?php /*echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); */?>
	<br />-->

	<?php echo GxHtml::encode($data->getAttributeLabel('title')); ?>:
	<?php echo GxHtml::encode($data->title); ?>
	<br />
	
	<?php echo GxHtml::encode($data->getAttributeLabel('parent')); ?>:
	<?php echo GxHtml::encode($data->parent); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('image')); ?>:
	<?php echo CHtml::image(Yii::app()->baseUrl."/upload/".$model->image, array(
      'style' => 'max-height:40px',// set all sorts of styles here
      'class' => 'someClass',
 ));  ?> 
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('is_active')); ?>:
	<?php echo GxHtml::encode($data->is_active); ?>
	<br />

</div>