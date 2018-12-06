<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('contact_id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->contact_id), array('view', 'id' => $data->contact_id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('contact_fname')); ?>:
	<?php echo GxHtml::encode($data->contact_fname); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('contact_lname')); ?>:
	<?php echo GxHtml::encode($data->contact_lname); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('contact_email')); ?>:
	<?php echo GxHtml::encode($data->contact_email); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('contact_phone')); ?>:
	<?php echo GxHtml::encode($data->contact_phone); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('contact_msg')); ?>:
	<?php echo GxHtml::encode($data->contact_msg); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('contact_file')); ?>:
	<?php echo GxHtml::encode($data->contact_file); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />
	*/ ?>

</div>