<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('noti_key')); ?>:
	<?php echo GxHtml::encode($data->noti_key); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('noti_eng')); ?>:
	<?php echo GxHtml::encode($data->noti_eng); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('noti_other')); ?>:
	<?php echo GxHtml::encode($data->noti_other); ?>
	<br />

</div>