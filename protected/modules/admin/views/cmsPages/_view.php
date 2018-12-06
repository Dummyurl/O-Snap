<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('page_id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->page_id), array('view', 'id' => $data->page_id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('page_name')); ?>:
	<?php echo GxHtml::encode($data->page_name); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('page_description')); ?>:
	<?php echo GxHtml::encode($data->page_description); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('image')); ?>:
	<?php echo CHtml::image(Yii::app()->baseUrl."/upload/image/".$model->image.$data->image,$data->im‌​age , array(
      'style' => 'max-height:40px',// set all sorts of styles here
      'class' => 'someClass',
 ));  ?> 
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('page_title')); ?>:
	<?php echo GxHtml::encode($data->page_title); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('is_active')); ?>:
	<?php echo GxHtml::encode($data->is_active); ?>
	<br />

</div>