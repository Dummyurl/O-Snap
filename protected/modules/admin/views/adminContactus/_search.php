<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'contact_id'); ?>
		<?php echo $form->textField($model, 'contact_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'contact_fname'); ?>
		<?php echo $form->textField($model, 'contact_fname', array('maxlength' => 50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'contact_lname'); ?>
		<?php echo $form->textField($model, 'contact_lname', array('maxlength' => 50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'contact_email'); ?>
		<?php echo $form->textField($model, 'contact_email', array('maxlength' => 50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'contact_phone'); ?>
		<?php echo $form->textField($model, 'contact_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'contact_msg'); ?>
		<?php echo $form->textField($model, 'contact_msg', array('maxlength' => 500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'contact_file'); ?>
		<?php echo $form->textArea($model, 'contact_file'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'status'); ?>
		<?php echo $form->dropDownList($model, 'status', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
